<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DormitoryRegistration;

class AccountActivationController extends Controller
{
    public function activate($token)
    {
        $registration = DormitoryRegistration::where('activation_token', $token)
            ->where('status', 'approved')
            ->first();

        if (!$registration) {
            abort(404, 'Liên kết kích hoạt không hợp lệ hoặc đã hết hạn');
        }

        $registration->update([
            'status' => 'activated',
            'activation_token' => null
        ]);

        return view('activation.success', [
            'fullname' => $registration->fullname
        ]);
    }
}
