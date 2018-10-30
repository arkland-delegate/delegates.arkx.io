@component('layouts.master')
    <div class="page-auth xs:w-4/5 sm:w-2/3 md:w-1/2 lg:w-1/3 xl:w-1/4">
        <a href="{{ route('home') }}">
            <img src="/images/logo.svg" class="w-24 mt-24" />
        </a>

        <div class="content">
            @if (session()->has('alert.message'))
                <div class="mb-6">
                    @include('shared.alert')
                </div>
            @endif

            @if (count($errors) > 0)
                <div class="mb-6 -mx-6">
                    @include('shared.errors')
                </div>
            @endif

            @yield('content')
        </div>

        @yield('alert')

        @include('layouts.partials.copyright-footer')
    </div>
@endcomponent
