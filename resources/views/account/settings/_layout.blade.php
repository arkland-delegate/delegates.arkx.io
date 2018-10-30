@extends('layouts.dashboard')

@section('content')
    <div class="p-6">
        <h2>Settings</h2>

        <div class="mt-6">
            <ul class="tabs">
                {!! Menu::settingTabs() !!}
            </ul>
        </div>
    </div>

    <div class="px-6 w-full lg:w-3/5">
        {{ $slot }}
    </div>
@endsection
