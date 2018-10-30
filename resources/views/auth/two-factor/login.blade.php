@extends('layouts.authentication')

@section('content')
    <h2 class="mb-6">Login</h2>

    <form method="POST" action="{{ route('two-factor.login') }}">
        @csrf

        <label>Authentication Token</label>
        <input type="text" name="token" required autofocus />

        <div class="actions">
            <button class="button-grey">Login</button>
            <a href="{{ route('emergency-login') }}" class="button">Lost your device?</a>
        </div>
    </form>
@endsection
