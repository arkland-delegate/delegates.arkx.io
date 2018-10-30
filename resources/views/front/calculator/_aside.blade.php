<aside class="xxs:hidden lg:block profit-aside" v-if="!chosenDelegate">
    <div>
        <h2>Information</h2>
    </div>

    <div>
        <p>
            <span class="highlight">
                These calculations are rough estimates of how many ARK you will earn
                per day.
            </span>

            If you want to get exact numbers and more detailed information please
            check the proposal and get in touch with the corresponding delegate.
        </p>

        <p>
            To learn more about the delegate's proposal, select the delegate you need
            and click on it.
        </p>

        <img src="/images/arkx_delegate_information.png" />

        <p>
            On the right hand side you will be given a brief information about the
            delegate.
        </p>
    </div>
</aside>

<aside class="xxs:hidden lg:block delegate-info-aside" v-if="chosenDelegate">
    <div>
        <h1>@{{ chosenDelegate.username }}</h1>
    </div>

    <div class="meter">
        <div class="relative">
            <div class="w-percentage-meter text-green percentage-meter">
                <ProgressMeter :percentage="chosenDelegate.share" shadow-color="#27d876" stroke-color="#caead8" :background-stroke="2" :inner-icon="true" />
            </div>
        </div>

        <div>
            <label>Share</label>
            <h3>@{{ chosenDelegate.share }}%</h3>
        </div>
    </div>

    <ul class="info-list">
        <li>
            <span>Productivity</span>
            <span>@{{ chosenDelegate.productivity }}%</span>
        </li>
        <li>
            <span>Votes</span>
            <span>@{{ formatArktoshi(chosenDelegate.votes) }} Ѧ</span>
        </li>
        <li>
            <span>Approval</span>
            <span>@{{ chosenDelegate.approval }}%</span>
        </li>
    </ul>

    <div class="desc mt-4">
        {{-- <p>@{{ chosenDelegate.description }}</p> --}}

        <a :href="getProfileLink(chosenDelegate)">Show more</a>
    </div>
</aside>
