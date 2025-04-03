@component('mail::layout')
<div style="margin-bottom: 20px;">
    <h1 style="font-size: 24px; color: #2d3748; margin-bottom: 16px;">Xác nhận đăng ký Ký Túc Xá</h1>

    <p style="margin-bottom: 16px;">Chào {{ $fullname }},</p>

    <p style="margin-bottom: 16px;">Chúng tôi đã nhận được đơn đăng ký Ký Túc Xá của bạn. Dưới đây là thông tin chi tiết:</p>

    <div style="background-color: #f8fafc; padding: 16px; border-radius: 8px; margin-bottom: 16px;">
        <p style="margin: 8px 0;">Mã Học Sinh: {{ $student_code }}</p>
        <p style="margin: 8px 0;">Lớp: {{ $class }}</p>
        <p style="margin: 8px 0;">Số CMND/CCCD: {{ $id_number }}</p>
        <p style="margin: 8px 0;">Địa chỉ: {{ $address }}</p>
    </div>

    <p style="margin-bottom: 16px;">Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất để xác nhận thông tin và hướng dẫn thủ tục tiếp theo.</p>

    <p style="margin-bottom: 8px;">Trân trọng,</p>
    <p>Ban Quản Lý Ký Túc Xá Trường Cao Đẳng GTVT Đường Thuỷ I</p>
</div>
@endcomponent
