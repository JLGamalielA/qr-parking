{{--
    Company: CETAM
    Project: QRP
    File: layouts/app.blade.php
    Description: Layout principal.
--}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>@yield('title') | QR-Parking Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('assets/img/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('assets/img/favicon/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('assets/img/favicon/safari-pinned-tab.svg') }}" color="#ffffff">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">

    <!-- Carga de Estilos y Scripts compilados con Vite -->
    @vite(['resources/scss/volt.scss', 'resources/js/app.js'])
</head>

<body>

    {{-- Menú Lateral (Sidebar) --}}
    @include('layouts.sidenav')

    <main class="content">

        {{-- Barra Superior (Navbar) --}}
        @include('layouts.topbar')

        {{-- Contenido Dinámico de cada vista --}}
        @yield('content')

        {{-- Pie de Página --}}
        @include('layouts.footer')
        
    </main>

    {{-- Scripts globales opcionales si no usas Vite para todo --}}
</body>

</html>