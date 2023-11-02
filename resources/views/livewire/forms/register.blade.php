<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <img class="mx-auto h-10 w-auto" src="{{ asset('images/LightLogo.svg') }}" alt="Your Company">
        <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Create new account</h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <form class="space-y-6" wire:submit="register" method="POST">
            <div>
                <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">First Name</label>
                <div class="mt-2">
                    <input wire:model="email" id="email" name="email" type="email" autocomplete="email" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-visionBlue sm:text-sm sm:leading-6">
                </div>
            </div>
            <div>
                <label for="last-name" class="block text-sm font-medium leading-6 text-gray-900">Last Name</label>
                <div class="mt-2">
                    <input wire:model="email" id="email" name="email" type="email" autocomplete="email" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-visionBlue sm:text-sm sm:leading-6">
                </div>
            </div>
            <div>
                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
                <div class="mt-2">
                    <input wire:model="email" id="email" name="email" type="email" autocomplete="email" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-visionBlue sm:text-sm sm:leading-6">
                </div>
            </div>

            <div>
                <div class="flex items-center justify-between">
                    <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                </div>
                <div class="mt-2">
                    <input wire:model="password" id="password" name="password" type="password" autocomplete="current-password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-visionBlue sm:text-sm sm:leading-6">
                </div>
            </div>

            @if(session('error'))
                <div>
                    <p class="text-sm text-visionRed text-center">{{ session('error') }}</p>
                </div>
            @endif

            <div>
                <button type="submit" class="flex w-full justify-center items-center rounded-md bg-visionBlue px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-visionRed focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    <div class="w-4 h-4 border-t-2 border-white border-solid rounded-full mr-4 animate-spin" wire:loading></div>
                    Create account
                </button>
            </div>
        </form>

        <p class="mt-10 text-center text-sm text-gray-500">
            Already a member?
            <a @click="isLoginFormOpen = true;
                 isRegisterFormOpen = false;
                 isResetFormOpen = false;"
               class="font-semibold leading-6 text-visionBlue hover:text-visionRed cursor-pointer">Login</a>
        </p>
    </div>
</div>
