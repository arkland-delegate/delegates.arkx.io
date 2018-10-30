@extends('layouts.authentication')

@section('content')
    <h2 class="mb-6">Verify Your Email Address</h2>

    <div class="card-body">
        @if (session('resent'))
            <div class="alert alert-success mt-0 mb-6">
                A fresh verification link has been sent to your email address.
            </div>
        @endif

        <p>Before proceeding, please check your email for a verification link.</p>
        <p>If you did not receive the email, <a href="{{ route('verification.resend') }}">click here to request another</a>.</p>
    </div>
@endsection
