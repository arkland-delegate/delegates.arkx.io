@extends('layouts.dashboard')

@section('content')
    <div class="flex justify-between px-6 py-8 pt-8">
        <h2>Statuses by <strong>{{ $delegate->username }}</strong></h2>
        {{-- <form method="POST" action="{{ route('delegate.statuses.search') }}">
            @include('shared.search')
        </form> --}}
    </div>

    @if($statuses->count())
        <div class="xxs:transactions-xxs xs:transactions-xs sm:transactions-sm md:transactions-md lg:transactions-lg xl:transactions-xl">
            @foreach ($statuses as $status)
                <div class="announcement flex justify-start px-8 pb-8 mt-8 border-b border-grey-medium">
                    <div class="mr-4">
                        <div class="{{ $status->is_recent ? 'calendar-green' : 'calendar-grey' }}">
                            <span class="header"></span>
                            <span class="day">{{ $status->day }}</span>
                            <span class="month">{{ $status->month }}</span>
                        </div>
                    </div>

                    <div class="content">
                        <h3 class="mb-3"><a href="{{ route('delegate.status', [$delegate, $status]) }}">{{ $status->title }}</a></h3>
                        <p>{{ str_limit($status->body, 256) }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        {{ $statuses->links() }}
    @else
        <div class="alert-warning m-6 mb-0" role="alert">
            There are no statuses at the moment.
        </div>
    @endif
@endsection
