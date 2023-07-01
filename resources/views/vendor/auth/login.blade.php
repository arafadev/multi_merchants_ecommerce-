<form action="{{ route('vendor.login') }}" method="POST" >
    @csrf
    <input type="email" name="email">
    <input type="password" name="password">
    <input type="submit" value="Login">
</form>
