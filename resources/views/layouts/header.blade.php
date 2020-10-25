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

<div class="d-flex flex-column flex-md-row align-items-center p-2 px-md-3 mb-3 bg-dark text-white border-bottom shadow-sm">
    <img class="p-1" src="image/study.png" alt="icon" width="50" height="50">
    <h5 class="my-0 mr-md-auto font-weight-normal">Librasystem</h5>
    <nav class="my-2 my-md-0 mr-md-3">


        <div class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
                <div class="row">
                    <div class="col-sm ">
                        <a class="nav-item btn btn btn-success" href="/">Home</a>
                    </div>
                    <div class="col-sm" >
                        <a class="nav-item btn btn btn-success" href="/about">Readers</a>
                    </div>

                    <div class="col-sm nav-item btn btn btn-success">
                        <a class="text-white" href="/">{{ __('Login') }}</a>
                    </div>

                    <div class="col-sm">
                    @if (Route::has('register'))
                        <div class="col-sm nav-item btn btn btn-success">
                            <a class="text-white" href="/userregister">{{ __('Register') }}</a>
                        </div>
                    </div>
                </div>
                @endif
                 @else
                    <div class="nav-item dropdown btn btn-info text-white">
                       <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="{{ route('logout') }}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->first_name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right btn btn-success text-white " aria-labelledby="navbarDropdown">
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
    <a class=" p-3 btn btn-info" href="/allogs">Take book</a>
</div>
<div class="container mt-5">
    @yield('main_content')
</div>

</body>
</html>
