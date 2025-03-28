@extends('layouts.app')

@section('title', 'Kích hoạt thành công')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body text-center">
                    <i class="fas fa-check-circle text-success" style="font-size: 4em;"></i>
                    <h2 class="mt-3">Kích hoạt tài khoản thành công</h2>
                    <p class="lead">Chúc mừng {{ $fullname }}! Tài khoản của bạn đã được kích hoạt thành công.</p>
                    <p>Bạn có thể đăng nhập vào hệ thống Ký Túc Xá để xem thông tin và thực hiện các thủ tục tiếp theo.</p>
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg mt-3">
                        Đăng nhập ngay
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
