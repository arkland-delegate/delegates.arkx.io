<div class="content white heading overflow-hidden">
    <div class="kicker">
        <h4 class="mb-3">Contributions</h4>
        <p>Being a delegate should be about more than sharing profits. Ultimately, delegates are supposed to ensure the health and safety of the network — and that can come in many forms. Whether through development, community-building, marketing, content production, or something else entirely, the best delegates elevate ARK from a cryptocurrency to a full ecosystem. Consider your vote accordingly.</p>
    </div>

    <table class="mt-3">
        <thead>
            <tr>
                <th>Title</th>
                <th class="text-right">Date</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($contributions as $contribution)
                <tr>
                    <td><a href="{{ route('delegate.contribution', [$delegate, $contribution]) }}">{{ $contribution->title }}</a></td>
                    <td class="text-right">{{ $delegate->created_at->toDayDateTimeString() }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if($contributions->count() > 10)
        <div class="flex justify-center m-6">
            <a href="{{ route('delegate.contributions', $delegate) }}" class="button-pager hover:button-pager-hover">
                Show All
            </a>
        </div>
    @endif
</div>
