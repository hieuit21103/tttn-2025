<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Danh Sách Khoa</h5>
        <div>
            <a href="#" wire:click="setActiveComponent('faculty.create')" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i>
                Thêm Khoa Mới
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
                        <th wire:click="sortBy('code')">
                            Mã Khoa
                            @if($sortField === 'code')
                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                            @endif
                        </th>
                        <th wire:click="sortBy('name')">
                            Tên Khoa
                            @if($sortField === 'name')
                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                            @endif
                        </th>
                        <th>Trạng thái</th>
                        <th>Số lượng lớp</th>
                        <th>Số lượng sinh viên</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($faculties as $faculty)
                        <tr>
                            <td>{{ $faculty->code }}</td>
                            <td>{{ $faculty->name }}</td>
                            <td>
                                <span class="badge bg-{{ $faculty->is_active ? 'success' : 'danger' }}">
                                    {{ $faculty->is_active ? 'Hoạt động' : 'Ngừng hoạt động' }}
                                </span>
                            </td>
                            <td>{{ $faculty->classes()->count() }}</td>
                            <td>{{ $faculty->students()->count() }}</td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-info" wire:click="setActiveComponent('faculty.edit', {{ $faculty->id }})">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" wire:click="confirmDelete({{ $faculty->id }})">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-3">
            <div>
                Hiển thị {{ $faculties->firstItem() }} đến {{ $faculties->lastItem() }} trong tổng số {{ $faculties->total() }} khoa
            </div>
            <div>
                {{ $faculties->links() }}
            </div>
        </div>
    </div>
</div>
