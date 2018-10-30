@extends('layouts.dashboard')

@section('content')
    <h2 class="m-6">New Status</h2>

    <div class="px-6 w-full">
        <form method="POST" action="{{ route('dashboard.delegate.statuses', $delegate) }}">
            @csrf

            <div>
                <label>Title</label>
                <input type="text" name="title" value="{{ old('title') }}" />
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
