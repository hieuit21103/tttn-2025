@extends('layouts.app')

@section('title', 'Thông tin cá nhân')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Thông tin cá nhân</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Họ và tên:</strong> {{ Auth::user()->name }}</p>
                            <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                            <p><strong>Quyền truy cập:</strong> {{ Auth::user()->role }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
