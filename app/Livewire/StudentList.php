<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\Room;
use App\Models\Student;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class StudentList extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $availableRooms = [];
    
    // Form fields
    public $student_code = '';
    public $fullname = '';
    public $gender = '';
    public $class = '';
    public $birthdate = '';
    public $id_number = '';
    public $personal_phone = '';
    public $family_phone = '';
    public $address = '';
    public $email = '';
    public $id_front_image = '';
    public $id_back_image = '';
    public $room_id = '';
    
    // Modal control properties
    public $showAddModal = false;
    public $showEditModal = false;
    public $showAssignRoomModal = false;
    public $showDeleteModal = false;
    public $showDetailsModal = false;
    public $editingStudentId = null;
    public $deletingStudentId = null;
    public $selectedStudent = null;
    public $assigningStudentId = null;

    public function render()
    {
        $rooms = Room::all();
        $availableRooms = Room::where('status', 'available')
            ->with('roomType')
            ->get();

        $query = Student::query()
            ->with('room')
            ->orderBy('fullname');

        if ($this->search) {
            $query->where('name', 'like', "%{$this->search}%");
        }

        $students = $query->paginate($this->perPage);

        return view('livewire.student.list', [
            'rooms' => $rooms,
            'availableRooms' => $availableRooms,
            'students' => $students
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCapacity()
    {
        $this->resetPage();
    }

    public function updatingMonthlyPrice()
    {
        $this->resetPage();
    }

    public function handleRoomChange($value)
    {
        if ($value) {
            $room = Room::find($value);
            if ($room) {
                $this->monthly_price = $room->monthly_price;
                $this->capacity = $room->capacity;
            }
        }
    }

    // Modal handling methods
    public function openAddModal()
    {
        $this->resetStudentForm();
        $this->showAddModal = true;
    }

    public function openEditModal($id)
    {
        $this->editingStudentId = $id;
        $student = Student::findOrFail($id);
        $this->student_code = $student->student_code;
        $this->fullname = $student->fullname;
        $this->gender = $student->gender;
        $this->class = $student->class;
        $this->birthdate = $student->birthdate;
        $this->id_number = $student->id_number;
        $this->personal_phone = $student->personal_phone;
        $this->family_phone = $student->family_phone;
        $this->address = $student->address;
        $this->email = $student->email;
        $this->id_front_image = '';
        $this->id_back_image = '';
        $this->room_id = $student->room_id;
        $this->showEditModal = true;
    }

    public function openDeleteModal($id)
    {
        $this->deletingStudentId = $id;
        $this->showDeleteModal = true;
    }

    public function openAssignRoomModal($id)
    {
        $this->assigningStudentId = $id;
        $this->availableRooms = Room::where('status', 'available')
            ->with('roomType')
            ->get();
        $this->showAssignRoomModal = true;
    }

    public function showDetails($id)
    {
        $this->selectedStudent = Student::findOrFail($id);
        $this->showDetailsModal = true;
    }

    public function closeDetailsModal()
    {
        $this->showDetailsModal = false;
        $this->selectedStudent = null;
    }

    public function closeModal()
    {
        $this->showAddModal = false;
        $this->showEditModal = false;
        $this->showDeleteModal = false;
        $this->resetStudentForm();
    }

    public function resetStudentForm()
    {
        $this->student_code = '';
        $this->fullname = '';
        $this->gender = '';
        $this->class = '';
        $this->id_number = '';
        $this->personal_phone = '';
        $this->family_phone = '';
        $this->address = '';
        $this->email = '';
        $this->id_front_image = '';
        $this->id_back_image = '';
        $this->room_id = '';
        $this->editingStudentId = null;
        $this->deletingStudentId = null;
        $this->resetValidation();
    }

    // CRUD operations
    public function createStudent()
    {
        try {
            $this->validate([
                'student_code' => 'required|string|max:255|unique:students,student_code',
                'fullname' => 'required|string|max:255',
                'gender' => 'required|string|in:Nam,Nữ',
                'class' => 'required|string|max:255',
                'birthdate' => 'required|date',
                'id_number' => 'required|string|max:255|unique:students,id_number',
                'personal_phone' => 'required|string|max:10',
                'family_phone' => 'required|string|max:10',
                'address' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:students,email',
                'id_front_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'id_back_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'room_id' => 'required|exists:rooms,id'
            ], [
                'student_code.required' => 'Mã học sinh là bắt buộc',
                'student_code.unique' => 'Mã học sinh đã tồn tại',
                'fullname.required' => 'Họ và tên là bắt buộc',
                'gender.required' => 'Giới tính là bắt buộc',
                'gender.in' => 'Giới tính phải là Nam hoặc Nữ',
                'class.required' => 'Lớp là bắt buộc',
                'birthdate.required' => 'Ngày sinh là bắt buộc',
                'id_number.required' => 'Số CMND/CCCD là bắt buộc',
                'id_number.unique' => 'Số CMND/CCCD đã tồn tại',
                'personal_phone.required' => 'Số điện thoại cá nhân là bắt buộc',
                'personal_phone.max' => 'Số điện thoại không được vượt quá 10 ký tự',
                'family_phone.required' => 'Số điện thoại gia đình là bắt buộc',
                'family_phone.max' => 'Số điện thoại không được vượt quá 10 ký tự',
                'address.required' => 'Địa chỉ là bắt buộc',
                'email.required' => 'Email là bắt buộc',
                'email.email' => 'Email không hợp lệ',
                'email.unique' => 'Email đã tồn tại',
                'id_front_image.required' => 'Hình ảnh mặt trước CMND/CCCD là bắt buộc',
                'id_front_image.image' => 'File phải là hình ảnh',
                'id_front_image.mimes' => 'Chỉ chấp nhận file JPEG, PNG, JPG',
                'id_front_image.max' => 'Kích thước file không được vượt quá 2MB',
                'id_back_image.required' => 'Hình ảnh mặt sau CMND/CCCD là bắt buộc',
                'id_back_image.image' => 'File phải là hình ảnh',
                'id_back_image.mimes' => 'Chỉ chấp nhận file JPEG, PNG, JPG',
                'id_back_image.max' => 'Kích thước file không được vượt quá 2MB',
                'room_id.required' => 'Phòng là bắt buộc',
                'room_id.exists' => 'Phòng không tồn tại'
            ]);

            // Upload hình ảnh CMND
            $idFrontPath = $this->id_front_image->store('students/id_cards/front', 'private');
            $idBackPath = $this->id_back_image->store('students/id_cards/back', 'private');

            Student::create([
                'student_code' => $this->student_code,
                'fullname' => $this->fullname,
                'gender' => $this->gender,
                'class' => $this->class,
                'birthdate' => $this->birthdate,
                'id_number' => $this->id_number,
                'personal_phone' => $this->personal_phone,
                'family_phone' => $this->family_phone,
                'address' => $this->address,
                'email' => $this->email,
                'id_front_path' => $idFrontPath,
                'id_back_path' => $idBackPath,
                'room_id' => $this->room_id
            ]);

            session()->flash('success', 'Học sinh đã được tạo thành công');
            $this->closeModal();
            $this->loadStudents(1);
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function updateStudent()
    {
        try {
            $this->validate([
                'student_code' => 'required|string|max:255|unique:students,student_code,'.$this->editingStudentId,
                'fullname' => 'required|string|max:255',
                'gender' => 'required|string|in:Nam,Nữ',
                'class' => 'required|string|max:255',
                'birthdate' => 'required|date',
                'id_number' => 'required|string|max:255|unique:students,id_number,'.$this->editingStudentId,
                'personal_phone' => 'required|string|max:10',
                'family_phone' => 'required|string|max:10',
                'address' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:students,email,'.$this->editingStudentId,
                'id_front_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'id_back_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'room_id' => 'required|exists:rooms,id'
            ], [
                'student_code.required' => 'Mã học sinh là bắt buộc',
                'student_code.unique' => 'Mã học sinh đã tồn tại',
                'fullname.required' => 'Họ và tên là bắt buộc',
                'gender.required' => 'Giới tính là bắt buộc',
                'gender.in' => 'Giới tính phải là Nam hoặc Nữ',
                'class.required' => 'Lớp là bắt buộc',
                'birthdate.required' => 'Ngày sinh là bắt buộc',
                'id_number.required' => 'Số CMND/CCCD là bắt buộc',
                'id_number.unique' => 'Số CMND/CCCD đã tồn tại',
                'personal_phone.required' => 'Số điện thoại cá nhân là bắt buộc',
                'personal_phone.max' => 'Số điện thoại không được vượt quá 10 ký tự',
                'family_phone.required' => 'Số điện thoại gia đình là bắt buộc',
                'family_phone.max' => 'Số điện thoại không được vượt quá 10 ký tự',
                'address.required' => 'Địa chỉ là bắt buộc',
                'email.required' => 'Email là bắt buộc',
                'email.email' => 'Email không hợp lệ',
                'email.unique' => 'Email đã tồn tại',
                'id_front_image.image' => 'File phải là hình ảnh',
                'id_front_image.mimes' => 'Chỉ chấp nhận file JPEG, PNG, JPG',
                'id_front_image.max' => 'Kích thước file không được vượt quá 2MB',
                'id_back_image.image' => 'File phải là hình ảnh',
                'id_back_image.mimes' => 'Chỉ chấp nhận file JPEG, PNG, JPG',
                'id_back_image.max' => 'Kích thước file không được vượt quá 2MB',
                'room_id.required' => 'Phòng là bắt buộc',
                'room_id.exists' => 'Phòng không tồn tại'
            ]);

            $student = Student::findOrFail($this->editingStudentId);

            // Xóa hình ảnh cũ nếu có upload mới
            if ($this->id_front_image) {
                Storage::disk('private')->delete($student->id_front_path);
                $student->id_front_path = $this->id_front_image->store('students/id_cards/front', 'private');
            }

            if ($this->id_back_image) {
                Storage::disk('private')->delete($student->id_back_path);
                $student->id_back_path = $this->id_back_image->store('students/id_cards/back', 'private');
            }

            $student->update([
                'student_code' => $this->student_code,
                'fullname' => $this->fullname,
                'gender' => $this->gender,
                'class' => $this->class,
                'birthdate' => $this->birthdate,
                'id_number' => $this->id_number,
                'personal_phone' => $this->personal_phone,
                'family_phone' => $this->family_phone,
                'address' => $this->address,
                'email' => $this->email,
                'room_id' => $this->room_id
            ]);

            session()->flash('success', 'Học sinh đã được cập nhật thành công');
            $this->closeModal();
            $this->loadStudents($this->currentPage);
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function deleteStudent()
    {
        try {
            $student = Student::findOrFail($this->deletingStudentId);
            $student->delete();

            session()->flash('success', 'Học sinh đã được xóa thành công');
            $this->closeModal();
            $this->loadStudents($this->currentPage);
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function assignRoom($roomId)
    {
        try {
            $room = Room::findOrFail($roomId);
            $student = Student::findOrFail($this->assigningStudentId);

            if (!$room->isAvailable()) {
                $this->dispatch('error', 'Phòng đã đầy hoặc không còn trống!');
                return;
            }

            DB::beginTransaction();
            
            $student->room_id = $roomId;
            $student->save();

            $room->current_occupancy += 1;
            if ($room->current_occupancy >= $room->capacity) {
                $room->status = 'pending';
            }
            $room->save();

            DB::commit();

            $this->dispatch('success', 'Đã xếp phòng thành công!');
            $this->closeAssignRoomModal();
            $this->loadStudents();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function closeAssignRoomModal()
    {
        $this->assigningStudentId = null;
        $this->showAssignRoomModal = false;
    }
}