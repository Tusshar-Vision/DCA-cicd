<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
  <div class="sm:mx-auto sm:w-full sm:max-w-sm">
    <img class="mx-auto h-10 w-auto" src="<?php echo e(asset('images/LightLogo.svg')); ?>" alt="Your Company">
    <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Sign in to your account</h2>
  </div>

  <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
    <form class="space-y-6" wire:submit="login" method="POST">
      <div>
        <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
        <div class="mt-2">
          <input wire:model="email" id="email" name="email" type="email" autocomplete="email" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-visionBlue sm:text-sm sm:leading-6">
        </div>
      </div>

      <div>
        <div class="flex items-center justify-between">
          <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
          <div class="text-sm">
            <a @click="isLoginFormOpen = false;
                 isRegisterFormOpen = false;
                 isResetFormOpen = true"
               class="font-semibold text-visionBlue hover:text-visionRed cursor-pointer">Forgot password?</a>
          </div>
        </div>
        <div class="mt-2">
          <input wire:model="password" id="password" name="password" type="password" autocomplete="current-password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-visionBlue sm:text-sm sm:leading-6">
        </div>
      </div>

      <!--[if BLOCK]><![endif]--><?php if(session('error')): ?>
        <div>
          <p class="text-sm text-visionRed text-center"><?php echo e(session('error')); ?></p>
        </div>
      <?php endif; ?> <!--[if ENDBLOCK]><![endif]-->

      <div>
        <button type="submit" class="flex w-full justify-center items-center rounded-md bg-visionBlue px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-visionRed focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
          <div class="w-4 h-4 border-t-2 border-white border-solid rounded-full mr-4 animate-spin" wire:loading></div>
          Sign in
        </button>
      </div>
    </form>

    <p class="mt-10 text-center text-sm text-gray-500">
      Not a member?
      <a @click="isLoginFormOpen = false;
                 isRegisterFormOpen = true;
                 isResetFormOpen = false"
         class="font-semibold leading-6 text-visionBlue hover:text-visionRed cursor-pointer">Create a new account</a>
    </p>
  </div>
</div>
<?php /**PATH /home/yash/vision-ca-api/resources/views/livewire/forms/login.blade.php ENDPATH**/ ?>