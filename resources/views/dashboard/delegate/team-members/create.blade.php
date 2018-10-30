@extends('layouts.dashboard')

@section('content')
    @include('shared.errors')

    <h2 class="m-6">New Team Member</h2>

    <div class="px-6 w-full">
        <form method="POST" action="{{ route('dashboard.delegate.team-members', $delegate) }}">
            @csrf

            <div>
                <label>Name</label>
                <input type="text" name="name" value="{{ old('name') }}" />
            </div>

            <div class="mt-6">
                <label>Role</label>
                <input type="text" name="role" value="{{ old('role') }}" />
            </div>

            <div class="mt-6">
                <label class="block mb-2">Body</label>
                <textarea name="body" class="markdown-editor">{{ old('body') }}</textarea>
            </div>

            <div class="mt-6">
                <button class="button-grey">Create</button>
            </div>
        </form>
    </div>
@endsection
