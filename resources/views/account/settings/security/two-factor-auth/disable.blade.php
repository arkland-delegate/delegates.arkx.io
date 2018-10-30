@component('account.settings._layout')
    @if (session('resetCode'))
        <div class="alert-warning">
            Here is your Two-Factor Authentication emergency token. This is the only time it will be shown so don't lose it! <strong>{{ session('resetCode') }}</strong>
        </div>
    @endif

    <form method="POST" action="{{ route('account.settings.security.two-factor') }}">
        @csrf
        @method('DELETE')

        <div class="mt-6">
            <button class="button-red" type="submit">Disable Two-Factor Authentication</button>
        </div>
    </form>
@endcomponent
