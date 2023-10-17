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
</head>
<body x-data="{ isModalOpen: false }">
  <div class="mx-auto max-w-[90%]">
    <header>
      <x-ui.header.header />
      <x-initiatives-nav :initiatives="$initiatives" />
      @yield('header')
    </header>

    <main>
        @yield('content')
    </main>
  </div>

  <footer>
    <x-ui.footer.footer />
  </footer>
  
  <x-modal-box x-show="isModalOpen">
    <livewire:login-form />
  </x-modal-box>
</body>
</html>