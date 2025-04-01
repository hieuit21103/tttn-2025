<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Danh Sách Lớp</h5>
        <div>
            <a href="#" wire:click="setActiveComponent('class.create')" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i>
                Thêm Lớp Mới
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-4">
                <input type="text" wire:model.live="search" class="form-control" placeholder="Tìm kiếm...">
            </div>
            <div class="col-md-4">
                <select wire:model.live="faculty_id" class="form-select">
                    <option value="">Tất cả khoa</option>
                    @foreach($faculties as $faculty)
                        <option value="{{ $faculty->id }}">
                            {{ $faculty->code }} - {{ $faculty->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th wire:click="sortBy('code')">
                            Mã Lớp
                            @if($sortField === 'code')
                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                            @endif
                        </th>
                        <th wire:click="sortBy('name')">
                            Tên Lớp
                            @if($sortField === 'name')
                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                            @endif
                        </th>
                        <th>Khoa</th>
                        <th>Khóa học</th>
                        <th>Chuyên ngành</th>
                        <th>Số lượng sinh viên</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($classes as $class)
                        <tr>
                            <td>{{ $class->code }}</td>
                            <td>{{ $class->name }}</td>
                            <td>
                                {{ $class->faculty->code }} - {{ $class->faculty->name }}
                            </td>
                            <td>{{ $class->grade }}</td>
                            <td>{{ $class->major }}</td>
                            <td>{{ $class->students_count }}</td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-info" wire:click="setActiveComponent('class.edit', {{ $class->id }})">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" wire:click="confirmDelete({{ $class->id }})">
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
                Hiển thị {{ $classes->firstItem() }} đến {{ $classes->lastItem() }} trong tổng số {{ $classes->total() }} lớp
            </div>
            <div>
                {{ $classes->links() }}
            </div>
        </div>
    </div>
</div>
