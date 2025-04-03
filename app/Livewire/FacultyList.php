<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Faculty;
use Livewire\WithPagination;

class FacultyList extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;

    public $name = '';

    public $showAddModal = false;
    public $showEditModal = false;
    public $showDeleteModal = false;

    public $editingFacultyId;
    public $deletingFacultyId;

    public function render()
    {
        $query = Faculty::query()
            ->orderBy('id', 'asc')
            ->where('name', 'like', "%{$this->search}%");
        
        $faculties = $query->paginate($this->perPage);

        return view('livewire.faculty.list', [
            'faculties' => $faculties
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
        $this->editingFacultyId = $id;
        $faculty = Faculty::findOrFail($id);
        $this->name = $faculty->name;
        $this->showEditModal = true;
    }

    public function openDeleteModal($id)
    {
        $this->editingFacultyId = $id;
        $this->showDeleteModal = true;
    }

    public function closeModal()
    {
        $this->showAddModal = false;
        $this->showEditModal = false;
        $this->showDeleteModal = false;
        $this->resetFacultyForm();
    }

    public function resetFacultyForm()
    {
        $this->name = '';
    }

    public function createFaculty()
    {
        try{
            $this->validate([
                'name' => 'required|string|max:255|unique:faculties,name',
            ]);

            Faculty::create([
                'name' => $this->name
            ]);

            session()->flash('success', 'Khoa đã được tạo thành công!');
            $this->closeModal();
            $this->resetFacultyForm();
        }catch(\Exception $e){
            session()->flash('error', $e->getMessage());
        }     
    }

    public function updateFaculty()
    {
        try{
            $this->validate([
                'name' => 'required|string|max:255|unique:faculties,name,',
            ]);

            Faculty::where('id',$this->editingFacultyId)
                    ->update([
                        'name' => $this->name
                    ]);
            session()->flash('success', 'Khoa đã được cập nhật thành công!');
            $this->closeModal();
            $this->resetFacultyForm();
        }catch(\Exception $e){
            session()->flash('error', $e->getMessage());
        }     
    }       

    public function deleteFaculty()
    {
        try{
            Faculty::findOrFail($this->deletingFacultyId)->delete();
            session()->flash('success', 'Khoa đã được xoá thành công!');
            $this->closeModal();
            $this->resetPage();
        }catch(\Exception $e){
            session()->flash('error', $e->getMessage());
        }
    }

    
}
