<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Student;
use App\Models\Room;
use Illuminate\Support\Facades\Log;
use Livewire\WithFileUploads;

class StudentList extends Component
{
    public $students = [];
    public $search = '';
    public $class = '';
    public $gender = '';
    public $hasRoom = '';
    public $totalStudents = 0;
    public $lastPage = 1;
    public $currentPage = 1;
    public $perPage = 10;

    public function mount()
    {
        $this->loadStudents();
    }

    public function loadStudents($page = null)
    {
        if ($page) {
            $this->currentPage = $page;
        }

        $query = Student::query()
            ->with('room')
            ->withCount('room')
            ->orderBy('fullname');

        if ($this->search) {
            $query->where(function($q) {
                $q->where('name', 'like', "%{$this->search}%")
                    ->orWhere('class', 'like', "%{$this->search}%")
                    ->orWhere('phone', 'like', "%{$this->search}%");
            });
        }

        if ($this->class) {
            $query->where('class', $this->class);
        }

        if ($this->gender) {
            $query->where('gender', $this->gender);
        }

        if ($this->hasRoom === '1') {
            $query->whereNotNull('room_id');
        } elseif ($this->hasRoom === '0') {
            $query->whereNull('room_id');
        }

        // Calculate total students and pages
        $this->totalStudents = $query->count();
        $this->lastPage = ceil($this->totalStudents / $this->perPage);
        
        // Ensure current page is valid
        if ($this->currentPage < 1) {
            $this->currentPage = 1;
        } else if ($this->currentPage > $this->lastPage) {
            $this->currentPage = $this->lastPage ?: 1;
        }

        // Manual pagination
        $this->students = $query->skip(($this->currentPage - 1) * $this->perPage)
                               ->take($this->perPage)
                               ->get();
    }

    public function nextPage()
    {
        if ($this->currentPage < $this->lastPage) {
            $this->currentPage++;
            $this->loadStudents();
        }
    }

    public function previousPage()
    {
        if ($this->currentPage > 1) {
            $this->currentPage--;
            $this->loadStudents();
        }
    }

    public function goToPage($page)
    {
        $this->loadStudents($page);
    }

    public function updatingSearch()
    {
        $this->loadStudents(1);
    }

    public function updatingClass()
    {
        $this->loadStudents(1);
    }

    public function updatingGender()
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