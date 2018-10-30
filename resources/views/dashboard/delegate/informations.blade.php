@extends('layouts.dashboard')

@section('content')
    @include('shared.errors')

    <h2 class="m-6">Delegate <strong>{{ $delegate->username }}</strong></h2>

    @if (!$delegate->claimHasExpired())
        <div class="p-6">
            <div class="alert-warning mb-6">
                {{-- Here is your verification code: <strong>{{ $delegate->verification_token }}</strong>. <em>It will expire at {{ $delegate->claimed_at->addMinutes(5)->toDayDateTimeString() }}.</em> --}}
                Here is your verification code: <strong>{{ $delegate->verification_token }}</strong>. <em>It will expire at <local-time datetime="{{ $delegate->claimed_at->addMinutes(5)->toAtomString() }}"></local-time>.</em>

                <strong class="block mt-4">Desktop Wallet</strong>
                <ol class="mt-5">
                    <li class="pb-2">Copy the verification code and sign it using the <a href="https://github.com/ArkEcosystem/ark-desktop">ARK Desktop Wallet</a>.</li>
                    <li class="pb-2">Copy the JSON that you receive after signing the message.</li>
                    <li>Paste the JSON into the textarea below and hit verify.</li>
                </ol>

                <strong class="block mt-4">Ledger</strong>
                <ol class="mt-5">
                    <li class="pb-2">Send a transaction of <strong>0.00000001 Ѧ</strong> to <strong>{{ $delegate->address }}</strong> using your verification code as SmartBridge.</li>
                    <li>Contact support with the link to your transaction on <a href="https://explorer.arkx.io">https://explorer.arkx.io</a>.</li>
                </ol>
            </div>

            <form method="POST" action="{{ route('dashboard.lost-and-found.claim', $delegate) }}">
                @csrf

                <label>JSON Message</label>
                <textarea name="message" class="mb-3" required autofocus>
                    {{ old('message') }}
                </textarea>

                <button class="button-grey" type="submit">Verify</button>
            </form>
        </div>
    @endif

    @if($delegate->is_verified)
        <div class="px-6 w-full mb-6">
            <form method="POST" action="{{ route('dashboard.delegate', $delegate) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf

                @include('dashboard.delegate.informations.identity')
                @include('dashboard.delegate.informations.profile')
                @include('dashboard.delegate.informations.sharing')
                @include('dashboard.delegate.informations.voting-requirements')
                @include('dashboard.delegate.informations.voting-fidelity')
                @include('dashboard.delegate.informations.calculator')

                <div class="mt-6">
                    <button class="button-grey">Save Changes</button>
                </div>
            </form>
        </div>
    @endif
@endsection
