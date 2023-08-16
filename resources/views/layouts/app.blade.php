<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,300;1,400&display=swap');
  </style>
  @vite('resources/css/app.css')
</head>
<body>
  <div class="mx-auto max-w-[90%]">
    <x-header />
    @yield('content')
  </div>
</body>
</html>