<!-- right-navbar.blade.php -->
<ul class="navbar-nav ms-auto">
    @if(!Route::is('search')) 
    <div class="search position-relative">
         <form action="{{ route('search') }}" method="GET" class="d-flex">
             <input type="text" 
                    name="query" 
                    id="searchInput" 
                    class="form-control me-2" 
                    placeholder="Search" 
                    autocomplete="off"
                    required>
             <button type="submit" class="btn btn-sm btn-primary me-3">Search</button>
         </form>
         <div id="searchResults" class="position-absolute w-100 mt-1 d-none">
             <div class="list-group shadow">
                 <!-- Results will be inserted here -->
             </div>
         </div>
     </div>
     @endif
    <!-- Authentication Links -->
    @guest
        @if (Route::has('login'))
            <li class="nav-item ">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
        @endif

        @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
        @endif
    @else
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle dropdown-item border" href="#" role="button"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
            </a>

            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">

                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
    @endguest
</ul>
