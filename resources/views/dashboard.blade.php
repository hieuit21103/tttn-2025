@extends('layouts.app')
@section('title', 'Trang chủ')
@section('css')
    <link rel="stylesheet" href="{{ url('css/dashboard.css') }}">
@endsection
@section('content')
<body class="bg-light">
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

    <!-- Main Content -->
    <div class="container-fluid mt-3">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2">
                <div class="card shadow-sm mb-4">
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-center align-items-center mb-4">
                            <img src="https://thuvien.wtc1.edu.vn/public/themes/images/logo.png" alt="Logo trường" class="rounded-circle" width="64">
                        </div>
                        <div class="nav flex-column">
                            <a href="#" class="nav-link active py-2">
                                <i class="fas fa-home me-2"></i> Trang chủ
                            </a>
                            <a href="#" class="nav-link py-2">
                                <i class="fas fa-user-graduate me-2"></i> Quản lý học sinh
                            </a>
                            <a class="nav-link py-2" >
                                <i class="fas fa-building me-2"></i> Quản lý phòng ở
                            </a>
                            <a href="#" class="nav-link py-2">
                                <i class="fas fa-clipboard-list me-2"></i> Điểm danh
                            </a>
                            <a href="#" class="nav-link py-2">
                                <i class="fas fa-money-bill-wave me-2"></i> Quản lý học phí
                            </a>
                            <a href="#" class="nav-link py-2">
                                <i class="fas fa-exclamation-circle me-2"></i> Vi phạm kỷ luật
                            </a>
                            <a href="#" class="nav-link py-2">
                                <i class="fas fa-chart-bar me-2"></i> Thống kê báo cáo
                            </a>
                            <a href="#" class="nav-link py-2">
                                <i class="fas fa-cog me-2"></i> Cài đặt hệ thống
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Area -->
                <div class="col-md-9 col-lg-10">
                    <div class="card shadow-sm">
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
</script>
@endsection
