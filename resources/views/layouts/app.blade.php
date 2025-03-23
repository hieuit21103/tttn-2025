<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    @yield('css')
    <link rel="icon" href="https://wtc1.edu.vn/wp-content/uploads/2020/10/cropped-1575452751.nv_-32x32.jpg" sizes="32x32">
    @livewireStyles
</head>
@yield('content')
@yield('scripts')