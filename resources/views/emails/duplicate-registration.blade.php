@component('mail::message')
# Thông Báo Đăng Ký Ký Túc Xá

Chào bạn {{ $fullname }},

Rất tiếc, hệ thống đã phát hiện rằng bạn đã đăng ký ký túc xá trước đó. Hồ sơ đăng ký mới của bạn đã bị từ chối vì lý do sau:

- Mã Học Sinh: {{ $student_code }}
- Lớp: {{ $class }}

Hồ sơ đăng ký trước đó của bạn:
- Họ và Tên: {{ $existingFullname }}
- Mã Học Sinh: {{ $existingStudentCode }}
- Lớp: {{ $existingClass }}
- Email: {{ $existingEmail }}

Nếu bạn cần thêm thông tin hoặc muốn cập nhật thông tin đăng ký, vui lòng liên hệ với ban quản lý ký túc xá.

Trân trọng,
Ban Quản Lý Ký Túc Xá
@endcomponent
