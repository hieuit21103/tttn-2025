<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StorageController extends Controller
{
    public function show($path)
    {
        if (!Storage::disk('private')->exists($path)) {
            abort(404);
        }
        
        return response()->file(storage_path('app/private/' . $path));
    }
}