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

    <body x-data="{ isAuthFormOpen: false }">
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
            @stack('scripts')
        </footer>

        <x-modals.login-modal x-show="isAuthFormOpen">
            <livewire:widgets.auth-container />
        </x-modals.login-modal>
    </body>
</html>
