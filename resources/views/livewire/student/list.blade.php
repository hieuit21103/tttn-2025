
<div class="container-fluid py-4">
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
</div>
