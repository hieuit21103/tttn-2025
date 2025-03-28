@component('mail::message')
# Xác nhận đăng ký Ký Túc Xá

Chào {{ $fullname }},

Chúng tôi đã nhận được đơn đăng ký Ký Túc Xá của bạn. Dưới đây là thông tin chi tiết:

- Mã Học Sinh: {{ $student_code }}
- Lớp: {{ $class }}
- Số CMND/CCCD: {{ $id_number }}
- Địa chỉ: {{ $address }}

Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất để xác nhận thông tin và hướng dẫn thủ tục tiếp theo.

Trân trọng,
Ban Quản Lý Ký Túc Xá Trường Cao Đẳng GTVT Đường Thuỷ I
@endcomponent
