<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - {{ config('app.name', 'Soundify') }}</title>
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
    <nav class="navbar navbar-dark bg-inverse">
        <div class="container">
            <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"></button>
            <div class="collapse navbar-toggleable-md" id="navbarResponsive">
                <a class="navbar-brand" href="/">{{ config('app.name', 'Soundify') }}</a>
                <form class="form-inline float-lg-left" method="get" action="/search">
                    <input class="form-control" type="text" name="query" placeholder="Tracks..">
                    <button class="btn btn-danger" type="submit">Search</button>
                </form>
                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav float-lg-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li class="nav-item"><a class="nav-link" href="{{ url('/login') }}">Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="/tracks/create">Upload</a></li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->username }} <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu" role="menu">
                                <a href="/users/{{ Auth::user()->username }}" class="dropdown-item">Profile</a>
                                <a href="/users/edit" class="dropdown-item">Settings</a>
                                <a href="/users/you/tracks" class="dropdown-item">Tracks</a>
                                <a class="dropdown-item" href="{{ url('/logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-3">@yield('title')</h1>
        </div>
    </div>
    <div class="container">
        @yield('content')
    </div>
    <script src="/js/app.js"></script>
    @yield('javascripts')
</body>
</html>
