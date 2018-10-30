@extends('layouts.dashboard')

@section('content')
    <h2 class="m-6">Edit Status</h2>

    <div class="px-6 w-full">
        <form method="POST" action="{{ route('dashboard.delegate.statuses.edit', [$delegate, $status]) }}">
            @method('PUT')
            @csrf

            <div>
                <label>Title</label>
                <input type="text" name="title" value="{{ old('title', $status->title) }}" />
            </div>

            <div class="mt-6">
                <label>Body</label>
                <textarea name="body" class="markdown-editor">{{ old('body', $status->body) }}</textarea>
            </div>

            <div class="mt-6">
                <button class="button-grey">Save Changes</button>
            </div>
        </form>
    </div>
@endsection
