@extends('layouts.app')

@section('title','Quản lý học sinh nội trú')

@section('css')
    <link rel="stylesheet" href="{{ url('css/common.css') }}">     
@endsection
@section('content')
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống Quản lý Học sinh Nội trú</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        .sidebar {
            min-height: calc(100vh - 56px);
        }
        .nav-link {
            color: #333;
            border-radius: 5px;
            margin-bottom: 5px;
        }
        .nav-link:hover {
            background-color: #f8f9fa;
        }
        .nav-link.active {
            background-color: #0d6efd;
            color: white;
        }
        .status-badge {
            font-size: 0.75rem;
        }
    </style>
</head>
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
                        <span class="text-white me-3">Xin chào, Admin</span>
                    </li>
                    <li class="nav-item">
                        <img src="/api/placeholder/40/40" alt="Avatar" class="rounded-circle" width="32">
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
                        <div class="text-center mb-4">
                            <img src="/api/placeholder/80/80" alt="Logo trường" class="rounded-circle" width="64">
                            <div class="mt-2 fw-bold">KÝ TÚC XÁ TRƯỜNG</div>
                        </div>
                        <div class="nav flex-column">
                            <a href="#" class="nav-link active py-2">
                                <i class="fas fa-home me-2"></i> Trang chủ
                            </a>
                            <a href="#" class="nav-link py-2">
                                <i class="fas fa-user-graduate me-2"></i> Quản lý học sinh
                            </a>
                            <a href="#" class="nav-link py-2">
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
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="card-title">Danh sách học sinh nội trú</h5>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#studentModal">
                                <i class="fas fa-plus me-2"></i> Thêm học sinh mới
                            </button>
                        </div>

                        <!-- Search and Filter -->
                        <div class="row mb-4">
                            <div class="col-md-6 mb-2 mb-md-0">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                    <input type="text" class="form-control" placeholder="Tìm kiếm theo tên, lớp, mã học sinh...">
                                </div>
                            </div>
                            <div class="col-md-3 mb-2 mb-md-0">
                                <select class="form-select">
                                    <option>Tất cả khối</option>
                                    <option>Khối 10</option>
                                    <option>Khối 11</option>
                                    <option>Khối 12</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select class="form-select">
                                    <option>Tất cả toà nhà</option>
                                    <option>Toà A</option>
                                    <option>Toà B</option>
                                    <option>Toà C</option>
                                </select>
                            </div>
                        </div>

                        <!-- Student Table -->
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Mã HS</th>
                                        <th>Họ và tên</th>
                                        <th>Lớp</th>
                                        <th>Phòng</th>
                                        <th>Ngày sinh</th>
                                        <th>Số điện thoại</th>
                                        <th>Trạng thái</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>HS001</td>
                                        <td>Nguyễn Văn A</td>
                                        <td>10A1</td>
                                        <td>A101</td>
                                        <td>01/01/2007</td>
                                        <td>0987654321</td>
                                        <td><span class="badge bg-success status-badge">Đang ở</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary me-1"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>HS002</td>
                                        <td>Trần Thị B</td>
                                        <td>11A2</td>
                                        <td>B205</td>
                                        <td>15/05/2006</td>
                                        <td>0912345678</td>
                                        <td><span class="badge bg-success status-badge">Đang ở</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary me-1"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>HS003</td>
                                        <td>Lê Văn C</td>
                                        <td>12A3</td>
                                        <td>C302</td>
                                        <td>20/09/2005</td>
                                        <td>0978123456</td>
                                        <td><span class="badge bg-warning text-dark status-badge">Tạm vắng</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary me-1"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>HS004</td>
                                        <td>Phạm Thị D</td>
                                        <td>10A2</td>
                                        <td>A102</td>
                                        <td>05/03/2007</td>
                                        <td>0967890123</td>
                                        <td><span class="badge bg-success status-badge">Đang ở</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary me-1"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>HS005</td>
                                        <td>Hoàng Văn E</td>
                                        <td>11A1</td>
                                        <td>B201</td>
                                        <td>12/12/2006</td>
                                        <td>0932145678</td>
                                        <td><span class="badge bg-danger status-badge">Đã rời đi</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary me-1"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div class="text-muted">Hiển thị 1-5 của 25 học sinh</div>
                            <nav>
                                <ul class="pagination">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#"><i class="fas fa-chevron-left"></i></a>
                                    </li>
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                                    <li class="page-item"><a class="page-link" href="#">5</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Modal (Add/Edit Student) -->
    <div class="modal fade" id="studentModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Thêm học sinh mới</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Mã học sinh</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Họ và tên</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Ngày sinh</label>
                                <input type="date" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Giới tính</label>
                                <select class="form-select">
                                    <option>Nam</option>
                                    <option>Nữ</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Lớp</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Số điện thoại</label>
                                <input type="tel" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Toà nhà</label>
                                <select class="form-select">
                                    <option>Toà A</option>
                                    <option>Toà B</option>
                                    <option>Toà C</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Phòng</label>
                                <select class="form-select">
                                    <option>A101</option>
                                    <option>A102</option>
                                    <option>A103</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Địa chỉ gia đình</label>
                                <textarea class="form-control" rows="2"></textarea>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Thông tin phụ huynh</label>
                                <textarea class="form-control" rows="2"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Huỷ bỏ</button>
                    <button type="button" class="btn btn-primary">Lưu thông tin</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Example functionality that would be implemented in a real application
            console.log('Hệ thống quản lý học sinh nội trú đã sẵn sàng');
        });
    </script>
</body>
</html>
@endsection
