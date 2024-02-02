<div class="flex flex-col xl:flex-row min-h-[680px] justify-center text-center items-stretch bg-white py-[50px] xl:py-0">
    <div class="w-full xl:w-6/12 flex items-center bg-white xl:bg-[#F5F7F8] mb-0">
        <dotlottie-player
            src="https://lottie.host/07fb6a39-c632-4ee0-a521-f7d341f9b34d/eUdLCAHNrn.json"
            background="transparent" speed="1" style="width: 300px; height: 300px; margin: 0 auto;"
            loop autoplay>
        </dotlottie-player>
    </div>
    <div class="w-full xl:w-6/12 flex flex-col justify-center px-[20px] md:px-[56px] py-[30px] loginwrap">
        @if($success === true)
            <h5 class="py-[20px] bg-[#C5F7DC4D] text-sm mb-[40px]">Sent OTP Successfully On your Email ID</h5>
        @endif
        <h2 class="font-medium text-base mb-5">Forgot Password</h2>
        <p class="text-sm	font-normal mb-[30px]">Have you forgotten your password? Enter your registered e-mail ID here to generate a new one!</p>
        <form class="w-full">
            <div class="form-item mb-[56px]">
                <input type="email" id="email" class="w-full rounded-lg" required autocomplete="off">
                <label for="email">Email</label>
            </div>
            <button type="submit" class="login-btn">Continue</button>
        </form>
    </div>
</div>
