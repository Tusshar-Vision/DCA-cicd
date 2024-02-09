@use('App\Helpers\SvgIconsHelper')

<div class="flex flex-col xl:flex-row md:min-h-[680px] min-h-[100vh] justify-center text-center items-stretch bg-white py-[50px] xl:py-0">
    <div class="w-full xl:w-6/12 flex items-center bg-white xl:bg-[#F5F7F8] mb-0">
        <dotlottie-player
            src="https://lottie.host/efd12853-25b1-4c36-bf27-3d0efb0eea46/mtnAb2oVRI.json"
            speed="1" style="width: 300px; height: 300px; margin: 0 auto;" loop
            autoplay
        >
        </dotlottie-player>
    </div>
    <div x-data="{ focusedEmail: false, focusedPassword: false, passwordVisible: false }" class="w-full xl:w-6/12 flex flex-col justify-center px-[20px] md:px-[56px] py-[30px] loginwrap">
        <h2 class="font-bold text-base mb-2">Welcome Back !</h2>
        <p class="text-xs font-normal mb-[40px]">Please log in to your account for a personalized experience.</p>

        <div class="form-item mb-[15px]">
            <input
                type="email"
                id="login-email"
                x-on:focus="focusedEmail = true"
                x-on:blur="focusedEmail = false"
                class="w-full rounded-lg"
                name="email"
                wire:model.blur="email"
                wire:keydown.enter="login"
                required
            >
            <label for="login-email" :class="{ 'overlayLabel-focused': focusedEmail || $wire.email }">Email</label>
            @error('email')
                <p class="text-xs text-[#C10000] text-left mt-2">{{ $message }}</p>
            @enderror
        </div>

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
                name="password"
                :type="passwordVisible ? 'text' : 'password'"
                id="login-password"
                x-on:focus="focusedPassword = true"
                x-on:blur="focusedPassword = false"
                class="w-full rounded-lg"
                wire:model.blur="password"
                wire:keydown.enter="login"
                required
            >
            <label for="login-password" :class="{ 'overlayLabel-focused': focusedPassword || $wire.password }">Enter Password</label>
            @error('password')
                <p class="text-xs text-[#C10000] text-left mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end w-full">
            <a href="javascript:void(0)" wire:click="$dispatch('renderComponent', { component: 'forms.reset-password' })" class="inline-block text-right forgetpass mb-[20px]">Forgot password?</a>
        </div>

        <button wire:click="login" wire:keydown.enter="login" wire:target="login" wire:loading.attr="disabled" wire:loading.class="bg-[#3362CC]" class="login-btn text-center transition-colors">
            <p wire:loading.class="text-white" wire:target="login" class="flex items-center justify-center">
                <span wire:loading.delay class="mr-1" wire:target="login"> {!! SvgIconsHelper::getSvgIcon('loading') !!} </span>
                <span>Login</span>
            </p>
        </button>

{{--        <span class="divider-or mt-[20px]">OR</span>--}}
{{--        <ul class="flex justify-center items-center my-[20px]">--}}
{{--            <li class="mx-[7px]">--}}
{{--                <a href="#" class="log-google flex items-center px-[20px] py-[10px]">--}}
{{--                    {!! SvgIconsHelper::getSvgIcon('google-icon') !!}--}}
{{--                    Google--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            <li class="mx-[7px]">--}}
{{--                <a href="#" class="log-fb flex items-center px-[20px] py-[10px]">--}}
{{--                    {!! SvgIconsHelper::getSvgIcon('facebook-icon') !!}--}}
{{--                    Facebook--}}
{{--                </a>--}}
{{--            </li>--}}
{{--        </ul>--}}

        <button type="button" class="sign-up mt-[20px]" wire:click="$dispatch('renderComponent', { component: 'forms.register' })">New User? Sign up</button>
    </div>
</div>
