@extends('layouts.admin.master')

@section('title', 'Chi tiết sinh viên')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Thông tin sinh viên</h2>
        <div>
            <a href="{{ route('admin.students.edit', ['id' => $id]) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Chỉnh sửa
            </a>
            <a href="{{ route('admin.students.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Quay lại
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Thông tin cá nhân -->
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body text-center">
                    <img src="{{ asset('images/avatar-placeholder.jpg') }}" alt="Student Photo" class="rounded-circle img-fluid mb-3" style="width: 150px;">
                    <h4>Nguyễn Văn A</h4>
                    <p class="text-muted mb-1">MSSV: 20250001</p>
                    <p class="text-muted mb-4">Khoa Công nghệ thông tin</p>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Thông tin liên hệ</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <p class="mb-0">Email</p>
                        </div>
                        <div class="col-sm-8">
                            <p class="text-muted mb-0">example@student.edu.vn</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <p class="mb-0">SĐT</p>
                        </div>
                        <div class="col-sm-8">
                            <p class="text-muted mb-0">0987654321</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-4">
                            <p class="mb-0">Địa chỉ</p>
                        </div>
                        <div class="col-sm-8">
                            <p class="text-muted mb-0">Hà Nội, Việt Nam</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Thông tin học tập và KTX -->
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Thông tin học tập</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <p class="mb-0">Khoa</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">Công nghệ thông tin</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <p class="mb-0">Lớp</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">IT2025</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Khóa học</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">2025-2029</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Thông tin KTX</h5>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#assignRoomModal">
                        <i class="fas fa-home"></i> Phân phòng
                    </button>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <p class="mb-0">KTX</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">KTX A</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <p class="mb-0">Phòng</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">A101</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <p class="mb-0">Ngày vào</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">01/09/2025</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Trạng thái</p>
                        </div>
                        <div class="col-sm-9">
                            <span class="badge bg-success">Đang ở</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Lịch sử thanh toán</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Mã HĐ</th>
                                    <th>Ngày thanh toán</th>
                                    <th>Kỳ thanh toán</th>
                                    <th>Số tiền</th>
                                    <th>Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(range(1, 5) as $index)
                                <tr>
                                    <td>HD{{ str_pad($index, 6, '0', STR_PAD_LEFT) }}</td>
                                    <td>{{ date('d/m/Y', strtotime('-' . $index . ' months')) }}</td>
                                    <td>Tháng {{ date('m/Y', strtotime('-' . $index . ' months')) }}</td>
                                    <td>{{ number_format(750000) }}đ</td>
                                    <td><span class="badge bg-success">Đã thanh toán</span></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Phân phòng -->
<div class="modal fade" id="assignRoomModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Phân phòng KTX</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label class="form-label">Chọn KTX</label>
                        <select class="form-select" required>
                            <option value="">Chọn KTX...</option>
                            <option value="a">KTX A</option>
                            <option value="b">KTX B</option>
                            <option value="c">KTX C</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Chọn phòng</label>
                        <select class="form-select" required>
                            <option value="">Chọn phòng...</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ngày vào</label>
                        <input type="date" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Thời hạn (tháng)</label>
                        <input type="number" class="form-control" required min="1" max="12" value="6">
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