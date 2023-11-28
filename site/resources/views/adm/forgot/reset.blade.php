<!-- resources/views/auth/passwords/reset.blade.php -->

<form method="POST" action="{{ route('password.update') }}">
    @csrf

    <input type="hidden" name="token" value="{{ $token }}">

    <label for="email">Email:</label>
    <input id="email" type="email" name="email" value="{{ $email ?? old('email') }}" required>
    @error('email')
        <span>{{ $message }}</span>
    @enderror

    <label for="password">Password:</label>
    <input id="password" type="password" name="password" required>
    @error('password')
        <span>{{ $message }}</span>
    @enderror

    <label for="password_confirmation">Confirm Password:</label>
    <input id="password_confirmation" type="password" name="password_confirmation" required>
    @error('password_confirmation')
        <span>{{ $message }}</span>
    @enderror

    <button type="submit">Reset Password</button>
</form>
