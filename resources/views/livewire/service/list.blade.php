<div class="container-fluid py-4">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Danh sách dịch vụ</h2>
        <button type="button" class="btn btn-primary" wire:click="openAddModal">
            <i class="fas fa-plus me-2"></i> Thêm dịch vụ mới
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
                            <th>Mã vi phạm</th>
                            <th>Tên vi phạm</th>
                            <th>Đơn vị</th>
                            <th>Giá</th>
                            <th>Loại dịch vụ</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($services as $service)
                        <tr>
                            <td>{{ $service->id }}</td>
                            <td>{{ $service->name }}</td>
                            <td>{{ $service->unit }}</td>
                            <td>{{ $service->price_per_unit }}</td>
                            <td>{{ $service->type === 'metered' ? 'Đo lường' : 'Cố định' }}</td>
                            <td>
                                <button class="btn btn-sm btn-warning" title="Chỉnh sửa" wire:click="openEditModal({{ $service->id }})">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-danger" title="Xóa" wire:click="openDeleteModal({{ $service->id }})">
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
                    Hiển thị {{ $services->firstItem() }}-{{ $services->lastItem() }} trong tổng số {{ $services->total() }} dịch vụ
                </div>
                <div>
                    {{ $services->links('pagination') }}
                </div>
            </div>
        </div>
    </div>

    <!-- Add Service Modal -->
    @if($showAddModal || $showEditModal)
    <div class="modal fade show" style="display: block; background-color: rgba(0,0,0,0.5);" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@if($showEditModal) Sửa dịch vụ @else Thêm dịch vụ @endif</h5>
                    <button type="button" class="btn-close" wire:click="closeModal"></button>
                </div>
                <form wire:submit.prevent="@if($editingServiceId) updateService @else createService @endif">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label">Tên dịch vụ</label>
                                    <input type="text" class="form-control" wire:model="name" required>
                                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Đơn vị</label>
                                    <input type="text" class="form-control" wire:model="unit" required>
                                    @error('unit') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Giá</label>
                                    <input type="number" class="form-control" wire:model="price_per_unit" required>
                                    @error('price_per_unit') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Loại dịch vụ</label>
                                    <select class="form-select" wire:model="type" required>
                                        <option value="">Chọn loại dịch vụ</option>
                                        <option value="metered">Đo lường</option>
                                        <option value="fixed">Cố định</option>
                                    </select>
                                    @error('type') <span class="text-danger">{{ $message }}</span> @enderror
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

    <!-- Delete Service Modal -->
    @if($showDeleteModal)
    <div class="modal fade show" style="display: block; background-color: rgba(0,0,0,0.5);" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Xác nhận xóa</h5>
                    <button type="button" class="btn-close" wire:click="closeModal"></button>
                </div>
                <div class="modal-body">
                    Bạn có chắc muốn xóa dịch vụ này không?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal">Hủy</button>
                    <button type="button" class="btn btn-danger" wire:click="deleteService">Xóa</button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
