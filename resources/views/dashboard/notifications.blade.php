@extends('layouts.dashboard')

@section('content')
    <div class="flex justify-between px-6 py-6 pt-6">
        <h2>Notifications</h2>
    </div>

    <div class="px-6">
        <ul class="tabs">
            {!! Menu::notificationTabs() !!}
        </ul>

        @if($notifications->count())
            @foreach ($notifications as $notification)
                <notification :notification='{!! json_encode($notification) !!}'></notification>
            @endforeach

            <div class="-mx-6">
                {{ $notifications->links() }}
            </div>
        @else
            <div class="alert-warning mt-6 mb-0" role="alert">
                There are no notifications for your account.
            </div>
        @endif
    </div>
@endsection
