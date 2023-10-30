<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title')</title>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800&display=swap');
        </style>
        @vite('resources/sass/app.scss')
        @vite('resources/js/app.js')
    </head>
    <body x-data="{ isLoginFormOpen: false, isRegisterFormOpen: false, isResetFormOpen: false }">
        <div class="mx-auto max-w-[90%]">
            <header>
                <x-header />
                <x-navigation.initiatives :initiatives="$initiatives" />
                @yield('header')
            </header>

            <main>
                @yield('content')
            </main>
        </div>

        <footer>
            @yield('footer')
            <x-footer />
        </footer>

        <x-modals.modal-box x-show="isLoginFormOpen">
            <livewire:forms.login />
        </x-modals.modal-box>

        <x-modals.modal-box x-show="isRegisterFormOpen">
            <livewire:forms.register />
        </x-modals.modal-box>

        <x-modals.modal-box x-show="isResetFormOpen">
            <livewire:forms.reset-password />
        </x-modals.modal-box>
    </body>
</html>
