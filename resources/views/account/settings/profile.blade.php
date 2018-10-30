@component('account.settings._layout')
    <form method="POST" action="{{ route('account.settings.profile') }}">
        @csrf
        @method('PUT')

        <div class="mt-6">
            <label>E-Mail Address</label>
            <input type="email" name="email" value="{{ old('email', $currentUser->email) }}" required autofocus />
        </div>

        <div class="mt-6">
            <button class="button-grey">Save Changes</button>
        </div>
    </form>
@endcomponent
