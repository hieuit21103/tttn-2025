<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('layouts.index');
});

Route::get('/forms/{filename}', function ($filename) {
    return response()->download(storage_path('app/public/forms/' . $filename));
})->name('forms.download');

Route::get('/admin/login',function(){
    return view('layouts.admin.login');
})->name('admin.login');

Route::post('/contact', function (Request $request) {
    // TODO: Implement contact form submission
    return redirect()->back()->with('success', 'Thắc mắc của bạn đã được gửi!');
})->name('contact.submit');

// Admin routes protected by auth.check middleware
Route::middleware('auth.check')->prefix('admin')->group(function () {
    Route::get('/',function(){
        return view('layouts.admin.dashboard');
    })->name('admin.dashboard');

    // Quản lý KTX
    Route::prefix('dorms')->group(function () {
        Route::get('/', function() {
            return view('layouts.admin.dorm.dorm_list');
        })->name('admin.dorms.list');
        
        Route::get('/types', function() {
            return view('layouts.admin.dorm.dorm_types');
        })->name('admin.dorms.types');
        
        Route::get('/pricing', function() {
            return view('layouts.admin.dorm.dorm_pricing');
        })->name('admin.dorms.pricing');
        
        // API routes for AJAX requests
        Route::post('/create', function(Request $request) {
            return response()->json(['success' => true]);
        })->name('admin.dorms.create');
        
        Route::put('/{id}', function(Request $request, $id) {
            return response()->json(['success' => true]);
        })->name('admin.dorms.update');
        
        Route::delete('/{id}', function(Request $request, $id) {
            return response()->json(['success' => true]);
        })->name('admin.dorms.delete');
    });

    // Quản lý sinh viên
    Route::prefix('students')->group(function () {
        Route::get('/', function() {
            return view('layouts.admin.student.student_list');
        })->name('admin.students.list');
        
        Route::get('/detail/{id}', function($id) {
            return view('layouts.admin.student.student_detail', ['id' => $id]);
        })->name('admin.students.detail');
        
        Route::get('/modify/{id}', function($id) {
            return view('layouts.admin.student.student_modify', ['id' => $id]);
        })->name('admin.students.modify');
        
        // API routes for AJAX requests
        Route::post('/create', function(Request $request) {
            return response()->json(['success' => true]);
        })->name('admin.students.create');
        
        Route::put('/{id}', function(Request $request, $id) {
            return response()->json(['success' => true]);
        })->name('admin.students.update');
        
        Route::delete('/{id}', function(Request $request, $id) {
            return response()->json(['success' => true]);
        })->name('admin.students.delete');
        
        // API route for room assignment
        Route::post('/{id}/assign-room', function(Request $request, $id) {
            return response()->json(['success' => true]);
        })->name('admin.students.assign-room');
    });
});
