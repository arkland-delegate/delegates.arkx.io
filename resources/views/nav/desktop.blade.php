<nav class="left-nav lg:block">
    <div>
        <a class="brand" href="{{ route('home') }}" title="Home">
            <img src="/images/logo.svg" />
        </a>
    </div>

    <div class="nav-bar">
        <ul>
            {!! Menu::main() !!}

            {!! Menu::tools() !!}

            @role('delegate')
                {!! Menu::dashboard() !!}
            @endrole

            @auth
                {!! Menu::user() !!}
            @endauth

            @guest
                {!! Menu::auth() !!}
            @endauth
        </ul>
    </div>
</nav>
