@use('App\Helpers\SvgIconsHelper')

<div class="flex flex-col xl:flex-row min-h-[680px] justify-center text-center items-stretch bg-white py-[50px] xl:py-0">
    <div class="w-full xl:w-6/12 flex items-center bg-white xl:bg-[#F5F7F8] mb-0">
        <dotlottie-player
            src="https://lottie.host/efd12853-25b1-4c36-bf27-3d0efb0eea46/mtnAb2oVRI.json"
            speed="1" style="width: 300px; height: 300px; margin: 0 auto;" loop
            autoplay
        >
        </dotlottie-player>
    </div>
    <div class="w-full xl:w-6/12 flex flex-col justify-center px-[20px] md:px-[56px] py-[30px] loginwrap">
        <h2 class="font-bold text-base mb-2">Welcome Back !</h2>
        <p class="text-xs font-normal mb-[40px]">Please log in to your account for a personalised experience.</p>

            <div class="form-item mb-[15px]">
                <input
                    type="text"
                    id="email"
                    class="w-full rounded-lg js_form-input"
                    required autocomplete="off"
                    wire:model.live="email"
                >
                <label for="email">Email</label>
            </div>

            <div class="form-item mb-[15px] relative">
                <span class="show-password" onclick="showPassword('password')">
                    {!! SvgIconsHelper::getSvgIcon('eye-icon') !!}
                </span>
                <input
                    type="password"
                    id="password"
                    class="w-full rounded-lg passwordOverlay js_form-input"
                    required autocomplete="off"
                    wire:model="password"
                >
                <label for="password" class="overlayLabel">Enter Password</label>
            </div>

            <a href="#" class="block text-right forgetpass mb-[20px]">Forgot password?</a>
            <button @click="login" class="login-btn">Login</button>

            <span class="divider-or mt-[20px]">OR</span>
            <ul class="flex justify-center items-center my-[20px]">
                <li class="mx-[7px]">
                    <a href="#" class="log-google flex items-center px-[40px] py-[10px]">
                        {!! SvgIconsHelper::getSvgIcon('google-icon') !!}
                        Google
                    </a>
                </li>
                <li class="mx-[7px]">
                    <a href="#" class="log-fb flex items-center p-[40px] py-[10px]">
                        {!! SvgIconsHelper::getSvgIcon('facebook-icon') !!}
                        Facebook
                    </a>
                </li>
            </ul>
            <button type="button" class="sign-up" @click="isLoginFormOpen = false;isRegisterFormOpen = true;">New User? Sign up</button>
    </div>
</div>

@script
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
            const x = document.getElementById(targetID);
            const img = document.querySelector('.eye');
            if (x.type === "password") {
                x.type = "text";
                img.style.opacity = "0.5";
            } else {
                x.type = "password";
                img.style.opacity = "1";
            }
        }
    </script>
@endscript
