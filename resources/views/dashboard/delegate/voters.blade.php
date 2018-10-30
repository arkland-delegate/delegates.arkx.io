@extends('layouts.dashboard')

@section('content')
    <div class="flex justify-between px-6 py-8 pt-8">
        <h2>Voters</h2>
        <form method="POST" action="{{ route('dashboard.delegate.voters.search', $delegate) }}">
            @include('shared.search')
        </form>
    </div>

    <div class="page-transactions">
        @if($voters->count())
            <table>
                <thead>
                    <tr>
                        <th>Address</th>
                        <th>Balance</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($voters as $voter)
                        <tr>
                            <td>{{ $voter->address }}</td>
                            <td>{{ format_arktoshi($voter->balance) }}</td>
                            <td class="text-right">
                                @if($voter->is_excluded)
                                    <a href="{{ route('dashboard.delegate.voters.include', [$delegate, $voter]) }}" class="link-icon mr-1">
                                        <i class="far fa-unlock"></i>
                                    </a>
                                @else
                                    <a href="{{ route('dashboard.delegate.voters.exclude', [$delegate, $voter]) }}" class="link-icon mr-1">
                                        <i class="far fa-lock"></i>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $voters->links() }}
        @else
            <div class="alert-warning m-6 mb-0" role="alert">
                There are no voters for your delegate.
            </div>
        @endif
    </div>
@endsection
