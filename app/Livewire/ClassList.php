<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ClassModel;
use App\Models\Faculty;
use Livewire\WithPagination;

class ClassList extends Component
{
    use WithPagination;
    public $search = '';
    public $perPage = 10;

    public function render()
    {
        $query = ClassModel::query()
            ->with('faculty')
            ->orderBy('id', 'asc');
        
        if($this->search) {
            $query->where('name', 'like', "%{$this->search}%")
                ->orWhere('code', 'like', "%{$this->search}%");
        }

        $classes = $query->paginate($this->perPage);

        $faculties = Faculty::where('is_active', true)->get();

        return view('livewire.class.list', [
            'classes' => $classes,
            'faculties' => $faculties
        ]);
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
}
