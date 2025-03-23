<div class="container-fluid py-4">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Quản lý Ký túc xá</h2>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDormModal">
            <i class="fas fa-plus"></i> Thêm KTX mới
        </button>
    </div>

    <!-- Filters -->
    <div class="card mb-4">
        <div class="card-body">
            <form class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">Tên KTX</label>
                    <input type="text" class="form-control" name="search" placeholder="Tìm theo tên...">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Loại phòng</label>
                    <select class="form-select" name="room_type">
                        <option value="">Tất cả</option>
                        <option value="4">4 người</option>
                        <option value="6">6 người</option>
                        <option value="8">8 người</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Trạng thái</label>
                    <select class="form-select" name="status">
                        <option value="">Tất cả</option>
                        <option value="available">Còn chỗ</option>
                        <option value="full">Đã đầy</option>
                        <option value="maintenance">Bảo trì</option>
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

    <!-- Dorms Table -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên KTX</th>
                            <th>Loại phòng</th>
                            <th>Sức chứa</th>
                            <th>Đã ở</th>
                            <th>Giá/tháng</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(range(1, 10) as $index)
                        <tr>
                            <td>{{ $index }}</td>
                            <td>KTX {{ chr(64 + $index) }}</td>
                            <td>4 người</td>
                            <td>40</td>
                            <td>35</td>
                            <td>{{ number_format(500000 + ($index * 50000)) }}đ</td>
                            <td>
                                <span class="badge bg-{{ $index % 3 == 0 ? 'success' : ($index % 3 == 1 ? 'warning' : 'danger') }}">
                                    {{ $index % 3 == 0 ? 'Còn chỗ' : ($index % 3 == 1 ? 'Sắp đầy' : 'Đã đầy') }}
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
    <!-- Add Dorm Modal -->
    <div class="modal fade" id="addDormModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Thêm KTX mới</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Tên KTX</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Loại phòng</label>
                            <select class="form-select" required>
                                <option value="4">4 người</option>
                                <option value="6">6 người</option>
                                <option value="8">8 người</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Số phòng</label>
                            <input type="number" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Giá/tháng</label>
                            <input type="number" class="form-control" required>
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
</div>

