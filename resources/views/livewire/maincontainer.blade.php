<div>
    <!-- Main Content -->
    <div class="container-fluid mt-3">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2">
                <div class="card shadow-sm mb-4">
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-center align-items-center mb-4">
                            <img src="https://thuvien.wtc1.edu.vn/public/themes/images/logo.png" alt="Logo trường" class="rounded-circle" width="64">
                        </div>
                        <div class="nav flex-column">
                            <button class="nav-link active py-2">
                                <i class="fas fa-home me-2"></i> Trang chủ
                            </button>
                            <button wire:click="setActiveComponent('student.list')" class="nav-link py-2">
                                <i class="fas fa-user-graduate me-2"></i> Quản lý học sinh
                            </button>
                            <button wire:click="setActiveComponent('room.list')" class="nav-link py-2">
                                <i class="fas fa-building me-2"></i> Quản lý phòng ở
                            </button>
                            <button class="nav-link py-2">
                                <i class="fas fa-clipboard-list me-2"></i> Điểm danh
                            </button>
                            <button class="nav-link py-2">
                                <i class="fas fa-money-bill-wave me-2"></i> Quản lý học phí
                            </button>
                            <button class="nav-link py-2">
                                <i class="fas fa-exclamation-circle me-2"></i> Vi phạm kỷ luật
                            </button>
                            <button class="nav-link py-2">
                                <i class="fas fa-chart-bar me-2"></i> Thống kê báo cáo
                            </button>
                            <button class="nav-link py-2">
                                <i class="fas fa-cog me-2"></i> Cài đặt hệ thống
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Area -->
                <div class="col-md-9 col-lg-10">
                    <div class="card shadow-sm">
                        @livewire($activeComponent)
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
