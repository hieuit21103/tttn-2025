<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Đăng Ký Ký Túc Xá')</title>
    <!-- Bootstrap CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" type="text/css" href="{{ url('css/common.css') }}">
    <link rel="icon" href="https://wtc1.edu.vn/wp-content/uploads/2020/10/cropped-1575452751.nv_-32x32.jpg" sizes="32x32">
</head>

<body>
     <div class="bg-white py-2 d-none d-md-block banner">
        <div class="container">
            <div class="d-flex">
            <img width="700" height="125" src="http://wtc1.edu.vn/wp-content/uploads/2020/12/thanh-duong-thuy-noi-quy-khu-the-duc4.png" class="header_logo header-logo" alt="Trường Cao đẳng GTVT đường thủy I- Hàng Giang I">
            </div>
        </div>
    </div>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
        <div class="container">
            <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="#home">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">Giới thiệu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#registration">Đăng ký</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#downloads">Biểu mẫu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Liên hệ</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Content -->
    @yield('content')
    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>KTX Trường Cao Đẳng GTVT Đường Thuỷ I.</h5>
                    <p>Môi trường sống lý tưởng cho sinh viên</p>
                    <div class="d-flex mt-3">
                        <a href="#" class="text-white me-3"><i class="bi bi-facebook fs-4"></i></a>
                        <a href="#" class="text-white me-3"><i class="bi bi-youtube fs-4"></i></a>
                        <a href="#" class="text-white"><i class="bi bi-instagram fs-4"></i></a>
                    </div>
                </div>
                <div class="col-md-3 mt-4 mt-md-0">
                    <h5>Liên kết nhanh</h5>
                    <ul class="list-unstyled">
                        <li><a href="#home" class="text-decoration-none text-light">Trang chủ</a></li>
                        <li><a href="#about" class="text-decoration-none text-light">Giới thiệu</a></li>
                        <li><a href="#registration" class="text-decoration-none text-light">Đăng ký</a></li>
                        <li><a href="#downloads" class="text-decoration-none text-light">Biểu mẫu</a></li>
                    </ul>
                </div>
                <div class="col-md-3 mt-4 mt-md-0">
                    <h5>Hỗ trợ</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-decoration-none text-light">Câu hỏi thường gặp</a></li>
                        <li><a href="#" class="text-decoration-none text-light">Nội quy KTX</a></li>
                        <li><a href="#" class="text-decoration-none text-light">Chính sách</a></li>
                        <li><a href="#contact" class="text-decoration-none text-light">Liên hệ</a></li>
                    </ul>
                </div>
            </div>
            <hr class="mt-4">
            <div class="text-center">
                <p class="mb-0">&copy; {{ date('Y') }} Trường Cao Đẳng GTVT Đường Thuỷ I.</p>
            </div>
        </div>
    </footer>
    @yield('scripts')
</body>

</html>
