@if (session()->has('alert.message'))
    <div class="alert-{{ session()->get('alert.style') }}" role="alert">
        {!! session()->get('alert.message') !!}
    </div>
@endif
