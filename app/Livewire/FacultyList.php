<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Faculty;

class FacultyList extends Component
{
    public $search = '';
    public $perPage = 10;

    public function render()
    {
        $query = Faculty::query()
            ->orderBy('id', 'asc');
        
        if($this->search) {
            $query->where('name', 'like', "%{$this->search}%")
                ->orWhere('code', 'like', "%{$this->search}%");
        }

        $faculties = $query->paginate($this->perPage);

        return view('livewire.faculty.list', [
            'faculties' => $faculties
        ]);
    }

    public function confirmDelete($id)
    {
        $this->dispatch('confirm', [
            'title' => 'Xác nhận xóa',
            'message' => 'Bạn có chắc chắn muốn xóa khoa này không?',
            'callback' => 'deleteFaculty',
            'data' => ['id' => $id]
        ]);
    }

    public function deleteFaculty($id)
    {
        Faculty::findOrFail($id)->delete();
        $this->dispatch('success', 'Khoa đã được xóa thành công!');
    }

    
}
