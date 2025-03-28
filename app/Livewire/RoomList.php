<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Room;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class RoomList extends Component
{
    public $rooms = [];
    public $search = '';
    public $roomType = '';
    public $status = '';
    public $selectedRoom = null;
    public $selectedStudentId = null;
    public $availableStudents = [];
    public $currentPage = 1;
    public $totalRooms = 0;
    public $lastPage = 1;

    public function mount()
    {
        $this->loadRooms();
    }

    public function loadRooms($page = 1)
    {
        $query = Room::query();

        if ($this->search) {
            $query->where('name', 'like', "%{$this->search}%");
        }

        if ($this->roomType) {
            $query->where('type', $this->roomType);
        }

        if ($this->status) {
            $query->where('status', $this->status);
        }

        $paginated = $query->paginate(10, ['*'], 'page', $page);
        
        $this->rooms = $paginated->items();
        $this->totalRooms = $paginated->total();
        $this->lastPage = $paginated->lastPage();
        $this->currentPage = $page;
    }

    public function showAssignModal($roomId)
    {
        $this->selectedRoom = Room::findOrFail($roomId);
        $this->availableStudents = Student::whereNull('room_id')
            ->where('activated_at', '!=', null)
            ->get();

        $this->dispatch('showAssignModal');
    }

    public function assignRoom()
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

            $this->dispatch('success', 'Đã xếp phòng thành công!');
            $this->dispatch('hideAssignModal');
            $this->loadRooms($this->currentPage);

        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('error', 'Có lỗi xảy ra khi xếp phòng. Vui lòng thử lại.');
        }
    }

    public function updatingSearch()
    {
        $this->loadRooms(1);
    }

    public function updatingRoomType()
    {
        $this->loadRooms(1);
    }

    public function updatingStatus()
    {
        $this->loadRooms(1);
    }

    public function render()
    {
        return view('livewire.room.list');
    }
}
