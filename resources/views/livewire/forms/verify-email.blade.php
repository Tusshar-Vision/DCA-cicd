@use('App\Helpers\SvgIconsHelper')

<div class="flex flex-col xl:flex-row md:min-h-[680px] min-h-[100vh] justify-center text-center items-stretch bg-white py-[50px] xl:py-0">
    <div class="w-full xl:w-6/12 flex items-center bg-white xl:bg-[#F5F7F8] mb-0 dark:bg-dark545557">
        <dotlottie-player
            src="https://lottie.host/0f7d5194-bee9-43a5-b8df-449414d075bd/xfIpwtfMSg.json"
            background="transparent" speed="1" style="width: 300px; height: 300px; margin: 0 auto;"
            loop autoplay>
        </dotlottie-player>
    </div>
    <div x-data="{ focusedEmail: false }" class="w-full xl:w-6/12 flex flex-col justify-center px-[20px] md:px-[48px] py-[30px] loginwrap dark:bg-dark373839">
        <h2 class="font-medium text-base mb-5">Please Verify Your Email ID</h2>
        <p class="text-sm font-normal mb-[30px]">Please verify your email address to get access to more information.</p>
        <form wire:submit="submit" class="w-full">
            <div class="form-item mb-[56px]">
                <input
                    type="email"
                    id="email"
                    class="w-full rounded-lg"
                    x-on:focus="focusedEmail = true"
                    x-on:blur="focusedEmail = false"
                    wire:model.blur="email"
                    required
                >
                <label for="email" :class="{ 'overlayLabel-focused': focusedEmail || $wire.email }">Email</label>
                @error('email')
                    <p class="text-xs text-[#C10000] text-left mt-2">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" wire:loading.attr="disabled" wire:loading.class="bg-[#3362CC]" class="login-btn text-center transition-colors">
                <p wire:loading.class="text-white" class="flex items-center justify-center">
                    <span wire:loading.delay class="mr-1"> {!! SvgIconsHelper::getSvgIcon('loading') !!} </span>
                    <span>Continue</span>
                </p>
            </button>
        </form>
    </div>
</div>
