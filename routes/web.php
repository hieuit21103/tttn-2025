<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('layouts.index');
});

Route::get('/forms/{filename}', function ($filename) {
    return response()->download(storage_path('app/public/forms/' . $filename));
})->name('forms.download');

Route::get('/admin/',function(){
    return view('layouts.admin.dashboard');
});

Route::get('/admin/login',function(){
    return view('layouts.admin.login');
});

Route::post('/contact', function (Request $request) {
    // Xử lý logic gửi liên hệ ở đây
    return redirect()->back()->with('success', 'Thắc mắc của bạn đã được gửi!');
})->name('contact.submit');

// Quản lý KTX
Route::prefix('admin/dorms')->group(function () {
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
        // TODO: Implement dorm creation
        return response()->json(['success' => true]);
    })->name('admin.dorms.create');
    
    Route::put('/{id}', function(Request $request, $id) {
        // TODO: Implement dorm update
        return response()->json(['success' => true]);
    })->name('admin.dorms.update');
    
    Route::delete('/{id}', function(Request $request, $id) {
        // TODO: Implement dorm deletion
        return response()->json(['success' => true]);
    })->name('admin.dorms.delete');
});

// Quản lý sinh viên
Route::prefix('admin/students')->group(function () {
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
        // TODO: Implement student creation
        return response()->json(['success' => true]);
    })->name('admin.students.create');
    
    Route::put('/{id}', function(Request $request, $id) {
        // TODO: Implement student update
        return response()->json(['success' => true]);
    })->name('admin.students.update');
    
    Route::delete('/{id}', function(Request $request, $id) {
        // TODO: Implement student deletion
        return response()->json(['success' => true]);
    })->name('admin.students.delete');
    
    // API route for room assignment
    Route::post('/{id}/assign-room', function(Request $request, $id) {
        // TODO: Implement room assignment
        return response()->json(['success' => true]);
    })->name('admin.students.assign-room');
});