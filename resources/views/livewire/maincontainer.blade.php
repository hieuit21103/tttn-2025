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
                        
                        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                            <div class="container-fluid">
                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarNav">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse" id="sidebarNav">
                                    <ul class="navbar-nav flex-column w-100">
                                        <!-- Hồ Sơ Chờ Duyệt -->
                                        <li class="nav-item">
                                            <a href="#" wire:click.prevent="setActiveComponent('pending-approvals')" class="nav-link {{ $activeComponent === 'pending-approvals' ? 'active' : '' }} py-2">
                                                <i class="fas fa-home me-1"></i>
                                                <span class="d-inline-block">Hồ Sơ Chờ Duyệt</span>
                                            </a>
                                        </li>

                                        <!-- Danh Sách Học Sinh -->
                                        <li class="nav-item">
                                            <a href="#" wire:click.prevent="setActiveComponent('student-list')" class="nav-link {{ $activeComponent === 'student-list' ? 'active' : '' }} py-2">
                                                <i class="fas fa-user-graduate me-1"></i>
                                                <span class="d-inline-block">Danh Sách Học Sinh</span>
                                            </a>
                                        </li>

                                        <!-- Quản lý Phòng -->
                                        <li class="nav-item">
                                            <a href="#" class="nav-link py-2" wire:click.prevent="toggleMenu('room')">
                                                <i class="fas fa-home me-1"></i>
                                                <span class="d-inline-block">Quản lý Phòng</span>
                                            </a>
                                            <div class="collapse {{ $activeMenu === 'room' ? 'show' : '' }}" id="roomMenu">
                                                <ul class="nav flex-column ms-3">
                                                    <li class="nav-item">
                                                        <a href="#" wire:click.prevent="setActiveComponent('room-types')" class="nav-link py-2 {{ $activeComponent === 'room-types' ? 'active' : '' }}">
                                                            <i class="fas fa-bed me-1"></i>
                                                            <span class="d-inline-block">Loại Phòng</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#" wire:click.prevent="setActiveComponent('room-list')" class="nav-link py-2 {{ $activeComponent === 'room-list' ? 'active' : '' }}">
                                                            <i class="fas fa-list me-1"></i>
                                                            <span class="d-inline-block">Danh Sách Phòng</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>

                                        <!-- Quản lý Vi Phạm -->
                                        <li class="nav-item">
                                            <a href="#" class="nav-link py-2" wire:click.prevent="toggleMenu('violation')">
                                                <i class="fas fa-exclamation-circle me-1"></i>
                                                <span class="d-inline-block">Quản lý Vi Phạm</span>
                                            </a>
                                            <div class="collapse {{ $activeMenu === 'violation' ? 'show' : '' }}" id="violationMenu">
                                                <ul class="nav flex-column ms-3">
                                                    <li class="nav-item">
                                                        <a href="#" wire:click.prevent="setActiveComponent('violation-list')" class="nav-link py-2 {{ $activeComponent === 'violation-list' ? 'active' : '' }}">
                                                            <i class="fas fa-list me-1"></i>
                                                            <span class="d-inline-block">Danh Sách Vi Phạm</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#" wire:click.prevent="setActiveComponent('violation-level')" class="nav-link py-2 {{ $activeComponent === 'violation-level' ? 'active' : '' }}">
                                                            <i class="fas fa-shield-alt me-1"></i>
                                                            <span class="d-inline-block">Mức Vi Phạm</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>

                                        <!-- Quản lý Khoa và Lớp -->
                                        <li class="nav-item">
                                            <a href="#" class="nav-link py-2" wire:click.prevent="toggleMenu('faculty')">
                                                <i class="fas fa-university me-1"></i>
                                                <span class="d-inline-block">Quản lý Khoa và Lớp</span>
                                            </a>
                                            <div class="collapse {{ $activeMenu === 'faculty' ? 'show' : '' }}" id="facultyMenu">
                                                <ul class="nav flex-column ms-3">
                                                    <li class="nav-item">
                                                        <a href="#" wire:click.prevent="setActiveComponent('faculty-list')" class="nav-link py-2 {{ $activeComponent === 'faculty-list' ? 'active' : '' }}">
                                                            <i class="fas fa-building me-1"></i>
                                                            <span class="d-inline-block">Danh Sách Khoa</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#" wire:click.prevent="setActiveComponent('class.list')" class="nav-link py-2 {{ $activeComponent === 'class.list' ? 'active' : '' }}">
                                                            <i class="fas fa-graduation-cap me-1"></i>
                                                            <span class="d-inline-block">Danh Sách Lớp</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>

                                        <!-- Quản lý Dịch vụ -->
                                        <li class="nav-item">
                                            <a href="#" class="nav-link py-2" wire:click.prevent="toggleMenu('service')">
                                                <i class="fas fa-box me-1"></i>
                                                <span class="d-inline-block">Quản lý Dịch vụ</span>
                                            </a>
                                            <div class="collapse {{ $activeMenu === 'service' ? 'show' : '' }}" id="serviceMenu">
                                                <ul class="nav flex-column ms-3">
                                                    <li class="nav-item">
                                                        <a href="#" wire:click.prevent="setActiveComponent('service-list')" class="nav-link py-2 {{ $activeComponent === 'service-list' ? 'active' : '' }}">
                                                            <i class="fas fa-list me-1"></i>
                                                            <span class="d-inline-block">Danh Sách Dịch vụ</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#" wire:click.prevent="setActiveComponent('service-room')" class="nav-link py-2 {{ $activeComponent === 'service-room' ? 'active' : '' }}">
                                                            <i class="fas fa-link me-1"></i>
                                                            <span class="d-inline-block">Dịch vụ Phòng</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>

                                        <!-- Quản lý Hóa đơn -->
                                        <li class="nav-item">
                                            <a href="#" class="nav-link py-2" wire:click.prevent="toggleMenu('invoice')">
                                                <i class="fas fa-receipt me-1"></i>
                                                <span class="d-inline-block">Quản lý Hóa đơn</span>
                                            </a>
                                            <div class="collapse {{ $activeMenu === 'invoice' ? 'show' : '' }}" id="invoiceMenu">
                                                <ul class="nav flex-column ms-3">
                                                    <li class="nav-item">
                                                        <a href="#" wire:click.prevent="setActiveComponent('invoice-list')" class="nav-link py-2 {{ $activeComponent === 'invoice-list' ? 'active' : '' }}">
                                                            <i class="fas fa-list me-1"></i>
                                                            <span class="d-inline-block">Danh Sách Hóa đơn</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#" wire:click.prevent="setActiveComponent('invoice-generate')" class="nav-link py-2 {{ $activeComponent === 'invoice-generate' ? 'active' : '' }}">
                                                            <i class="fas fa-plus me-1"></i>
                                                            <span class="d-inline-block">Tạo Hóa đơn</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>

                                        <!-- Báo Cáo -->
                                        <li class="nav-item">
                                            <a href="#" wire:click.prevent="setActiveComponent('report')" class="nav-link {{ $activeComponent === 'report' ? 'active' : '' }} py-2">
                                                <i class="fas fa-chart-bar me-1"></i>
                                                <span class="d-inline-block">Báo Cáo Thống Kê</span>
                                            </a>
                                        </li>

                                        <!-- Cài Đặt -->
                                        <li class="nav-item">
                                            <a href="#" wire:click.prevent="setActiveComponent('setting')" class="nav-link {{ $activeComponent === 'setting' ? 'active' : '' }} py-2">
                                                <i class="fas fa-cog me-1"></i>
                                                <span class="d-inline-block">Cài Đặt Hệ Thống</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>

            <!-- Main Content Area -->
            <div class="col-md-9 col-lg-10">
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        @livewire($activeComponent)
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
