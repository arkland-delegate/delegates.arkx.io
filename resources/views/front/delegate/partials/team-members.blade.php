<div class="content white heading overflow-hidden">
    <div class="kicker">
        <h4 class="mb-3">Team Members</h4>
        <p>From solo developers to full-fledged marketing teams, groups of any size can build successful delegates. Here you'll find all delegate team members alongside their role in maintaining (or capturing) forging position.</p>
    </div>

    <table class="mt-3">
        <thead>
            <tr>
                <th>Name</th>
                <th>Role</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($teamMembers as $teamMember)
                <tr>
                    <td><a href="{{ route('delegate.team-member', [$delegate, $teamMember]) }}">{{ $teamMember->name }}</a></td>
                    <td>{{ $teamMember->role }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if($teamMembers->count() > 10)
        <div class="flex justify-center m-6">
            <a href="{{ route('delegate.team-members', $delegate) }}" class="button-pager hover:button-pager-hover">
                Show All
            </a>
        </div>
    @endif
</div>
