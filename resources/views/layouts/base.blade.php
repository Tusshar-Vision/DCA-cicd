<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title')</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800&display=swap');
  </style>
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  @vite('resources/sass/app.scss')
</head>
<body>
  <div class="mx-auto max-w-[90%]">
    
    <header>
      <x-header />
      <x-initiatives-nav :initiatives="$initiatives" />
      @yield('header')
    </header>

    <main>
        @yield('content')
    </main>

  </div>
  <footer>
    <x-footer />
  </footer>
</body>
</html>