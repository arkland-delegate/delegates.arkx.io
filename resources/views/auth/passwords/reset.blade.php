@extends('layouts.authentication')

@section('content')
    <h2 class="mb-6">Reset Password</h2>

    <form method="POST" action="{{ route('password.request') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <label>E-Mail Address</label>
        <input type="email" name="email" class="mb-6" value="{{ old('email') }}" required />

        <label>Password</label>
        <input type="password" name="password" class="mb-6" required />

        <label>Confirm Password</label>
        <input type="password" name="password_confirmation" class="mb-6" required />

        <button class="button-grey" type="submit">Reset Password</button>
    </form>
@endsection
