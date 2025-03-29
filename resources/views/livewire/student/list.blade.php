<div class="container-fluid py-4">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Danh sách sinh viên</h2>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#studentModal">
            <i class="fas fa-plus me-2"></i> Thêm học sinh mới
        </button>
    </div>

    <!-- Filters -->
    <div class="card mb-4">
        <div class="card-body">
            <form class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">Tìm kiếm</label>
                    <input type="text" class="form-control" wire:model="search" placeholder="Tìm theo mã học sinh, tên hoặc lớp...">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Lớp</label>
                    <input type="text" class="form-control" wire:model="class" placeholder="Nhập tên lớp">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Giới tính</label>
                    <select class="form-select" wire:model="gender">
                        <option value="">Tất cả</option>
                        <option value="Nam">Nam</option>
                        <option value="Nữ">Nữ</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Trạng thái phòng</label>
                    <select class="form-select" wire:model="hasRoom">
                        <option value="">Tất cả</option>
                        <option value="1">Đã có phòng</option>
                        <option value="0">Chưa có phòng</option>
                    </select>
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
                            <th>Mã học sinh</th>
                            <th>Họ và tên</th>
                            <th>Giới tính</th>
                            <th>Lớp</th>
                            <th>Phòng</th>
                            <th>Ngày sinh</th>
                            <th>Địa chỉ</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $student)
                        <tr>
                            <td>{{ $student->student_code }}</td>
                            <td>{{ $student->fullname }}</td>
                            <td>{{ $student->getGenderLabel() }}</td>
                            <td>{{ $student->class }}</td>
                            <td>
                                <span class="badge bg-{{ $student->hasRoom() ? 'success' : 'warning' }}">
                                    {{ $student->hasRoom() ? 'Đã có phòng' : 'Chưa có phòng' }}
                                </span>
                            </td>
                            <td>{{ $student->birthdate->format('d/m/Y') }}</td>
                            <td>{{ $student->address }}</td>
                            <td>
                                <span class="badge bg-{{ $student->isActivated() ? 'success' : 'warning' }}">
                                    {{ $student->isActivated() ? 'Đã kích hoạt' : 'Chưa kích hoạt' }}
                                </span>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-info" title="Xem chi tiết" wire:click="showDetails({{ $student->id }})">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-warning" title="Chỉnh sửa" wire:click="showEditModal({{ $student->id }})">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-danger" title="Xóa" wire:click="confirmDelete({{ $student->id }})">
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
                <div>Hiển thị {{ ($currentPage - 1) * 10 + 1 }}-{{ min($currentPage * 10, $totalStudents) }} của {{ $totalStudents }} mục</div>
                <nav>
                    <ul class="pagination mb-0">
                        @if($currentPage === 1)
                            <li class="page-item disabled">
                                <a class="page-link" href="#">Trước</a>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="#" wire:click="loadStudents({{ $currentPage - 1 }})">Trước</a>
                            </li>
                        @endif

                        @for($i = 1; $i <= $lastPage; $i++)
                            <li class="page-item {{ $currentPage === $i ? 'active' : '' }}">
                                <a class="page-link" href="#" wire:click="loadStudents({{ $i }})">{{ $i }}</a>
                            </li>
                        @endfor

                        @if($currentPage === $lastPage)
                            <li class="page-item disabled">
                                <a class="page-link" href="#">Sau</a>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="#" wire:click="loadStudents({{ $currentPage + 1 }})">Sau</a>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <!-- Add Student Modal -->
    <div class="modal fade" id="studentModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Thêm học sinh mới</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="createStudent">
                        <div class="mb-3">
                            <label class="form-label">Mã học sinh</label>
                            <input type="text" class="form-control" wire:model="student.student_code" required>
                            @error('student.student_code') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Họ và tên</label>
                            <input type="text" class="form-control" wire:model="student.fullname" required>
                            @error('student.fullname') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Lớp</label>
                            <input type="text" class="form-control" wire:model="student.class" required>
                            @error('student.class') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Giới tính</label>
                            <select class="form-select" wire:model="student.gender">
                                <option value="">Chọn giới tính</option>
                                <option value="Nam">Nam</option>
                                <option value="Nữ">Nữ</option>
                            </select>
                            @error('student.gender') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Ngày sinh</label>
                            <input type="date" class="form-control" wire:model="student.birthdate" required>
                            @error('student.birthdate') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Địa chỉ</label>
                            <textarea class="form-control" wire:model="student.address" required></textarea>
                            @error('student.address') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Số điện thoại</label>
                            <input type="tel" class="form-control" wire:model="student.phone" required>
                            @error('student.phone') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" wire:model="student.email" required>
                            @error('student.email') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary" wire:click="createStudent">Lưu</button>
                </div>
            </div>
        </div>
    </div>
</div>
