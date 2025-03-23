<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Middleware\CheckAuth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/forms/{filename}', function ($filename) {
    return response()->download(storage_path('app/public/forms/' . $filename));
})->name('forms.download');

Route::get('/login',function(){
    return view('login');
});

Route::post('/login',[LoginController::class,'login'])->name('login');

Route::get('/logout',[LogoutController::class,'logout'])->name('logout');

Route::post('/contact', function (Request $request) {
    // Xử lý logic gửi liên hệ ở đây
    return redirect()->back()->with('success', 'Thắc mắc của bạn đã được gửi!');
})->name('contact.submit');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home',function(){
        return view('dashboard');
    })->name('home');
});