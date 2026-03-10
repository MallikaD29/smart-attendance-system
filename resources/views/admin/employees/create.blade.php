<h2>Create Employee</h2>

@if(session('success'))
<p>{{ session('success') }}</p>
@endif

<form method="POST" action="{{ route('admin.employees.store') }}">
@csrf

<input name="name" placeholder="Name"><br><br>

<input name="email" placeholder="Email"><br><br>

<input name="department" placeholder="Department"><br><br>

<input name="designation" placeholder="Designation"><br><br>

<input type="date" name="joining_date"><br><br>

<input name="salary" placeholder="Salary"><br><br>

<input name="phone" placeholder="Phone"><br><br>

<button type="submit">Create Employee</button>

</form>