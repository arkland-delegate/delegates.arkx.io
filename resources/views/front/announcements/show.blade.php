@extends('layouts.app')

@section('content')
    <div class="flex justify-between px-6 py-6 pt-6">
        <h2>Announcement</h2>
    </div>

    <div class="px-6">
        <div>
            <h3 class="text-2xl">{{ $announcement->title }}</h3>
            <p class="text-grey text-sm my-3">{{ $announcement->created_at->toDayDateTimeString() }}</p>
        </div>

        <div id="announcement-content">
            {!! parsedown($announcement->body) !!}
        </div>

        <hr>

        <em class="inline-block bg-yellow p-2">Thank you for your continued support and happy stacking!</em>
    </div>

    @include('shared.pager', [
        'route' => 'announcement',
        'model' => $announcement
    ])
@endsection

@section('sidebar')
    @include('layouts.sidebars.app')
@endsection
