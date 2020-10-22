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
<body class="bg-dark text-white">

<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-dark text-white border-bottom shadow-sm">
    <h5 class="my-0 mr-md-auto font-weight-normal">Books</h5>
    <nav class="my-2 my-md-0 mr-md-3">


        <div class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
                <div class="row">
                    <div class="col-sm">
                        <a class="nav-item btn btn btn-success" href="/">Home</a>
                    </div>
                    <div class="col-sm" >
                        <a class="nav-item btn btn btn-success" href="/about">Readers</a>
                    </div>

                    <div class="col-sm nav-item btn btn btn-success"">
                        <a class="text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </div>

                    <div class="col-sm">
                    @if (Route::has('register'))
                        <div class="col-sm nav-item btn btn btn-success">
                            <a class="text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </div>
                    </div>
                </div>
                @endif
                 @else
                   <div class="nav-item dropdown btn btn-success text-white">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="{{ route('logout') }}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right btn btn-success text-white    " aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                    </div>
                </div>
            @endguest
        </a>
    </nav>
    <a class="btn btn-info" href="/allogs">Log</a>
</div>
<div class="container mt-5">
    @yield('main_content')
</div>

</body>
</html>
