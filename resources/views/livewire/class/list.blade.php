<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Danh Sách Lớp</h5>
        <div>
            <a href="#" wire:click="openAddModal" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i>
                Thêm Lớp Mới
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-6">
                <input type="text" wire:model.live="search" class="form-control" placeholder="Tìm kiếm...">
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên Lớp</th>
                        <th>Khoa</th>
                        <th>Trạng thái</th>
                        <th>Số lượng sinh viên</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($classes as $class)
                        <tr>
                            <td>{{ $class->id }}</td>
                            <td>{{ $class->name }}</td>
                            <td>{{ $class->faculty->name }}</td>
                            <td>
                                <span class="badge bg-{{ $class->is_active ? 'success' : 'danger' }}">
                                    {{ $class->is_active ? 'Hoạt động' : 'Ngừng hoạt động' }}
                                </span>
                            </td>
                            <td>{{ $class->students()->count() }}</td>
                            <td>
                                <button class="btn btn-sm btn-info" wire:click="openEditModal({{ $class->id }})">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-danger" wire:click="openDeleteModal({{ $class->id }})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-3">
            <div>
                Hiển thị {{ $classes->firstItem() }} đến {{ $classes->lastItem() }} trong tổng số {{ $classes->total() }} lớp
            </div>
            <div>
                {{ $classes->links('pagination') }}
            </div>
        </div>

        <!-- Add Class Modal -->
        @if($showAddModal || $showEditModal)
        <div class="modal fade show" style="display: block; background-color: rgba(0,0,0,0.5);" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">@if($showEditModal) Sửa Lớp @else Thêm Lớp @endif</h5>
                        <button type="button" class="btn-close" wire:click="closeModal"></button>
                    </div>
                    <form wire:submit.prevent="@if($editingClassId) updateClass @else createClass @endif">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Khoa</label>
                                        <select class="form-select" wire:model="faculty_id" required>
                                            <option value="">-- Chọn Khoa --</option>
                                            @foreach($faculties as $faculty)
                                                <option value="{{ $faculty->id }}">{{ $faculty->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('faculty_id') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Tên Lớp</label>
                                        <input type="text" class="form-control" wire:model="name" required>
                                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
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
        @if($showDeleteModal)
        <div class="modal fade show" style="display: block; background-color: rgba(0,0,0,0.5);" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Xác nhận xóa</h5>
                        <button type="button" class="btn-close" wire:click="closeModal"></button>
                    </div>
                    <div class="modal-body">
                        Bạn có chắc muốn xóa lớp này không?
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
