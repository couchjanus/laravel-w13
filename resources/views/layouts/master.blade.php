<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Meta -->
    @include('layouts.partials.shared._meta')
    @yield('meta')
    
    <!-- Fonts -->
    @include('layouts.partials.shared._fonts')
    @yield('fonts')
    
    <!-- Styles -->
    @include('layouts.partials.shared._styles')
    @yield('styles')
</head>

<body id="page-top">
    @yield('navbar')
    @yield('main')
    @yield('footer')
    <!-- Scripts -->
    @include('layouts.partials.shared._scripts')
    @yield('scripts')
</body>
</html>
