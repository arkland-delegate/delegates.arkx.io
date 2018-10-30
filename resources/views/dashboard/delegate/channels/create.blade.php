@extends('layouts.dashboard')

@section('content')
    <h2 class="m-6">New Channel</h2>

    <div class="px-6 w-full">
        <form method="POST" action="{{ route('dashboard.delegate.channels', $delegate) }}">
            @csrf

            <div>
                <label>Name</label>
                <input type="text" name="name" value="{{ old('name') }}" />
            </div>

            <div class="mt-6">
                <label>Handle</label>
                <input type="text" name="handle" value="{{ old('handle') }}" />
            </div>

            <div class="mt-6">
                <label>Location / URI</label>
                <input type="text" name="location" value="{{ old('location') }}" />
            </div>

            <div class="mt-6">
                <button class="button-grey">Save Changes</button>
            </div>
        </form>
    </div>
@endsection
