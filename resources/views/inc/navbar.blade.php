<nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm navbar-custom">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>



        <div class="d-flex flex-row order-2 order-lg-3">
            @auth
            @if (Route::getCurrentRoute()->uri() =='home')
            <ul class="navbar-nav flex-row">
                <li class="nav-item">
                    <div class="container" id="sidenav-btn">
                        <span style="font-size:30px; cursor:pointer" onclick="openNav()" title="Your Profile"><i
                                class="fa fa-user-circle" style="color: white; font-size:25px;"></i></span>
                    </div>
                </li>
            </ul>
            @endif
            @endauth
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>



        <div class="collapse navbar-collapse order-3 order-lg-2" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">


                <!-- Authentication Links -->
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
                @endif
                @else
                @if (Route::getCurrentRoute()->uri() !='home')
                <li class="nav-item">
                    <a href="{{ url('/home') }}" class="mr-5"><i class="fa fa-home mt-1"
                            style="font-size: 30px;"></i></a>
                </li>
                @endif
                <li class="nav-item">
                    <a href="{{ url('/post/create') }}" title="Create a new post" class="mr-5"><i
                            class="fa fa-pencil-square-o mt-2" style="font-size: 25px;"></i></a>
                </li>
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>