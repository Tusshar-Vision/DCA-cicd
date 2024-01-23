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



<!-- verify mail ID -->

{{-- <div class="flex flex-col xl:flex-row min-h-[680px] justify-center text-center items-stretch bg-white py-[50px] xl:py-0">
    <div class="w-full xl:w-6/12 flex items-center bg-white xl:bg-[#F5F7F8] mb-0">
      <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
      <dotlottie-player src="https://lottie.host/efd12853-25b1-4c36-bf27-3d0efb0eea46/mtnAb2oVRI.json" background="transparent" speed="1" style="width: 300px; height: 300px; margin: 0 auto;" loop autoplay></dotlottie-player>
    </div>
    <div class="w-full xl:w-6/12 flex flex-col justify-center px-[20px] md:px-[48px] py-[30px] loginwrap">
      <h2 class="font-medium text-base mb-5">Please Verify Your Email ID</h2>
      <p class="text-sm	font-normal mb-[30px]">Please verify your email address to get access to more information.</p>
      <form class="w-full">
        <div class="form-item mb-[56px]">
          <input type="text" id="email" class="w-full rounded-lg" required autocomplete="off">
          <label for="email">Email</label>
        </div>
        <button type="submit" class="login-btn">Continue</button>
      </form>
    </div>
</div> --}}


<!-- Forgot password -->
{{-- <div class="flex flex-col xl:flex-row min-h-[680px] justify-center text-center items-stretch bg-white py-[50px] xl:py-0">
    <div class="w-full xl:w-6/12 flex items-center bg-white xl:bg-[#F5F7F8] mb-0">
        <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
        <dotlottie-player src="https://lottie.host/07fb6a39-c632-4ee0-a521-f7d341f9b34d/eUdLCAHNrn.json" background="transparent" speed="1" style="width: 300px; height: 300px; margin: 0 auto;" loop autoplay></dotlottie-player>
    </div>
    <div class="w-full xl:w-6/12 flex flex-col justify-center px-[20px] md:px-[56px] py-[30px] loginwrap">
      <h5 class="py-[20px] bg-[#C5F7DC4D] text-sm mb-[40px]">Sent OTP Successfully On your Email ID</h5>
      <h2 class="font-medium text-base mb-5">Forgot Password</h2>
      <p class="text-sm	font-normal mb-[30px]">Have you forgotten your password? Enter your registered e-mail ID here to generate a new one!</p>
      <form class="w-full">
        <div class="form-item mb-[56px]">
          <input type="text" id="email" class="w-full rounded-lg" required autocomplete="off">
          <label for="email">Email</label>
        </div>
        <button type="submit" class="login-btn">Continue</button>
      </form>
    </div>
</div> --}}


 <!-- Enter OTP UI -->
 {{-- <div class="flex flex-col xl:flex-row min-h-[680px] justify-center text-center items-stretch bg-white py-[50px] xl:py-0">
    <div class="w-full xl:w-6/12 flex items-center bg-white xl:bg-[#F5F7F8]">
        <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
        <dotlottie-player src="https://lottie.host/37fd71df-253c-4c97-9801-0269a1916e43/nXpmkJueeK.json" background="transparent" speed="1" style="width: 300px; height: 300px; margin: 0 auto;" loop autoplay></dotlottie-player>
    </div>
    <div class="w-full xl:w-6/12 flex flex-col justify-center px-[20px] md:px-[56px] py-[30px] loginwrap">
        <h2 class="font-medium text-base mb-[15px]">Enter OTP</h2>
        <p class="text-xs text-[#3D3D3D] mb-[15px]">Kindly, enter the four digit verification code sent to your e-mail ID, vision@gmail.com</p>
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
            <div class="w-full mb-4 text-right">
                <button type="button" class="text-[18px] text-[#3362CC]">Resend</button>
            </div>
            <div class="form-item mb-[25px] relative">
                <span class="show-password" onclick="showPassword('enterpassword')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22"
                        fill="none" class="eye">
                        <path
                            d="M21.8035 10.6702C21.7659 10.607 20.8612 9.10512 19.0852 7.59752C16.7236 5.59286 13.9278 4.5332 11 4.5332C8.07224 4.5332 5.27643 5.59281 2.91483 7.59748C1.13876 9.10512 0.234137 10.607 0.196496 10.6702L0 11L0.196496 11.3299C0.234137 11.3931 1.1388 12.895 2.91483 14.4026C5.27643 16.4072 8.07224 17.4669 11 17.4669C13.9278 17.4669 16.7236 16.4073 19.0852 14.4026C20.8612 12.895 21.7659 11.3932 21.8035 11.33L22 11L21.8035 10.6702ZM18.2508 13.4197C16.095 15.2497 13.6555 16.1776 11 16.1776C8.35931 16.1776 5.93128 15.2594 3.78323 13.4485C2.63196 12.4779 1.87172 11.495 1.52346 10.9994C1.86656 10.5101 2.61121 9.54641 3.74915 8.58043C5.90498 6.75039 8.34453 5.82252 11 5.82252C13.6407 5.82252 16.0687 6.74068 18.2168 8.5516C19.368 9.52222 20.1282 10.5052 20.4765 11.0007C20.1334 11.49 19.3888 12.4537 18.2508 13.4197Z"
                            fill="#686E70" />
                        <path
                            d="M11.0002 6.78442C8.67572 6.78442 6.78467 8.67548 6.78467 11C6.78467 13.3244 8.67572 15.2155 11.0002 15.2155C13.3247 15.2155 15.2157 13.3244 15.2157 11C15.2157 8.67548 13.3247 6.78442 11.0002 6.78442ZM11.0002 13.9262C9.38664 13.9262 8.07394 12.6135 8.07394 11C8.07394 9.3864 9.38664 8.0737 11.0002 8.0737C12.6138 8.0737 13.9265 9.3864 13.9265 11C13.9265 12.6135 12.6138 13.9262 11.0002 13.9262Z"
                            fill="#686E70" />
                        <path
                            d="M11.0004 11.8476C11.4685 11.8476 11.848 11.4681 11.848 11C11.848 10.5319 11.4685 10.1525 11.0004 10.1525C10.5323 10.1525 10.1528 10.5319 10.1528 11C10.1528 11.4681 10.5323 11.8476 11.0004 11.8476Z"
                            fill="#686E70" />
                    </svg>
                </span>
                <input type="password" id="enterpassword" class="w-full rounded-lg passwordOverlay" required autocomplete="off"
                    wire:model=" enter password">
                <label for="enter password" class="overlayLabel">Enter Password</label>
            </div>

            <div class="form-item mb-[25px] relative">
                <span class="show-password" onclick="showPassword('confirmpassword')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22"
                        fill="none" class="eye">
                        <path
                            d="M21.8035 10.6702C21.7659 10.607 20.8612 9.10512 19.0852 7.59752C16.7236 5.59286 13.9278 4.5332 11 4.5332C8.07224 4.5332 5.27643 5.59281 2.91483 7.59748C1.13876 9.10512 0.234137 10.607 0.196496 10.6702L0 11L0.196496 11.3299C0.234137 11.3931 1.1388 12.895 2.91483 14.4026C5.27643 16.4072 8.07224 17.4669 11 17.4669C13.9278 17.4669 16.7236 16.4073 19.0852 14.4026C20.8612 12.895 21.7659 11.3932 21.8035 11.33L22 11L21.8035 10.6702ZM18.2508 13.4197C16.095 15.2497 13.6555 16.1776 11 16.1776C8.35931 16.1776 5.93128 15.2594 3.78323 13.4485C2.63196 12.4779 1.87172 11.495 1.52346 10.9994C1.86656 10.5101 2.61121 9.54641 3.74915 8.58043C5.90498 6.75039 8.34453 5.82252 11 5.82252C13.6407 5.82252 16.0687 6.74068 18.2168 8.5516C19.368 9.52222 20.1282 10.5052 20.4765 11.0007C20.1334 11.49 19.3888 12.4537 18.2508 13.4197Z"
                            fill="#686E70" />
                        <path
                            d="M11.0002 6.78442C8.67572 6.78442 6.78467 8.67548 6.78467 11C6.78467 13.3244 8.67572 15.2155 11.0002 15.2155C13.3247 15.2155 15.2157 13.3244 15.2157 11C15.2157 8.67548 13.3247 6.78442 11.0002 6.78442ZM11.0002 13.9262C9.38664 13.9262 8.07394 12.6135 8.07394 11C8.07394 9.3864 9.38664 8.0737 11.0002 8.0737C12.6138 8.0737 13.9265 9.3864 13.9265 11C13.9265 12.6135 12.6138 13.9262 11.0002 13.9262Z"
                            fill="#686E70" />
                        <path
                            d="M11.0004 11.8476C11.4685 11.8476 11.848 11.4681 11.848 11C11.848 10.5319 11.4685 10.1525 11.0004 10.1525C10.5323 10.1525 10.1528 10.5319 10.1528 11C10.1528 11.4681 10.5323 11.8476 11.0004 11.8476Z"
                            fill="#686E70" />
                    </svg>
                </span>
                <input type="password" id="confirmpassword" class="w-full rounded-lg passwordOverlay" required autocomplete="off"
                    wire:model="confirm password">
                <label for="confirm password" class="overlayLabel">Confirm Password</label>
            </div>
            <button type="submit" class="login-btn mb-[30px]">Update</button>
            <div class="flex items-center justify-center flex-col">
                <button type="button" class="text-[18px] text-[#3362CC] mb-[40px]">Login</button>
                <button type="button" class="text-[18px] text-[#3362CC]">Change Email ID?</button>
            </div>
        </form>
    </div>
</div>


<script>

    // restrict label animation
    document.querySelectorAll('input').forEach(function(input) {
      input.addEventListener('focus', function() {
        this.nextElementSibling.style.top = '-5px';
        this.nextElementSibling.style.fontSize = '11px';
        this.nextElementSibling.style.color = '#3362CC';
        this.nextElementSibling.style.zIndex = '1';
      });

      input.addEventListener('blur', function() {
        if (!this.value) {
          this.nextElementSibling.style.top = '';
          this.nextElementSibling.style.fontSize = '';
          this.nextElementSibling.style.color = '';
          this.nextElementSibling.style.zIndex = '0';
        }
      });
    });

    const inputs = document.querySelectorAll('.js_form-input');
    inputs.forEach(input => {
        input.addEventListener('blur', (event) => {
        if (event.target.value.length) {
            event.target.classList.add("full");
        } else {
            event.target.classList.remove("full");
        }
    });
    })
    // show hide function
    function showPassword(targetID) {
        var x = document.getElementById(targetID);
        var img = document.querySelector('.eye')
        if (x.type === "password") {
            x.type = "text";
            img.style.opacity = "0.5";
        } else {
            x.type = "password";
            img.style.opacity = "1";
        }
    }
</script> --}}
