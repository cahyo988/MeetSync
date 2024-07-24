<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MeetSync</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/LogoTA.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <script src="https://kit.fontawesome.com/25efff6b6b.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/countup.js@2.0.8"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">


</head>

<body>
    <div id="content" class="active">
        <nav class="navbar navbar-expand-lg">
            <button type="button" id="sidebarCollapse" class="btn btn-info">
                <i class="fa fa-bars"></i>
            </button>
            <div class="logo-container">
                <img src="{{ asset('assets/img/Logota.png') }}" alt="Logoe" width="40" class="nav-logo"
                    height="40">
                <span class="logo-text">MeetSYNC</span>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <img class="avatar-img rounded-circle"
                                        src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="User Profile"
                                        width="40" height="40">

                                        {{ Auth::user()->employee->nama }} | {{ Auth::user()->role->role }}

                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('user.profile.page') }}">
                                        {{ __('User Account') }}
                                    </a>
                                    <br>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Log in') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @endauth
                    @endif
                </ul>
            </div>
        </nav>
        @stack('scripts')
        @vite('resources/js/app.js')
        @include('Sidebar.sidebar')
        @yield('content')
    </div>
</body>


</html>
