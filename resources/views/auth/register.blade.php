@extends('layouts.authentication')

@section('content')
    <h2 class="mb-6">Register</h2>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <label>E-Mail Address</label>
        <input type="email" name="email" class="mb-6" value="{{ old('email') }}" required autofocus />

        <label>Password</label>
        <input type="password" name="password" class="mb-6" required />

        <label>Confirm Password</label>
        <input type="password" name="password_confirmation" required />

        <div class="actions">
            <button class="button-grey" type="submit">Register</button>
        </div>
    </form>
@endsection
