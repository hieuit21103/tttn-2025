<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.index');
});

Route::get('/forms/{filename}', function ($filename) {
    return response()->download(storage_path('app/public/forms/' . $filename));
})->name('forms.download');

Route::get('/admin/dashboard',function(){
    return view('layouts.admin.dashboard');
});

Route::get('/admin/login',function(){
    return view('layouts.admin.login');
});

Route::post('/contact', function (Request $request) {
    // Xử lý logic gửi liên hệ ở đây
    return redirect()->back()->with('success', 'Thắc mắc của bạn đã được gửi!');
})->name('contact.submit');