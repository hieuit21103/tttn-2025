@component('mail::message')
# Thông Báo Duyệt Hồ Sơ Đăng Ký Ký Túc Xá

Chào bạn {{ $fullname }},

Hồ sơ đăng ký ký túc xá của bạn đã được duyệt thành công. Vui lòng kích hoạt tài khoản bằng cách nhấp vào nút dưới đây:

@component('mail::button', ['url' => $activationUrl])
Kích hoạt tài khoản
@endcomponent

Thông tin đăng ký:
- Mã Học Sinh: {{ $student_code }}
- Lớp: {{ $class }}

Nếu bạn gặp bất kỳ vấn đề gì, vui lòng liên hệ với ban quản lý ký túc xá.

Trân trọng,
Ban Quản Lý Ký Túc Xá
@endcomponent
