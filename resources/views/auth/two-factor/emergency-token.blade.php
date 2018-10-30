@extends('layouts.authentication')

@section('content')
    <h2 class="mb-6">Login via Emergency Token</h2>

    <form method="POST" action="{{ route('two-factor.emergency') }}">
        @csrf

        <label>Emergency Token</label>
        <input type="text" name="token" required autofocus />

        <div class="actions">
            <button class="button-grey" type="submit">Login</button>
        </div>
    </form>
@endsection

@section('alert')
    <div class="emergency-info">
        <p>
            After logging in via your emergency token, two-factor authentication
            will be disabled for your account. If you would like to maintain
            two-factor authentication security, you should re-enable it after
            logging in.
        </p>
    </div>
@endsection
