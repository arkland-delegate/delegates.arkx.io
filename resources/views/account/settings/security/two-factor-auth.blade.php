@component('account.settings._layout')
    @includeWhen(!$currentUser->uses_two_factor_auth, 'account.settings.security.two-factor-auth.enable')
    @includeWhen($currentUser->uses_two_factor_auth, 'account.settings.security.two-factor-auth.disable')
@endcomponent
