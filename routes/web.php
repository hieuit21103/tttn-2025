<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Middleware\CheckAuth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\AccountActivationController;
use App\Http\Controllers\DormitoryController;

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

Route::get('/api/address-data', function () {
    $path = public_path('data/vietnam-divisions.json');
    if (!file_exists($path)) {
        return response()->json(['error' => 'Data file not found'], 404);
    }
    $data = json_decode(file_get_contents($path), true);
    return response()->json($data);
})->name('address.data');

Route::post('/contact', function (Request $request) {
    // Xử lý logic gửi liên hệ ở đây
    return redirect()->back()->with('success', 'Thắc mắc của bạn đã được gửi!');
})->name('contact.submit');

Route::post('/dormitory/register', [DormitoryController::class, 'register'])->name('dormitory.register');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home',function(){
        return view('dashboard');
    })->name('home');
});