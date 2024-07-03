<?php

namespace App\Http\Middleware;

use App\Helpers\CustomEncrypter;
use App\Services\CognitoAuthService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class CheckVisionCookieAndAuthenticate
{
    protected CognitoAuthService $authService;

    protected array $skipRoutes = [
        'logout',
    ];
    public function __construct(CognitoAuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Determine if the route is a Livewire route.
     *
     * @param string|null $routeName
     * @return bool
     */
    protected function isLivewireOrAdminRoute(?string $routeName): bool
    {
        return $routeName && (str_starts_with($routeName, 'livewire.') || str_starts_with($routeName, 'horizon.'));
    }
    /**
     * Handle an incoming request.
     *
     * @param \Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $routeName = $request->route() ? $request->route()->getName() : null;

        // Check if the route name is in the skipRoutes array or is a Livewire route
        if ($routeName && (in_array($routeName, $this->skipRoutes) || $this->isLivewireOrAdminRoute($routeName))) {
            return $next($request);
        }

        $refreshTokenCookieName = config('app.cookie_name.refresh_token');
        $versionCookieName = config('app.cookie_name.version');

        $isUserAuthenticated = Session::has('user_authenticated');
        $hasRefreshTokenCookie = $request->hasCookie($refreshTokenCookieName);
        $hasVersionCookie = $request->hasCookie($versionCookieName);

        if ($hasVersionCookie) {
            CustomEncrypter::resetKey();
            $encryptionVersion = CustomEncrypter::decrypt($request->cookie($versionCookieName));
            $encryptionVersion = ($encryptionVersion === false) ? 'V1' : $encryptionVersion;
            CustomEncrypter::setKey(config('app.encryption_key_' . $encryptionVersion));
        }

        if (!$isUserAuthenticated && $hasRefreshTokenCookie) {
            return $this->authenticateUserFromCookie($request, $next);
        }

        if ($isUserAuthenticated && !$hasRefreshTokenCookie) {
            return redirect()->route('logout');
        }

        if ($isUserAuthenticated && $hasRefreshTokenCookie) {
            return $this->validateTokenPeriodically($request, $next);
        }

        return $next($request);
    }

    protected function authenticateUserFromCookie(Request $request, Closure $next): Response
    {
        $refreshToken = $request->cookie(config('app.cookie_name.refresh_token'));
        $decryptedRefreshToken = CustomEncrypter::decrypt($refreshToken);

        if ($decryptedRefreshToken === false) {
            return redirect()->route('logout');
        }

        $response = $this->processToken($decryptedRefreshToken);

        if (!empty($response['error'])) {
            $cookiesToForget = [
                config('app.cookie_name.version'),
                config('app.cookie_name.access_token'),
                config('app.cookie_name.refresh_token'),
                config('app.cookie_name.id_token')
            ];

            foreach ($cookiesToForget as $cookieName) {
                Cookie::queue(Cookie::forget($cookieName, '/', config('app.cookie_domain')));
            }

            if (config('app.env') === 'production') {
                if(config('app.prefix_url') === '/current-affairs') {
                    return redirect()->to('https://visionias.in/');
                }
            }
            return redirect()->route('home');
        }

        $this->setAuthCookiesAndSession($response);
        return $next($request);
    }

    protected function validateTokenPeriodically(Request $request, Closure $next): Response
    {
        $lastCheck = Session::get('last_token_check', 0);
        if (time() - $lastCheck > 30) {
            $refreshToken = $request->cookie(config('app.cookie_name.refresh_token'));
            $decryptedRefreshToken = CustomEncrypter::decrypt($refreshToken);

            if ($decryptedRefreshToken === false) {
                return redirect()->route('logout');
            }

            $response = $this->processToken($decryptedRefreshToken);

            if (!empty($response['error'])) {
                return redirect()->route('logout');
            }

            $this->setAuthCookiesAndSession($response);
            Session::put('last_token_check', time());
        }
        return $next($request);
    }

    protected function processToken($decryptedRefreshToken)
    {
        $decodedRefreshToken = json_decode(urldecode($decryptedRefreshToken));
        $token = $decodedRefreshToken->refreshToken->token;

        return $this->authService->refreshTokenAuthentication($token);
    }

    protected function setAuthCookiesAndSession(array $response): void
    {
        $accessToken = $response['AccessToken'];
        $idToken = $response['IdToken'];

        $decodedAccessToken = $this->authService->decodeToken($accessToken);
        $decodedIdToken = $this->authService->decodeToken($idToken);

        $idTokenCookie = ['idToken' => ['jwtToken' => $idToken, 'expiryTime' => $decodedIdToken->claims['exp']]];
        $accessTokenCookie = ['accessToken' => ['jwtToken' => $accessToken, 'expiryTime' => $decodedAccessToken->claims['exp']]];

        $encryptedIdTokenCookie = CustomEncrypter::encrypt(json_encode($idTokenCookie));
        $encryptedAccessTokenCookie = CustomEncrypter::encrypt(json_encode($accessTokenCookie));

        $this->authService->loginStudent($idToken);

        Cookie::queue(
            Cookie::make(
                config('app.cookie_name.access_token'),
                $encryptedAccessTokenCookie,
                5,
                "/",
                config('app.cookie_domain'),
                false,
                false
            )
        );
        Cookie::queue(
            Cookie::make(
                config('app.cookie_name.id_token'),
                $encryptedIdTokenCookie,
                5,
                "/",
                config('app.cookie_domain'),
                false,
                false
            )
        );

        Session::put('user_authenticated', true);
    }
}
