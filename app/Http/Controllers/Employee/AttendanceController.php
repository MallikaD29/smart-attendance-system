<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use Carbon\Carbon;

class AttendanceController extends Controller
{

    public function checkIn()
    {
        $employee = auth()->user()->employee;
        $today = Carbon::today();

        $attendance = Attendance::where('employee_id', $employee->id)
            ->whereDate('date', $today)
            ->first();

        if ($attendance) {
            return back()->with('error', 'Already checked in today');
        }

        $now = Carbon::now();

        // Office start time (9:30 AM)
        $officeStart = Carbon::createFromTime(9, 30, 0);

        $status = $now->greaterThan($officeStart) ? 'late' : 'present';

        Attendance::create([
            'employee_id' => $employee->id,
            'date' => $today,
            'check_in' => $now,
            'status' => $status
        ]);

        return back()->with('success', 'Checked in successfully');
    }


    public function checkOut()
    {
        $employee = auth()->user()->employee;
        $today = Carbon::today();

        $attendance = Attendance::where('employee_id', $employee->id)
            ->whereDate('date', $today)
            ->first();

        if (!$attendance) {
            return back()->with('error', 'You have not checked in today');
        }

        if ($attendance->check_out) {
            return back()->with('error', 'Already checked out');
        }

        $checkIn = Carbon::parse($attendance->check_in);
        $checkOut = Carbon::now();
        $workMinutes = $checkIn->diffInMinutes($checkOut);
        $workHours = $workMinutes / 60;

        $attendance->update([
            'check_out' => $checkOut,
            'work_hours' => round($workHours, 2)
        ]);

        return back()->with('success', 'Checked out successfully');
    }
}
