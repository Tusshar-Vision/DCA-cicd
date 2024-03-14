@use('App\Helpers\SvgIconsHelper')

<div class="flex flex-col xl:flex-row md:min-h-[680px] min-h-[100vh] justify-center text-center items-stretch bg-white py-[50px] xl:py-0 dark:bg-dark373839">
    <div class="w-full xl:w-6/12 flex items-center bg-white xl:bg-[#F5F7F8] mb-0 dark:bg-dark545557">
        <dotlottie-player
            src="https://lottie.host/2b30c43d-ae5f-4db8-8698-2acbf3511801/m6u1iyrHdl.json"
            background="transparent"
            speed="1"
            style="width: 300px; height: 300px; margin: 0 auto;"
            loop autoplay
        >
        </dotlottie-player>
    </div>
    <div x-data="{ focusedFirstName: false, focusedLastName: false, focusedEmail: false, focusedMobile: false, focusedPassword: false, passwordVisible: false }"
         class="w-full xl:w-6/12 flex flex-col justify-center px-[20px] md:px-[56px] py-[30px] loginwrap dark:bg-dark373839"
    >
        <h2 class="font-medium text-base mb-5">Welcome!</h2>
        <p class="text-sm font-normal mb-[40px]">Please sign-up to your account for a personalised experience.</p>

        <form wire:submit="register">
            <div class="form-item mb-[15px]">
                <input
                    type="text"
                    id="first_name"
                    x-on:focus="focusedFirstName = true"
                    x-on:blur="focusedFirstName = false"
                    class="w-full rounded-lg"
                    name="first_name"
                    wire:model.blur="first_name"
                    required
                >
                <label for="first_name" :class="{ 'overlayLabel-focused': focusedFirstName || $wire.first_name }">First Name</label>
                @error('first_name')
                    <p class="text-xs text-[#C10000] text-left mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-item mb-[15px]">
                <input
                    type="text"
                    id="last_name"
                    x-on:focus="focusedLastName = true"
                    x-on:blur="focusedLastName = false"
                    class="w-full rounded-lg"
                    wire:model.blur="last_name"
                    required
                >
                <label for="last_name" :class="{ 'overlayLabel-focused': focusedLastName || $wire.last_name }">Last Name</label>
                @error('last_name')
                    <p class="text-xs text-[#C10000] text-left mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-item mb-[15px]">
                <input
                    type="text"
                    id="email"
                    x-on:focus="focusedEmail = true"
                    x-on:blur="focusedEmail = false"
                    class="w-full rounded-lg"
                    wire:model.blur="email"
                    required
                >
                <label for="email" :class="{ 'overlayLabel-focused': focusedEmail || $wire.email }">Email</label>
                @error('email')
                    <p class="text-xs text-[#C10000] text-left mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-item mb-[15px] flex gap-2 items-center">
                <div class="flex items-center gap-2 px-[16px] h-[56px] rounded-md continent">
                    <span>IND</span>
                   {!! SvgIconsHelper::getSvgIcon('indian-flag') !!}
                </div>
                <div class="relative w-full">
                    <input
                        type="tel"
                        id="mob"
                        x-on:focus="focusedMobile = true"
                        x-on:blur="focusedMobile = false"
                        class="w-full rounded-lg"
                        wire:model.blur="mobile"
                        required
                    >
                    <label for="mob" :class="{ 'overlayLabel-focused': focusedMobile || $wire.mobile }">+91 Mobile Number</label>
                </div>
            </div>
            @error('mobile')
                <p class="text-xs text-[#C10000] text-left mb-4 mt-[-5px]">{{ $message }}</p>
            @enderror
            <div class="form-item mb-[15px] relative">
                <span class="show-password" @click="passwordVisible = !passwordVisible">
                    <template x-if="passwordVisible" x-transition>
                        {!! SvgIconsHelper::getSvgIcon('eye-icon') !!}
                    </template>
                    <template x-if="!passwordVisible">
                        {!! SvgIconsHelper::getSvgIcon('eye-icon-close') !!}
                    </template>
                </span>
                <input
                    :type="passwordVisible ? 'text' : 'password'"
                    id="password"
                    x-on:focus="focusedPassword = true"
                    x-on:blur="focusedPassword = false"
                    class="w-full rounded-lg"
                    wire:model.blur="password"
                    required
                >
                <label for="password" :class="{ 'overlayLabel-focused': focusedPassword || $wire.password }">Enter Password</label>
                @error('password')
                    <p class="text-xs text-[#C10000] text-left mt-2">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" wire:loading.attr="disabled" wire:loading.class="bg-[#3362CC]" wire:target="register" class="login-btn text-center transition-colors">
                <p wire:loading.class="text-white" wire:target="register" class="flex items-center justify-center">
                    <span wire:loading.delay class="mr-1" wire:target="register"> {!! SvgIconsHelper::getSvgIcon('loading') !!} </span>
                    <span>Sign up</span>
                </p>
            </button>

{{--            <span class="divider-or mt-[20px]">OR</span>--}}
{{--            <ul class="flex justify-center items-center my-[20px]">--}}
{{--                <li class="mx-[7px]">--}}
{{--                    <a href="#" class="log-google flex items-center px-[40px] py-[10px]">--}}
{{--                        {!! SvgIconsHelper::getSvgIcon('google-icon') !!}--}}
{{--                        Google--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="mx-[7px]">--}}
{{--                    <a href="#" class="log-fb flex items-center p-[40px] py-[10px]">--}}
{{--                        {!! SvgIconsHelper::getSvgIcon('facebook-icon') !!}--}}
{{--                        Facebook--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--            </ul>--}}
            <h5 class="text-base text-[#3D3D3D] dark:text-white mt-[20px]">Already Registered?
                <a href="#" class="text-[#3362CC] hover:underline" wire:click="$dispatch('renderComponent', { component: 'forms.login' })">
                    Login
                </a>
            </h5>
            <p class="text-[12px] text-[#3D3D3D] dark:text-white">By signing in, you confirm that you have read and agree to our
                <a href="{{ \App\Helpers\UrlHelper::linkToVision('/termsandcondition') }}" target="_blank" class="text-[#3362CC] block">Terms and Conditions</a>
            </p>
        </form>
    </div>
</div>
