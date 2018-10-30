<aside class="xxs:hidden lg:block delegates-aside">
    <div>
        <h1>Information</h1>
    </div>

    <div>
        <p>{{ $delegate->statistics['voters'] }} Voters</p>
        <h3>{{ $delegate->statistics['approval'] }}% of Total Voters</h3>
    </div>

    <div>
        <ProgressBar
            :percentage="{{ $delegate->statistics['approval'] }}"
            :width="271"
            shadow-color="#27d876"
            stroke-color="#caead8"></ProgressBar>
    </div>

    <ul class="info-list">
        <li>
            <span>Country</span>
            <span>{{ $delegate->country->name }}</span>
        </li>
        <li>
            <span>Status Updates</span>
            <span>{{ $delegate->cached_statuses_count }}</span>
        </li>
        <li>
            <span>Contributions</span>
            <span>{{ $delegate->cached_contributions_count }}</span>
        </li>
        <li>
            <span>Servers</span>
            <span>{{ $delegate->cached_servers_count }}</span>
        </li>
        <li>
            <span>Channels</span>
            <span>{{ $delegate->cached_channels_count }}</span>
        </li>
        <li>
            <span>Subscribers</span>
            <span>{{ $delegate->cached_subscribers_count }}</span>
        </li>
    </ul>
</aside>
