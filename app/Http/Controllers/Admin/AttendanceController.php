<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Attendance;

class AttendanceController extends Controller
{
   public function index(Request $request)
{
    $query = Attendance::with('employee.user');

    if ($request->date) {
        $query->whereDate('date', $request->date);
    }

    $attendances = $query->latest()->get();

    return view('admin.attendance.index', compact('attendances'));
}
}