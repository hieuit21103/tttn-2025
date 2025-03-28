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
                    <input type="text" class="form-control" wire:model="search" placeholder="Tìm theo tên...">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Loại phòng</label>
                    <select class="form-select" wire:model="roomType">
                        <option value="">Tất cả</option>
                        <option value="4">4 người</option>
                        <option value="6">6 người</option>
                        <option value="8">8 người</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Trạng thái</label>
                    <select class="form-select" wire:model="status">
                        <option value="">Tất cả</option>
                        <option value="available">Còn chỗ</option>
                        <option value="full">Đã đầy</option>
                        <option value="maintenance">Bảo trì</option>
                    </select>
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
                        @foreach($rooms as $room)
                        <tr>
                            <td>{{ $room->id }}</td>
                            <td>{{ $room->name }}</td>
                            <td>{{ $room->type }} người</td>
                            <td>{{ $room->capacity }}</td>
                            <td>{{ $room->current_occupancy }}</td>
                            <td>{{ number_format($room->monthly_price) }}đ</td>
                            <td>
                                <span class="badge bg-{{ $room->status === 'available' ? 'success' : ($room->status === 'full' ? 'danger' : 'warning') }}">
                                    {{ $room->status === 'available' ? 'Còn chỗ' : ($room->status === 'full' ? 'Đã đầy' : 'Bảo trì') }}
                                </span>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-info" title="Xem chi tiết" wire:click="showDetails({{ $room->id }})">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-warning" title="Chỉnh sửa" wire:click="showEditModal({{ $room->id }})">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-danger" title="Xóa" wire:click="confirmDelete({{ $room->id }})">
                                    <i class="fas fa-trash"></i>
                                </button>
                                @if($room->isAvailable())
                                    <button class="btn btn-sm btn-success" title="Xếp phòng" wire:click="showAssignModal({{ $room->id }})">
                                        <i class="fas fa-user-plus"></i>
                                    </button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div>Hiển thị {{ ($currentPage - 1) * 10 + 1 }}-{{ min($currentPage * 10, $totalRooms) }} của {{ $totalRooms }} mục</div>
                <nav>
                    <ul class="pagination mb-0">
                        @if($currentPage === 1)
                            <li class="page-item disabled">
                                <a class="page-link" href="#">Trước</a>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="#" wire:click="loadRooms({{ $currentPage - 1 }})">Trước</a>
                            </li>
                        @endif

                        @for($i = 1; $i <= $lastPage; $i++)
                            <li class="page-item {{ $currentPage === $i ? 'active' : '' }}">
                                <a class="page-link" href="#" wire:click="loadRooms({{ $i }})">{{ $i }}</a>
                            </li>
                        @endfor

                        @if($currentPage === $lastPage)
                            <li class="page-item disabled">
                                <a class="page-link" href="#">Sau</a>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="#" wire:click="loadRooms({{ $currentPage + 1 }})">Sau</a>
                            </li>
                        @endif
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
                    <form wire:submit.prevent="createRoom">
                        <div class="mb-3">
                            <label class="form-label">Tên KTX</label>
                            <input type="text" class="form-control" wire:model="name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Loại phòng</label>
                            <select class="form-select" wire:model="type" required>
                                <option value="4">4 người</option>
                                <option value="6">6 người</option>
                                <option value="8">8 người</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Sức chứa</label>
                            <input type="number" class="form-control" wire:model="capacity" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Giá/tháng</label>
                            <input type="number" class="form-control" wire:model="monthly_price" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary" wire:click="createRoom">Lưu</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Assign Room Modal -->
    <div class="modal fade" id="assignRoomModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Xếp phòng cho sinh viên</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="assignRoom">
                        <div class="mb-3">
                            <label class="form-label">Phòng</label>
                            <input type="text" class="form-control" readonly value="{{ $selectedRoom ? $selectedRoom->name : '' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Sinh viên</label>
                            <select class="form-select" wire:model="selectedStudentId">
                                <option value="">Chọn sinh viên</option>
                                @foreach($availableStudents as $student)
                                    <option value="{{ $student->id }}">{{ $student->fullname }} ({{ $student->student_code }})</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary" wire:click="assignRoom">Xác nhận</button>
                </div>
            </div>
        </div>
    </div>
</div>
