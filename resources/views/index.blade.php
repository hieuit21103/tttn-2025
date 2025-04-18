@extends('layouts.app')
@section('title', 'Đăng Ký Ký Túc Xá')

@section('css')
    <link rel="stylesheet" href="{{ url('css/common.css') }}">
@endsection
@section('content')
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
                        <a class="nav-link" href="#contact">Liên hệ</a>
                    </li>
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Đăng nhập</a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile') }}">
                                        <i class="fas fa-user me-2"></i>Thông tin cá nhân
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a href="{{ route('payment') }}" class="dropdown-item">
                                        <i class="fas fa-credit-card me-2"></i>Thanh toán
                                    </a>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}">
                                        <i class="fas fa-sign-out-alt me-2"></i>Đăng xuất
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    <!-- Content -->
    <!-- Hero Section -->
    <section id="home" class="hero-section text-center">
        <div class="container">
            <h1 class="display-4 fw-bold mb-4">KTX Trường Cao Đẳng GTVT Đường Thuỷ I</h1>
            <p class="lead mb-5">Môi trường sống lý tưởng cho sinh viên với đầy đủ tiện nghi và an ninh 24/7</p>
            <a href="#registration" class="btn btn-primary btn-lg me-3">Đăng Ký Ngay</a>
        </div>
    </section>

    <!-- About University Section -->
    <section id="about" class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Giới Thiệu Về Trường Đại Học</h2>
            <hr class="w-25 mx-auto">
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <img src="{{ url('/images/introduction.png') }}" alt="Trường Đại Học" class="img-fluid rounded shadow">
            </div>
            <div class="col-md-6 d-flex align-items-center">
                <div>
                    <h3 class="mb-4">Trường Cao Đẳng GTVT Đường Thuỷ I - Nơi Ươm Mầm Tài Năng</h3>
                    <p>Trường Cao đẳng Giao thông vận tải Đường thủy I, thành lập năm 1961 tại Hải Phòng với tên Trường Hàng Giang, đã trải qua nhiều lần đổi tên và nâng cấp, chính thức mang tên hiện tại từ năm 2017. Với hơn 60 năm phát triển, trường đã đào tạo hàng ngàn kỹ sư, thuyền trưởng, máy trưởng và cán bộ chuyên môn, góp phần cung cấp nguồn nhân lực chất lượng cao cho ngành giao thông vận tải đường thủy.</p>
                    <p>Ký túc xá của trường được xây dựng với mục tiêu cung cấp môi trường sống an toàn, tiện nghi và thân thiện cho sinh viên, tạo điều kiện tốt nhất để các bạn có thể tập trung vào việc học tập và nghiên cứu.</p>
                </div>
            </div>
        </div>
    </div>
    </section>

    <!-- Dormitory Features -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Tiện Ích KTX</h2>
                <hr class="w-25 mx-auto">
            </div>
            
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card feature-card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <div class="feature-icon">
                                <i class="bi bi-shield-check"></i>
                            </div>
                            <h4 class="card-title">An Ninh 24/7</h4>
                            <p class="card-text">Hệ thống an ninh hiện đại với nhân viên bảo vệ trực 24/7, đảm bảo sự an toàn cho sinh viên.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card feature-card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <div class="feature-icon">
                                <i class="bi bi-wifi"></i>
                            </div>
                            <h4 class="card-title">Internet Tốc Độ Cao</h4>
                            <p class="card-text">Kết nối internet nhanh chóng, ổn định giúp sinh viên học tập và giải trí thuận lợi.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card feature-card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <div class="feature-icon">
                                <i class="bi bi-book"></i>
                            </div>
                            <h4 class="card-title">Phòng Học Tập</h4>
                            <p class="card-text">Không gian học tập yên tĩnh, thoáng mát với đầy đủ trang thiết bị học tập cần thiết.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @guest
    <!-- Registration Process -->
    <section id="registration" class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Quy Trình Đăng Ký KTX</h2>
                <hr class="w-25 mx-auto">
            </div>
            
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="timeline">
                                <div class="d-flex mb-4">
                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; min-width: 40px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">1</div>
                                    <div class="ms-3">
                                        <h4>Điền đơn đăng ký trực tuyến</h4>
                                        <p>Điền đầy đủ thông tin vào biểu mẫu đăng ký trực tuyến và tải lên ảnh CCCD/CMND mặt trước, mặt sau.</p>
                                    </div>
                                </div>
                                
                                <div class="d-flex mb-4">
                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; min-width: 40px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">2</div>
                                    <div class="ms-3">
                                        <h4>Chuẩn bị hồ sơ bổ sung</h4>
                                        <p>Chuẩn bị thẻ sinh viên và 2 ảnh 3x4 để nộp khi nhận phòng.</p>
                                    </div>
                                </div>
                                
                                <div class="d-flex mb-4">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; min-width: 40px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">3</div>
                                    <div class="ms-3">
                                        <h4>Xác nhận và thanh toán</h4>
                                        <p>Sau khi đăng ký thành công, bạn sẽ nhận được email xác nhận kèm thông tin thanh toán phí KTX.</p>
                                    </div>
                                </div>
                                
                                <div class="d-flex">
                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; min-width: 40px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">4</div>
                                    <div class="ms-3">
                                        <h4>Nhận phòng</h4>
                                        <p>Mang theo hồ sơ đã chuẩn bị và biên lai thanh toán đến văn phòng KTX để làm thủ tục nhận phòng theo lịch hẹn.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Registration Form Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Đăng Ký Ký Túc Xá</h2>
                <hr class="w-25 mx-auto">
            </div>
            
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card shadow">
                        <div class="card-body">
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            @if(session('error'))
                                <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            <form id="registrationForm" action="{{ route('dormitory.register') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Mã Học Sinh</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                                            <input type="text" class="form-control @error('student_code') is-invalid @enderror" name="student_code" value="{{ old('student_code') }}" required>
                                            @error('student_code')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label class="form-label">Họ và Tên</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            <input type="text" class="form-control @error('fullname') is-invalid @enderror" name="fullname" value="{{ old('fullname') }}" required>
                                            @error('fullname')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Giới tính</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-venus-mars"></i></span>
                                            <select class="form-select @error('gender') is-invalid @enderror" name="gender" required>
                                                <option value="">Chọn giới tính</option>
                                                <option value="Nam">Nam</option>
                                                <option value="Nữ">Nữ</option>
                                            </select>
                                        </div>
                                        @error('gender')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Ngày Sinh</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                            <input type="date" class="form-control @error('birthdate') is-invalid @enderror" name="birthdate" value="{{ old('birthdate') }}" required>
                                            @error('birthdate')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Khoa</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-graduation-cap"></i></span>
                                            <select class="form-select @error('faculty') is-invalid @enderror" name="faculty_id" id="faculty" required>
                                                <option value="">Chọn khoa</option>
                                                @foreach($faculties as $faculty)
                                                    <option value="{{ $faculty->id }}" {{ old('faculty') == $faculty->id ? 'selected' : '' }}>
                                                        {{ $faculty->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('faculty')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Lớp</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-graduation-cap"></i></span>
                                            <select class="form-select @error('class') is-invalid @enderror" name="class_id" id="class" required disabled>
                                                <option value="">Chọn lớp</option>
                                            </select>
                                            @error('class')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Số CMND/CCCD</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                            <input type="text" class="form-control @error('id_number') is-invalid @enderror" name="id_number" value="{{ old('id_number') }}" required>
                                            @error('id_number')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Email</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                                        </div>
                                        <div class="form-text">Chúng tôi sẽ gửi thông tin về học phí và xác nhận đăng ký đến email này.</div>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Số Điện Thoại Cá Nhân</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                            <input type="text" class="form-control @error('personal_phone') is-invalid @enderror" name="personal_phone" value="{{ old('personal_phone') }}" required>
                                            @error('personal_phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Số Điện Thoại Gia Đình</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-home"></i></span>
                                            <input type="text" class="form-control @error('family_phone') is-invalid @enderror" name="family_phone" value="{{ old('family_phone') }}" required>
                                            @error('family_phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <label class="form-label">Ảnh CCCD mặt trước</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                            <input type="file" class="form-control @error('id_front') is-invalid @enderror" name="id_front" required>
                                            @error('id_front')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-12">
                                        <label class="form-label">Ảnh CCCD mặt sau</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                            <input type="file" class="form-control @error('id_back') is-invalid @enderror" name="id_back" required>
                                            @error('id_back')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <label class="form-label">Địa Chỉ Thường Trú</label>
                                        <div class="row g-2">
                                            <div class="col-md-4">
                                                <select class="form-select @error('city') is-invalid @enderror" name="city" id="city" required>
                                                    <option value="">Chọn Tỉnh/Thành phố</option>
                                                </select>
                                                @error('city')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <select class="form-select @error('district') is-invalid @enderror" name="district" id="district" required disabled>
                                                    <option value="">Chọn Quận/Huyện</option>
                                                </select>
                                                @error('district')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <select class="form-select @error('ward') is-invalid @enderror" name="ward" id="ward" required disabled>
                                                    <option value="">Chọn Phường/Xã</option>
                                                </select>
                                                @error('ward')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <label class="form-label">Địa chỉ chi tiết</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                            <input type="text" class="form-control @error('address_detail') is-invalid @enderror" name="address_detail" value="{{ old('address_detail') }}" required>
                                            @error('address_detail')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input @error('truth_commitment') is-invalid @enderror" type="checkbox" name="truth_commitment" id="truth_commitment" required>
                                        <label class="form-check-label" for="truth_commitment">
                                            Tôi cam kết thông tin trên là chính xác
                                        </label>
                                        @error('truth_commitment')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input @error('dormitory_rules') is-invalid @enderror" type="checkbox" name="dormitory_rules" id="dormitory_rules" required>
                                        <label class="form-check-label" for="dormitory_rules">
                                            Tôi đã đọc và đồng ý với <a href="{{ asset('documents/noi-quy.pdf') }}" target="_blank"><i class="fas fa-file-pdf"></i> quy định ký túc xá</a>
                                        </label>
                                        @error('dormitory_rules')
                                           <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary btn-lg" id="registerBtn">
                                        <i class="fas fa-paper-plane me-2"></i>Đăng Ký
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Cam Kết -->
    <div class="modal fade" id="commitmentModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-file-contract me-2"></i>Quy Định Ký Túc Xá
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <ol>
                        <li>Chấp hành nghiêm chỉnh nội quy, quy chế của ký túc xá và của nhà trường.</li>
                        <li>Giữ gìn vệ sinh phòng ở, khu vực chung và bảo quản tài sản của ký túc xá.</li>
                        <li>Không được tự ý thay đổi, sửa chữa phòng ở khi chưa được sự đồng ý của ban quản lý.</li>
                        <li>Chấp hành các quy định về an ninh, an toàn và phòng chống cháy nổ.</li>
                        <li>Đóng học phí và các khoản phí khác đúng thói hạn.</li>
                        <li>Không được cho người ngoài ở qua đêm, không được mang các vật dụng nguy hiểm, dễ cháy nổ vào khu ký túc xá.</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    @endguest

    <!-- Contact Section -->
    <section id="contact" class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Liên Hệ</h2>
                <hr class="w-25 mx-auto">
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-4 mb-md-0">
                    <div class="card shadow h-100">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Thông Tin Liên Hệ</h4>
                            <ul class="list-unstyled">
                                <li class="mb-3 d-flex align-items-center">
                                    <i class="bi bi-geo-alt-fill me-3 text-primary fs-5"></i>
                                    <span>Số 22 Đinh Nhu - P. Lam Sơn - Q. Lê Chân -TP. Hải Phòng</span>
                                </li>
                                <li class="mb-3 d-flex align-items-center">
                                    <i class="bi bi-telephone-fill me-3 text-primary fs-5"></i>
                                    <span>(0225)3835190</span>
                                </li>
                                <li class="mb-3 d-flex align-items-center">
                                    <i class="bi bi-envelope-fill me-3 text-primary fs-5"></i>
                                    <span>ktx@truongdaihoc.edu.vn</span>
                                </li>
                                <li class="d-flex align-items-center">
                                    <i class="bi bi-clock-fill me-3 text-primary fs-5"></i>
                                    <span>Giờ làm việc: Thứ 2 - Thứ 6 (8:00 - 17:00)</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="card shadow h-100">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Gửi Thắc Mắc</h4>
                            <form action="{{ route('contact.submit') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Họ và tên</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Số điện thoại</label>
                                    <input type="tel" class="form-control" id="phone" name="phone">
                                </div>
                                <div class="mb-3">
                                    <label for="message" class="form-label">Nội dung thắc mắc</label>
                                    <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Gửi thắc mắc</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const truthCommitment = document.getElementById('truth_commitment');
            const dormitoryRules = document.getElementById('dormitory_rules');
            const registerBtn = document.getElementById('registerBtn');
            const facultySelect = document.querySelector('select[name="faculty_id"]');
            const classSelect = document.querySelector('select[name="class_id"]');
            const citis = document.getElementById("city");
            const districts = document.getElementById("district");
            const wards = document.getElementById("ward");
            
            function checkButtonStatus() {
                const addressValid = citis.value && districts.value && wards.value;
                registerBtn.disabled = !(truthCommitment.checked && dormitoryRules.checked && addressValid);
            }

            function loadClassesByFaculty(facultyCode) {
                if (!facultyCode) {
                    classSelect.length = 1;
                    classSelect.disabled = true;
                    return;
                }

                axios.get(`{{ route('classes.byFaculty') }}/${facultyCode}`)
                    .then(function(response) {
                        classSelect.length = 1;
                        classSelect.disabled = false;
                        response.data.forEach(function(classItem) {
                            const option = new Option(`${classItem.name}`, classItem.id);
                            classSelect.appendChild(option);
                        });
                    })
                    .catch(function(error) {
                        console.error('Error loading classes:', error.message);
                        alert('Không thể tải danh sách lớp. Vui lòng thử lại sau.');
                        classSelect.length = 1;
                        classSelect.disabled = true;
                    });
            }

            facultySelect.addEventListener('change', function() {
                loadClassesByFaculty(this.value);
                checkButtonStatus();
            });

            // Load classes based on the initially selected faculty
            if (facultySelect.value) {
                loadClassesByFaculty(facultySelect.value);
            }

            truthCommitment.addEventListener('change', checkButtonStatus);
            dormitoryRules.addEventListener('change', checkButtonStatus);
            var Parameter = {
                url: "{{ route('address.data') }}", 
                method: "GET"
            };
            
            axios(Parameter)
                .then(function (response) {
                    if (response.data && Array.isArray(response.data)) {
                        renderCity(response.data);
                    } else {
                        throw new Error('Invalid data format');
                    }
                })
                .catch(function (error) {
                    console.error("Error loading address data:", error);
                    alert("Không thể tải dữ liệu địa chỉ. Vui lòng thử lại sau.");
                });

            function renderCity(data) {
                district.length = 1;
                ward.length = 1;
                district.disabled = true;
                ward.disabled = true;

                if (!Array.isArray(data)) {
                    console.error("Data is not an array");
                    return;
                }

                citis.length = 1;
                citis.options[0] = new Option("Chọn thành phố", "");
                for (const x of data) {
                    citis.options[citis.options.length] = new Option(x.Name, x.Name);
                }

                citis.onchange = function () {
                    district.length = 1;
                    ward.length = 1;
                    district.disabled = true;
                    ward.disabled = true;
                    
                    if(this.value !== "") {
                        const result = data.find(n => n.Name === this.value);
                        if (result && result.Districts) {
                            district.disabled = false;
                            district.length = 1;
                            district.options[0] = new Option("Chọn quận/huyện", "");
                            for (const k of result.Districts) {
                                district.options[district.options.length] = new Option(k.Name, k.Name);
                            }
                        }
                    }
                    checkButtonStatus();
                };

                district.onchange = function () {
                    ward.length = 1;
                    ward.disabled = true;
                    
                    if(this.value !== "" && citis.value !== "") {
                        const result = data.find(n => n.Name === citis.value);
                        if (result && result.Districts) {
                            const districtData = result.Districts.find(d => d.Name === this.value);
                            if (districtData && districtData.Wards) {
                                ward.disabled = false;
                                ward.length = 1;
                                ward.options[0] = new Option("Chọn phường/xã", "");
                                for (const p of districtData.Wards) {
                                    ward.options[ward.options.length] = new Option(p.Name, p.Name);
                                }
                            }
                        }
                    }
                    checkButtonStatus();
                };

                citis.onchange();
            }

            wards.onchange = checkButtonStatus;
        });
    </script>
</body>
@endsection
