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
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user-circle me-2"></i> Tài khoản
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}">
                                    <i class="fas fa-sign-out-alt me-2"></i> Đăng xuất
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
@livewire('maincontainer')
@endsection
