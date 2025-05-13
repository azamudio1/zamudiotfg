<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="relative overflow-auto bg-gradient-to-br from-purple-900 via-fuchsia-700 to-blue-900 text-white min-h-screen">

    <div class="absolute inset-0 z-0 pointer-events-none bg-[radial-gradient(ellipse_at_top_left,_var(--tw-gradient-stops))] from-purple-700/30 via-transparent to-blue-900/10"></div>

    @include('layouts.navbar')

    <main class="relative z-10 p-6 min-h-screen">
        @yield('content')
    </main>

</body>
</html>
