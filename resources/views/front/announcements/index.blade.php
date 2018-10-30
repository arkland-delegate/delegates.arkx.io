@extends('layouts.app')

@section('content')
    <div class="flex justify-between px-6 py-6 pt-6">
        <h2>Announcements</h2>
        <form method="POST" action="{{ route('announcements.search') }}">
            @include('shared.search')
        </form>
    </div>

    @if($announcements->count())
        <div class="xxs:transactions-xxs xs:transactions-xs sm:transactions-sm md:transactions-md lg:transactions-lg xl:transactions-xl">
            @foreach ($announcements as $announcement)
                <div class="announcement flex justify-start px-6 pb-6 mt-6 border-b border-grey-medium">
                    <div class="mr-4">
                        <div class="{{ $announcement->is_recent ? 'calendar-green' : 'calendar-grey' }}">
                            <span class="header"></span>
                            <span class="day block">{{ $announcement->day }}</span>
                            <span class="month">{{ $announcement->month }}</span>
                        </div>
                    </div>

                    <div class="content">
                        <h3 class="mb-3"><a href="{{ route('announcement', $announcement) }}">{{ $announcement->title }}</a></h3>
                        <p>{!! str_limit($announcement->body, 256) !!}</p>
                    </div>
                </div>
            @endforeach
        </div>

        {{ $announcements->links() }}
    @else
        <div class="alert-warning mx-6" role="alert">
            Sorry, there are no announcements available at this time.
        </div>
    @endif
@endsection

@section('sidebar')
    @include('layouts.sidebars.app')
@endsection
