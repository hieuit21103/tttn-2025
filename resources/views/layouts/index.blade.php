@extends('layouts.master')

@section('title', 'Đăng Ký Ký Túc Xá')

@section('content')
    <!-- Hero Section -->
    <section id="home" class="hero-section text-center">
        <div class="container">
            <h1 class="display-4 fw-bold mb-4">KTX Trường Cao Đẳng GTVT Đường Thuỷ I</h1>
            <p class="lead mb-5">Môi trường sống lý tưởng cho sinh viên với đầy đủ tiện nghi và an ninh 24/7</p>
            <a href="#registration" class="btn btn-primary btn-lg me-3">Đăng Ký Ngay</a>
            <a href="#downloads" class="btn btn-outline-light btn-lg">Tải Biểu Mẫu</a>
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
                                    <h4>Tải và điền biểu mẫu đăng ký</h4>
                                    <p>Tải biểu mẫu đăng ký từ mục "Biểu Mẫu" bên dưới và điền đầy đủ thông tin cá nhân theo hướng dẫn.</p>
                                </div>
                            </div>
                            
                            <div class="d-flex mb-4">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; min-width: 40px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">2</div>
                                <div class="ms-3">
                                    <h4>Nộp biểu mẫu và các giấy tờ cần thiết</h4>
                                    <p>Nộp biểu mẫu đã điền cùng với bản photo CMND/CCCD, thẻ sinh viên, và 2 ảnh 3x4 tại Văn phòng KTX.</p>
                                </div>
                            </div>
                            
                            <div class="d-flex mb-4">
                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; min-width: 40px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">3</div>
                                <div class="ms-3">
                                    <h4>Thanh toán phí KTX</h4>
                                    <p>Sau khi hồ sơ được duyệt, tiến hành thanh toán phí KTX theo một trong các phương thức: chuyển khoản ngân hàng, thanh toán trực tiếp tại văn phòng KTX.</p>
                                </div>
                            </div>
                            
                            <div class="d-flex">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; min-width: 40px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">4</div>
                                <div class="ms-3">
                                    <h4>Nhận phòng</h4>
                                    <p>Sau khi hoàn tất các bước trên, sinh viên sẽ được thông báo ngày nhận phòng và các hướng dẫn cần thiết.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

    <!-- Download Forms Section -->
    <section id="downloads" class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Biểu Mẫu Đăng Ký</h2>
            <hr class="w-25 mx-auto">
        </div>
        
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow border-primary">
                    <div class="card-body">
                        <h4 class="card-title text-center mb-4">Tải Các Biểu Mẫu Cần Thiết</h4>
                        
                        <div class="list-group">
                            @foreach ([
                                ['url' => '/forms/dang-ky-ktx.pdf', 'title' => 'Đơn đăng ký KTX', 'description' => 'Mẫu đơn đăng ký ở KTX dành cho sinh viên', 'icon' => 'fas fa-file-signature'],
                                ['url' => '/forms/cam-ket.pdf', 'title' => 'Bản cam kết', 'description' => 'Bản cam kết tuân thủ nội quy KTX', 'icon' => 'fas fa-handshake'],
                                ['url' => '/forms/huong-dan.pdf', 'title' => 'Hướng dẫn đăng ký', 'description' => 'Tài liệu hướng dẫn chi tiết quy trình đăng ký KTX', 'icon' => 'fas fa-book'],
                                ['url' => '/forms/noi-quy.pdf', 'title' => 'Nội quy KTX', 'description' => 'Nội quy và quy định của Ký túc xá', 'icon' => 'fas fa-clipboard-list'],
                            ] as $form)
                                <a href="{{ url($form['url']) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center hover-effect">
                                    <div>
                                        <h5 class="mb-1"><i class="{{ $form['icon'] }} me-1"></i>{{ $form['title'] }}</h5>
                                        <p class="mb-1 text-muted">{{ $form['description'] }}</p>
                                    </div>
                                    <span class="btn btn-sm btn-primary">
                                        <i class="fa-solid fa-download"></i>
                                        Tải xuống
                                    </span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
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
@endsection