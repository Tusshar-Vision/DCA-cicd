<div class="flex min-h-full flex-col justify-center px-[20px] py-[20px] bg-white">
  <div class="flex items-center loginwrap">
    <div class="w-full text-center">
      <h2 class="font-medium text-base mb-5">Welcome Back !</h2>
      <p class="text-sm	font-normal mb-[40px]">Please log-in to your account for a personalised experience.</p>
      <form>
        <div class="form-item mb-[15px]">
          <input type="text" id="username" class="w-full rounded-lg" required>
          <label for="username">Email</label>
        </div> 
        <div class="form-item mb-[15px] relative">
          <span class="show-password" onclick="showPassword('password')">
          <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none" class="eye">
            <path d="M21.8035 10.6702C21.7659 10.607 20.8612 9.10512 19.0852 7.59752C16.7236 5.59286 13.9278 4.5332 11 4.5332C8.07224 4.5332 5.27643 5.59281 2.91483 7.59748C1.13876 9.10512 0.234137 10.607 0.196496 10.6702L0 11L0.196496 11.3299C0.234137 11.3931 1.1388 12.895 2.91483 14.4026C5.27643 16.4072 8.07224 17.4669 11 17.4669C13.9278 17.4669 16.7236 16.4073 19.0852 14.4026C20.8612 12.895 21.7659 11.3932 21.8035 11.33L22 11L21.8035 10.6702ZM18.2508 13.4197C16.095 15.2497 13.6555 16.1776 11 16.1776C8.35931 16.1776 5.93128 15.2594 3.78323 13.4485C2.63196 12.4779 1.87172 11.495 1.52346 10.9994C1.86656 10.5101 2.61121 9.54641 3.74915 8.58043C5.90498 6.75039 8.34453 5.82252 11 5.82252C13.6407 5.82252 16.0687 6.74068 18.2168 8.5516C19.368 9.52222 20.1282 10.5052 20.4765 11.0007C20.1334 11.49 19.3888 12.4537 18.2508 13.4197Z" fill="#686E70"/>
            <path d="M11.0002 6.78442C8.67572 6.78442 6.78467 8.67548 6.78467 11C6.78467 13.3244 8.67572 15.2155 11.0002 15.2155C13.3247 15.2155 15.2157 13.3244 15.2157 11C15.2157 8.67548 13.3247 6.78442 11.0002 6.78442ZM11.0002 13.9262C9.38664 13.9262 8.07394 12.6135 8.07394 11C8.07394 9.3864 9.38664 8.0737 11.0002 8.0737C12.6138 8.0737 13.9265 9.3864 13.9265 11C13.9265 12.6135 12.6138 13.9262 11.0002 13.9262Z" fill="#686E70"/>
            <path d="M11.0004 11.8476C11.4685 11.8476 11.848 11.4681 11.848 11C11.848 10.5319 11.4685 10.1525 11.0004 10.1525C10.5323 10.1525 10.1528 10.5319 10.1528 11C10.1528 11.4681 10.5323 11.8476 11.0004 11.8476Z" fill="#686E70"/>
          </svg>
          </span>
          <input type="password" id="password" class="w-full rounded-lg" required>
          <label for="password">Password</label>
        </div>
        <a href="#" class="block text-right forgetpass mb-[20px]">Forgot password?</a>
        <button type="submit" class="login-btn">Login</button>

        <span class="divider-or mt-[20px]">OR</span>
        <ul class="flex justify-center items-center my-[20px]">
          <li class="mx-[7px]"><a href="#" class="log-google flex items-center px-[40px] py-[10px]">
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none" class="mr-[10px]">
            <path d="M3.98918 10.8764L3.36262 13.2154L1.07258 13.2638C0.388195 11.9945 0 10.5421 0 8.99876C0 7.50634 0.362953 6.09896 1.00631 4.85974H1.0068L3.04559 5.23352L3.9387 7.26007C3.75177 7.80503 3.64989 8.39003 3.64989 8.99876C3.64996 9.65941 3.76963 10.2924 3.98918 10.8764Z" fill="#FBBB00"/>
            <path d="M17.8417 7.31848C17.945 7.86291 17.9989 8.42516 17.9989 8.99979C17.9989 9.64414 17.9312 10.2727 17.8021 10.8789C17.364 12.942 16.2192 14.7435 14.6333 16.0183L14.6328 16.0178L12.0649 15.8868L11.7014 13.618C12.7537 13.0009 13.5761 12.0351 14.0093 10.8789H9.19678V7.31848H14.0795H17.8417Z" fill="#518EF8"/>
            <path d="M14.6331 16.0184L14.6336 16.0189C13.0912 17.2586 11.132 18.0004 8.9992 18.0004C5.57178 18.0004 2.5919 16.0847 1.07178 13.2655L3.98837 10.8781C4.74842 12.9065 6.70518 14.3505 8.9992 14.3505C9.98522 14.3505 10.909 14.0839 11.7017 13.6186L14.6331 16.0184Z" fill="#28B446"/>
            <path d="M14.7437 2.07209L11.8281 4.45906C11.0077 3.94627 10.038 3.65004 8.99906 3.65004C6.65312 3.65004 4.65976 5.16025 3.93779 7.26143L1.00586 4.86111H1.00537C2.50324 1.9732 5.5207 0.00012207 8.99906 0.00012207C11.1828 0.00012207 13.185 0.777989 14.7437 2.07209Z" fill="#F14336"/>
          </svg>   
          Google</a></li>
          <li class="mx-[7px]"><a href="#" class="log-fb flex items-center p-[40px] py-[10px]">
          <svg xmlns="http://www.w3.org/2000/svg" width="10" height="18" viewBox="0 0 10 18" fill="none" class="mr-[10px]">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M10 0.129808V2.98558H8.18287C6.75926 2.98558 6.49306 3.6238 6.49306 4.54327V6.58774H9.88426L9.43287 9.78966H6.49306V18H2.95139V9.78966H0V6.58774H2.95139V4.22957C2.95139 1.49279 4.74537 0 7.36111 0C8.61111 0 9.6875 0.0865385 10 0.129808Z" fill="#3B5998"/>
          </svg>  
          Facebook</a></li>
        </ul>
        <button type="button" class="sign-up">New User? Sign up</button>
      </form>
    </div>
  </div>
</div>

<script>
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
</script>



