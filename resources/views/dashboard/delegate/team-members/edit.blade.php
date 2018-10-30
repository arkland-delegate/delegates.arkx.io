@extends('layouts.dashboard')

@section('content')
    @include('shared.errors')

    <h2 class="m-6">Edit Team Member</h2>

    <div class="px-6 w-full">
        <form method="POST" action="{{ route('dashboard.delegate.team-members.edit', [$delegate, $teamMember]) }}">
            @method('PUT')
            @csrf

            <div>
                <label>Name</label>
                <input type="text" name="name" value="{{ old('name', $teamMember->name) }}" />
            </div>

            <div class="mt-6">
                <label>Role</label>
                <input type="text" name="role" value="{{ old('role', $teamMember->role) }}" />
            </div>

            <div class="mt-6">
                <label>Description</label>
                <textarea name="body" class="markdown-editor">{{ old('body', $teamMember->body) }}</textarea>
            </div>

            <div class="mt-6">
                <button class="button-grey">Save Changes</button>
            </div>
        </form>
    </div>
@endsection
