{{-- Password long? Hard to type?

Get a magic link sent to your email that'll sign you in instantly

Send Magic Link

We sent an email to you at {{ $user->email }}. It has a magic link that'll sign you in. --}}

@extends('layouts.authentication')

@section('content')
    <h2 class="mb-6">Password long? Hard to type?</h2>

    <form method="POST" action="{{ route('login.magic.request') }}">
        @csrf

        <p class="block bg-yellow p-2 text-center mb-6">
            Get a magic link sent to your email that'll sign you in instantly.
        </p>

        <label>E-Mail Address</label>
        <input type="email" name="email" value="{{ old('email') }}" required autofocus />

        <div class="actions">
            <button class="button-grey" type="submit">Send Magic Link</button>
        </div>
    </form>
@endsection
