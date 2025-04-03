<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\DormitoryRegistrationNotification;
use App\Models\DormitoryRegistration;
use App\Models\ClassModel;
use App\Models\Faculty;
use App\Models\Student;

class DormitoryController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'student_code' => 'required|string|max:20|unique:dormitory_registrations',
            'fullname' => 'required|string|max:255',
            'gender' => 'required|in:Nam,Nữ',
            'birthdate' => 'required|date|before:today',
            'class_id' => 'required|string|max:50',
            'faculty_id' => 'required|string|max:50',
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
            'gender.in' => 'Giới tính phải là Nam hoặc Nữ.',
            'faculty.required' => 'Khoa là bắt buộc.'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $id_front_path = $request->file('id_front')->store('students/id_cards/front', 'private');
            $id_back_path = $request->file('id_back')->store('students/id_cards/back', 'private');

            $full_address = $request->address_detail . ', ' . 
                           $request->ward . ', ' . 
                           $request->district . ', ' . 
                           $request->city;

            $registration = new DormitoryRegistration([
                'student_code' => $request->student_code,
                'fullname' => $request->fullname,
                'gender' => $request->gender,
                'birthdate' => $request->birthdate,
                'class_id' => $request->class_id,
                'faculty_id' => $request->faculty_id,
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

            Mail::to($request->email)->send(new DormitoryRegistrationNotification($registration));

            return redirect()->back()
                ->with('success', 'Đăng ký ký túc xá thành công! Chúng tôi đã gửi thông tin xác nhận đến email của bạn.');

        } catch (\Exception $e) {
            if (isset($id_front_path)) {
                Storage::delete($id_front_path);
            }
            if (isset($id_back_path)) {
                Storage::delete($id_back_path);
            }

            return redirect()->back()
                ->with('error', $e->getMessage());
        }
    }

    public function index()
    {
        $faculties = Faculty::with('classes')->get();
        return view('index', compact('faculties'));
    }

    public function getClassesByFaculty($facultyCode)
    {
        $faculty = Faculty::where('id', $facultyCode)->first();
        if (!$faculty) {
            return response()->json([], 404);
        }
        
        $classes = ClassModel::where('faculty_id', $faculty->id)->get();
        return response()->json($classes);
    }
}
