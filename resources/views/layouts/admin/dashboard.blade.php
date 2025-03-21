@extends('layouts.admin.master')

@section('title','Quản lý học sinh nội trú')

@section('content')
<body>
    <!-- Mobile menu toggle button -->
    <div class="d-md-none mobile-header p-2 d-flex justify-content-between align-items-center">
        <button class="btn btn-dark" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>
        <h5 class="mb-0 text-white">Quản lý Học sinh</h5>
        <div class="dropdown">
            <button class="btn btn-dark dropdown-toggle" type="button" id="mobileUserDropdown" data-bs-toggle="dropdown">
                <i class="fas fa-user"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i> Tài khoản</a></li>
                <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i> Cài đặt</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt me-2"></i> Đăng xuất</a></li>
            </ul>
        </div>
    </div>

    <!-- Mobile overlay for sidebar -->
    <div class="mobile-overlay" id="mobileOverlay"></div>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 sidebar px-0 d-flex flex-column" id="sidebar">
                <div class="p-3 text-center d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">QUẢN LÝ HỌC SINH</h4>
                    <button class="btn-close text-white d-md-none" id="sidebarClose"></button>
                </div>
                <div class="nav flex-column px-3">
                    <a href="#" class="nav-link active">
                        <i class="fas fa-users me-2"></i>Danh sách học sinh
                    </a>
                    <a href="#" class="nav-link">
                        <i class="fa-solid fa-house"></i> Danh sách phòng   
                    </a>
                    <a href="#" class="nav-link">
                    <i class="fa-solid fa-house-user"></i> Danh sách loại phòng
                    </a>
                    <a href="#" class="nav-link">
                    <i class="fa-duotone fa-solid fa-money-bill"></i> Quản lý giá phòng
                    </a>
                    <a href="#" class="nav-link">
                    <i class="fa-solid fa-user-lock"></i> Quản lý vi phạm nội quy
                    </a>
                    <a href="#" class="nav-link">
                    <i class="fa-solid fa-chart-simple"></i> Báo cáo thống kê
                    </a>
                    <a href="#" class="nav-link">
                        <i class="fas fa-cog me-2"></i> Cài đặt
                    </a>
                </div>
                <div class="mt-auto p-3">
                    <a href="#" class="nav-link">
                        <i class="fas fa-sign-out-alt me-2"></i> Đăng xuất
                    </a>
                </div>
            </div>
            
            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 main-content p-0">
                <!-- Header - visible only on desktop -->
                <div class="header p-3 d-none d-md-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Danh sách học sinh</h5>
                    <div class="d-flex align-items-center">
                        <div class="dropdown me-3">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="notificationDropdown" data-bs-toggle="dropdown">
                                <i class="fas fa-bell"></i>
                                <span class="badge bg-danger">3</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#">Học sinh mới đăng ký</a></li>
                                <li><a class="dropdown-item" href="#">Yêu cầu xin nghỉ học</a></li>
                                <li><a class="dropdown-item" href="#">Lịch họp phụ huynh</a></li>
                            </ul>
                        </div>
                        <div class="dropdown">
                            <button class="btn dropdown-toggle d-flex align-items-center" type="button" id="userDropdown" data-bs-toggle="dropdown">
                                <img src="/api/placeholder/40/40" class="student-avatar me-2" alt="Admin">
                                <span>Admin</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i> Tài khoản</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i> Cài đặt</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt me-2"></i> Đăng xuất</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <!-- Student Management Content -->
                <div class="p-4">
                    <!-- Section title - visible only on mobile -->
                    <div class="d-md-none mb-3">
                        <h5>Danh sách học sinh</h5>
                    </div>
                    
                    <!-- Filter & Search -->
                    <div class="row mb-4">
                        <div class="col-12 col-md-6 mb-3 mb-md-0">
                            <div class="search-bar input-group">
                                <input type="text" class="form-control" placeholder="Tìm kiếm học sinh...">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 d-flex flex-wrap justify-content-md-end">
                            <button class="btn btn-success me-2 mb-2 mb-md-0">
                                <i class="fas fa-plus me-1"></i> Thêm học sinh
                            </button>
                            <div class="dropdown">
                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown">
                                    <i class="fas fa-filter me-1"></i> Lọc
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="#">Lớp 10</a></li>
                                    <li><a class="dropdown-item" href="#">Lớp 11</a></li>
                                    <li><a class="dropdown-item" href="#">Lớp 12</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="#">Học sinh giỏi</a></li>
                                    <li><a class="dropdown-item" href="#">Học sinh cần hỗ trợ</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Student Table -->
                    <div class="table-container p-3">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 50px">#</th>
                                    <th style="width: 60px"></th>
                                    <th>Họ và tên</th>
                                    <th class="d-none d-md-table-cell">Mã học sinh</th>
                                    <th>Lớp</th>
                                    <th class="d-none d-md-table-cell">Ngày sinh</th>
                                    <th class="d-none d-md-table-cell">Điểm TB</th>
                                    <th>Trạng thái</th>
                                    <th style="width: 130px">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td><img src="/api/placeholder/40/40" class="student-avatar" alt="Học sinh"></td>
                                    <td>Nguyễn Văn A</td>
                                    <td class="d-none d-md-table-cell">SV2024001</td>
                                    <td>10A1</td>
                                    <td class="d-none d-md-table-cell">15/05/2008</td>
                                    <td class="d-none d-md-table-cell">8.5</td>
                                    <td><span class="badge bg-success">Đang học</span></td>
                                    <td class="action-buttons">
                                        <button class="btn btn-primary me-1" title="Xem"><i class="fas fa-eye"></i></button>
                                        <button class="btn btn-warning me-1" title="Sửa"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-danger" title="Xóa"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td><img src="/api/placeholder/40/40" class="student-avatar" alt="Học sinh"></td>
                                    <td>Trần Thị B</td>
                                    <td class="d-none d-md-table-cell">SV2024002</td>
                                    <td>10A2</td>
                                    <td class="d-none d-md-table-cell">22/08/2008</td>
                                    <td class="d-none d-md-table-cell">9.0</td>
                                    <td><span class="badge bg-success">Đang học</span></td>
                                    <td class="action-buttons">
                                        <button class="btn btn-primary me-1" title="Xem"><i class="fas fa-eye"></i></button>
                                        <button class="btn btn-warning me-1" title="Sửa"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-danger" title="Xóa"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td><img src="/api/placeholder/40/40" class="student-avatar" alt="Học sinh"></td>
                                    <td>Lê Văn C</td>
                                    <td class="d-none d-md-table-cell">SV2024003</td>
                                    <td>10A3</td>
                                    <td class="d-none d-md-table-cell">10/03/2008</td>
                                    <td class="d-none d-md-table-cell">7.8</td>
                                    <td><span class="badge bg-warning text-dark">Nghỉ phép</span></td>
                                    <td class="action-buttons">
                                        <button class="btn btn-primary me-1" title="Xem"><i class="fas fa-eye"></i></button>
                                        <button class="btn btn-warning me-1" title="Sửa"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-danger" title="Xóa"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td><img src="/api/placeholder/40/40" class="student-avatar" alt="Học sinh"></td>
                                    <td>Phạm Thị D</td>
                                    <td class="d-none d-md-table-cell">SV2024004</td>
                                    <td>10A1</td>
                                    <td class="d-none d-md-table-cell">05/12/2008</td>
                                    <td class="d-none d-md-table-cell">8.2</td>
                                    <td><span class="badge bg-success">Đang học</span></td>
                                    <td class="action-buttons">
                                        <button class="btn btn-primary me-1" title="Xem"><i class="fas fa-eye"></i></button>
                                        <button class="btn btn-warning me-1" title="Sửa"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-danger" title="Xóa"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td><img src="/api/placeholder/40/40" class="student-avatar" alt="Học sinh"></td>
                                    <td>Hoàng Văn E</td>
                                    <td class="d-none d-md-table-cell">SV2024005</td>
                                    <td>10A2</td>
                                    <td class="d-none d-md-table-cell">18/07/2008</td>
                                    <td class="d-none d-md-table-cell">6.5</td>
                                    <td><span class="badge bg-danger">Cần hỗ trợ</span></td>
                                    <td class="action-buttons">
                                        <button class="btn btn-primary me-1" title="Xem"><i class="fas fa-eye"></i></button>
                                        <button class="btn btn-warning me-1" title="Sửa"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-danger" title="Xóa"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        
                        <!-- Pagination -->
                        <nav>
                            <ul class="pagination justify-content-end flex-wrap">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1">Trước</a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Sau</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Mobile sidebar toggle functionality
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebarClose = document.getElementById('sidebarClose');
            const mobileOverlay = document.getElementById('mobileOverlay');
            
            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('show');
                mobileOverlay.classList.toggle('show');
                document.body.classList.toggle('overflow-hidden');
            });
            
            sidebarClose.addEventListener('click', function() {
                sidebar.classList.remove('show');
                mobileOverlay.classList.remove('show');
                document.body.classList.remove('overflow-hidden');
            });
            
            mobileOverlay.addEventListener('click', function() {
                sidebar.classList.remove('show');
                mobileOverlay.classList.remove('show');
                document.body.classList.remove('overflow-hidden');
            });
            
            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 768) {
                    sidebar.classList.remove('show');
                    mobileOverlay.classList.remove('show');
                    document.body.classList.remove('overflow-hidden');
                }
            });
        });
    </script>
</body>
@endsection
