@extends('layouts.admin.master')

@section('title', 'Quản lý giá KTX')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Quản lý giá KTX</h2>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPricingModal">
            <i class="fas fa-plus"></i> Thêm mức giá mới
        </button>
    </div>

    <!-- Bảng giá hiện tại -->
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Bảng giá hiện tại</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>KTX</th>
                                    <th>Loại phòng</th>
                                    <th>Giá/tháng</th>
                                    <th>Áp dụng từ</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(range(1, 5) as $index)
                                <tr>
                                    <td>KTX {{ chr(64 + $index) }}</td>
                                    <td>{{ (4 + ($index % 3) * 2) }} người</td>
                                    <td>{{ number_format(500000 + ($index * 100000)) }}đ</td>
                                    <td>01/01/2025</td>
                                    <td>
                                        <span class="badge bg-{{ $index % 2 == 0 ? 'success' : 'warning' }}">
                                            {{ $index % 2 == 0 ? 'Đang áp dụng' : 'Sắp áp dụng' }}
                                        </span>
                                    </td>
                                    <td>
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
                </div>
            </div>
        </div>

        <!-- Thống kê -->
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Thống kê giá</h5>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <h6 class="text-muted mb-2">Giá trung bình</h6>
                        <h3>750,000đ/tháng</h3>
                    </div>
                    <div class="mb-4">
                        <h6 class="text-muted mb-2">Giá thấp nhất</h6>
                        <h3>500,000đ/tháng</h3>
                        <small class="text-muted">KTX A - Phòng 8 người</small>
                    </div>
                    <div>
                        <h6 class="text-muted mb-2">Giá cao nhất</h6>
                        <h3>1,000,000đ/tháng</h3>
                        <small class="text-muted">KTX C - Phòng 4 người</small>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Lịch sử thay đổi</h5>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        @foreach(range(1, 4) as $index)
                        <div class="timeline-item">
                            <div class="timeline-date">{{ date('d/m/Y', strtotime('-' . $index . ' months')) }}</div>
                            <div class="timeline-content">
                                <h6>Cập nhật giá KTX {{ chr(64 + $index) }}</h6>
                                <p class="text-muted mb-0">Tăng {{ $index * 5 }}% cho phòng {{ 4 + ($index % 3) * 2 }} người</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal thêm mức giá mới -->
<div class="modal fade" id="addPricingModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Thêm mức giá mới</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label class="form-label">KTX</label>
                        <select class="form-select" required>
                            <option value="">Chọn KTX...</option>
                            <option value="a">KTX A</option>
                            <option value="b">KTX B</option>
                            <option value="c">KTX C</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Loại phòng</label>
                        <select class="form-select" required>
                            <option value="">Chọn loại phòng...</option>
                            <option value="4">4 người</option>
                            <option value="6">6 người</option>
                            <option value="8">8 người</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Giá/tháng</label>
                        <div class="input-group">
                            <input type="number" class="form-control" required min="100000" step="50000">
                            <span class="input-group-text">VNĐ</span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ngày áp dụng</label>
                        <input type="date" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ghi chú</label>
                        <textarea class="form-control" rows="2"></textarea>
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

@section('styles')
<style>
.timeline {
    position: relative;
    padding: 0;
    list-style: none;
}

.timeline-item {
    position: relative;
    padding-left: 24px;
    margin-bottom: 24px;
}

.timeline-item:before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    height: 100%;
    width: 2px;
    background-color: #e9ecef;
}

.timeline-item:last-child {
    margin-bottom: 0;
}

.timeline-date {
    font-size: 0.875rem;
    color: #6c757d;
    margin-bottom: 4px;
}

.timeline-content {
    position: relative;
    padding-left: 12px;
}

.timeline-content:before {
    content: '';
    position: absolute;
    left: -18px;
    top: 8px;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background-color: #0d6efd;
    border: 2px solid #fff;
}
</style>
@endsection
@endsection