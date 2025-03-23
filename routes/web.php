<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Middleware\CheckAuth;

Route::get('/', function () {
    return view('index');
});

Route::get('/forms/{filename}', function ($filename) {
    return response()->download(storage_path('app/public/forms/' . $filename));
})->name('forms.download');


Route::get('/login',function(){
    return view('login');
});

Route::post('/login',[LoginController::class,'login'])->name('login');

Route::post('/contact', function (Request $request) {
    // Xử lý logic gửi liên hệ ở đây
    return redirect()->back()->with('success', 'Thắc mắc của bạn đã được gửi!');
})->name('contact.submit');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home',function(){
        return view('dashboard');
    })->name('home');

    Route::prefix('dorms')->group(function () {
        Route::get('/', function() {
            return view('dorm.dorm_list');
        })->name('dorms.list');
        
        Route::get('/types', function() {
            return view('dorm.dorm_types');
        })->name('dorms.types');
        
        Route::get('/pricing', function() {
            return view('dorm.dorm_pricing');
        })->name('dorms.pricing');
        
        // API routes for AJAX requests
        Route::post('/create', function(Request $request) {
            // TODO: Implement dorm creation
            return response()->json(['success' => true]);
        })->name('dorms.create');
        
        Route::put('/{id}', function(Request $request, $id) {
            // TODO: Implement dorm update
            return response()->json(['success' => true]);
        })->name('dorms.update');
        
        Route::delete('/{id}', function(Request $request, $id) {
            // TODO: Implement dorm deletion
            return response()->json(['success' => true]);
        })->name('dorms.delete');
    });

    // Apply middleware to students routes
    Route::prefix('students')->group(function () {
        Route::get('/', function() {
            return view('student.student_list');
        })->name('students.list');
        
        Route::get('/detail/{id}', function($id) {
            return view('student.student_detail', ['id' => $id]);
        })->name('students.detail');
        
        Route::get('/modify/{id}', function($id) {
            return view('student.student_modify', ['id' => $id]);
        })->name('students.modify');
        
        // API routes for AJAX requests
        Route::post('/create', function(Request $request) {
            // TODO: Implement student creation
            return response()->json(['success' => true]);
        })->name('students.create');
        
        Route::put('/{id}', function(Request $request, $id) {
            // TODO: Implement student update
            return response()->json(['success' => true]);
        })->name('students.update');
        
        Route::delete('/{id}', function(Request $request, $id) {
            // TODO: Implement student deletion
            return response()->json(['success' => true]);
        })->name('students.delete');
        
        // API route for room assignment
        Route::post('/{id}/assign-room', function(Request $request, $id) {
            // TODO: Implement room assignment
            return response()->json(['success' => true]);
        })->name('students.assign-room');
    });
});