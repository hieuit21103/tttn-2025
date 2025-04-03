@component('mail::layout')
<div style="margin-bottom: 20px;">
    <h1 style="font-size: 24px; color: #2d3748; margin-bottom: 16px;">Thông Báo Duyệt Hồ Sơ Đăng Ký Ký Túc Xá</h1>

    <p style="margin-bottom: 16px;">Chào bạn {{ $fullname }},</p>

    <p style="margin-bottom: 16px;">Chúng tôi vui mừng thông báo rằng hồ sơ đăng ký ký túc xá của bạn đã được duyệt. Dưới đây là thông tin chi tiết:</p>

    <div style="background-color: #f8fafc; padding: 16px; border-radius: 8px; margin-bottom: 16px;">
        <p style="margin: 8px 0;">Mã Học Sinh: {{ $student_code }}</p>
        <p style="margin: 8px 0;">Lớp: {{ $class }}</p>
        <p style="margin: 8px 0;">Số CMND/CCCD: {{ $id_number }}</p>
        <p style="margin: 8px 0;">Địa chỉ: {{ $address }}</p>
    </div>

    <p style="margin-bottom: 16px;">Để kích hoạt tài khoản và hoàn tất thủ tục đăng ký, vui lòng nhấp vào liên kết dưới đây:</p>
    <div style="text-align: center; margin: 20px 0;">
        <a href="{{ $activationUrl }}" style="display: inline-block; padding: 12px 24px; background-color: #4299e1; color: white; text-decoration: none; border-radius: 4px;">
            Kích hoạt tài khoản
        </a>
    </div>

    <p style="margin-bottom: 16px;">Sau khi kích hoạt, vui lòng đến văn phòng KTX trong thời gian sớm nhất để hoàn tất thủ tục nhập KTX.</p>

    <p style="margin-bottom: 8px;">Trân trọng,</p>
    <p>Ban Quản Lý Ký Túc Xá</p>
</div>
@endcomponent
