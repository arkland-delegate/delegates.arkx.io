@component('account.settings._layout')
    <form method="POST" action="{{ route('account.settings.security.password') }}">
        @csrf
        @method('PUT')

        <div class="mt-6">
            <label>Current Password</label>
            <input type="password" name="current_password" required autofocus />
        </div>

        <div class="mt-6">
            <label>New Password</label>
            <input type="password" name="password" required />
        </div>

        <div class="mt-6">
            <label>Confirm Password</label>
            <input type="password" name="password_confirmation" required />
        </div>

        <div class="mt-6">
            <button class="button-grey" type="submit">Save Changes</button>
        </div>
    </form>
@endcomponent
