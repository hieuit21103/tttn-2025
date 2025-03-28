<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Student;
use App\Models\Room;

class StudentList extends Component
{
    public $students = [];
    public $search = '';
    public $class = '';
    public $hasRoom = '';
    public $currentPage = 1;
    public $totalStudents = 0;
    public $lastPage = 1;

    public $studentModal = false;
    public $student = [
        'student_code' => '',
        'fullname' => '',
        'class' => '',
        'birthdate' => '',
        'address' => '',
        'phone' => '',
        'email' => '',
        'activated_at' => null
    ];

    public function mount()
    {
        $this->loadStudents();
    }

    public function loadStudents($page = 1)
    {
        $query = Student::query()
            ->with('room')
            ->where('activated_at', '!=', null);

        if ($this->search) {
            $query->where(function($q) {
                $q->where('student_code', 'like', "%{$this->search}%")
                  ->orWhere('fullname', 'like', "%{$this->search}%")
                  ->orWhere('class', 'like', "%{$this->search}%");
            });
        }

        if ($this->class) {
            $query->where('class', $this->class);
        }

        if ($this->hasRoom === 'yes') {
            $query->whereNotNull('room_id');
        } elseif ($this->hasRoom === 'no') {
            $query->whereNull('room_id');
        }

        $paginated = $query->paginate(10, ['*'], 'page', $page);
        
        $this->students = $paginated->items();
        $this->totalStudents = $paginated->total();
        $this->lastPage = $paginated->lastPage();
        $this->currentPage = $page;
    }

    public function showStudentModal()
    {
        $this->studentModal = true;
        $this->resetStudentForm();
    }

    public function resetStudentForm()
    {
        $this->student = [
            'student_code' => '',
            'fullname' => '',
            'class' => '',
            'birthdate' => '',
            'address' => '',
            'phone' => '',
            'email' => '',
            'activated_at' => null
        ];
    }

    public function createStudent()
    {
        $validated = $this->validate([
            'student.student_code' => 'required|unique:students,student_code',
            'student.fullname' => 'required',
            'student.class' => 'required',
            'student.birthdate' => 'required|date',
            'student.address' => 'required',
            'student.phone' => 'required|numeric',
            'student.email' => 'required|email|unique:students,email',
        ]);

        $validated['student']['activated_at'] = now();
        Student::create($validated['student']);

        $this->studentModal = false;
        $this->resetStudentForm();
        $this->loadStudents($this->currentPage);
        $this->dispatch('success', 'Đã thêm học sinh thành công!');
    }

    public function updatingSearch()
    {
        $this->loadStudents(1);
    }

    public function updatingClass()
    {
        $this->loadStudents(1);
    }

    public function updatingHasRoom()
    {
        $this->loadStudents(1);
    }

    public function render()
    {
        return view('livewire.student.list');
    }
}
