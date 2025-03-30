<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\RoomType;

class RoomTypeComponent extends Component
{
    public $roomTypes = [];
    public $search = '';
    public $totalRoomTypes = 0;
    public $lastPage = 1;
    public $currentPage = 1;
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
    public $deletingRoomTypeId = null;

    public function mount()
    {
        $this->loadRoomTypes();
    }

    public function loadRoomTypes($page = null)
    {
        if ($page) {
            $this->currentPage = $page;
        }

        $query = RoomType::query()
            ->orderBy('name');

        if ($this->search) {
            $query->where(function($q) {
                $q->where('name', 'like', "%{$this->search}%");
            });
        }

        // Calculate total rooms and pages
        $this->totalRoomTypes = $query->count();
        $this->lastPage = ceil($this->totalRoomTypes / $this->perPage);
        
        // Ensure current page is valid
        if ($this->currentPage < 1) {
            $this->currentPage = 1;
        } else if ($this->currentPage > $this->lastPage) {
            $this->currentPage = $this->lastPage ?: 1;
        }

        // Manual pagination
        $this->roomTypes = $query->skip(($this->currentPage - 1) * $this->perPage)
                               ->take($this->perPage)
                               ->get();
    }

    public function nextPage()
    {
        if ($this->currentPage < $this->lastPage) {
            $this->currentPage++;
            $this->loadRoomTypes();
        }
    }

    public function previousPage()
    {
        if ($this->currentPage > 1) {
            $this->currentPage--;
            $this->loadRoomTypes();
        }
    }

    public function goToPage($page)
    {
        $this->loadRoomTypes($page);
    }

    public function updatingSearch()
    {
        $this->loadRoomTypes(1);
    }

    public function updatingCapacity()
    {
        $this->loadRoomTypes(1);
    }

    public function updatingMonthlyPrice()
    {
        $this->loadRoomTypes(1);
    }

    // Modal handling methods
    public function openAddModal()
    {
        $this->resetRoomTypeForm();
        $this->showAddModal = true;
    }

    public function openEditModal($id)
    {
        $this->editingRoomTypeId = $id;
        $roomType = RoomType::findOrFail($id);
        $this->name = $roomType->name;
        $this->monthly_price = $roomType->monthly_price;
        $this->capacity = $roomType->capacity;
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
        $this->deletingRoomTypeId = null;
        $this->resetValidation();
    }

    // CRUD operations
    public function createRoomType()
    {
        try {
            $this->validate([
                'name' => 'required|string|max:255|unique:room_types,name',
                'monthly_price' => 'required|numeric|min:0',
                'capacity' => 'required|integer|min:1'
            ], [
                'name.required' => 'Tên loại phòng là bắt buộc',
                'name.unique' => 'Tên loại phòng đã tồn tại',
                'monthly_price.required' => 'Giá thuê là bắt buộc',
                'monthly_price.numeric' => 'Giá thuê phải là số',
                'monthly_price.min' => 'Giá thuê không thể âm',
                'capacity.required' => 'Sức chứa là bắt buộc',
                'capacity.integer' => 'Sức chứa phải là số nguyên',
                'capacity.min' => 'Sức chứa phải lớn hơn 0'
            ]);

            RoomType::create([
                'name' => $this->name,
                'monthly_price' => $this->monthly_price,
                'capacity' => $this->capacity
            ]);

            session()->flash('success', 'Loại phòng đã được tạo thành công');
            $this->closeModal();
            $this->loadRoomTypes(1);
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function updateRoomType()
    {
        try {
            $this->validate([
                'name' => 'required|string|max:255|unique:room_types,name,'.$this->editingRoomTypeId,
                'monthly_price' => 'required|numeric|min:0',
                'capacity' => 'required|integer|min:1'
            ], [
                'name.required' => 'Tên loại phòng là bắt buộc',
                'name.unique' => 'Tên loại phòng đã tồn tại',
                'monthly_price.required' => 'Giá thuê là bắt buộc',
                'monthly_price.numeric' => 'Giá thuê phải là số',
                'monthly_price.min' => 'Giá thuê không thể âm',
                'capacity.required' => 'Sức chứa là bắt buộc',
                'capacity.integer' => 'Sức chứa phải là số nguyên',
                'capacity.min' => 'Sức chứa phải lớn hơn 0'
            ]);

            $roomType = RoomType::findOrFail($this->editingRoomTypeId);
            $roomType->update([
                'name' => $this->name,
                'monthly_price' => $this->monthly_price,
                'capacity' => $this->capacity
            ]);

            session()->flash('success', 'Loại phòng đã được cập nhật thành công');
            $this->closeModal();
            $this->loadRoomTypes($this->currentPage);
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function deleteRoomType()
    {
        try {
            $roomType = RoomType::findOrFail($this->deletingRoomTypeId);
            $roomType->delete();

            session()->flash('success', 'Loại phòng đã được xóa thành công');
            $this->closeModal();
            $this->loadRoomTypes($this->currentPage);
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.room.types');
    }
}