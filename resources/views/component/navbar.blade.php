<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container-fluid px-4">
        <!-- Brand Name -->
        <a class="navbar-brand d-flex align-items-center" href="{{ route('homePage') }}">
            <i class="bi bi-people-fill me-2"></i><strong>Connect Friend</strong>
        </a>

        <!-- Navbar Toggle for Mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Menu Items -->
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('homePage') ? 'active' : '' }}" href="{{ route('homePage') }}">
                        <i class="bi bi-house-fill me-1"></i>@lang('lang.home')
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('friendPage') ? 'active' : '' }}" href="{{ route('friendPage') }}">
                        <i class="bi bi-person-fill me-1"></i>@lang('lang.friend')
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('avatarMarketPage') ? 'active' : '' }}" href="{{ route('avatarMarketPage') }}">
                        <i class="bi bi-shop me-1"></i>Avatar
                    </a>
                </li>
                @auth
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('chat*') ? 'active' : '' }}" href="{{ route('chatPage') }}">
                        <i class="bi bi-chat-dots-fill me-1"></i>Chat
                    </a>
                </li>
                @endauth
            </ul>
        </div>

        <!-- Navbar Right Section -->
        <div class="d-flex align-items-center">
            <!-- Language Dropdown -->
            <div class="dropdown me-3">
                <button class="btn btn-outline-light dropdown-toggle" type="button" id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ app()->getLocale() == 'en' ? 'EN' : 'ID' }}
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">
                    @if(app()->getLocale() != 'en')
                        <li><a class="dropdown-item" href="{{ route('set-locale', 'en') }}">EN</a></li>
                    @endif
                    @if(app()->getLocale() != 'id')
                        <li><a class="dropdown-item" href="{{ route('set-locale', 'id') }}">ID</a></li>
                    @endif
                </ul>
            </div>

            @auth
            <!-- Coins Display -->
            <div class="mx-2">
                <span class="text-light">Coins: <strong>{{ Auth::user()->coin }}</strong></span>
            </div>

            <!-- Notifications -->
            <div class="me-3">
                <a href="{{ route('notificationPage') }}" class="d-block text-decoration-none">
                    <i class="bi bi-bell-fill text-light" style="font-size: 1.5rem;"></i>
                </a>
            </div>

            <!-- Profile Dropdown -->
            <div class="dropdown">
                <a href="#" class="d-block text-decoration-none dropdown-toggle" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ Auth::user()->profile_picture ?: asset('assets/images/default-avatar.png') }}" alt="Profile" class="rounded-circle" style="height: 40px; width: 40px;">
                </a>
                <ul class="dropdown-menu dropdown-menu-end text-small" aria-labelledby="profileDropdown">
                    <li><strong class="px-3 d-block text-truncate" style="max-width: 180px;">{{ Auth::user()->name }}</strong></li>
                    <li><a class="dropdown-item" href="{{ route('myProfilePage') }}">@lang('lang.profile')</a></li>
                    <li><a class="dropdown-item" href="{{ route('friendRequestPage') }}">@lang('lang.friend_request')</a></li>
                    <li><a class="dropdown-item" href="{{ route('topupPage') }}">@lang('lang.top_up') Coin</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="dropdown-item" type="submit">@lang('lang.logout')</button>
                        </form>
                    </li>
                </ul>
            </div>
            @endauth

            @guest
            <!-- Login Button -->
            <div class="d-flex">
                <a href="{{ route('loginPage') }}" class="btn btn-light">@lang('lang.login')</a>
            </div>
            @endguest
        </div>
    </div>
</nav>
