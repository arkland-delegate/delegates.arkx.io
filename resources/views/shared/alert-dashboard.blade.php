@if (session()->has('alert.message'))
    <div class="m-6 mb-0">
        @include('shared.alert')
    </div>
@endif
