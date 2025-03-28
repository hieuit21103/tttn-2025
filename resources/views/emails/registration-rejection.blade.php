@component('mail::message')
# Thông Báo Từ Chối Hồ Sơ Đăng Ký Ký Túc Xá

Chào bạn {{ $fullname }},

Rất tiếc, hồ sơ đăng ký ký túc xá của bạn đã bị từ chối. Vui lòng liên hệ với ban quản lý ký túc xá để biết thêm chi tiết.

Thông tin đăng ký:
- Mã Học Sinh: {{ $student_code }}
- Lớp: {{ $class }}

Nếu bạn muốn đăng ký lại, vui lòng truy cập trang đăng ký của chúng tôi.

Trân trọng,
Ban Quản Lý Ký Túc Xá
@endcomponent
