<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <title>@yield('title')</title>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,600;0,700;1,400&family=Tiro+Devanagari+Hindi&display=swap');
        </style>
        @vite('resources/sass/app.scss')
        @yield('styles')
    </head>

    <body x-data="{
        isAuthFormOpen: false,
        isDarkModeEnabled: false,
        init() {
            const storedPreference = localStorage.getItem('isDarkModeEnabled');
            if (storedPreference !== null) {
                this.isDarkModeEnabled = storedPreference === 'true';
            } else {
                this.isDarkModeEnabled = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
            }
        }
    }" :class="{ 'dark' : isDarkModeEnabled }">
        <div class="mx-auto w-full px-[20px] lg:px-0 lg:max-w-[90%]">
            <header>
                <x-header />
                <x-navigation.initiatives />
                @yield('header')
            </header>

            <main x-data="{ isNoteOpen: false }">
                @yield('content')
            </main>
        </div>

        <footer>
            @yield('footer')
                <x-footer />
        </footer>

        <x-modals.login-modal x-show="isAuthFormOpen">
            <template x-if="isAuthFormOpen">
                <livewire:widgets.auth-container />
            </template>
        </x-modals.login-modal>
    </body>
    @vite('resources/js/app.js')
    @stack('scripts')
</html>
