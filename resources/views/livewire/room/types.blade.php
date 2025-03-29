<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Quản lý loại phòng KTX</h2>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRoomTypeModal">
            <i class="fas fa-plus"></i> Thêm loại phòng mới
        </button>
    </div>

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
                                    <th>Số phòng</th>
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
                                    <td>{{ $type->rooms_count ?? 0 }}</td>
                                    <td>{{ $type->created_at->format('d/m/Y H:i') }}</td>
                                    <td>{{ $type->updated_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-sm btn-primary" wire:click="editRoomType({{ $type->id }})" title="Chỉnh sửa" onclick="console.log('Type ID:', {{ $type->id }})">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger" wire:click="deleteRoomType({{ $type->id }})" title="Xóa" onclick="return confirm('Bạn có chắc muốn xóa loại phòng này không?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
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
                        <div>Hiển thị {{ ($currentPage - 1) * 10 + 1 }}-{{ min($currentPage * 10, $totalRoomTypes) }} của {{ $totalRoomTypes }} mục</div>
                        <nav>
                            <ul class="pagination mb-0">
                                @if($currentPage === 1)
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#">Trước</a>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="#" wire:click="loadRoomTypes({{ $currentPage - 1 }})">Trước</a>
                                    </li>
                                @endif

                                @for($i = 1; $i <= $lastPage; $i++)
                                    <li class="page-item {{ $currentPage === $i ? 'active' : '' }}">
                                        <a class="page-link" href="#" wire:click="loadRoomTypes({{ $i }})">{{ $i }}</a>
                                    </li>
                                @endfor

                                @if($currentPage === $lastPage)
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#">Sau</a>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="#" wire:click="loadRoomTypes({{ $currentPage + 1 }})">Sau</a>
                                    </li>
                                @endif
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal thêm/sửa loại phòng -->
    <div class="modal fade" id="addRoomTypeModal" tabindex="-1" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <form wire:submit="{{ $isEditing ? 'updateRoomType' : 'createRoomType' }}">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $isEditing ? 'Cập nhật loại phòng' : 'Thêm loại phòng mới' }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Tên loại phòng</label>
                            <input type="text" class="form-control @error('roomType.name') is-invalid @enderror" 
                                wire:model="roomType.name">
                            @error('roomType.name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Giá thuê/tháng</label>
                            <div class="input-group">
                                <input type="number" class="form-control @error('roomType.monthly_price') is-invalid @enderror" 
                                    wire:model="roomType.monthly_price">
                                <span class="input-group-text">₫</span>
                                @error('roomType.monthly_price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="resetForm">Hủy</button>
                        <button type="submit" class="btn btn-primary">{{ $isEditing ? 'Cập nhật' : 'Thêm' }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@script
<script>
    document.addEventListener('livewire:initialized', function () {
        document.addEventListener('showModal', (event) => {
            console.log(event.detail.modalId);
            const modalId = event.detail.modalId;
            const modal = new bootstrap.Modal(document.getElementById(modalId));
            modal.show();
        });

        document.addEventListener('hideModal', (event) => {
            const modalId = event.detail.modalId;
            const modal = bootstrap.Modal.getInstance(document.getElementById(modalId));
            if (modal) {
                modal.hide();
            }
        });

        const addModal = document.getElementById('addRoomTypeModal');
        if (addModal) {
            addModal.addEventListener('hidden.bs.modal', () => {
                Livewire.dispatch('resetForm');
            });
        }
    });
</script>
@endscript
