@extends('layouts.dashboard')

@section('content')
    <h2 class="m-6">New Server</h2>

    <div class="px-6 w-full">
        <form method="POST" action="{{ route('dashboard.delegate.servers', $delegate) }}">
            @csrf

            <div>
                <label class="w-full select">
                    Country
                    {{ html()->select('country_id', $countries) }}
                </label>
            </div>

            <div class="mt-6">
                <label class="w-full select">
                    Network
                    {{ html()->select('network', [
                        'production' => 'Main Network',
                        'development' => 'Development Network',
                    ]) }}
                </label>
            </div>

            <div class="mt-6">
                <label class="w-full select">
                    Type
                    {{ html()->select('type', [
                        'relay' => 'Relay',
                        'forger' => 'Forger',
                    ]) }}
                </label>
            </div>

            <div class="mt-6">
                <label>CPU</label>
                <input type="text" name="cpu" value="{{ old('cpu') }}" />
            </div>

            <div class="mt-6">
                <label>RAM</label>
                <input type="text" name="ram" value="{{ old('ram') }}" />
            </div>

            <div class="mt-6">
                <label>Disk</label>
                <input type="text" name="disk" value="{{ old('disk') }}" />
            </div>

            <div class="mt-6">
                <label>Connection</label>
                <input type="text" name="connection" value="{{ old('connection') }}" />
            </div>

            <div class="mt-6">
                <button class="button-grey">Save Changes</button>
            </div>
        </form>
    </div>
@endsection
