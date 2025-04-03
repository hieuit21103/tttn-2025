<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\RoomType;
use App\Models\Room;
use App\Models\Student;
use Livewire\WithPagination;

class RoomList extends Component
{
    use WithPagination;
    public $search = '';
    public $perPage = 10;
    
    // Form fields
    public $name = '';
    public $monthly_price = null;
    public $capacity = null;
    public $room_type_id = null;
    
    // Modal control properties
    public $showAddModal = false;
    public $showEditModal = false;
    public $showDeleteModal = false;
    public $editingRoomId = null;
    public $deletingRoomId = null;


    public function render(){
        $roomTypes = RoomType::all();

        $query = Room::query()
            ->with('roomType')
            ->withCount('students')
            ->orderBy('id', 'asc');

        if ($this->search) {
            $query->where('name', 'like', "%{$this->search}%")
                ->orWhere('roomType.name', 'like', "%{$this->search}%");
        }

        $rooms = $query->paginate($this->perPage);

        return view('livewire.room.list', [
            'rooms' => $rooms,
            'roomTypes' => $roomTypes
        ]);
    }

    #[On('search')]
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCapacity()
    {
        $this->resetPage();
    }

    public function updatingMonthlyPrice()
    {
        $this->resetPage();
    }

    public function handleRoomTypeChange($value)
    {
        if ($value) {
            $roomType = RoomType::find($value);
            if ($roomType) {
                $this->monthly_price = $roomType->monthly_price;
                $this->capacity = $roomType->capacity;
            }
        }
    }

    public function openAddModal()
    {
        $this->resetRoomTypeForm();
        $this->showAddModal = true;
    }

    public function openEditModal($id)
    {
        $this->editingRoomId = $id;
        $room = Room::findOrFail($id);
        $this->name = $room->name;
        $this->room_type_id = $room->room_type_id;
        $this->monthly_price = $room->roomType->monthly_price;
        $this->capacity = $room->capacity;
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
    public function createRoom()
    {
        try {
            $this->validate([
                'name' => 'required|string|max:255|unique:rooms,name',
                'room_type_id' => 'required',
                'capacity' => 'required|integer|min:1',
                'monthly_price' => 'required|numeric|min:0',
            ], [
                'name.required' => 'Tên phòng là bắt buộc',
                'name.unique' => 'Tên phòng đã tồn tại',
                'room_type_id.required' => 'Loại phòng là bắt buộc',
                'monthly_price.required' => 'Giá thuê là bắt buộc',
                'monthly_price.numeric' => 'Giá thuê phải là số',
                'monthly_price.min' => 'Giá thuê không thể âm',
                'capacity.required' => 'Sức chứa là bắt buộc',
                'capacity.integer' => 'Sức chứa phải là số nguyên',
                'capacity.min' => 'Sức chứa phải lớn hơn 0'
            ]);

            Room::create([
                'name' => $this->name,
                'room_type_id' => $this->room_type_id,
                'monthly_price' => $this->monthly_price,
                'capacity' => $this->capacity,
                'current_occupancy' => 0,
                'status' => 'available'
            ]);

            session()->flash('success', 'Phòng đã được tạo thành công');
            $this->closeModal();
            $this->resetPage();
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function updateRoom()
    {
        try {
            $this->validate([
                'name' => 'required|string|max:255|unique:rooms,name,'.$this->editingRoomId,
                'room_type_id' => 'required',
                'monthly_price' => 'required|numeric|min:0',
                'capacity' => 'required|integer|min:1'
            ], [
                'name.required' => 'Tên phòng là bắt buộc',
                'name.unique' => 'Tên phòng đã tồn tại',
                'monthly_price.required' => 'Giá thuê là bắt buộc',
                'monthly_price.numeric' => 'Giá thuê phải là số',
                'monthly_price.min' => 'Giá thuê không thể âm',
                'capacity.required' => 'Sức chứa là bắt buộc',
                'capacity.integer' => 'Sức chứa phải là số nguyên',
                'capacity.min' => 'Sức chứa phải lớn hơn 0'
            ]);

            $room = Room::findOrFail($this->editingRoomId);
            $room->update([
                'name' => $this->name,
                'room_type_id' => $this->room_type_id,
                'monthly_price' => $this->monthly_price,
                'capacity' => $this->capacity
            ]);

            session()->flash('success', 'Phòng đã được cập nhật thành công');
            $this->closeModal();
            $this->loadRooms($this->currentPage);
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function deleteRoomType()
    {
        try {
            $roomType = RoomType::findOrFail($this->deletingRoomTypeId);
            $roomType->delete();
            session()->flash('success', 'Phòng đã được xóa thành công');
            $this->closeModal();
            $this->loadRoomTypes($this->currentPage);
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }
}