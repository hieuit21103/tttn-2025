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
                    <input type="text" wire:model="search" class="form-control" placeholder="Tìm theo mã học sinh, tên hoặc lớp...">
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="button" class="btn btn-primary w-100" wire:click="loadRegistrations(1)">
                        <i class="fas fa-search"></i> Tìm kiếm
                    </button>
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
                            <td>{{ $registration->class }}</td>
                            <td>{{ $registration->birthdate->format('d/m/Y') }}</td>
                            <td>{{ $registration->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <span class="badge bg-warning">
                                    Chờ duyệt
                                </span>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-info" title="Xem chi tiết" data-bs-toggle="modal" data-bs-target="#viewModal{{ $registration->id }}">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-success" title="Duyệt" wire:click="approve({{ $registration->id }})" wire:loading.attr="disabled" wire:target="approve({{ $registration->id }})">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" title="Từ chối" wire:click="reject({{ $registration->id }})" wire:loading.attr="disabled" wire:target="reject({{ $registration->id }})">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- View Modal -->
                        <div class="modal fade" id="viewModal{{ $registration->id }}">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Chi tiết hồ sơ</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p><strong>Mã Học Sinh:</strong> {{ $registration->student_code }}</p>
                                                <p><strong>Họ và Tên:</strong> {{ $registration->fullname }}</p>
                                                <p><strong>Lớp:</strong> {{ $registration->class }}</p>
                                                <p><strong>Ngày Sinh:</strong> {{ $registration->birthdate->format('d/m/Y') }}</p>
                                                <p><strong>Số CMND/CCCD:</strong> {{ $registration->id_number }}</p>
                                                <p><strong>Email:</strong> {{ $registration->email }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <p><strong>Số Điện Thoại Cá Nhân:</strong> {{ $registration->personal_phone }}</p>
                                                <p><strong>Số Điện Thoại Gia Đình:</strong> {{ $registration->family_phone }}</p>
                                                <p><strong>Địa Chỉ:</strong> {{ $registration->address }}</p>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-6">
                                                <h6>Ảnh CCCD Mặt Trước</h6>
                                                <img src="{{ asset('storage/' . $registration->id_front_path) }}" class="img-fluid" alt="CMND Mặt Trước">
                                            </div>
                                            <div class="col-md-6">
                                                <h6>Ảnh CCCD Mặt Sau</h6>
                                                <img src="{{ asset('storage/' . $registration->id_back_path) }}" class="img-fluid" alt="CMND Mặt Sau">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div>Hiển thị {{ $pagination['from'] == "" ? 1 : $pagination['from'] }}-{{ $pagination['to'] == "" ? 0 : $pagination['to'] }} trong tổng số {{ $pagination['total'] }} hồ sơ</div>
                <nav>
                    <ul class="pagination mb-0">
                        @if($pagination['current_page'] > 1)
                            <li class="page-item">
                                <a class="page-link" href="javascript:void(0)" wire:click="loadRegistrations({{ $pagination['current_page'] - 1 }})">Trước</a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <a class="page-link" href="#">Trước</a>
                            </li>
                        @endif
                        
                        @for($i = 1; $i <= $pagination['last_page']; $i++)
                            <li class="page-item {{ $pagination['current_page'] == $i ? 'active' : '' }}">
                                <a class="page-link" href="javascript:void(0)" wire:click="loadRegistrations({{ $i }})">{{ $i }}</a>
                            </li>
                        @endfor
                        
                        @if($pagination['current_page'] < $pagination['last_page'])
                            <li class="page-item">
                                <a class="page-link" href="javascript:void(0)" wire:click="loadRegistrations({{ $pagination['current_page'] + 1 }})">Sau</a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <a class="page-link" href="#">Sau</a>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
