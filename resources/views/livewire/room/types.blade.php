<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Quản lý loại phòng KTX</h2>
        <button type="button" 
                class="btn btn-primary" 
                wire:click="openAddModal"
                aria-label="Thêm loại phòng mới">
            <i class="fas fa-plus"></i> Thêm loại phòng mới
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
                        <h5 class="mb-0">Danh sách loại phòng</h5>
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
                                    <th>Tên loại phòng</th>
                                    <th>Giá thuê/tháng</th>
                                    <th>Sức chứa</th>
                                    <th>Ngày tạo</th>
                                    <th>Ngày cập nhật</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($roomTypes as $type)
                                <tr>
                                    <td>{{ $type->id }}</td>
                                    <td>{{ $type->name }}</td>
                                    <td>{{ number_format($type->monthly_price, 0, ',', '.') }} ₫</td>
                                    <td>{{ $type->capacity }}</td>
                                    <td>{{ $type->created_at->format('d/m/Y H:i') }}</td>
                                    <td>{{ $type->updated_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-warning" wire:click="openEditModal({{ $type->id }})" title="Chỉnh sửa">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger" wire:click="openDeleteModal({{ $type->id }})" title="Xóa">
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
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div>
                            Hiển thị {{ $roomTypes->firstItem() }} đến {{ $roomTypes->lastItem() }} trong tổng số {{ $roomTypes->total() }} loại phòng
                        </div>
                        <div>
                            {{ $roomTypes->links('pagination') }}
                        </div>
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
                    <h5 class="modal-title">Thêm loại phòng mới</h5>
                    <button type="button" class="btn-close" wire:click="closeModal"></button>
                </div>
                <form wire:submit.prevent="createRoomType">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Tên loại phòng</label>
                            <input type="text" class="form-control" wire:model="name" required>
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Giá thuê/tháng</label>
                            <div class="input-group">
                                <input type="number" class="form-control" wire:model="monthly_price" required>
                                <span class="input-group-text">₫</span>
                            </div>
                            @error('monthly_price') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Sức chứa</label>
                            <input type="number" class="form-control" wire:model="capacity" required>
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
                <form wire:submit.prevent="updateRoomType">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Tên loại phòng</label>
                            <input type="text" class="form-control" wire:model="name" required>
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Giá thuê/tháng</label>
                            <div class="input-group">
                                <input type="number" class="form-control" wire:model="monthly_price" required>
                                <span class="input-group-text">₫</span>
                            </div>
                            @error('monthly_price') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Sức chứa</label>
                            <input type="number" class="form-control" wire:model="capacity" required>
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