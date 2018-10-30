@component('layouts.master-with-sidebar')
    @include('nav.desktop')
    @include('nav.mobile')

    <div class="lg:pl-side-nav lg:pr-desktop-aside">
        @include('shared.alert-dashboard')
        @include('shared.errors')

        @guest
            <div class="px-6 pt-6">
                <em class="inline-block bg-yellow p-2">
                    If you are a delegate, consider <a href="{{ route('register') }}">registering</a> to update your information. Or, if you've already done that, <a href="{{ route('login') }}">login</a>.
                </em>
            </div>
        @endguest

        @yield('content')

        @section('sidebar')
            @include('layouts.sidebars.app')
        @endsection
    </div>
@endcomponent
