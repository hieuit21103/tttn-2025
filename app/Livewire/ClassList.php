<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ClassModel;

class ClassList extends Component
{
    public $search = '';
    public $faculty_id = '';
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
            'message' => 'Bạn có chắc chắn muốn xóa lớp này không?',
            'callback' => 'deleteClass',
            'data' => ['id' => $id]
        ]);
    }

    public function deleteClass($id)
    {
        ClassModel::findOrFail($id)->delete();
        $this->dispatch('success', 'Lớp đã được xóa thành công!');
    }

    public function render()
    {
        $classes = ClassModel::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('code', 'like', '%' . $this->search . '%');
            })
            ->when($this->faculty_id, function ($query) {
                $query->where('faculty_id', $this->faculty_id);
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        $faculties = \App\Models\Faculty::where('is_active', true)->get();

        return view('livewire.class.list', [
            'classes' => $classes,
            'faculties' => $faculties
        ]);
    }
}
