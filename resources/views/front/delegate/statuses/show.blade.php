@extends('layouts.dashboard')

@section('content')
    <div class="flex justify-between px-6 py-8 pt-8">
        <h2>Announcement</h2>
    </div>

    <div class="px-6">
        <div>
            <h3 class="text-2xl">{{ $status->title }}</h3>
            <p class="text-grey text-sm my-3">{{ $status->created_at->toDayDateTimeString() }}</p>
        </div>

        {!! parsedown($status->body) !!}
    </div>
@endsection
