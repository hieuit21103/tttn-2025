@extends('layouts.admin.master')

@section('title', 'Chỉnh sửa thông tin sinh viên')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Chỉnh sửa thông tin sinh viên</h2>
        <a href="{{ route('admin.students.detail', ['id' => $id]) }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Quay lại
        </a>
    </div>

    <form action="{{ route('admin.students.update', ['id' => $id]) }}" method="POST" class="row">
        @csrf
        @method('PUT')
        
        <!-- Thông tin cá nhân -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Thông tin cá nhân</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">MSSV</label>
                        <input type="text" class="form-control" name="student_id" value="20250001" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Họ và tên</label>
                        <input type="text" class="form-control" name="name" value="Nguyễn Văn A" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Ngày sinh</label>
                            <input type="date" class="form-control" name="birth_date" value="2007-01-01" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Giới tính</label>
                            <select class="form-select" name="gender" required>
                                <option value="male">Nam</option>
                                <option value="female">Nữ</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" value="example@student.edu.vn" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Số điện thoại</label>
                        <input type="tel" class="form-control" name="phone" value="0987654321" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Địa chỉ</label>
                        <textarea class="form-control" name="address" rows="2" required>Hà Nội, Việt Nam</textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Thông tin học tập và KTX -->
        <div class="col-md-6 mb-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Thông tin học tập</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Khoa</label>
                        <select class="form-select" name="faculty" required>
                            <option value="cntt">Công nghệ thông tin</option>
                            <option value="kt">Kế toán</option>
                            <option value="qtkd">Quản trị kinh doanh</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Lớp</label>
                        <input type="text" class="form-control" name="class" value="IT2025" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Khóa học</label>
                        <input type="text" class="form-control" name="academic_year" value="2025-2029" required>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Thông tin KTX</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">KTX</label>
                        <select class="form-select" name="dorm" required>
                            <option value="a">KTX A</option>
                            <option value="b">KTX B</option>
                            <option value="c">KTX C</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phòng</label>
                        <select class="form-select" name="room" required>
                            <option value="a101">A101</option>
                            <option value="a102">A102</option>
                            <option value="a103">A103</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Ngày vào</label>
                            <input type="date" class="form-control" name="check_in_date" value="2025-09-01" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Thời hạn (tháng)</label>
                            <input type="number" class="form-control" name="duration" value="6" required min="1" max="12">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Trạng thái</label>
                        <select class="form-select" name="status" required>
                            <option value="active">Đang ở</option>
                            <option value="pending">Chờ vào</option>
                            <option value="expired">Hết hạn</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Nút submit -->
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-end gap-2">
                        <button type="reset" class="btn btn-secondary">
                            <i class="fas fa-undo"></i> Đặt lại
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Lưu thay đổi
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection