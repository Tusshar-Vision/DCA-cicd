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
                    id="login-email"
                    class="w-full rounded-lg"
                    required
                    autocomplete="off"
                    wire:model.live="email"
                >
                <label for="login-email" class="overlayLabel">Email</label>
                @error('email')
                    <p class="text-xs text-[#C10000] text-left mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-item mb-[15px] relative">
                <span class="show-password" onclick="showPassword('login-password')">
                    {!! SvgIconsHelper::getSvgIcon('eye-icon') !!}
                </span>
                <input
                    type="password"
                    id="login-password"
                    class="w-full rounded-lg passwordOverlay"
                    required autocomplete="off"
                    wire:model.live="password"
                >
                <label for="login-password" class="overlayLabel">Enter Password</label>
                @error('password')
                    <p class="text-xs text-[#C10000] text-left mt-2">{{ $message }}</p>
                @enderror
            </div>

            <a href="#" wire:click="$parent.renderComponent('forms.verify-email')" class="block text-right forgetpass mb-[20px]">Forgot password?</a>
            <button wire:click="login" class="login-btn text-center">
                <p class="flex items-center justify-center">
                    <span wire:loading.delay class="loader mr-2"></span>
                    <span>Login</span>
                </p>
            </button>

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
            <button type="button" class="sign-up" wire:click="$parent.renderComponent('forms.register')">New User? Sign up</button>
    </div>
</div>

<script>
    // restrict label animation
    document.addEventListener('livewire:init', () => {

        let inputFields = document.querySelectorAll('input');

        inputFields.forEach(function(input) {
            input.addEventListener('focus', function() {
                animateLabelOnFocus(input);
            });

            input.addEventListener('blur', function() {
                animateLabelOnFocusOut(input);
            });
        });

        Livewire.hook('morph.updated', ({ el, component }) => {
            inputFields.forEach(function (input) {
                animateLabelOnFocus(input);
                animateLabelOnFocusOut(input);
            });
        });
    });

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

    function animateLabelOnFocus(input) {
        if (input !== null && input.nextElementSibling !== null) {
            input.nextElementSibling.style.top = '-5px';
            input.nextElementSibling.style.fontSize = '11px';
            input.nextElementSibling.style.color = '#3362CC';
            input.nextElementSibling.style.zIndex = '1';
        }
    }

    function animateLabelOnFocusOut(input) {
        if (input !== null && input.value === '' && input.nextElementSibling !== null) {
            input.nextElementSibling.style.top = '';
            input.nextElementSibling.style.fontSize = '';
            input.nextElementSibling.style.color = '';
            input.nextElementSibling.style.zIndex = '0';
        }
    }
</script>
