<x-app-layout>

<x-slot name="header">
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
Attendance Report
</h2>
</x-slot>

<div class="py-6">
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

<form method="GET" class="mb-4">

<label>Select Date:</label>

<input type="date" name="date" value="{{ request('date') }}">

<button type="submit">Filter</button>

</form>

<table border="1" cellpadding="10">

<tr>
<th>Employee</th>
<th>Date</th>
<th>Check In</th>
<th>Check Out</th>
<th>Work Hours</th>
<th>Status</th>
</tr>

@foreach($attendances as $attendance)

<tr>
<td>{{ $attendance->employee->user->name }}</td>
<td>{{ $attendance->date }}</td>
<td>{{ $attendance->check_in }}</td>
<td>{{ $attendance->check_out }}</td>
<td>{{ $attendance->work_hours }}</td>
<td>{{ $attendance->status }}</td>
</tr>

@endforeach

</table>

</div>

</div>
</div>

</x-app-layout>