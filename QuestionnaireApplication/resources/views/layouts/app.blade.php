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

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        How are you feeling?
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
                    <!-- <ul class="nav navbar-nav navbar-right">
                        @if (Auth::guest())
                            <ul class="nav navbar-nav">
                                &nbsp;
                                <li class="nav-link ">
                                    <a class="nav-link " href="<?php echo url('/') . '/register' ?>">Register</a>
                                </li>
                            </ul>
                        @else
                        <ul class="nav-element-right">
                            <a class="btn btn-bd-download d-none d-lg-inline-block mb-3 mb-md-0 ml-md-3" href="<?php echo url('/') . '/register' ?>">Account</a>
                            <a class="btn btn-bd-download d-none d-lg-inline-block mb-3 mb-md-0 ml-md-3" href="<?php echo url('/') . '/home' ?>">Home</a>
                        </ul>
                        @endif
                    </ul> -->
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
</body>
</html>
