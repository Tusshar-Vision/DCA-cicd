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
        <h5 class="py-[20px] bg-[#C5F7DC4D] text-sm mb-[40px] px-[30px] rounded-md">Kindly, enter the six digit
            verification code sent to your e-mail ID, vision@gmail.com</h5>
        <h2 class="font-medium text-base mb-[15px]">Enter the verification code</h2>
        <p class="text-xs text-[#3D3D3D] mb-[15px]">Kindly, enter the six digit verification code sent to your e-mail
            ID, vision@gmail.com</p>
        <form class="w-full" wire:submit="verify">
            <div class="flex gap-2 otp-wrap mb-[15px]">
                <input type="number" maxlength="1" value="" onKeyPress="if(this.value.length==1) return false;"
                    class="otp-input w-2/12 border h-[56px] rounded appearance-none text-center" wire:model="otp_first">
                <input type="number" maxlength="1" value="" onKeyPress="if(this.value.length==1) return false;"
                    class="otp-input w-2/12 border h-[56px] rounded appearance-none text-center" wire:model="otp_sec">
                <input type="number" maxlength="1" value="" onKeyPress="if(this.value.length==1) return false;"
                    class="otp-input w-2/12 border h-[56px] rounded appearance-none text-center" wire:model="otp_third">
                <input type="number" maxlength="1" value="" onKeyPress="if(this.value.length==1) return false;"
                    class="otp-input w-2/12 border h-[56px] rounded appearance-none text-center"
                    wire:model="otp_fourth">
                <input type="number" maxlength="1" value="" onKeyPress="if(this.value.length==1) return false;"
                    class="otp-input w-2/12 border h-[56px] rounded appearance-none text-center" wire:model="otp_fifth">
                <input type="number" maxlength="1" value="" onKeyPress="if(this.value.length==1) return false;"
                    class="otp-input w-2/12 border h-[56px] rounded appearance-none text-center" wire:model="otp_sixth">
            </div>
            <p class="text-xs text-[#C10000] mb-[15px]">Invalid verification code please try again</p>
            <button type="submit" class="login-btn mb-[30px]">Verify</button>
            <div class="flex items-center justify-center flex-col">
                <button type="button" class="text-[18px] text-[#3362CC] mb-[40px]">Resend</button>
                <button type="button" class="text-[18px] text-[#3362CC]">Change Email ID?</button>
            </div>
        </form>
    </div>
</div>
