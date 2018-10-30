@extends('layouts.app')

@section('content')
    @auth
        @if(!$delegate->claimed_at)
            <div class="px-6 pt-6">
                <em class="inline-block bg-yellow p-2">
                    If you are the owner of this delegate, consider <a href="{{ route('dashboard.lost-and-found.claim', $delegate) }}">claiming</a> it to update your information.
                </em>
            </div>
        @endif
    @endauth

    <div class="p-8 pb-0">
        <h2>Delegate <span class="font-bold">{{ $delegate->username }}</span></h2>
    </div>

    <div class="page-delegate p-8 xs:page-delegate-xs sm:page-delegate-sm md:page-delegate-md lg:page-delegate-lg xl:page-delegate-xl">
        @include('front.delegate.partials.info')

        <delegate-tabs inline-template>
            <div class="my-6">
                <div class="content my-6">
                    <ul class="tabs cursor-pointer">
                        <li>
                            <a :class="{ 'button-active': selected === 'statuses' }" @click="switchTab('statuses')">Statuses</a>
                        </li>

                        @if($delegate->contributions()->count())
                            <li>
                                <a :class="{ 'button-active': selected === 'contributions' }" @click="switchTab('contributions')">Contributions</a>
                            </li>
                        @endif

                        @if($delegate->teamMembers()->count())
                            <li>
                                <a :class="{ 'button-active': selected === 'team-members' }" @click="switchTab('team-members')">Team Members</a>
                            </li>
                        @endif

                        <li>
                            <a :class="{ 'button-active': selected === 'sharing' }" @click="switchTab('sharing')">Sharing</a>
                        </li>

                        <li>
                            <a :class="{ 'button-active': selected === 'voting' }" @click="switchTab('voting')">Voting</a>
                        </li>

                        @if($delegate->servers()->count())
                            <li>
                                <a :class="{ 'button-active': selected === 'servers' }" @click="switchTab('servers')">Servers</a>
                            </li>
                        @endif

                        @if($delegate->channels()->count())
                            <li>
                                <a :class="{ 'button-active': selected === 'channels' }" @click="switchTab('channels')">Channels</a>
                            </li>
                        @endif

                        @if($delegate->voters()->count())
                            <li>
                                <a :class="{ 'button-active': selected === 'voters' }" @click="switchTab('voters')">Voters</a>
                            </li>
                        @endif
                    </ul>
                </div>

                <div class="tab-statuses" :class="{ hidden: selected !== 'statuses' }">
                    @include("front.delegate.partials.statuses")
                </div>

                <div class="tab-contributions" :class="{ hidden: selected !== 'contributions' }">
                    @include("front.delegate.partials.contributions")
                </div>

                <div class="tab-team-members" :class="{ hidden: selected !== 'team-members' }">
                    @include("front.delegate.partials.team-members")
                </div>

                <div class="tab-sharing" :class="{ hidden: selected !== 'sharing' }">
                    @include("front.delegate.partials.sharing")
                </div>

                <div class="tab-voting" :class="{ hidden: selected !== 'voting' }">
                    @include("front.delegate.partials.voting")
                </div>

                <div class="tab-servers" :class="{ hidden: selected !== 'servers' }">
                    @include("front.delegate.partials.servers")
                </div>

                <div class="tab-channels" :class="{ hidden: selected !== 'channels' }">
                    @include("front.delegate.partials.channels")
                </div>

                <div class="tab-voters" :class="{ hidden: selected !== 'voters' }">
                    @include("front.delegate.partials.voters")
                </div>
            </div>
        </delegate-tabs>
    </div>
@endsection

@section('sidebar')
    {{-- @include('layouts.sidebars.app') --}}
    @include('front.delegate._aside')
@endsection

@section('meta')
    {{-- Meta --}}
    @if($delegate->profile['details'])
        <meta name="description" itemprop="description" content="{{ str_limit($delegate->profile['details']) }}" />
    @else
        <meta name="description" itemprop="description" content="No information available" />
    @endif

    @if($delegate->tags->count())
        <meta name="keywords" content="{{ $delegate->tags->implode(',') }}" />
    @else
        <meta name="keywords" content="ark,delegates,crypto,currency,dpos,voters" />
    @endif

    {{-- Open Graph --}}
    @if($delegate->profile['details'])
        <meta name="og:description" content="{{ str_limit($delegate->profile['details']) }}" />
    @else
        <meta name="og:description" content="No information available" />
    @endif

    <meta property="og:title" content="ArkX Delegates - {{ $delegate->username }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:type" content="website" />
    <meta property="og:locale" content="{{ app()->getLocale() }}" />
    {{-- <meta property="og:locale:alternate" content="en-us" /> --}}
    <meta property="og:site_name" content="ArkX Delegates - {{ $delegate->username }}" />
    {{-- <meta property="og:image" content="http://delegates.arkx.io/cover.jpg" /> --}}
    {{-- <meta property="og:image:url" content="http://delegates.arkx.io/cover.jpg" /> --}}
    {{-- <meta property="og:image:size" content="300" /> --}}
@endsection
