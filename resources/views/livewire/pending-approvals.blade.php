<div class="container-fluid py-4">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Hồ sơ chờ duyệt</h2>
    </div>

    <!-- Filters -->
    <div class="card mb-4">
        <div class="card-body">
            <form class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">Tìm kiếm</label>
                    <input type="text" wire:model.live="search" class="form-control" placeholder="Tìm theo mã học sinh, tên hoặc lớp...">
                </div>
            </form>
        </div>
    </div>

    <!-- Registrations Table -->
    <div class="card">
        <div class="card-body">
            @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Mã Học Sinh</th>
                            <th>Họ và Tên</th>
                            <th>Khoa</th>
                            <th>Lớp</th>
                            <th>Ngày Sinh</th>
                            <th>Ngày Đăng Ký</th>
                            <th>Trạng Thái</th>
                            <th>Thao Tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registrations as $registration)
                        <tr>
                            <td>{{ $registration->student_code }}</td>
                            <td>{{ $registration->fullname }}</td>
                            <td>{{ $registration->faculty->name }}</td>
                            <td>{{ $registration->class->name }}</td>
                            <td>{{ $registration->birthdate->format('d/m/Y') }}</td>
                            <td>{{ $registration->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <span class="badge {{ $registration->status === 'pending' ? 'bg-warning' : ($registration->status === 'approved' ? 'bg-success' : ($registration->status === 'activated' ? 'bg-info' : 'bg-danger')) }}">
                                    {{ 
                                        match($registration->status) {
                                            'pending' => 'Chờ duyệt',
                                            'approved' => 'Đã duyệt',
                                            'activated' => 'Đã kích hoạt',
                                            'rejected' => 'Đã từ chối',
                                            default => 'Chờ duyệt'
                                        } 
                                    }}
                                </span>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-primary" title="Xem chi tiết" wire:click="showDetails({{ $registration->id }})">
                                    <i class="fas fa-eye"></i>
                                </button>
                                @if($registration->status === 'pending')
                                    <button class="btn btn-sm btn-success" title="Duyệt" wire:click="approve({{ $registration->id }})" wire:loading.attr="disabled" wire:target="approve({{ $registration->id }})">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" title="Từ chối" wire:click="reject({{ $registration->id }})" wire:loading.attr="disabled" wire:target="reject({{ $registration->id }})">
                                        <i class="fas fa-times"></i>
                                    </button>
                                @else
                                    <button class="btn btn-sm btn-warning" title="Hoàn tác" wire:click="revert({{ $registration->id }})" wire:loading.attr="disabled" wire:target="revert({{ $registration->id }})">
                                        <i class="fas fa-undo"></i>
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
                <div>
                    Hiển thị {{ $registrations->firstItem() }}-{{ $registrations->lastItem() }} trong tổng số {{ $registrations->total() }} hồ sơ
                </div>
                <div>
                    {{ $registrations->links('pagination') }}
                </div>
            </div>
        </div>
    </div>

    <!-- Details Modal -->
    @if($showDetailsModal)
    <div class="modal fade show" style="display: block; background-color: rgba(0,0,0,0.5);" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Chi tiết hồ sơ đăng ký</h5>
                    <button type="button" class="btn-close" wire:click="closeDetailsModal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Mã Học Sinh</label>
                                <input type="text" class="form-control" value="{{ $selectedRegistration->student_code }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Họ và Tên</label>
                                <input type="text" class="form-control" value="{{ $selectedRegistration->fullname }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Giới tính</label>
                                <input type="text" class="form-control" value="{{ $selectedRegistration->gender }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Khoa</label>
                                <input type="text" class="form-control" value="{{ $selectedRegistration->faculty->name }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Lớp</label>
                                <input type="text" class="form-control" value="{{ $selectedRegistration->class->name }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Ngày Sinh</label>
                                <input type="text" class="form-control" value="{{ $selectedRegistration->birthdate->format('d/m/Y') }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Số CMND/CCCD</label>
                                <input type="text" class="form-control" value="{{ $selectedRegistration->id_number }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Số điện thoại cá nhân</label>
                                <input type="text" class="form-control" value="{{ $selectedRegistration->personal_phone }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Số điện thoại gia đình</label>
                                <input type="text" class="form-control" value="{{ $selectedRegistration->family_phone }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Địa chỉ</label>
                                <textarea class="form-control" rows="3" readonly>{{ $selectedRegistration->address }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" value="{{ $selectedRegistration->email }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Ngày Đăng Ký</label>
                                <input type="text" class="form-control" value="{{ $selectedRegistration->created_at->format('d/m/Y H:i') }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Hình ảnh CMND/CCCD mặt trước</label>
                                @if($selectedRegistration->id_front_path)
                                    <img src="{{ Storage::url($selectedRegistration->id_front_path) }}" class="img-fluid" alt="CMND mặt trước">
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Hình ảnh CMND/CCCD mặt sau</label>
                                @if($selectedRegistration->id_back_path)
                                    <img src="{{ Storage::url($selectedRegistration->id_back_path) }}" class="img-fluid" alt="CMND mặt sau">
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
</div>
