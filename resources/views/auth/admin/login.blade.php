<h2>Admin Login</h2>
<form action="{{ route('admin.login') }}" method="post">
    @csrf
    Email
    <input type="text" name="email" value="admin@admin.com">
    Password
    <input type="password" name="password" value="password">
    <input type="submit">
</form>
