<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập - Hệ thống Quản lý Học sinh</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <link rel="stylesheet" type="text/css" href="{{ url('css/login.css') }}">
</head>
<body>
    <div class="login-container">
        <div class="login-image">
            <div class="login-branding">
                <h2>HỆ THỐNG QUẢN LÝ HỌC SINH NỘI TRÚ</h2>
                <p>Nền tảng số hóa toàn diện cho việc quản lý trường học hiện đại</p>
            </div>
        </div>
        
        <div class="login-form-container">
            <div class="login-logo">
                <span><i class="fas fa-graduation-cap"></i></span>
            </div>
            
            <div class="login-header">
                <h1>Đăng nhập</h1>
                <p>Vui lòng đăng nhập để tiếp tục sử dụng hệ thống</p>
            </div>
            
            <form id="loginForm">
                <div class="form-group">
                    <label for="username">Tên đăng nhập</label>
                    <i class="fas fa-user"></i>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Nhập tên đăng nhập" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Mật khẩu</label>
                    <i class="fas fa-lock"></i>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu" required>
                </div>
                
                <div class="remember-forgot">
                    <div class="remember-me">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">Ghi nhớ đăng nhập</label>
                    </div>
                    
                    <div class="forgot-password">
                        <a href="#"><i class="fas fa-question-circle"></i> Quên mật khẩu?</a>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary"><i class="fas fa-sign-in-alt"></i> Đăng nhập</button>
            </form>    
    <script>
    </script>
</body>
</html>