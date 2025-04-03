<?php

namespace App\Services;

use App\Models\Student;
use Carbon\Carbon;

class RoomFeeCalculator
{
    public function calculateMonthlyFee(Student $student): float
    {
        if (!$student->assigned_at || !$student->room_id) {
            return 0;
        }

        $room = $student->room;
        if (!$room) {
            return 0;
        }

        // Get the first day of the current month
        $currentMonthStart = Carbon::now()->startOfMonth();
        
        // Get the last day of the current month
        $currentMonthEnd = Carbon::now()->endOfMonth();

        // Get the number of days in the current month
        $totalDaysInMonth = $currentMonthEnd->diffInDays($currentMonthStart) + 1;

        // Calculate the number of days the student has been in the room
        $daysInRoom = min(
            $currentMonthEnd->diffInDays($student->assigned_at) + 1,
            $totalDaysInMonth
        );

        // Calculate daily rate
        $dailyRate = $room->monthly_price / $totalDaysInMonth;

        // Calculate total fee
        $totalFee = $dailyRate * $daysInRoom;

        return (float) number_format($totalFee, 2);
    }

    public function calculateDailyRate(Student $student): float
    {
        if (!$student->room_id) {
            return 0;
        }

        $room = $student->room;
        if (!$room) {
            return 0;
        }

        // Get the number of days in the current month
        $totalDaysInMonth = Carbon::now()->endOfMonth()->diffInDays(
            Carbon::now()->startOfMonth()
        ) + 1;

        // Calculate daily rate
        $dailyRate = $room->monthly_price / $totalDaysInMonth;

        return (float) number_format($dailyRate, 2);
    }
}
