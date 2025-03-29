<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AssignRoomController extends Controller
{
    public function assignRoom(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'room_id' => 'required|exists:rooms,id',
        ]);

        DB::beginTransaction();
        try {
            // Get the room and student
            $room = Room::findOrFail($request->room_id);
            $student = Student::findOrFail($request->student_id);

            // Check if room is available
            if (!$room->isAvailable()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Phòng không còn chỗ trống'
                ], 422);
            }

            // Assign the room
            $student->room_id = $request->room_id;
            $student->save();

            // Update room occupancy
            $room->current_occupancy += 1;
            
            if ($room->current_occupancy >= $room->capacity) {
                $room->status = 'full';
            }
            
            $room->save();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Đã xếp phòng thành công',
                'student' => $student,
                'room' => $room
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi khi xếp phòng: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getAvailableRooms(Request $request)
    {
        $student = Student::findOrFail($request->student_id);
        
        return Room::where('status', 'available')
            ->where('current_occupancy', '<', 'capacity')
            ->get();
    }
}
