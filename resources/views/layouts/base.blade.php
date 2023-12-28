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
    @vite('resources/js/app.js')
    <script type="text/javascript" src="{{ URL::asset('js/rangy/rangy-core.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/rangy/rangy-classapplier.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/rangy/rangy-highlighter.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/rangy/highlighter.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>
    <script src="{{ asset('vendor/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
</head>

<body x-data="{ isLoginFormOpen: false, isRegisterFormOpen: false, isResetFormOpen: false, isEmailVerificationFormOpen: false }">
    <div class="mx-auto max-w-[90%]">
        <header>
            <x-header />
            <x-navigation.initiatives :initiatives="$initiatives" />
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

    <x-modals.login-modal x-show="isLoginFormOpen">
        <livewire:forms.login />
    </x-modals.login-modal>

    <x-modals.login-modal x-show="isRegisterFormOpen">
        <livewire:forms.register />
    </x-modals.login-modal>

    <x-modals.login-modal x-show="isResetFormOpen">
        <livewire:forms.reset-password />
    </x-modals.login-modal>

    <x-modals.login-modal x-show="isEmailVerificationFormOpen">
        <livewire:forms.email-verification />
    </x-modals.login-modal>

    @stack('scripts')

</body>

</html>
