<h2>Employee Dashboard</h2>

@if(session('success'))
<p style="color:green">{{ session('success') }}</p>
@endif

@if(session('error'))
<p style="color:red">{{ session('error') }}</p>
@endif

<form method="POST" action="{{ route('employee.checkin') }}">
@csrf
<button type="submit">Check In</button>
</form>

<br>

<form method="POST" action="{{ route('employee.checkout') }}">
@csrf
<button type="submit">Check Out</button>
</form>