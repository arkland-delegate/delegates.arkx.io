@extends('layouts.app')

@section('content')
    <div class="p-8">
        <h2>Voters for <strong><a href="{{ route('delegate', $delegate) }}">{{ $delegate->username }}</a></strong> <em>({{ $delegate->cached_voters_count }})</em></h2>
        {{-- <form method="POST" action="{{ route('delegate.voters.search') }}">
            @include('shared.search')
        </form> --}}
    </div>

    <div class="page-top-100">
        <table class="hidden sm:table">
            <thead>
                <tr>
                    <th>Address</th>
                    <th>Balance</th>
                    <th>Excluded</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($voters as $voter)
                    <tr>
                        <td><a href="https://explorer.ark.io/wallets/{{ $voter->address }}" target="_blank">{{ $voter->address }}</a></td>
                        <td>{{ format_arktoshi($voter->balance, 0) }}</td>
                        <td>{{ $voter->is_excluded ? 'Yes' : 'No' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @foreach ($voters as $voter)
            <ul class="info-list sm:hidden">
                <li>
                    <span>Address</span>
                    <span class="text-right"><a href="https://explorer.ark.io/wallets/{{ $voter->address }}" target="_blank">{{ $voter->address }}</a></span>
                </li>

                <li>
                    <span>Balance</span>
                    <span class="text-right">{{ format_arktoshi($voter->balance, 0) }}</span>
                </li>

                <li>
                    <span>Status</span>
                    <span class="text-right">{{ $voter->is_excluded ? 'Yes' : 'No' }}</span>
                </li>
            </ul>
        @endforeach

        {{ $voters->links() }}
    </div>
@endsection

@section('sidebar')
    @include('layouts.sidebars.app')
@endsection
