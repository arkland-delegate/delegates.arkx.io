<div class="content">
    <div class="stats flex-wrap">
        <img src="{{ $delegate->logo }}" class="shadow-md" />

        <div class="sm:border-r pr-8 sm:ml-8 ml-0">
            <span>Rank</span>
            <p>{{ $delegate->rank }}</p>
        </div>

        <div class="sm:border-r pr-0 sm:pr-8 ml-16 sm:ml-8 pl-3 sm:pl-0">
            <span>Votes</span>
            <p>{{ format_arktoshi($delegate->votes, 0) }}</p>
        </div>

        <div class="sm:border-r pr-8 ml-0 sm:ml-8">
            <span>Productivity</span>
            <p>{{ $delegate->statistics['productivity'] }}%</p>
        </div>

        <div class="sm:border-r pr-8 ml-0 sm:ml-8">
            <span>Approval</span>
            <p>{{ $delegate->statistics['approval'] }}%</p>
        </div>

        <div class="ml-8">
            <span>Stability</span>
            <p>{{ $delegate->cached_stability }}%</p>
        </div>
    </div>

    <div class="general">
        @if($delegate->profile['details'])
            <h5 class="mb-3">General Information</h5>

            {!! parsedown($delegate->profile['details']) !!}
        @else
            <em class="inline-block bg-yellow p-2">No information available</em>
        @endif

        <div class="tags">
            @foreach($delegate->tags as $tag)
                <a href="{{ route('tag', $tag->slug) }}">{{ $tag->name }}</a>
            @endforeach
        </div>
    </div>
</div>
