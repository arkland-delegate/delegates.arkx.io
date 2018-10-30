<aside class="xxs:hidden lg:block delegates-aside">
    <div>
        <h1>Information</h1>
    </div>

    <div>
        <p>{{ $forgingTotals['voters'] }} Voters</p>
        <h3>{{ $forgingTotals['votes_percent'] }}% of Ѧ</h3>
    </div>

    <div>
        <ProgressBar :percentage="{{ $forgingTotals['votes_percent'] }}" :width="271" shadow-color="#27d876" stroke-color="#caead8" />
    </div>

    <ul class="info-list">
        <li>
            <span>Votes</span>
            <span>{{ $forgingTotals['votes'] }} Ѧ</span>
        </li>
        <li>
            <span>Remaining Supply</span>
            <span>{{ $forgingTotals['supply_left'] }} Ѧ</span>
        </li>
        <li>
            <span>Total Supply</span>
            <span>{{ $forgingTotals['supply'] }} Ѧ</span>
        </li>
    </ul>

    <div>
        <p class="desc">
            In order to find the most advantageous delegate,
            <span class="bg-yellow">
                we recommend you to use the <a href="{{ route('calculator') }}">calculator</a>
            </span>.
        </p>

        <img src="/images/arkx_top_delegates_calc.png" />
    </div>
</aside>
