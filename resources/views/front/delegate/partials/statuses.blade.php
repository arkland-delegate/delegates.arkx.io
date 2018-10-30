<div class="content white heading overflow-hidden">
    <div class="kicker">
        <h4 class="mb-3">Statuses</h4>
        <p>All delegates should regularly inform voters of their progress in accomplishing the goals set out in their proposal. There are many ways for delegates to get in contact — either through this website or through official ARK communications channels. Delegates who can't keep you updated on their status may not deserve your vote.</p>
    </div>

    @if($subscribed === 'yes')
        <div class="subscribe p-8 pb-0">
            <p class="mb-4">If you're no longer interested in hearing about <strong>{{ $delegate->username }}</strong>, unsubscribe below. You'll no longer receive updates from the delegate.</p>

            <form method="POST" action="{{ route('delegate.subscribe', $delegate) }}" class="flex">
                @csrf

                <input type="email" name="email" class="mb-6 mr-2 mti-0" value="{{ old('email') }}" placeholder="E-Mail Address" required autofocus />

                <div class="actions">
                    <button class="button-grey" type="submit">Unsubscribe</button>
                </div>
            </form>
        </div>
    @else
        <div class="subscribe p-8 pb-0">
            <p class="mb-4">If you're interested in hearing more about <strong>{{ $delegate->username }}</strong>, subscribe below. You'll receive updates from the delegate as they're released, and we'll keep you informed on voting shifts that could affect your payout.</p>

            <form method="POST" action="{{ route('delegate.subscribe', $delegate) }}" class="flex">
                @csrf

                <input type="email" name="email" class="mb-6 mr-2 mti-0" value="{{ old('email') }}" placeholder="E-Mail Address" required autofocus />

                <div class="actions">
                    <button class="button-grey" type="submit">Subscribe</button>
                </div>
            </form>
        </div>
    @endif

    @if($statuses->count())
        <table class="mt-3">
            <thead>
                <tr>
                    <th>Title</th>
                    <th class="text-right">Date</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($statuses as $status)
                    <tr>
                        <td><a href="{{ route('delegate.status', [$delegate, $status]) }}">{{ $status->title }}</a></td>
                        <td class="text-right">{{ $delegate->created_at->toDayDateTimeString() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @if($statuses->count() > 10)
            <div class="flex justify-center m-6">
                <a href="{{ route('delegate.statuses', $delegate) }}" class="button-pager hover:button-pager-hover">
                    Show All
                </a>
            </div>
        @endif
    @endif
</div>
