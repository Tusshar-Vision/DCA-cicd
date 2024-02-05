@use('App\Helpers\SvgIconsHelper')

<!-- Email verification OTP UI -->
<div class="flex flex-col xl:flex-row min-h-[680px] justify-center text-center items-stretch bg-white py-[50px] xl:py-0">
    <div class="w-full xl:w-6/12 flex items-center bg-white xl:bg-[#F5F7F8]">
        <dotlottie-player
            src="https://lottie.host/5659d5fb-8a75-464f-9488-683967c8dd65/PyUWY2Jblu.json"
            background="transparent"
            speed="1" style="width: 300px; height: 300px; margin: 0 auto;"
            loop autoplay>
        </dotlottie-player>
    </div>
    <div class="w-full xl:w-6/12 flex flex-col justify-center px-[20px] md:px-[56px] py-[30px] loginwrap">
        @if(!$errors->any())
            <h5 class="py-[20px] bg-[#C5F7DC4D] text-sm mb-[40px] px-[30px] rounded-md">
                Kindly, enter the six digit verification code sent to your e-mail ID, {{ $email }}
            </h5>
        @endif
        <h2 class="font-medium text-base mb-[15px]">Enter the verification code</h2>
        @if($errors->any())
            <p class="text-xs text-[#3D3D3D] mb-[15px]">Kindly, enter the six digit verification code sent to your e-mail ID, {{ $email }}</p>
        @endif
        <form class="w-full" wire:submit="verify">
            <div class="flex gap-2 otp-wrap mb-[15px]">
                <input id="otp_first" type="number" maxlength="1" value=""
                       x-on:input="window.handleInput(0, $event)"
                       x-on:keydown="window.handleBackspace(0, $event)"
                       class="otp-input w-2/12 border h-[56px] rounded appearance-none text-center"
                       wire:model="otp_first"
                >
                <input id="otp_sec" type="number" maxlength="1" value=""
                       x-on:input="window.handleInput(1, $event)"
                       x-on:keydown="window.handleBackspace(1, $event)"
                       class="otp-input w-2/12 border h-[56px] rounded appearance-none text-center"
                       wire:model="otp_sec"
                >
                <input id="otp_third" type="number" maxlength="1" value=""
                       x-on:input="window.handleInput(2, $event)"
                       x-on:keydown="window.handleBackspace(2, $event)"
                       class="otp-input w-2/12 border h-[56px] rounded appearance-none text-center"
                       wire:model="otp_third"
                >
                <input id="otp_fourth" type="number" maxlength="1" value=""
                       x-on:input="window.handleInput(3, $event)"
                       x-on:keydown="window.handleBackspace(3, $event)"
                       class="otp-input w-2/12 border h-[56px] rounded appearance-none text-center"
                       wire:model="otp_fourth"
                >
                <input id="otp_fifth" type="number" maxlength="1" value=""
                       x-on:input="window.handleInput(4, $event)"
                       x-on:keydown="window.handleBackspace(4, $event)"
                       class="otp-input w-2/12 border h-[56px] rounded appearance-none text-center"
                       wire:model="otp_fifth"
                >
                <input id="otp_sixth" type="number" maxlength="1" value=""
                       x-on:input="window.handleInput(5, $event)"
                       x-on:keydown="window.handleBackspace(5, $event)"
                       class="otp-input w-2/12 border h-[56px] rounded appearance-none text-center"
                       wire:model="otp_sixth"
                >
            </div>
            @if($errors->any())
                <p class="text-xs text-[#C10000] mb-[15px]">Invalid verification code please try again</p>
            @endif
            <button type="submit" wire:loading.attr="disabled" wire:loading.class="bg-[#3362CC]" class="login-btn text-center transition-colors mb-[30px]">
                <p wire:loading.class="text-white" class="flex items-center justify-center">
                    <span wire:loading.delay class="mr-1"> {!! SvgIconsHelper::getSvgIcon('loading') !!} </span>
                    <span>Continue</span>
                </p>
            </button>
            <div class="flex items-center justify-center flex-col">
                <button type="button" class="text-[18px] text-[#3362CC] mb-[40px]">Resend</button>
                <button type="button" class="text-[18px] text-[#3362CC]">Change Email ID?</button>
            </div>
        </form>
    </div>
</div>
