<ul class="navbar-nav ms-auto">
    <!-- Authentication Links -->
    @guest
        @if (Route::has('login'))
            <li class="nav-item text-center {{ request()->routeIs('login') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
        @endif

        @if (Route::has('register'))
            <li class="nav-item text-center {{ request()->routeIs('register') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
        @endif
    @else
        @auth
            @if (Auth::user()->hasRole('Admin'))
                <li class="nav-item text-center {{ request()->routeIs('admin') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin') }}">Admin Panel</a>
                </li>
            @endif
        @endauth
        <li class="nav-item dropdown text-center">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
            </a>

            <div class="dropdown-menu dropdown-menu-end text-center" aria-labelledby="navbarDropdown">
                <a class="dropdown-item px-4 text-center" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
                @if(!Route::is('account.edit'))
                <a class="dropdown-item px-4 text-center btn btn-sm" href="{{ route('account.edit') }}">
                    Edit Account
                </a>
                @endif
                <form action="{{ route('account.delete') }}" method="POST"
                    onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Delete My Account</button>
                </form>

            </div>
        </li>
    @endguest

        <div class="search position-relative text-center d-flex justify-content-center mt-2 mt-md-0">
            @include('shared.search-form')
            <div id="searchResults" class="position-absolute w-100 mt-1 d-none">
                <div class="list-group shadow">
                    <!-- Results will be inserted here -->
                </div>
            </div>
        </div>
</ul>
