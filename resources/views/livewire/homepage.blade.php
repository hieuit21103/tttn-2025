<div class="container mt-3">
    <h2>Chào mừng đến với Hệ thống Quản lý Học sinh Nội trú</h2>
    <p>Hệ thống này giúp bạn quản lý thông tin học sinh một cách hiệu quả và dễ dàng. Dưới đây là các chức năng chính:</p>
    
    <div class="row">
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Quản lý học sinh</h5>
                    <p class="card-text">Thêm, sửa, hoặc xóa thông tin học sinh trong hệ thống.</p>
                    <button wire:click="setActiveComponent('student-list')" class="btn btn-primary">Xem danh sách</button>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Quản lý phòng ở</h5>
                    <p class="card-text">Quản lý thông tin các phòng ở và phân bổ cho học sinh.</p>
                    <button wire:click="setActiveComponent('room-list')" class="btn btn-primary">Xem danh sách</button>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Vi phạm kỷ luật</h5>
                    <p class="card-text">Theo dõi và xử lý các trường hợp vi phạm kỷ luật của học sinh.</p>
                    <button wire:click="setActiveComponent('violation-list')" class="btn btn-primary">Xem danh sách</button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="mt-4">
        <h4>Thông báo</h4>
        <p>Đừng quên kiểm tra thông báo mới từ ban quản lý để cập nhật thông tin kịp thời.</p>
    </div>
</div>