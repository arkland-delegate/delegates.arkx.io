@component('layouts.master')
    @include('nav.desktop')
    @include('nav.mobile')

    <div class="lg:pl-side-nav lg:pr-desktop-aside">
        @include('shared.alert-dashboard')
        @include('shared.errors')

        @yield('content')

        @yield('sidebar')
    </div>
@endcomponent
