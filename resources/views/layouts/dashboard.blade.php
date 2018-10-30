@component('layouts.master-with-sidebar')
    @include('nav.desktop')
    @include('nav.mobile')

    <div class="lg:pl-side-nav lg:pr-desktop-aside">
        @include('shared.alert-dashboard')
        @include('shared.errors')

        @yield('content')

        @section('sidebar')
            @include('layouts.sidebars.app')
        @endsection
    </div>
@endcomponent
