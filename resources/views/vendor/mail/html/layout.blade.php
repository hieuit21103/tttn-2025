<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            font-family: Arial, sans-serif;
        }
        .email-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .email-body {
            background-color: #f5f5f5;
            padding: 20px;
            border-radius: 8px;
        }
        .email-footer {
            text-align: center;
            margin-top: 30px;
            color: #666;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <img src="http://wtc1.edu.vn/wp-content/uploads/2020/12/thanh-duong-thuy-noi-quy-khu-the-duc4.png" alt="Trường Cao Đẳng GTVT Đường Thuỷ I" style="max-height: 80px;">
        </div>
        <div class="email-body">
            {{ $slot }}
        </div>
        <div class="email-footer">
            <p>Trường Cao Đẳng GTVT Đường Thuỷ I</p>
            <p>Địa chỉ: Số 22 Đinh Nhu - P. Lam Sơn - Q. Lê Chân - TP. Hải Phòng</p>
            <p>Email: info@wtc1.edu.vn | Điện thoại: (0225) 3822 181</p>
            <p>&copy; {{ date('Y') }} Trường Cao Đẳng GTVT Đường Thuỷ I. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
