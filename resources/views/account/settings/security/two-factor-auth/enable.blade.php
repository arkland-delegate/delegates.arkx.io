@component('account.settings._layout')
    <div class="alert-info">
        In order to use two-factor authentication, you <strong>must</strong> install the
        <strong><a href="https://authy.com/download/" target="_blank">Authy</a></strong> application
        on your smartphone. Authy is available for iOS, Android, macOS and Windows.
    </div>

    <form method="POST" action="{{ route('account.settings.security.two-factor') }}">
        @csrf

        <div class="mt-6">
            <label>Country Code</label>
            <input type="text" name="country_code" required autofocus />
        </div>

        <div class="mt-6">
            <label>Phone</label>
            <input type="text" name="phone" required />
        </div>

        <div class="mt-6">
            <button class="button-grey" type="submit">Enable Two-Factor Authentication</button>
        </div>
    </form>
@endcomponent
