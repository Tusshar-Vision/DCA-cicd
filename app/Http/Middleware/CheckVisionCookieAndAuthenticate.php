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
    public function __construct(CognitoAuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->hasCookie(config('app.cookie_name.version')) && $request->hasCookie(config('app.cookie_name.refresh_token'))) {

            if (!Session::has('user_authenticated')) {

                CustomEncrypter::resetKey();
                $encryptionVersion = CustomEncrypter::decrypt($request->cookie(config('app.cookie_name.version')));
                $encryptionVersion = ($encryptionVersion === false) ? 'V1' : $encryptionVersion;

                CustomEncrypter::setKey(config('app.encryption_key_' . $encryptionVersion));

                $refreshToken = $request->cookie(config('app.cookie_name.refresh_token'));
                $decryptedRefreshToken = json_decode(urldecode(CustomEncrypter::decrypt($refreshToken)));
                $token = $decryptedRefreshToken->refreshToken->token;

                $response = $this->authService->refreshTokenAuthentication($token);

                if (!empty($response['error'])) {
                    return redirect()->route('logout');
                }

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

        return $next($request);
    }
}
