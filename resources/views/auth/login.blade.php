@extends('layouts.authentication')

@section('content')
    <h2 class="mb-6">Login</h2>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <label>E-Mail Address</label>
        <input type="email" name="email" class="mb-6" value="{{ old('email') }}" required autofocus />

        <label>Password</label>
        <input type="password" name="password" required />

        <div class="actions">
            <button class="button-grey" type="submit">Login</button>
            <a href="{{ route('password.request') }}" class="button">Forgot Your Password?</a>
        </div>
    </form>
@endsection
