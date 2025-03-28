@component('mail::message')
# Kích hoạt tài khoản Ký Túc Xá

Chào {{ $fullname }},

Chúng tôi đã xác nhận đơn đăng ký Ký Túc Xá của bạn. Để hoàn tất quá trình đăng ký, vui lòng kích hoạt tài khoản bằng cách nhấn vào nút dưới đây:

@component('mail::button', ['url' => $activationUrl])
Kích hoạt tài khoản
@endcomponent

Sau khi kích hoạt, bạn sẽ có thể đăng nhập vào hệ thống Ký Túc Xá để xem thông tin và thực hiện các thủ tục tiếp theo.

Trân trọng,
Ban Quản Lý Ký Túc Xá Trường Cao Đẳng GTVT Đường Thuỷ I
@endcomponent
