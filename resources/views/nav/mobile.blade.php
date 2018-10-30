{{-- Top-Nav --}}
<nav class="flex lg:hidden shadow h-16 bg-white w-full sticky pin-t">
    <div class="flex flex-no-shrink">
        <img class="inline-block h-16 w-auto" src="/images/logo.svg" />
    </div>

    <div class="flex justify-around sm:justify-between items-center w-full">
        <ul class="list-reset sm:pl-6">
            <li class="mr-6" @click="toggleMenu">
                <i class="far fa-bars text-blue-light"></i>
                <span class="hidden sm:inline-block text-blue-light">Menu</span>
            </li>
        </ul>

        @guest
            <ul class="flex list-reset">
                <li class="p-6 border-r border-grey-light">
                    <a href="{{ route('login') }}" class="text-blue-lighter">
                        <i class="far fa-sign-in"></i>
                    </a>
                </li>
                <li class="p-6 pr-0">
                    <a href="{{ route('register') }}" class="text-blue-lighter">
                        <i class="far fa-user-plus"></i>
                    </a>
                </li>
            </ul>
        @else
            <ul class="flex list-reset">
                <li class="p-6 border-r border-grey-light">
                    <a href="{{ route('dashboard.notifications') }}" class="text-blue-lighter notification-badge-mobile">
                        <i class="far fa-bell"></i>
                        <span>{{ $unreadNotifications }}</span>
                    </a>
                </li>

                <li class="p-6 pr-0 sm:pr-6">
                    <a href="{{ route('logout') }}" class="text-blue-lighter">
                        <i class="far fa-sign-out"></i>
                    </a>
                </li>
            </ul>
        @endauth
    </div>
</nav>

<div class="nav-mobile" :class="{ hidden: !showMobileMenu }">
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
