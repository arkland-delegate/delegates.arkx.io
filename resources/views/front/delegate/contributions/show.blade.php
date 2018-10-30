@extends('layouts.dashboard')

@section('content')
    <div class="flex justify-between px-6 py-8 pt-8">
        <h2>Contribution</h2>
    </div>

    <div class="px-6">
        <div class="mb-4">
            <h3 class="text-2xl">{{ $contribution->title }}</h3>
            {{-- <p class="text-grey text-sm my-3">{{ $contribution->role }}</p> --}}
        </div>

        {!! parsedown($contribution->body) !!}
    </div>
@endsection
