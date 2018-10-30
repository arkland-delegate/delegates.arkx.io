<div class="content white heading">
    <div class="kicker">
        <h4 class="mb-3">Profit Sharing</h4>
        <p>Virtually all delegates share some portion of their block rewards with the voters who helped them get there. How large that payout is, however, depends on many factors. In addition to paying out different percentages of their rewards, delegates differ in their payout schedules, vote dilution, and other factors. Using our delegate calculator you can discover exactly how much ARK your vote should garner over the short, medium, and long term.</p>
    </div>

    <ul>
        <li>
            <span>Percentage</span>
            <span>{{ $delegate->sharing['percentage'] }}%</span>
        </li>

        <li>
            <span>Frequency</span>
            <span>{{ $delegate->sharing['frequency'] }}</span>
        </li>

        @if($delegate->sharing['threshold'] > 0)
            <li>
                <span>Threshold</span>
                <span>{{ $delegate->sharing['threshold'] }} Ѧ</span>
            </li>
        @endif

        <li>
            <span>Running Balance</span>
            <span>{{ $delegate->sharing['running_balance'] === 'yes' ? 'Yes' : 'No' }}</span>
        </li>

        <li>
            <span>Covers Fee</span>
            <span>{{ $delegate->sharing['covers_fee'] === 'yes' ? 'Yes' : 'No' }}</span>
        </li>
    </ul>

    @if(isset($delegate->sharing['details']))
        <div class="px-8 pb-8">
            {!! parsedown($delegate->sharing['details']) !!}
        </div>
    @endif
</div>
