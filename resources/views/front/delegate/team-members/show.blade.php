@extends('layouts.dashboard')

@section('content')
    <div class="flex justify-between px-6 py-8 pt-8">
        <h2>Team Member</h2>
    </div>

    <div class="px-6">
        <div>
            <h3 class="text-2xl">{{ $teamMember->name }}</h3>
            <p class="text-grey text-sm my-3">{{ $teamMember->role }}</p>
        </div>

        {!! parsedown($teamMember->body) !!}
    </div>
@endsection
