<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Faculty;

class FacultyList extends Component
{
    public $search = '';
    public $sortField = 'name';
    public $sortDirection = 'asc';

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
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

    public function render()
    {
        $faculties = Faculty::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('code', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.faculty.list', [
            'faculties' => $faculties
        ]);
    }
}
