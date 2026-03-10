<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{

    public function index()
    {
        $employees = \App\Models\Employee::with('user')->latest()->get();

        return view('admin.employees.index', compact('employees'));
    }
    public function create()
    {
        return view('admin.employees.create');
    }
    public function edit(Employee $employee)
{
    return view('admin.employees.edit', compact('employee'));
}

public function update(Request $request, Employee $employee)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email',
    ]);

    DB::transaction(function () use ($request, $employee) {

        $employee->user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $employee->update([
            'department' => $request->department,
            'designation' => $request->designation,
            'joining_date' => $request->joining_date,
            'salary' => $request->salary,
            'phone' => $request->phone,
        ]);

    });

    return redirect()->route('admin.employees.index')
        ->with('success','Employee Updated');
}
public function destroy(Employee $employee)
{
    DB::transaction(function () use ($employee) {

        $employee->user()->delete(); // deletes user
        $employee->delete();         // deletes employee

    });

    return redirect()->route('admin.employees.index')
        ->with('success','Employee Deleted');
}

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
        ]);



        DB::transaction(function () use ($request) {

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make('password123')
            ]);

            $user->assignRole('Employee');
            $lastEmployee = Employee::latest()->first();

            if ($lastEmployee) {
                $number = (int) substr($lastEmployee->employee_code, 3) + 1;
            } else {
                $number = 1;
            }

            $employeeCode = 'EMP' . str_pad($number, 4, '0', STR_PAD_LEFT);

            Employee::create([
                'user_id' => $user->id,
                'employee_code' => $employeeCode,
                'department' => $request->department,
                'designation' => $request->designation,
                'joining_date' => $request->joining_date,
                'salary' => $request->salary,
                'phone' => $request->phone
            ]);
        });

        return redirect()->route('admin.employees.create')
            ->with('success', 'Employee Created Successfully');
    }
}
