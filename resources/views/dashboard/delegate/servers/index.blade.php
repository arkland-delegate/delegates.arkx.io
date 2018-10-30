@extends('layouts.dashboard')

@section('content')
    <div class="flex justify-between px-6 py-8 pt-8">
        <h2>Servers</h2>
        <form method="POST" action="{{ route('dashboard.delegate.servers.search', $delegate) }}">
            @include('shared.search')
        </form>
    </div>

    <div class="page-transactions">
        <span class="block p-6 pt-0 float-right">
            <a href="{{ route('dashboard.delegate.servers.create', $delegate) }}" class="button-grey">
                New Server
            </a>
        </span>

        @if($servers->count())
            <table>
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>Country</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($servers as $server)
                        <tr>
                            <td>{{ ucfirst($server->type) }}</td>
                            <td>{{ $server->country->name }}</td>
                            <td class="text-right">
                                <a href="{{ route('dashboard.delegate.servers.duplicate', [$delegate, $server]) }}" class="link-icon mr-1" title="Profile">
                                    <i class="far fa-copy"></i>
                                </a>
                                @include('shared.actions.edit', [
                                    'action' => route('dashboard.delegate.servers.edit', [$delegate, $server])
                                ])
                                @include('shared.actions.delete', [
                                    'action' => route('dashboard.delegate.servers.destroy', [$delegate, $server])
                                ])
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $servers->links() }}
        @else
            <div class="alert-warning m-6 mb-0" role="alert">
                There are no servers for your delegate.
            </div>
        @endif
    </div>
@endsection
