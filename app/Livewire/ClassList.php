<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ClassModel;
use Livewire\WithPagination;

class ClassList extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;

    public $name = '';

    public $showAddModal = false;
    public $showEditModal = false;
    public $showDeleteModal = false;

    public $editingClassId;
    public $deletingClassId;

    public function render()
    {
        $query = ClassModel::query()
            ->orderBy('id', 'asc')
            ->where('name', 'like', "%{$this->search}%");
        
        $classes = $query->paginate($this->perPage);

        return view('livewire.class.list', [
            'classes' => $classes   
        ]);
    }

    #[On('search')]
    public function search()
    {
        $this->resetPage();
    }

    public function openAddModal()
    {
        $this->showAddModal = true;
    }

    public function openEditModal($id)
    {
        $this->editingClassId = $id;
        $class = ClassModel::findOrFail($id);
        $this->name = $class->name;
        $this->showEditModal = true;
    }

    public function openDeleteModal($id)
    {
        $this->editingClassId = $id;
        $this->showDeleteModal = true;
    }

    public function closeModal()
    {
        $this->showAddModal = false;
        $this->showEditModal = false;
        $this->showDeleteModal = false;
        $this->resetClassForm();
    }

    public function resetClassForm()
    {
        $this->name = '';
        $this->editingClassId = null;
    }

    public function createClass()
    {
        try{
            $this->validate([
                'name' => 'required|string|max:255|unique:classes,name',
            ]);

            ClassModel::create([
                'name' => $this->name
            ]);

            session()->flash('success', 'Lớp đã được tạo thành công!');
            $this->closeModal();
            $this->resetClassForm();
        }catch(\Exception $e){
            session()->flash('error', $e->getMessage());
        }     
    }

    public function updateClass()
    {
        try{
            $this->validate([
                'name' => 'required|string|max:255|unique:classes,name,',
            ]);

            ClassModel::where('id',$this->editingClassId)
                    ->update([
                        'name' => $this->name
                    ]);
            session()->flash('success', 'Lớp đã được cập nhật thành công!');
            $this->closeModal();
            $this->resetClassForm();
        }catch(\Exception $e){
            session()->flash('error', $e->getMessage());
        }     
    }       

    public function deleteClass()
    {
        try{
            ClassModel::findOrFail($this->deletingClassId)->delete();
            session()->flash('success', 'Lớp đã được xoá thành công!');
            $this->closeModal();
            $this->resetPage();
        }catch(\Exception $e){
            session()->flash('error', $e->getMessage());
        }
    }

    
}
