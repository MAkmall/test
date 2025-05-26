@extends('layouts.admin')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - @yield('title', 'SPK Beasiswa')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Tambahkan asset lain jika perlu -->
</head>
<body>
    @include('templates.left-sidebar')
    <div class="content-wrapper" style="margin-left:250px;">
        @yield('content')
    </div>
</body>
</html>