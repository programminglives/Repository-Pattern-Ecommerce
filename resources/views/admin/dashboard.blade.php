<h2>Admin Dashboard</h2>
<form method="POST" action="{{ route('admin.logout') }}">
    @csrf

    <input type="submit" value="logout">
</form>
