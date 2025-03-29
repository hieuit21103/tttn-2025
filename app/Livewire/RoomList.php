<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class RoomList extends Component
{
    public $rooms = [];
    public $search = '';
    public $roomType = '';
    public $status = '';
    public $currentPage = 1;
    public $totalRooms = 0;
    public $lastPage = 1;

    public $roomModal = false;
    public $assignModal = false;
    public $room = [
        'name' => '',
        'room_type_id' => '',
        'capacity' => '',
        'status' => 'available',
        'monthly_price' => ''
    ];
    public $selectedRoom = null;
    public $selectedStudentId = null;
    public $availableStudents = [];

    protected $listeners = [
        'roomTypeChanged' => 'updateRoomType'
    ];

    public function mount()
    {
        $this->loadRooms();
    }

    public function loadRooms($page = 1)
    {
        $query = Room::query()
            ->when($this->search, function($query) {
                return $query->where('name', 'like', "%{$this->search}%");
            })
            ->when($this->roomType, function($query) {
                return $query->where('room_type_id', $this->roomType);
            })
            ->when($this->status, function($query) {
                return $query->where('status', $this->status);
            })
            ->with(['roomType']);

        $paginated = $query->paginate(10, ['*'], 'page', $page);

        $this->rooms = $paginated->items();
        $this->totalRooms = $paginated->total();
        $this->lastPage = $paginated->lastPage();
        $this->currentPage = $page;
    }

    public function gotoPage($page)
    {
        $this->loadRooms($page);
    }

    public function showAssignModal($roomId)
    {
        $this->selectedRoom = Room::findOrFail($roomId);
        $this->availableStudents = Student::whereNull('room_id')
            ->where('activated_at', '!=', null)
            ->get();
        $this->assignModal = true;
    }

    public function assignStudent()
    {
        if (!$this->selectedRoom || !$this->selectedStudentId) {
            return;
        }

        try {
            DB::beginTransaction();

            // Update student's room
            $student = Student::findOrFail($this->selectedStudentId);
            $student->room_id = $this->selectedRoom->id;
            $student->save();

            // Update room occupancy
            $this->selectedRoom->current_occupancy += 1;
            if ($this->selectedRoom->current_occupancy >= $this->selectedRoom->capacity) {
                $this->selectedRoom->status = 'full';
            }
            $this->selectedRoom->save();

            DB::commit();

            $this->assignModal = false;
            $this->emit('alert', 'success', 'Đã gán sinh viên thành công!');
            $this->loadRooms($this->currentPage);

        } catch (\Exception $e) {
            DB::rollBack();
            $this->emit('alert', 'error', 'Có lỗi xảy ra khi gán sinh viên. Vui lòng thử lại.');
        }
    }

    public function showEditModal($roomId)
    {
        $this->selectedRoom = Room::findOrFail($roomId);
        $this->room = [
            'name' => $this->selectedRoom->name,
            'room_type_id' => $this->selectedRoom->room_type_id,
            'capacity' => $this->selectedRoom->capacity,
            'status' => $this->selectedRoom->status,
            'monthly_price' => $this->selectedRoom->monthly_price
        ];
        $this->roomModal = true;
    }

    public function updateRoom()
    {
        $this->validate([
            'room.name' => 'required|string|max:255',
            'room.room_type_id' => 'required|exists:room_types,id',
            'room.capacity' => 'required|integer|min:1',
            'room.status' => 'required|in:available,full,maintenance',
            'room.monthly_price' => 'required|numeric|min:0'
        ]);

        $this->selectedRoom->update($this->room);
        $this->roomModal = false;
        $this->emit('alert', 'success', 'Đã cập nhật phòng thành công!');
    }

    public function deleteRoom($id)
    {
        $room = Room::findOrFail($id);
        $room->delete();
        $this->emit('alert', 'success', 'Đã xóa phòng thành công!');
    }

    public function updateRoomType($typeId)
    {
        $this->roomType = $typeId;
        $this->loadRooms(1);
    }

    public function render()
    {
        return view('livewire.room.list', [
            'roomTypes' => RoomType::all()
        ]);
    }
}
