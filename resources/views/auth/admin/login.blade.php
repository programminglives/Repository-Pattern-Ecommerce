<h2>Admin Login</h2>
<form action="{{ route('admin.login') }}" method="post">
    @csrf
    Email
    <input type="text" name="email">
    Password
    <input type="password" name="password">
    <input type="submit">
</form>
