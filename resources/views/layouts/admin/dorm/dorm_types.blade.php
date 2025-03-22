@extends('layouts.admin.master')

@section('title', 'Quản lý loại phòng KTX')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Quản lý loại phòng KTX</h2>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRoomTypeModal">
            <i class="fas fa-plus"></i> Thêm loại phòng mới
        </button>
    </div>

    <div class="row">
        <!-- Danh sách loại phòng -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Danh sách loại phòng</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Mã loại</th>
                                    <th>Tên loại</th>
                                    <th>Sức chứa</th>
                                    <th>Diện tích</th>
                                    <th>Tiện nghi</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(range(1, 5) as $index)
                                <tr>
                                    <td>RT{{ str_pad($index, 3, '0', STR_PAD_LEFT) }}</td>
                                    <td>Phòng {{ 4 + ($index % 3) * 2 }} người</td>
                                    <td>{{ 4 + ($index % 3) * 2 }} người</td>
                                    <td>{{ 20 + ($index * 5) }}m²</td>
                                    <td>
                                        <span class="badge bg-info me-1">Điều hòa</span>
                                        <span class="badge bg-info me-1">Nóng lạnh</span>
                                        @if($index % 2 == 0)
                                        <span class="badge bg-info">Ban công</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $index % 2 == 0 ? 'success' : 'warning' }}">
                                            {{ $index % 2 == 0 ? 'Đang sử dụng' : 'Đang nâng cấp' }}
                                        </span>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-info" title="Xem chi tiết" data-bs-toggle="modal" data-bs-target="#viewRoomTypeModal">
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
                </div>
            </div>
        </div>

        <!-- Thống kê và phân bố -->
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Thống kê phòng</h5>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <h6 class="text-muted mb-2">Tổng số loại phòng</h6>
                        <h3>5 loại</h3>
                    </div>
                    <div class="mb-4">
                        <h6 class="text-muted mb-2">Phân bố theo sức chứa</h6>
                        <div class="progress mb-2" style="height: 25px;">
                            <div class="progress-bar" role="progressbar" style="width: 40%;" title="4 người">40%</div>
                            <div class="progress-bar bg-success" role="progressbar" style="width: 35%;" title="6 người">35%</div>
                            <div class="progress-bar bg-info" role="progressbar" style="width: 25%;" title="8 người">25%</div>
                        </div>
                        <div class="d-flex justify-content-between small text-muted">
                            <span>4 người (40%)</span>
                            <span>6 người (35%)</span>
                            <span>8 người (25%)</span>
                        </div>
                    </div>
                    <div>
                        <h6 class="text-muted mb-2">Trạng thái phòng</h6>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span>Đang sử dụng</span>
                            <span class="badge bg-success">80%</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Đang nâng cấp</span>
                            <span class="badge bg-warning">20%</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Tiện nghi phổ biến</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-wrap gap-2">
                        <span class="badge bg-primary p-2">
                            <i class="fas fa-air-conditioner"></i> Điều hòa (100%)
                        </span>
                        <span class="badge bg-primary p-2">
                            <i class="fas fa-water"></i> Nóng lạnh (100%)
                        </span>
                        <span class="badge bg-primary p-2">
                            <i class="fas fa-wind"></i> Quạt trần (90%)
                        </span>
                        <span class="badge bg-primary p-2">
                            <i class="fas fa-door-open"></i> Ban công (50%)
                        </span>
                        <span class="badge bg-primary p-2">
                            <i class="fas fa-wifi"></i> Wifi (100%)
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal thêm loại phòng mới -->
<div class="modal fade" id="addRoomTypeModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Thêm loại phòng mới</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label class="form-label">Tên loại phòng</label>
                        <input type="text" class="form-control" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Sức chứa (người)</label>
                            <input type="number" class="form-control" required min="1">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Diện tích (m²)</label>
                            <input type="number" class="form-control" required min="1">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tiện nghi</label>
                        <div class="row g-2">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" checked>
                                    <label class="form-check-label">Điều hòa</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" checked>
                                    <label class="form-check-label">Nóng lạnh</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox">
                                    <label class="form-check-label">Ban công</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" checked>
                                    <label class="form-check-label">Wifi</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mô tả</label>
                        <textarea class="form-control" rows="3"></textarea>
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

<!-- Modal xem chi tiết loại phòng -->
<div class="modal fade" id="viewRoomTypeModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Chi tiết loại phòng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <img src="{{ asset('images/room-type-placeholder.jpg') }}" alt="Room Type" class="img-fluid rounded mb-3">
                        <div class="row g-2">
                            <div class="col-6">
                                <img src="{{ asset('images/room-detail-1.jpg') }}" alt="Detail 1" class="img-fluid rounded">
                            </div>
                            <div class="col-6">
                                <img src="{{ asset('images/room-detail-2.jpg') }}" alt="Detail 2" class="img-fluid rounded">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h4>Phòng 4 người</h4>
                        <p class="text-muted">Mã loại: RT001</p>
                        
                        <div class="mb-4">
                            <h6>Thông tin cơ bản</h6>
                            <div class="row">
                                <div class="col-6">
                                    <p class="mb-1"><strong>Sức chứa:</strong> 4 người</p>
                                    <p class="mb-1"><strong>Diện tích:</strong> 25m²</p>
                                </div>
                                <div class="col-6">
                                    <p class="mb-1"><strong>Giá/tháng:</strong> 750,000đ</p>
                                    <p class="mb-1"><strong>Trạng thái:</strong> <span class="badge bg-success">Đang sử dụng</span></p>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h6>Tiện nghi</h6>
                            <div class="d-flex flex-wrap gap-2">
                                <span class="badge bg-info">Điều hòa</span>
                                <span class="badge bg-info">Nóng lạnh</span>
                                <span class="badge bg-info">Quạt trần</span>
                                <span class="badge bg-info">Ban công</span>
                                <span class="badge bg-info">Wifi</span>
                            </div>
                        </div>

                        <div>
                            <h6>Mô tả</h6>
                            <p>Phòng 4 người với đầy đủ tiện nghi hiện đại, không gian thoáng mát, phù hợp cho sinh viên. Được trang bị điều hòa, nóng lạnh và các tiện ích cơ bản khác.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
@endsection