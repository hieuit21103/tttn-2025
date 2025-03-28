<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\DormitoryRegistrationNotification;
use App\Models\DormitoryRegistration;

class DormitoryController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'student_code' => 'required|string|max:20|unique:dormitory_registrations',
            'fullname' => 'required|string|max:255',
            'birthdate' => 'required|date|before:today',
            'class' => 'required|string|max:50',
            'id_number' => 'required|string|max:20|unique:dormitory_registrations',
            'id_front' => 'required|image|max:2048', // max 2MB
            'id_back' => 'required|image|max:2048',
            'personal_phone' => 'required|string|max:15|regex:/^[0-9]{10,11}$/',
            'family_phone' => 'required|string|max:15|regex:/^[0-9]{10,11}$/',
            'email' => 'required|email|unique:dormitory_registrations',
            'city' => 'required|string',
            'district' => 'required|string',
            'ward' => 'required|string',
            'address_detail' => 'required|string|max:255',
            'truth_commitment' => 'required|accepted',
            'dormitory_rules' => 'required|accepted'
        ], [
            'student_code.unique' => 'Mã học sinh này đã được sử dụng để đăng ký trước đó.',
            'email.unique' => 'Email này đã được sử dụng để đăng ký trước đó.',
            'id_number.unique' => 'Số CMND/CCCD này đã được sử dụng để đăng ký.',
            'personal_phone.regex' => 'Số điện thoại cá nhân không hợp lệ.',
            'family_phone.regex' => 'Số điện thoại gia đình không hợp lệ.',
            'birthdate.before' => 'Ngày sinh không hợp lệ.',
            'truth_commitment.accepted' => 'Bạn phải đồng ý với cam kết.',
            'dormitory_rules.accepted' => 'Bạn phải đồng ý với quy định ký túc xá.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Store ID card images
            $id_front_path = $request->file('id_front')->store('public/id_cards');
            $id_back_path = $request->file('id_back')->store('public/id_cards');

            // Format full address
            $full_address = $request->address_detail . ', ' . 
                           $request->input('ward') . ', ' . 
                           $request->input('district') . ', ' . 
                           $request->input('city');

            // Save to database
            $registration = new DormitoryRegistration([
                'student_code' => $request->student_code,
                'fullname' => $request->fullname,
                'birthdate' => $request->birthdate,
                'class' => $request->class,
                'id_number' => $request->id_number,
                'personal_phone' => $request->personal_phone,
                'family_phone' => $request->family_phone,
                'email' => $request->email,
                'address' => $full_address,
                'id_front_path' => $id_front_path,
                'id_back_path' => $id_back_path,
                'status' => 'pending'
            ]);

            $registration->save();

            // Send email notification
            Mail::to($request->email)->send(new DormitoryRegistrationNotification($registration));

            return redirect()->back()
                ->with('success', 'Đăng ký ký túc xá thành công! Chúng tôi đã gửi thông tin xác nhận đến email của bạn.');

        } catch (\Exception $e) {
            // Delete uploaded files if registration fails
            if (isset($id_front_path)) {
                Storage::delete($id_front_path);
            }
            if (isset($id_back_path)) {
                Storage::delete($id_back_path);
            }

            return redirect()->back()
                ->with('error', 'Đã xảy ra lỗi trong quá trình đăng ký. Vui lòng thử lại sau.');
        }
    }
}
