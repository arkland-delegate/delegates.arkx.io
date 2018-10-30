@extends('layouts.dashboard')

@section('content')
    <div class="flex justify-between px-6 py-8 pt-8">
        <h2>Channels</h2>
        <form method="POST" action="{{ route('dashboard.delegate.channels.search', $delegate) }}">
            @include('shared.search')
        </form>
    </div>

    <div class="page-transactions">
        <span class="block p-6 pt-0 float-right">
            <a href="{{ route('dashboard.delegate.channels.create', $delegate) }}" class="button-grey">
                New Channel
            </a>
        </span>

        @if($channels->count())
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Handle</th>
                        <th>Location</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($channels as $channel)
                        <tr>
                            <td>{{ $channel->name }}</td>
                            <td>{{ $channel->handle }}</td>
                            <td><a href="{{ $channel->location }}" target="_blank">{{ $channel->location }}</a></td>
                            <td class="text-right">
                                @include('shared.actions.edit', [
                                    'action' => route('dashboard.delegate.channels.edit', [$delegate, $channel])
                                ])
                                @include('shared.actions.delete', [
                                    'action' => route('dashboard.delegate.channels.destroy', [$delegate, $channel])
                                ])
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $channels->links() }}
        @else
            <div class="alert-warning m-6 mb-0" role="alert">
                There are no channels for your delegate.
            </div>
        @endif
    </div>
@endsection
