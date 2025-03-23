<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class LoginController extends Controller
{

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->except('password'));
        }

        $key = Str::lower($request->input('username')).'|'.$request->ip();
        
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            
            return redirect()->back()
                ->withErrors(['username' => 'Quá nhiều lần đăng nhập không thành công. Vui lòng thử lại sau ' . $seconds . ' giây.'])
                ->withInput($request->except('password'));
        }

        $credentials = $request->only('username', 'password');
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            RateLimiter::clear($key);
            return redirect()->intended(route('home'));
        }

        RateLimiter::hit($key);

        return redirect()->back()
            ->withErrors(['login_error' => 'Thông tin đăng nhập không chính xác.'])
            ->withInput($request->except('password'));
    }
}