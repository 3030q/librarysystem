<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="bg-info text-white">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a href="/"><img class="p-1" src="/image/study.png" alt="icon" width="50" height="50"></a>
    <a class="navbar-brand" href="/">Librarysystem</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ml-auto">
            @guest
                <li class="nav-item active">
                    <a class="nav-link" href="{{route('login')}}">Login</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/userregister">Register</a>
                </li>
            @else
                @if(Auth::user()->role == 'admin')
                    <li class="nav-item">
                        <a class="nav-link" href="/library">Library</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/readers">Readers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/records">All record</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="/library">Library</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/takenbook">Taken Book</a>
                    </li>
                @endif
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->first_name }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="/profile">Profile</a>
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
    </div>
</nav>
<div class="container mt-5">
    @yield('main_content')
</div>

</body>
</html>
