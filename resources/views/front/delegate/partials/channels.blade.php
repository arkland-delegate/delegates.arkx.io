<div class="content white heading">
    <div class="kicker">
        <h4 class="mb-3">Channels</h4>
        <p>Delegates should make themselves available to their voters. Much as you wouldn't vote for a mayor who never talks to anybody, it's not recommended that you vote for a delegate who doesn't offer communication channels for you to get in contact. However, as a voter, you should respect your delegates' time as well. While delegates may not be able to respond to you immediately, good delegates should make an effort to respond to voters' requests in a timely fashion.</p>
    </div>
</div>

@foreach($delegate->channels as $channel)
    <div class="content white heading">
        <div class="kicker">
            <h4>{{ ucfirst($channel->name) }}</h4>
        </div>

        <ul>
            <li>
                <span>Handle</span>
                @if(filter_var($channel->handle, FILTER_VALIDATE_EMAIL))
                    <span>
                        <a href="mailto:{{ $channel->handle }}">
                            {{ $channel->handle }}
                        </a>
                    </span>
                @else
                    <span>{{ $channel->handle }}</span>
                @endif
            </li>

            @if($channel->location)
                <li>
                    <span>Location</span>
                    <span><a href="{{ $channel->location }}">{{ $channel->location }}</a></span>
                </li>
            @endif
        </ul>
    </div>
@endforeach
