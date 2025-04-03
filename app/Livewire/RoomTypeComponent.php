<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\RoomType;

class RoomTypeComponent extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    
    // Form fields
    public $name = '';
    public $monthly_price = null;
    public $capacity = null;
    
    // Modal control properties
    public $showAddModal = false;
    public $showEditModal = false;
    public $showDeleteModal = false;
    public $editingRoomTypeId = null;
    public $editingRoomType = null;
    public $deletingRoomTypeId = null;

    public function render()
    {
        $query = RoomType::query()
            ->orderBy('id', 'asc');

        if ($this->search) {
            $query->where(function($q) {
                $q->where('name', 'like', "%{$this->search}%");
            });
        }

        $roomTypes = $query->paginate($this->perPage);

        return view('livewire.room.types', [
            'roomTypes' => $roomTypes
        ]);
    }

    #[On('search')]
    public function updatingSearch()
    {
        $this->resetPage();
    }

    // Modal handling methods
    public function openAddModal()
    {
        $this->resetRoomTypeForm();
        $this->showAddModal = true;
    }

    public function editRoomType($id)
    {
        $this->editingRoomTypeId = $id;
        $this->editingRoomType = RoomType::findOrFail($id);
        $this->name = $this->editingRoomType->name;
        $this->monthly_price = $this->editingRoomType->monthly_price;
        $this->capacity = $this->editingRoomType->capacity;
        $this->showEditModal = true;
    }

    public function openDeleteModal($id)
    {
        $this->deletingRoomTypeId = $id;
        $this->showDeleteModal = true;
    }

    public function closeModal()
    {
        $this->showAddModal = false;
        $this->showEditModal = false;
        $this->showDeleteModal = false;
        $this->resetRoomTypeForm();
    }

    public function resetRoomTypeForm()
    {
        $this->name = '';
        $this->monthly_price = null;
        $this->capacity = null;
        $this->editingRoomTypeId = null;
        $this->editingRoomType = null;
        $this->deletingRoomTypeId = null;
        $this->resetValidation();
    }

    // CRUD operations
    public function createRoomType()
    {
        try{
            $validated = $this->validate([
                'name' => 'required|string|max:255|unique:room_types,name',
                'monthly_price' => 'required|numeric|min:0',
                'capacity' => 'required|integer|min:1'
            ]);

            RoomType::create($validated);

            session()->flash('success', 'Loại phòng đã được tạo thành công');
            $this->closeModal();
            $this->reset(['name', 'monthly_price', 'capacity']);
        }catch(\Exception $e){
            session()->flash('error', $e->getMessage());
            $this->closeModal();
        }
    }

    public function updateRoomType()
    {
        $validated = $this->validate([
            'name' => 'required|string|max:255|unique:room_types,name,' . $this->editingRoomTypeId,
            'monthly_price' => 'required|numeric|min:0',
            'capacity' => 'required|integer|min:1'
        ]);

        $roomType = RoomType::findOrFail($this->editingRoomTypeId);
        $roomType->update($validated);

        session()->flash('success', 'Loại phòng đã được cập nhật thành công');
        $this->closeModal();
        $this->reset(['editingRoomTypeId', 'name', 'monthly_price', 'capacity']);
    }

    public function deleteRoomType()
    {
        $roomType = RoomType::findOrFail($this->deletingRoomTypeId);

        if ($roomType->rooms()->exists()) {
            session()->flash('error', 'Không thể xóa loại phòng đang được sử dụng');
            return;
        }

        $roomType->delete();
        session()->flash('success', 'Loại phòng đã được xoá thành công');
        $this->closeModal();
        $this->resetPage();
    }
}