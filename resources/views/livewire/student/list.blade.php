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
                    <input type="text" class="form-control" wire:model.live="search" placeholder="Tìm theo mã học sinh, tên hoặc lớp...">
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
                            <th>Khoa</th>
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
                            <td>{{ $student->faculty->name }}</td>
                            <td>{{ $student->class->name }}</td>
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
                                <button class="btn btn-sm btn-success" title="Xếp phòng" wire:click="openAssignRoomModal({{ $student->id }})">
                                    <i class="fas fa-user-plus"></i>
                                </button>
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
                <div>
                    Hiển thị {{ $students->firstItem() }}-{{ $students->lastItem() }} trong tổng số {{ $students->total() }} học sinh
                </div>
                <div>
                    {{ $students->links('pagination') }}
                </div>
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
                                    <label class="form-label">Khoa</label>
                                    <select class="form-select" wire:model="faculty_id">
                                    <option value="">Chọn khoa</option>
                                    @foreach($faculties as $faculty)
                                        <option value="{{ $faculty->id }}">{{ $faculty->name }}</option>
                                    @endforeach          
                                    </select>
                                    @error('faculty_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Lớp</label>
                                    <select class="form-select" wire:model="class_id">
                                        <option value="">Chọn lớp</option>
                                        @foreach($classes as $class)
                                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                                        @endforeach          
                                    </select>
                                    @error('class_id') <span class="text-danger">{{ $message }}</span> @enderror
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
                                    <input type="file" class="form-control" wire:model="id_front_image" {{ $editingStudentId ? '' : 'required' }}>
                                    @error('id_front_image') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Hình ảnh CMND/CCCD mặt sau</label>
                                    <input type="file" class="form-control" wire:model="id_back_image" {{ $editingStudentId ? '' : 'required' }}>
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
    @if($showDeleteModal)
    <div class="modal fade show" style="display: block; background-color: rgba(0,0,0,0.5);" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Xác nhận xóa</h5>
                    <button type="button" class="btn-close" wire:click="closeModal"></button>
                </div>
                <div class="modal-body">
                    Bạn có chắc muốn xóa học sinh này không?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal">Hủy</button>
                    <button type="button" class="btn btn-danger" wire:click="deleteStudent">Xóa</button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Details Modal -->
    @if($showDetailsModal)
    <div class="modal fade show" style="display: block; background-color: rgba(0,0,0,0.5);" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Chi tiết học sinh</h5>
                    <button type="button" class="btn-close" wire:click="closeDetailsModal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Mã học sinh</label>
                                <input type="text" class="form-control" value="{{ $selectedStudent->student_code }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Họ và tên</label>
                                <input type="text" class="form-control" value="{{ $selectedStudent->fullname }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Giới tính</label>
                                <input type="text" class="form-control" value="{{ $selectedStudent->getGenderLabel() }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Lớp</label>
                                <input type="text" class="form-control" value="{{ $selectedStudent->class }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Ngày sinh</label>
                                <input type="text" class="form-control" value="{{ $selectedStudent->birthdate->format('d/m/Y') }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Số CMND/CCCD</label>
                                <input type="text" class="form-control" value="{{ $selectedStudent->id_number }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Số điện thoại cá nhân</label>
                                <input type="text" class="form-control" value="{{ $selectedStudent->personal_phone }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Số điện thoại gia đình</label>
                                <input type="text" class="form-control" value="{{ $selectedStudent->family_phone }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Địa chỉ</label>
                                <textarea class="form-control" rows="3" readonly>{{ $selectedStudent->address }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" value="{{ $selectedStudent->email }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Hình ảnh CMND/CCCD mặt trước</label>
                                @if($selectedStudent->id_front_path)
                                    <img src="{{ Storage::url($selectedStudent->id_front_path) }}" class="img-fluid" alt="CMND mặt trước">
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Hình ảnh CMND/CCCD mặt sau</label>
                                @if($selectedStudent->id_back_path)
                                    <img src="{{ Storage::url($selectedStudent->id_back_path) }}" class="img-fluid" alt="CMND mặt sau">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeDetailsModal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Assign Room Modal -->
    @if($showAssignRoomModal)
        <div class="modal fade show" style="display: block; background-color: rgba(0,0,0,0.5);" tabindex="-1" role="dialog" aria-labelledby="assignRoomModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="assignRoomModalLabel">Danh sách phòng trống</h5>
                        <button type="button" class="close" wire:click="closeAssignRoomModal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Mã phòng</th>
                                        <th>Tên phòng</th>
                                        <th>Loại phòng</th>
                                        <th>Trạng thái</th>
                                        <th>Số người hiện tại</th>
                                        <th>Sức chứa</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($availableRooms as $room)
                                    <tr>
                                        <td>{{ $room->id }}</td>
                                        <td>{{ $room->name }}</td>
                                        <td>{{ $room->roomType->name }}</td>
                                        <td>
                                            <span class="badge bg-{{ $room->status === 'available' ? 'success' : 'warning' }}">
                                                {{ $room->status === 'available' ? 'Còn trống' : 'Đang chờ' }}
                                            </span>
                                        </td>
                                        <td>{{ $room->current_occupancy }}</td>
                                        <td>{{ $room->capacity }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-primary" wire:click="assignRoom({{ $room->id }})" wire:loading.attr="disabled" wire:target="assignRoom({{ $room->id }})">
                                                <i class="fas fa-check me-1"></i>
                                                Xếp phòng
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeAssignRoomModal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
