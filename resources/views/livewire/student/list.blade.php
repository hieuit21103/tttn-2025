<div class="container-fluid py-4">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Danh sách sinh viên</h2>
        <button type="button" class="btn btn-primary" wire:click="openAddModal">
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
                                @if($student->room)
                                    <span class="badge bg-success">
                                        Phòng {{ $student->room->name }}
                                    </span>
                                @else
                                    <span class="badge bg-warning">
                                        Chưa có phòng
                                    </span>
                                @endif
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
                                <button class="btn btn-sm btn-warning" title="Chỉnh sửa" wire:click="openEditModal({{ $student->id }})">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-danger" title="Xóa" wire:click="openDeleteModal({{ $student->id }})">
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
    @if($showAddModal || $showEditModal)
    <div class="modal fade show" style="display: block; background-color: rgba(0,0,0,0.5);" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Thêm học sinh mới</h5>
                    <button type="button" class="btn-close" wire:click="closeModal"></button>
                </div>
                <form wire:submit.prevent="@if($editingStudentId) updateStudent @else createStudent @endif">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Mã học sinh</label>
                                    <input type="text" class="form-control" wire:model="student_code" required>
                                    @error('student_code') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Họ và tên</label>
                                    <input type="text" class="form-control" wire:model="fullname" required>
                                    @error('fullname') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Giới tính</label>
                                    <select class="form-select" wire:model="gender" required>
                                        <option value="">Chọn giới tính</option>
                                        <option value="Nam">Nam</option>
                                        <option value="Nữ">Nữ</option>
                                    </select>
                                    @error('gender') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Lớp</label>
                                    <input type="text" class="form-control" wire:model="class" required>
                                    @error('class') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Ngày sinh</label>
                                    <input type="date" class="form-control" wire:model="birthdate" required>
                                    @error('birthdate') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Số CMND/CCCD</label>
                                    <input type="text" class="form-control" wire:model="id_number" required>
                                    @error('id_number') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Số điện thoại cá nhân</label>
                                    <input type="text" class="form-control" wire:model="personal_phone" required>
                                    @error('personal_phone') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Số điện thoại gia đình</label>
                                    <input type="text" class="form-control" wire:model="family_phone" required>
                                    @error('family_phone') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Địa chỉ</label>
                                    <textarea class="form-control" wire:model="address" required></textarea>
                                    @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" wire:model="email" required>
                                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Hình ảnh CMND/CCCD mặt trước</label>
                                    <input type="file" class="form-control" wire:model="id_front_image" required>
                                    @error('id_front_image') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Hình ảnh CMND/CCCD mặt sau</label>
                                    <input type="file" class="form-control" wire:model="id_back_image" required>
                                    @error('id_back_image') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Phòng</label>
                                    <select class="form-select" wire:model="room_id" required>
                                        <option value="">Chọn phòng</option>
                                        @foreach($rooms as $room)
                                            <option value="{{ $room->id }}">{{ $room->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('room_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" wire:click="closeModal">Đóng</button>
                            <button type="submit" class="btn btn-primary">Lưu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Delete Confirmation Modal -->
    <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Xác nhận xóa</h5>
                    <button type="button" class="btn-close" wire:click="closeModal"></button>
                </div>
                <div class="modal-body">
                    <p>Bạn có chắc chắn muốn xóa học sinh này không?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal">Hủy</button>
                    <button type="button" class="btn btn-danger" wire:click="deleteStudent">Xóa</button>
                </div>
            </div>
        </div>
    </div>
</div>
