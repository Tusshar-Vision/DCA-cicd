<div class="flex min-h-[680px] justify-center text-center items-stretch bg-white">
    <div class="w-6/12 flex items-center" style="background: #F5F7F8;">
      <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script> 
      <dotlottie-player src="https://lottie.host/efd12853-25b1-4c36-bf27-3d0efb0eea46/mtnAb2oVRI.json" background="transparent" speed="1" style="width: 300px; height: 300px; margin: 0 auto;" loop autoplay></dotlottie-player>
    </div>
    <div class="w-6/12 flex flex-col justify-center px-[56px] loginwrap">
      <h2 class="font-medium text-base mb-5">Password Reset Successful</h2>
      <p class="text-sm	font-normal mb-[50px]">Your password has been changed successfully!</p>
      <form class="w-full">
        <button type="submit" class="login-btn">continue to login</button>
      </form>
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



