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
                            <a href="#" wire:click.prevent="setActiveComponent('pending-approvals')" class="nav-link {{ $activeComponent === 'pending-approvals' ? 'active' : '' }} py-2">
                                <i class="fas fa-home me-1"></i>
                                <span class="d-inline-block">Hồ Sơ Chờ Duyệt</span>
                            </a>
                            <a href="#" wire:click.prevent="setActiveComponent('student.list')" class="nav-link {{ $activeComponent === 'student.list' ? 'active' : '' }} py-2">
                                <i class="fas fa-user-graduate me-1"></i>
                                <span class="d-inline-block">Danh Sách Học Sinh</span>
                            </a>
                            <a href="#" wire:click.prevent="setActiveComponent('room.list')" class="nav-link {{ $activeComponent === 'room.list' ? 'active' : '' }} py-2">
                                <i class="fas fa-building me-1"></i>
                                <span class="d-inline-block">Danh Sách Phòng</span>
                            </a>
                            <a href="#" wire:click.prevent="setActiveComponent('room.types')" class="nav-link {{ $activeComponent === 'room.types' ? 'active' : '' }} py-2">
                                <i class="fas fa-home me-1"></i>
                                <span class="d-inline-block">Loại Phòng</span>
                            </a>
                            <a href="#" wire:click.prevent="setActiveComponent('violation.list')" class="nav-link {{ $activeComponent === 'violation.list' ? 'active' : '' }} py-2">
                                <i class="fas fa-exclamation-circle me-1"></i>
                                <span class="d-inline-block">Vi Phạm Kỷ Luật</span>
                            </a>
                            <a href="#" wire:click.prevent="setActiveComponent('violation.level')" class="nav-link {{ $activeComponent === 'violation.level' ? 'active' : '' }} py-2">
                                <i class="fa-solid fa-shield-halved"></i>
                                <span class="d-inline-block"> Mức Vi Phạm Kỷ Luật</span>
                            </a>
                            <a href="#" wire:click.prevent="setActiveComponent('report')" class="nav-link {{ $activeComponent === 'report' ? 'active' : '' }} py-2">
                                <i class="fas fa-chart-bar me-1"></i>
                                <span class="d-inline-block">Báo Cáo Thống Kê</span>
                            </a>
                            <a href="#" wire:click.prevent="setActiveComponent('setting')" class="nav-link {{ $activeComponent === 'setting' ? 'active' : '' }} py-2">
                                <i class="fas fa-cog me-1"></i>
                                <span class="d-inline-block">Cài Đặt Hệ Thống</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Area -->
                <div class="col-md-9 col-lg-10">
                    <div class="card shadow-sm mb-4">
                        @if($activeComponent === 'pending-approvals')
                            @livewire('pending-approvals')
                        @elseif($activeComponent === 'student.list')
                            @livewire('student-list')
                        @elseif($activeComponent === 'room.list')
                            @livewire('room-list')
                        @elseif($activeComponent === 'room.types')
                            @livewire('room-type-component')
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
