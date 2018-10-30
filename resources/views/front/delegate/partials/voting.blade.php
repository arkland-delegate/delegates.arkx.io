<div class="content white heading">
    <div class="kicker">
        <h4 class="mb-3">Requirements</h4>
        <p>ARK delegates differ in what requirements they place upon their voters. Some delegates require you to hold a minimum amount of ARK to receive payouts; some delegates won't pay out votes from wallets holding ARK over a defined maximum. We've done our best to collect those requirements here, but you should always reach out to your delegate to confirm should you have further questions.</p>
    </div>

    <ul>
        @if($delegate->voting['requirements']['min_balance'] > 0)
            <li>
                <span>Minimum Balance</span>
                <span>{{ $delegate->voting['requirements']['min_balance'] }} Ѧ</span>
            </li>
        @endif

        @if($delegate->voting['requirements']['max_balance'] > 0)
            <li>
                <span>Maximum Balance</span>
                <span>{{ $delegate->voting['requirements']['max_balance'] }} Ѧ</span>
            </li>
        @endif

        <li>
            <span>Requires Registration</span>
            <span>{{ $delegate->voting['requirements']['registration'] === 'yes' ? 'Yes' : 'No' }}</span>
        </li>
    </ul>

    @if(isset($delegate->voting['requirements']['details']))
        <div class="px-8 pb-8">
            {!! parsedown($delegate->voting['requirements']['details']) !!}
        </div>
    @endif
</div>

@if(!empty($delegate->voting['fidelity']['period']) || !empty($delegate->voting['fidelity']['share']) || !empty($delegate->voting['fidelity']['details']))
    <div class="content white heading">
        <div class="kicker">
            <h4 class="mb-3">Fidelity</h4>
            <p>Some delegates withhold a portion of their payouts to new voters in order to discourage vote-hopping. Some delegates scale their voters into full payouts gradually, while others simply require voters to last through a "waiting period" before receiving rewards. Once you find a good delegate, it pays to stay loyal.</p>
        </div>

        <ul>
            <li>
                <span>Period</span>
                <span>{{ $delegate->voting['fidelity']['period'] }}</span>
            </li>

            <li>
                <span>Share</span>
                <span>{{ $delegate->voting['fidelity']['share'] }}%</span>
            </li>
        </ul>

        @if(isset($delegate->voting['fidelity']['details']))
            <div class="px-8 pb-8">
                {!! parsedown($delegate->voting['fidelity']['details']) !!}
            </div>
        @endif
    </div>
@endif
