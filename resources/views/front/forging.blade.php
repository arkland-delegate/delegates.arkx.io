@extends('layouts.app')

@section('content')
    <div class="p-8">
        <h2>Top 51 Delegates</h2>
    </div>

    <div class="page-top-100">
        <table class="hidden sm:table">
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>Type</th>
                    <th>Username</th>
                    <th>Votes in Percent</th>
                    <th>Votes</th>
                    <th>Voters</th>
                    <th class="text-right">Status</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($delegates as $delegate)
                    <tr>
                        <td>{{ $delegate->rank }}</td>
                        <td>{{ ucfirst($delegate->type) }}</td>
                        <td><a href="{{ route('delegate', $delegate->username) }}">{{ $delegate['username'] }}</a></td>
                        <td>{{ $delegate->statistics['approval'] }}%</td>
                        <td>{{ format_arktoshi($delegate->votes, 0) }}</td>
                        <td>{{ $delegate->statistics['voters'] }}</td>
                        <td class="text-right">{{ $delegate->last_block_time->diffForHumans() }} <span class="delegates-status bg-{{ $delegate->status }}"></span></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @foreach ($delegates as $delegate)
            <ul class="info-list sm:hidden">
                <li>
                    <span>Rank</span>
                    <span class="text-right">{{ $delegate->rank }}</span>
                </li>

                <li>
                    <span>Username</span>
                    <span class="text-right"><a href="https://explorer.ark.io/wallets/{{ $delegate['address'] }}">{{ $delegate['username'] }}</a></span>
                </li>

                <li>
                    <span>Votes in Percentage</span>
                    <span class="text-right">{{ $delegate->statistics['approval'] }}%</span>
                </li>

                <li>
                    <span>Votes</span>
                    <span class="text-right">{{ format_arktoshi($delegate->votes / ARKTOSHI, 0) }}</span>
                </li>

                <li>
                    <span>Status</span>
                    <span class="text-right">{{ $delegate->last_block_time->diffForHumans() }} <span class="delegates-status bg-{{ $delegate->status }}"></span></span>
                </li>
            </ul>
        @endforeach
    </div>
@endsection
