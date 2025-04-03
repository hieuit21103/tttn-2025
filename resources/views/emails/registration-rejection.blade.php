@component('mail::layout')
<div style="margin-bottom: 20px;">
    <h1 style="font-size: 24px; color: #2d3748; margin-bottom: 16px;">Thông Báo Từ Chối Hồ Sơ Đăng Ký Ký Túc Xá</h1>

    <p style="margin-bottom: 16px;">Chào bạn {{ $fullname }},</p>

    <p style="margin-bottom: 16px;">Rất tiếc, hồ sơ đăng ký ký túc xá của bạn đã bị từ chối. Dưới đây là thông tin chi tiết:</p>

    <div style="background-color: #f8fafc; padding: 16px; border-radius: 8px; margin-bottom: 16px;">
        <p style="margin: 8px 0;">Mã Học Sinh: {{ $student_code }}</p>
        <p style="margin: 8px 0;">Lớp: {{ $class }}</p>
        <p style="margin: 8px 0;">Lý do từ chối: {{ $reason }}</p>
    </div>

    <p style="margin-bottom: 16px;">Nếu bạn cần thêm thông tin hoặc muốn nộp lại hồ sơ, vui lòng liên hệ với ban quản lý ký túc xá.</p>

    <p style="margin-bottom: 8px;">Trân trọng,</p>
    <p>Ban Quản Lý Ký Túc Xá</p>
</div>
@endcomponent
