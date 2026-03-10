<h2>Edit Employee</h2>

@if(session('success'))
<p>{{ session('success') }}</p>
@endif

<form method="POST" action="{{ route('admin.employees.update',$employee->id) }}">

@csrf
@method('PUT')

<label>Name</label>
<br>
<input name="name" value="{{ $employee->user->name }}">
<br><br>

<label>Email</label>
<br>
<input name="email" value="{{ $employee->user->email }}">
<br><br>

<label>Department</label>
<br>
<input name="department" value="{{ $employee->department }}">
<br><br>

<label>Designation</label>
<br>
<input name="designation" value="{{ $employee->designation }}">
<br><br>

<label>Joining Date</label>
<br>
<input type="date" name="joining_date" value="{{ $employee->joining_date }}">
<br><br>

<label>Salary</label>
<br>
<input name="salary" value="{{ $employee->salary }}">
<br><br>

<label>Phone</label>
<br>
<input name="phone" value="{{ $employee->phone }}">
<br><br>

<button type="submit">Update Employee</button>

</form>