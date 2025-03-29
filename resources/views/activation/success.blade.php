@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Kích hoạt tài khoản thành công</div>

                <div class="card-body">
                    <div class="alert alert-success">
                        <h4>Chúc mừng {{ $fullname }}!</h4>
                        <p>Tài khoản của bạn đã được kích hoạt thành công.</p>
                    </div>

                    <div class="alert alert-info">
                        <h5>Thông tin tài khoản:</h5>
                        <p><strong>Tên đăng nhập:</strong> {{ $username }}</p>
                        <p><strong>Mật khẩu:</strong> {{ $password }}</p>
                        <p>Vui lòng lưu lại thông tin tài khoản này.</p>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('login') }}" class="btn btn-primary">
                            Đăng nhập ngay
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection