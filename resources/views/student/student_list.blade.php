@extends('layouts.admin.master')

@section('title', 'Quản lý Sinh viên')

@section('content')
<div class="container-fluid py-4">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Quản lý Sinh viên</h2>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStudentModal">
            <i class="fas fa-plus"></i> Thêm sinh viên
        </button>
    </div>

    <!-- Filters -->
    <div class="card mb-4">
        <div class="card-body">
            <form class="row g-3">
                <div class="col-md-2">
                    <label class="form-label">MSSV</label>
                    <input type="text" class="form-control" name="student_id" placeholder="Nhập MSSV...">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Họ tên</label>
                    <input type="text" class="form-control" name="name" placeholder="Tìm theo tên...">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Khoa</label>
                    <select class="form-select" name="faculty">
                        <option value="">Tất cả</option>
                        <option value="cntt">Công nghệ thông tin</option>
                        <option value="kt">Kế toán</option>
                        <option value="qtkd">Quản trị kinh doanh</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">KTX</label>
                    <select class="form-select" name="dorm">
                        <option value="">Tất cả</option>
                        <option value="a">KTX A</option>
                        <option value="b">KTX B</option>
                        <option value="c">KTX C</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-search"></i> Tìm kiếm
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Students Table -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>MSSV</th>
                            <th>Họ và tên</th>
                            <th>Khoa</th>
                            <th>Lớp</th>
                            <th>KTX</th>
                            <th>Phòng</th>
                            <th>Ngày vào</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(range(1, 10) as $index)
                        <tr>
                            <td>2025{{ str_pad($index, 4, '0', STR_PAD_LEFT) }}</td>
                            <td>Nguyễn Văn {{ chr(64 + $index) }}</td>
                            <td>Công nghệ thông tin</td>
                            <td>IT{{ 20 + ($index % 4) }}</td>
                            <td>KTX {{ chr(65 + ($index % 3)) }}</td>
                            <td>{{ chr(65 + ($index % 3)) }}{{ str_pad($index * 10, 3, '0', STR_PAD_LEFT) }}</td>
                            <td>{{ date('d/m/Y', strtotime('-' . $index . ' months')) }}</td>
                            <td>
                                <span class="badge bg-{{ $index % 2 == 0 ? 'success' : 'warning' }}">
                                    {{ $index % 2 == 0 ? 'Đang ở' : 'Sắp hết hạn' }}
                                </span>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-info" title="Xem chi tiết">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-warning" title="Chỉnh sửa">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-danger" title="Xóa">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div>Hiển thị 1-10 của 100 mục</div>
                <nav>
                    <ul class="pagination mb-0">
                        <li class="page-item disabled">
                            <a class="page-link" href="#">Trước</a>
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

<!-- Add Student Modal -->
<div class="modal fade" id="addStudentModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Thêm sinh viên mới</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">MSSV</label>
                        <input type="text" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Họ và tên</label>
                        <input type="text" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Ngày sinh</label>
                        <input type="date" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Giới tính</label>
                        <select class="form-select" required>
                            <option value="male">Nam</option>
                            <option value="female">Nữ</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Khoa</label>
                        <select class="form-select" required>
                            <option value="cntt">Công nghệ thông tin</option>
                            <option value="kt">Kế toán</option>
                            <option value="qtkd">Quản trị kinh doanh</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Lớp</label>
                        <input type="text" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">KTX</label>
                        <select class="form-select" required>
                            <option value="a">KTX A</option>
                            <option value="b">KTX B</option>
                            <option value="c">KTX C</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Phòng</label>
                        <select class="form-select" required>
                            <option value="">Chọn phòng...</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Ngày vào</label>
                        <input type="date" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Thời hạn (tháng)</label>
                        <input type="number" class="form-control" required min="1" max="12">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary">Lưu</button>
            </div>
        </div>
    </div>
</div>
@endsection