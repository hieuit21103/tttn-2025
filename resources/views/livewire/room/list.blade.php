<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Quản lý phòng KTX</h2>
        <button type="button" 
                class="btn btn-primary" 
                wire:click="openAddModal"
                aria-label="Thêm phòng mới">
            <i class="fas fa-plus"></i> Thêm phòng mới
        </button>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Error Message -->
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Danh sách phòng</h5>
                        <div class="col-md-3">
                            <input type="text" class="form-control" placeholder="Tìm kiếm..." wire:model.live="search">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên phòng</th>
                                    <th>Giá thuê/tháng</th>
                                    <th>Sức chứa</th>
                                    <th>Số người</th>
                                    <th>Loại phòng</th>
                                    <th>Trạng thái</th>
                                    <th>Ngày tạo</th>
                                    <th>Ngày cập nhật</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($rooms as $room)
                                <tr>
                                    <td>{{ $room->id }}</td>
                                    <td>{{ $room->name }}</td>
                                    <td>{{ number_format($room->roomType->monthly_price, 0, ',', '.') }} ₫</td>
                                    <td>{{ $room->capacity }}</td>
                                    <td>{{ $room->students_count }}</td>
                                    <td>{{ $room->roomType->name }}</td>
                                    <td>
                                        <span class="badge {{ $room->status === 'available' ? 'bg-success' : ($room->status === 'full' ? 'bg-danger' : 'bg-warning') }}">
                                            {{ $room->status === 'available' ? 'Còn trống' : ($room->status === 'full' ? 'Đầy' : 'Ngừng sử dụng') }}
                                        </span>
                                    </td>
                                    <td>{{ $room->created_at->format('d/m/Y H:i') }}</td>
                                    <td>{{ $room->updated_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-info" wire:click="viewDetail({{ $room->id }})" title="Xem chi tiết">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-warning" wire:click="openEditModal({{ $room->id }})" title="Chỉnh sửa">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger" wire:click="openDeleteModal({{ $room->id }})" title="Xóa">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">Không có loại phòng nào</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <div>Hiển thị {{ ($currentPage - 1) * $perPage + 1 }}-{{ min($currentPage * $perPage, $totalRooms) }} của {{ $totalRooms }} mục</div>
                        <nav>
                            <ul class="pagination mb-0">
                                @if($currentPage === 1)
                                    <li class="page-item disabled">
                                        <a class="page-link" href="javascript:void(0)">Trước</a>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="javascript:void(0)" wire:click="previousPage">Trước</a>
                                    </li>
                                @endif

                                @for($i = 1; $i <= $lastPage; $i++)
                                    <li class="page-item {{ $currentPage === $i ? 'active' : '' }}">
                                        <a class="page-link" href="javascript:void(0)" wire:click="goToPage({{ $i }})">{{ $i }}</a>
                                    </li>
                                @endfor

                                @if($currentPage === $lastPage)
                                    <li class="page-item disabled">
                                        <a class="page-link" href="javascript:void(0)">Sau</a>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="javascript:void(0)" wire:click="nextPage">Sau</a>
                                    </li>
                                @endif
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Room Type Modal -->
    @if($showAddModal)
    <div class="modal fade show" style="display: block; background-color: rgba(0,0,0,0.5);" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Thêm phòng mới</h5>
                    <button type="button" class="btn-close" wire:click="closeModal"></button>
                </div>
                <form wire:submit.prevent="createRoom">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Tên phòng</label>
                            <input type="text" class="form-control" wire:model="name" required>
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Loại phòng</label>
                            <select class="form-control" wire:model="room_type_id" wire:change="handleRoomTypeChange($event.target.value)" required>
                                <option value="">-- Chọn loại phòng --</option>
                                @foreach($roomTypes as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                            @error('room_type_id') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Giá thuê/tháng/người</label>
                            <div class="input-group">
                                <input type="number" class="form-control" value="{{ $monthly_price }}" wire:model="monthly_price" disabled>
                                <span class="input-group-text">₫</span>
                            </div>
                            @error('monthly_price') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Sức chứa</label>
                            <input type="number" class="form-control" value="{{ $capacity }}" wire:model="capacity" disabled>
                            @error('capacity') <span class="text-danger">{{ $message }}</span> @enderror
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
    @endif

    <!-- Edit Room Type Modal -->
    @if($showEditModal)
    <div class="modal fade show" style="display: block; background-color: rgba(0,0,0,0.5);" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Chỉnh sửa loại phòng</h5>
                    <button type="button" class="btn-close" wire:click="closeModal"></button>
                </div>
                <form wire:submit.prevent="updateRoom">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Tên phòng</label>
                            <input type="text" class="form-control" wire:model="name" required>
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <select class="form-control" wire:model="room_type_id" wire:change="handleRoomTypeChange($event.target.value)" required>
                            <option value="">-- Chọn loại phòng --</option>
                            @foreach($roomTypes as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                        @error('room_type_id') <span class="text-danger">{{ $message }}</span> @enderror
                        <div class="mb-3">
                            <label class="form-label">Giá thuê/tháng</label>
                            <div class="input-group">
                                <input type="number" class="form-control" value="{{ $monthly_price }}" wire:model="monthly_price" required>
                                <span class="input-group-text">₫</span>
                            </div>
                            @error('monthly_price') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Sức chứa</label>
                            <input type="number" class="form-control" value="{{ $capacity }}" wire:model="capacity" required>
                            @error('capacity') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeModal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </div>
                </form>
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
                    Bạn có chắc muốn xóa loại phòng này không?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal">Hủy</button>
                    <button type="button" class="btn btn-danger" wire:click="deleteRoomType">Xóa</button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>