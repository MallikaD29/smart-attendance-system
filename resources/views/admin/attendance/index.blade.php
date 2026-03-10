<h2>Attendance Report</h2>
<form method="GET">

<label>Select Date:</label>
<input type="date" name="date" value="{{ request('date') }}">

<button type="submit">Filter</button>

</form>

<br>
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