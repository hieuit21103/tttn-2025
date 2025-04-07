@component('mail::layout')
<div style="margin-bottom: 20px;">
    <h1 style="font-size: 24px; color: #2d3748; margin-bottom: 16px;">Thông Báo Đăng Ký Ký Túc Xá</h1>

    <p style="margin-bottom: 16px;">Chào bạn {{ $fullname }},</p>

    <p style="margin-bottom: 16px;">Rất tiếc, hệ thống đã phát hiện rằng bạn đã đăng ký ký túc xá trước đó. Hồ sơ đăng ký mới của bạn đã bị từ chối vì lý do sau:</p>

    <div style="background-color: #f8fafc; padding: 16px; border-radius: 8px; margin-bottom: 16px;">
        <p style="margin: 8px 0;">Mã Học Sinh: {{ $student_code }}</p>
        <p style="margin: 8px 0;">Khoa: {{ $class->faculty->name }}</p>
        <p style="margin: 8px 0;">Lớp: {{ $class->name }}</p>
    </div>

    <p style="margin-bottom: 16px;">Hồ sơ đăng ký trước đó của bạn:</p>
    
    <div style="background-color: #f8fafc; padding: 16px; border-radius: 8px; margin-bottom: 16px;">
        <p style="margin: 8px 0;">Họ và Tên: {{ $existingFullname }}</p>
        <p style="margin: 8px 0;">Mã Học Sinh: {{ $existingStudentCode }}</p>
        <p style="margin: 8px 0;">Lớp: {{ $existingClass }}</p>
        <p style="margin: 8px 0;">Email: {{ $existingEmail }}</p>
    </div>

    <p style="margin-bottom: 16px;">Nếu bạn cần thêm thông tin hoặc muốn cập nhật thông tin đăng ký, vui lòng liên hệ với ban quản lý ký túc xá.</p>

    <p style="margin-bottom: 8px;">Trân trọng,</p>
    <p>Ban Quản Lý Ký Túc Xá</p>
</div>
@endcomponent
