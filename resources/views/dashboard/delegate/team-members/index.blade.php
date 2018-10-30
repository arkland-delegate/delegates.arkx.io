@extends('layouts.dashboard')

@section('content')
    <div class="flex justify-between px-6 py-8 pt-8">
        <h2>Team Members</h2>
        {{-- <form method="POST" action="{{ route('dashboard.delegate.teamMembers.search', $delegate) }}">
            @include('shared.search')
        </form> --}}
    </div>

    <div class="page-transactions">
        <span class="block p-6 pt-0 float-right">
            <a href="{{ route('dashboard.delegate.team-members.create', $delegate) }}" class="button-grey">
                New Team Member
            </a>
        </span>

        @if($teamMembers->count())
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Role</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($teamMembers as $teamMember)
                        <tr>
                            <td>{{ $teamMember->name }}</td>
                            <td>{{ $teamMember->role }}</td>
                            <td class="text-right">
                                @include('shared.actions.edit', [
                                    'action' => route('dashboard.delegate.team-members.edit', [$delegate, $teamMember])
                                ])
                                @include('shared.actions.delete', [
                                    'action' => route('dashboard.delegate.team-members.destroy', [$delegate, $teamMember])
                                ])
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $teamMembers->links() }}
        @else
            <div class="alert-warning m-6 mb-0" role="alert">
                There are no team members for your delegate.
            </div>
        @endif
    </div>
@endsection
