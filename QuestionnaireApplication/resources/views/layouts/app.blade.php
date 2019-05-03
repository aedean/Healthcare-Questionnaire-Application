<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <script src="{{ asset('js/app.js') }}"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/customstyles.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <?php $applicationlogo = getApplicationLogo(); ?>
                    <?php if($applicationlogo != null): ?>
                    <img src="<?php echo url('/') . Storage::url($applicationlogo); ?>" alt="logo" class="app-logo navbar-brand mr-0 mr-md-2" />
                    <?php endif; ?>
                    
                    <ul class="nav navbar-nav">
                        &nbsp;
                        <li class="nav-link ">
                            <a class="nav-link app-name" href="<?php echo url('/') . '/questionnaires'; ?>"><?php echo getApplicationName(); ?></a>
                        </li>
                    </ul>

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    @if (!Auth::guest())
                        <ul class="nav navbar-nav">
                            &nbsp;
                            <li class="nav-link ">
                                <a class="nav-link " href="<?php echo url('/') . '/systemconfiguration' ?>">System Config</a>
                            </li>
                            &nbsp;
                            <li class="nav-link ">
                                <a class="nav-link " href="<?php echo url('/') . '/questionnaires' ?>">Questionnaires</a>
                            </li>
                            &nbsp;
                            <li class="nav-link ">
                                <a class="nav-link " href="<?php echo url('/') . '/users' ?>">Users</a>
                            </li>
                        </ul>
                    @endif

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <ul class="nav navbar-nav">
                                &nbsp;
                                <li class="nav-link ">
                                    <a class="nav-link " href="<?php echo url('/') . '/register' ?>">Register</a>
                                </li>
                            </ul>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <?php if(Auth::user()->firstname == ''): ?>
                                        {{ Auth::user()->username }} <span class="caret"></span>
                                    <?php else: ?>
                                        {{ Auth::user()->firstname }} {{ Auth::user()->lastname }} <span class="caret"></span>
                                    <?php endif; ?>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <div class="bd-example">
            @if(count($errors) > 0)
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger" role="alert">
                        {{$error}}
                    </div>
                @endforeach
            @endif

            @if(session('success'))
                <div class="alert alert-success" role="alert">
                    {{session('success')}}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger" role="alert">
                    {{session('error')}}
                </div>
            @endif
        </div>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript">
          if ('serviceWorker' in navigator ) {
            window.addEventListener('load', function() {
                navigator.serviceWorker.register('service-worker.js').then(function(registration) {
                    // Registration was successful
                    console.log('ServiceWorker registration successful with scope: ', registration.scope);
                }, function(err) {
                    // registration failed :(
                    console.log('ServiceWorker registration failed: ', err);
                });
            });
        }
    </script>
</body>
</html>
