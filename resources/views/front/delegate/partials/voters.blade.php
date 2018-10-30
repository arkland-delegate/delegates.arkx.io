<div class="content white heading overflow-hidden">
    <div class="kicker">
        <h4>Voters</h4>
        {{-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio qui eveniet odit ipsam recusandae ipsa eos, iste asperiores voluptatibus non quibusdam vitae odio, repellat obcaecati excepturi eius esse. Soluta, repellendus.</p> --}}
    </div>

    <table class="mt-3">
        <thead>
            <tr>
                <th>Address</th>
                <th>Balance</th>
                <th>Weight</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($voters->chunk(10) as $chunk)
                @foreach ($chunk as $voter)
                    <tr>
                        <td><a href="https://explorer.ark.io/wallets/{{ $voter['address'] }}">{{ $voter['address'] }}</a></td>
                        <td>{{ format_arktoshi($voter['balance'], 0) }} Ѧ</td>
                        <td>{{ format_number(($voter['balance'] / $delegate->votes) * 100, 4) }}%</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>

    @if($voters->count() > 10)
        <div class="flex justify-center m-6">
            <a href="{{ route('delegate.voters', $delegate) }}" class="button-pager hover:button-pager-hover">
                Show All
            </a>
        </div>
    @endif
</div>
