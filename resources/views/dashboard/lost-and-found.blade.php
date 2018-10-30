@extends('layouts.dashboard')

@section('content')
    <div class="flex justify-between px-6 py-6 pt-6">
        <h2>Lost &amp; Found</h2>
        <form method="POST" action="{{ route('dashboard.lost-and-found.search') }}">
            @csrf

            @include('shared.search')
        </form>
    </div>

    <div class="page-transactions">
        @if($delegates->count())
            <table class="hidden sm:table">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Votes</th>
                        <th>Productivity</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($delegates as $delegate)
                        <tr>
                            <td>
                                <a href="{{ route('delegate', $delegate) }}">{{ $delegate->username }}</a>
                            </td>
                            <td>
                                {{ $delegate->formatted_votes }} Ѧ
                            </td>
                            <td>
                                {{ $delegate->statistics['productivity'] }}%
                            </td>
                            <td class="text-right">
                                <a href="{{ route('dashboard.lost-and-found.claim', $delegate) }}" class="button-grey">Claim</a>
                            </td>
                        </tr>
                   @endforeach
                </tbody>
            </table>

            <form method="POST" action="{{ route('dashboard.lost-and-found.search') }}">
                @csrf

                @include('shared.search-mobile')
            </form>

            <ul class="info-list sm:hidden">
                @foreach ($delegates as $delegate)
                    <li class="px-6">
                        <span>
                            Wallet {{ $delegate->address }}<br>
                            <span>{{ $delegate->is_verified ? $delegate->verified_at->toDayDateTimeString() : 'No' }}</span>
                        </span>
                        <span class="text-sm">{{ $delegate->formatted_earnings }} Ѧ</span>
                    </li>
                @endforeach
            </ul>

            {{ $delegates->links() }}
        @else
            <div class="alert-warning mx-6" role="alert">
                Sorry, there are no delegates available at this time.
            </div>
        @endif
    </div>
@endsection
