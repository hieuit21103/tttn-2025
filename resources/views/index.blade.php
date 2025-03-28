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
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Đăng nhập</a>
                    </li>
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
                <div class="col-md-8">
                    <div class="card shadow">
                        <div class="card-body">
                            <!-- <form id="dormitoryForm" action="" method="POST" enctype="multipart/form-data"> -->
                            <form id="dormitoryForm" method="POST" enctype="multipart/form-data">                          
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Họ và Tên</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            <input type="text" class="form-control" name="fullname" required placeholder="Nhập họ và tên">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Ngày Sinh</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                            <input type="date" class="form-control" name="birthdate" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Lớp</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-graduation-cap"></i></span>
                                            <input type="text" class="form-control" name="class" required placeholder="Nhập lớp">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Số CMND/CCCD</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                            <input type="text" class="form-control" name="id_number" required placeholder="Nhập số CMND">
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Ảnh CCCD mặt trước</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                            <input type="file" class="form-control" name="id_front" accept="image/*" required>
                                        </div>
                                        <small class="text-muted">Tải lên ảnh CCCD/CMND mặt trước</small>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Ảnh CCCD mặt sau</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                            <input type="file" class="form-control" name="id_back" accept="image/*" required>
                                        </div>
                                        <small class="text-muted">Tải lên ảnh CCCD/CMND mặt sau</small>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Số Điện Thoại Cá Nhân</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                                            <input type="tel" class="form-control" name="personal_phone" required placeholder="Nhập số điện thoại">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Số Điện Thoại Gia Đình</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                            <input type="tel" class="form-control" name="family_phone" required placeholder="Nhập số điện thoại gia đình">
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-12">
                                        <label class="form-label">Địa Chỉ Thường Trú</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                            <input type="text" class="form-control" name="permanent_address" required placeholder="Nhập địa chỉ thường trú">
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="truthCommitment" required>
                                        <label class="form-check-label" for="truthCommitment">
                                            Tôi cam đoan các thông tin trên là đúng sự thật
                                        </label>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="dormitoryRules" required>
                                        <label class="form-check-label" for="dormitoryRules">
                                            Tôi đã đọc và đồng ý 
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#commitmentModal">
                                                <i class="fas fa-external-link-alt"></i> Quy định ký túc xá
                                            </a>
                                        </label>
                                    </div>
                                </div>

                                <button type="submit" id="registerBtn" class="btn btn-primary btn-lg w-100" disabled>
                                    <i class="fas fa-check-circle me-2"></i>Đăng Ký Ký Túc Xá
                                </button>
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
                        <li>Đóng học phí và các khoản phí khác đúng thời hạn.</li>
                        <li>Không được cho người ngoài ở qua đêm, không được mang các vật dụng nguy hiểm, dễ cháy nổ vào khu ký túc xá.</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

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
</body>
@endsection
