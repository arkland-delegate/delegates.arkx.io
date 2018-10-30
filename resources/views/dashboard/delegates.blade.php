@extends('layouts.dashboard')

@section('content')
    <div class="p-6 pb-0">
        <em class="inline-block bg-yellow p-2 mb-2">
            The Delegates API allows you to programatically manage your delegate. For more information on the API, you should consult the <a href="https://docs.arkx.io/">API documentation</a>.
        </em>
        <em class="inline-block bg-yellow p-2">
            Your API token is <strong>{{ $currentUser->api_token }}</strong>.
        </em>
    </div>

    <div class="flex justify-between px-6 py-8 pt-8">
        <h2>Delegates</h2>
        <form method="POST" action="{{ route('dashboard.delegates.search') }}">
            @include('shared.search')
        </form>
    </div>

    <div class="page-transactions">
        @if($delegates->count())
            <table class="hidden sm:table">
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>Name</th>
                        <th class="hidden md:table-cell">Address</th>
                        <th>Date</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($delegates as $delegate)
                        <tr>
                            <td>{{ ucfirst($delegate->type) }}</td>
                            <td>{{ $delegate->username }}</td>
                            <td class="hidden md:table-cell">{{ $delegate->address }}</td>
                            <td>{{ $delegate->created_at->toDayDateTimeString() }}</td>
                            <td class="text-right">
                                <a href="{{ route('dashboard.delegate', $delegate) }}" class="link-icon mr-1" title="Profile">
                                    <i class="far fa-id-badge"></i>
                                </a>

                                <a href="{{ route('dashboard.delegate.contributions', $delegate) }}" class="link-icon mr-1" title="Contributions">
                                    <i class="far fa-hand-holding-box"></i>
                                </a>

                                <a href="{{ route('dashboard.delegate.channels', $delegate) }}" class="link-icon mr-1" title="Channels">
                                    <i class="far fa-mail-bulk"></i>
                                </a>

                                <a href="{{ route('dashboard.delegate.statuses', $delegate) }}" class="link-icon mr-1" title="Statuses">
                                    <i class="far fa-poll-h"></i>
                                </a>

                                <a href="{{ route('dashboard.delegate.servers', $delegate) }}" class="link-icon mr-1" title="Servers">
                                    <i class="far fa-server"></i>
                                </a>

                                <a href="{{ route('dashboard.delegate.voters', $delegate) }}" class="link-icon mr-1" title="Voters">
                                    <i class="far fa-user-chart"></i>
                                </a>

                                <a href="{{ route('dashboard.delegate.team-members', $delegate) }}" class="link-icon mr-1" title="Team Members">
                                    <i class="far fa-users-class"></i>
                                </a>
                            </td>
                        </tr>
                   @endforeach
                </tbody>
            </table>

            @include('shared.search-mobile')

            <ul class="info-list sm:hidden">
                @foreach ($delegates as $delegate)
                    <li class="px-6">
                        <span>
                            Delegate <a href="{{ route('dashboard.delegate', $delegate) }}">{{ $delegate->username }}</a><br />
                            <span>{{ $delegate->created_at->toDayDateTimeString() }}</span>
                        </span>
                        <span>
                            <a href="{{ route('dashboard.delegate', $delegate) }}" class="link-icon mr-1" title="Profile">
                                <i class="far fa-id-badge"></i>
                            </a>

                            <a href="{{ route('dashboard.delegate.contributions', $delegate) }}" class="link-icon mr-1" title="Contributions">
                                <i class="far fa-hand-holding-box"></i>
                            </a>

                            <a href="{{ route('dashboard.delegate.channels', $delegate) }}" class="link-icon mr-1" title="Channels">
                                <i class="far fa-mail-bulk"></i>
                            </a>

                            <a href="{{ route('dashboard.delegate.statuses', $delegate) }}" class="link-icon mr-1" title="Statuses">
                                <i class="far fa-poll-h"></i>
                            </a>

                            <a href="{{ route('dashboard.delegate.servers', $delegate) }}" class="link-icon mr-1" title="Servers">
                                <i class="far fa-server"></i>
                            </a>

                            <a href="{{ route('dashboard.delegate.voters', $delegate) }}" class="link-icon mr-1" title="Voters">
                                <i class="far fa-user-chart"></i>
                            </a>

                            <a href="{{ route('dashboard.delegate.team-members', $delegate) }}" class="link-icon mr-1" title="Team Members">
                                <i class="far fa-users-class"></i>
                            </a>
                        </span>
                    </li>
                @endforeach
            </ul>

            {{ $delegates->links() }}
        @else
            <div class="alert-warning m-6 mb-0" role="alert">
                There are no delegates for your account.
            </div>
        @endif
    </div>
@endsection
