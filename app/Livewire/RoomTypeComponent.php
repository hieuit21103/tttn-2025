<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\RoomType;

class RoomTypeComponent extends Component
{
    public $search = '';
    public $monthly_price = '';
    public $currentPage = 1;
    public $totalRoomTypes = 0;
    public $lastPage = 1;
    public $roomTypes = [];
    
    public $roomType = [
        'name' => '',
        'monthly_price' => ''
    ];
    public $isEditing = false;
    public $editingId = null;

    protected $listeners = ['refreshRoomTypes' => '$refresh'];

    protected function rules()
    {
        return [
            'roomType.name' => 'required|string|max:255|unique:room_types,name' . ($this->editingId ? ',' . $this->editingId : ''),
            'roomType.monthly_price' => 'required|numeric|min:0'
        ];
    }

    protected $messages = [
        'roomType.name.required' => 'Tên loại phòng không được để trống',
        'roomType.name.unique' => 'Tên loại phòng đã tồn tại',
        'roomType.monthly_price.required' => 'Giá thuê không được để trống',
        'roomType.monthly_price.numeric' => 'Giá thuê phải là số',
        'roomType.monthly_price.min' => 'Giá thuê phải lớn hơn 0'
    ];
    
    public function mount()
    {
        $this->loadRoomTypes();
    }

    public function loadRoomTypes($page = 1)
    {
        $query = RoomType::query()
            ->withCount('rooms');

        if ($this->search) {
            $query->where(function($q) {
                $q->where('name', 'like', "%{$this->search}%");
            });
        }

        if ($this->monthly_price) {
            $query->where('monthly_price', $this->monthly_price);
        }

        $paginated = $query->paginate(10, ['*'], 'page', $page);
        
        $this->roomTypes = $paginated->items();
        $this->totalRoomTypes = $paginated->total();
        $this->lastPage = $paginated->lastPage();
        $this->currentPage = $page;
    }

    public function createRoomType()
    {
        $this->validate();

        RoomType::create($this->roomType);

        $this->resetForm();
        $this->loadRoomTypes($this->currentPage);
        $this->dispatch('hideModal', modalId: 'addRoomTypeModal');
        $this->dispatch('success', 'Đã thêm loại phòng thành công!');
    }

    public function editRoomType($id)
    {
        $type = RoomType::findOrFail($id);
        $this->editingId = $id;
        $this->isEditing = true;
        $this->roomType = [
            'name' => $type->name,
            'monthly_price' => $type->monthly_price
        ];
        $this->dispatch('showModal', modalId: 'addRoomTypeModal');
    }

    public function deleteRoomType($id)
    {
        $type = RoomType::findOrFail($id);
        
        if ($type->rooms()->count() > 0) {
            $this->dispatch('error', 'Không thể xóa loại phòng đang có phòng sử dụng!');
            return;
        }

        $type->delete();
        $this->dispatch('success', 'Đã xóa loại phòng thành công!');
        $this->loadRoomTypes($this->currentPage);
    }

    public function resetForm()
    {
        $this->roomType = [
            'name' => '',
            'monthly_price' => ''
        ];
        $this->isEditing = false;
        $this->editingId = null;
        $this->resetErrorBag();
    }

    public function updatingSearch()
    {
        $this->loadRoomTypes(1);
    }

    public function render()
    {
        return view('livewire.room.types');
    }
}