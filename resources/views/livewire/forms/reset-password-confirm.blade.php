@use('App\Helpers\SvgIconsHelper')

<div class="flex md:min-h-[680px] min-h-[100vh] justify-center text-center items-stretch bg-white">
    <div class="w-6/12 flex items-center bg-[#F5F7F8] dark:bg-dark545557">
        <dotlottie-player
            src="https://lottie.host/9fdd8a19-696b-458b-b325-a74104e6b362/ZBlOCe4MDw.json"
            background="transparent"
            speed="1" style="width: 300px; height: 300px; margin: 0 auto;" loop
            autoplay
        >
        </dotlottie-player>
    </div>
    <div x-data="{ focusedResetPassword: false, focusedResetConfirmPassword: false, resetPasswordVisible: false }" class="w-6/12 flex flex-col justify-center px-[56px] loginwrap dark:bg-dark373839">
        <h2 class="font-medium text-base mb-[15px]">Enter OTP</h2>
        <p class="text-xs text-[#3D3D3D] mb-[15px]">Kindly, enter the six digit verification code sent to your e-mail ID, {{ $email }}</p>
        <form wire:submit="verify" class="w-full">
            <div class="flex gap-2 otp-wrap mb-[15px]">
                <input id="otp_first" type="number" maxlength="1" value=""
                       x-on:input="window.handleInput(0, $event)"
                       x-on:keydown="window.handleBackspace(0, $event)"
                       class="otp-input w-2/12 border h-[56px] rounded appearance-none text-center"
                       wire:model.blur="otp_first"
                >
                <input id="otp_sec" type="number" maxlength="1" value=""
                       x-on:input="window.handleInput(1, $event)"
                       x-on:keydown="window.handleBackspace(1, $event)"
                       class="otp-input w-2/12 border h-[56px] rounded appearance-none text-center"
                       wire:model.blur="otp_sec"
                >
                <input id="otp_third" type="number" maxlength="1" value=""
                       x-on:input="window.handleInput(2, $event)"
                       x-on:keydown="window.handleBackspace(2, $event)"
                       class="otp-input w-2/12 border h-[56px] rounded appearance-none text-center"
                       wire:model.blur="otp_third"
                >
                <input id="otp_fourth" type="number" maxlength="1" value=""
                       x-on:input="window.handleInput(3, $event)"
                       x-on:keydown="window.handleBackspace(3, $event)"
                       class="otp-input w-2/12 border h-[56px] rounded appearance-none text-center"
                       wire:model.blur="otp_fourth"
                >
                <input id="otp_fifth" type="number" maxlength="1" value=""
                       x-on:input="window.handleInput(4, $event)"
                       x-on:keydown="window.handleBackspace(4, $event)"
                       class="otp-input w-2/12 border h-[56px] rounded appearance-none text-center"
                       wire:model.blur="otp_fifth"
                >
                <input id="otp_sixth" type="number" maxlength="1" value=""
                       x-on:input="window.handleInput(5, $event)"
                       x-on:keydown="window.handleBackspace(5, $event)"
                       class="otp-input w-2/12 border h-[56px] rounded appearance-none text-center"
                       wire:model.blur="otp_sixth"
                >
            </div>
            @error('OTP')
                <p class="text-xs text-[#C10000] mb-[15px]">{{ $message }}</p>
            @enderror
            <div class="text-right">
                <button wire:click="resendCode" wire:target="resendCode" type="button" class="text-[18px] text-[#3362CC] mb-[40px]" {{ $success === true ? 'disabled' : '' }}>
                    <p wire:loading.class="text-white" wire:target="resendCode" class="flex items-center justify-center">
                        <span wire:loading.delay class="mr-1" wire:target="resendCode"> {!! SvgIconsHelper::getSvgIcon('loading-2') !!} </span>
                        <span wire:loading.remove wire:target="resendCode">{{ $success === null ? 'Resend' : 'Sent!' }}</span>
                    </p>
                </button>
            </div>

            <div class="form-item mb-[15px] relative">
            <span class="show-password" @click="resetPasswordVisible = !resetPasswordVisible">
                <template x-if="resetPasswordVisible" x-transition>
                    {!! SvgIconsHelper::getSvgIcon('eye-icon') !!}
                </template>
                <template x-if="!resetPasswordVisible">
                    {!! SvgIconsHelper::getSvgIcon('eye-icon-close') !!}
                </template>
            </span>
                <input
                    name="password"
                    :type="resetPasswordVisible ? 'text' : 'password'"
                    id="password"
                    x-on:focus="focusedResetPassword = true"
                    x-on:blur="focusedResetPassword = false"
                    class="w-full rounded-lg"
                    wire:model.blur="password"
                    required
                >
                <label for="password" :class="{ 'overlayLabel-focused': focusedResetPassword || $wire.password }">Enter Password</label>
                @error('password')
                    <p class="text-xs text-[#C10000] text-left mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-item mb-[15px] relative">
            <span class="show-password" @click="resetPasswordVisible = !resetPasswordVisible">
                <template x-if="resetPasswordVisible" x-transition>
                    {!! SvgIconsHelper::getSvgIcon('eye-icon') !!}
                </template>
                <template x-if="!resetPasswordVisible">
                    {!! SvgIconsHelper::getSvgIcon('eye-icon-close') !!}
                </template>
            </span>
                <input
                    name="confirm-password"
                    :type="resetPasswordVisible ? 'text' : 'password'"
                    id="confirm-password"
                    x-on:focus="focusedResetConfirmPassword = true"
                    x-on:blur="focusedResetConfirmPassword = false"
                    class="w-full rounded-lg"
                    wire:model.blur="confirmPassword"
                    required
                >
                <label for="confirm-password" :class="{ 'overlayLabel-focused': focusedResetConfirmPassword || $wire.confirmPassword }">Confirm Password</label>
                @error('confirmPassword')
                    <p class="text-xs text-[#C10000] text-left mt-2">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" wire:loading.attr="disabled" wire:loading.class="bg-[#3362CC]" wire:target="verify" class="login-btn mb-[30px] transition-colors">
                <p wire:loading.class="text-white" wire:target="verify" class="flex items-center justify-center">
                    <span wire:loading.delay class="mr-1" wire:target="verify"> {!! SvgIconsHelper::getSvgIcon('loading') !!} </span>
                    <span>Update</span>
                </p>
            </button>
            <div class="flex items-center justify-center flex-col">
                <button type="button" wire:click="$dispatch('renderComponent', { component: 'forms.login' })" class="text-[18px] text-[#3362CC] mb-[40px]">Login?</button>
                <button type="button" wire:click="$dispatch('renderComponent', { component: 'forms.reset-password' })" class="text-[18px] text-[#3362CC]">Change Email ID?</button>
            </div>
        </form>
    </div>
</div>
