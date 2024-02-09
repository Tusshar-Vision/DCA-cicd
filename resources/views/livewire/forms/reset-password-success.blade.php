<div class="flex flex-col xl:flex-row min-h-[680px] justify-center text-center items-stretch bg-white py-[50px] xl:py-0">
    <div class="w-full xl:w-6/12 flex items-center bg-white xl:bg-[#F5F7F8] mb-0">
        <dotlottie-player src="https://lottie.host/2fc50154-ed3d-41a4-8df1-7d8674976352/s842sZ4KM6.json" background="transparent" speed="1" style="width: 300px; height: 300px; margin: 0 auto;" loop autoplay></dotlottie-player>
    </div>
    <div class="w-full xl:w-6/12 flex flex-col justify-center px-[20px] md:px-[56px] py-[30px] loginwrap">
        <h2 class="font-medium text-base mb-5">Password Reset Successful</h2>
        <p class="text-sm	font-normal mb-[50px]">Your password has been changed successfully!</p>
        <form class="w-full">
            <button type="button" wire:click="$dispatch('renderComponent', { component: 'forms.login' })" class="login-btn">Continue to Login</button>
        </form>
    </div>
</div>
