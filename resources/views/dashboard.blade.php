@extends('layouts.app')
@section('title', 'Trang chủ')
@section('css')
    <link rel="stylesheet" href="{{ url('css/dashboard.css') }}">
@endsection
@section('content')
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="#">HỆ THỐNG QUẢN LÝ NỘI TRÚ</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto d-flex align-items-center">
                    <li class="nav-item">
                        <span class="text-white me-3">Xin chào, {{ Auth::user()->name }}</span>
                    </li>
                    <li class="nav-item ms-3">
                        <a href="{{ route('logout') }}" class="btn btn-outline-light btn-sm">
                            <i class="fas fa-sign-out-alt me-1"></i> Đăng xuất
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
@livewire('maincontainer')
@endsection
