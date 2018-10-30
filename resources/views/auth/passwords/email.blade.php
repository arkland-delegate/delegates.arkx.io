@extends('layouts.authentication')

@section('content')
    @if (session('status'))
        <div class="alert alert-success mt-0 mb-6">
            {{ session('status') }}
        </div>
    @endif

    <h2 class="mb-6">Forgot Password</h2>

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <label>E-Mail Address</label>
        <input type="email" name="email" class="mb-6" value="{{ old('email') }}" required autofocus />

        <button class="button-grey" type="submit">
            Send Password Reset Link
        </button>
    </form>
@endsection
