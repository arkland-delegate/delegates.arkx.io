@extends('layouts.app')

@section('content')
    <div class="p-8">
        <h2>Team Members for <strong><a href="{{ route('delegate', $delegate) }}">{{ $delegate->username }}</a></strong> <em>({{ $delegate->cached_team_members_count }})</em></h2>
        {{-- <form method="POST" action="{{ route('delegate.team-members.search') }}">
            @include('shared.search')
        </form> --}}
    </div>

    <div class="page-top-100">
        <table class="hidden sm:table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Role</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($teamMembers as $teamMember)
                    <tr>
                        <td>{{ $teamMember->name }}</td>
                        <td>{{ $teamMember->role }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @foreach ($teamMembers as $teamMember)
            <ul class="info-list sm:hidden">
                <li>
                    <span>Name</span>
                    <span class="text-right">{{ $teamMember->name }}</span>
                </li>

                <li>
                    <span>Role</span>
                    <span class="text-right">{{ $teamMember->role }}</span>
                </li>
            </ul>
        @endforeach

        {{ $teamMembers->links() }}
    </div>
@endsection

@section('sidebar')
    @include('layouts.sidebars.app')
@endsection
