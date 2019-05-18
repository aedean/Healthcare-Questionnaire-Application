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
    <link href="{{ asset('css/customstyles.scss') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <div class="nav-container">
            <nav class="custom-nav navs">
                <div class="layer-one navs">
                    <div class="app-nav-data">
                        <?php $applicationlogo = getApplicationLogo(); ?>
                            <?php if($applicationlogo != null): ?>
                            <img src="<?php echo url('/') . Storage::url($applicationlogo); ?>" alt="logo" class="app-logo navbar-brand mr-0 mr-md-2" />
                        <?php endif; ?>
                        <h3 class="app-name-header"><a class="nav-link app-name" href="<?php echo url('/') . '/questionnaires'; ?>"><?php echo getApplicationName(); ?></a></h3>
                    </div>
                </div>
                <div class="my-lg-0 layer-two navs">
                    <div class="content">
                        <div class="icon-row">
                            <span class="icon-vertical"><a class="active" href="questionnaires">
                                <i class="fa fa-fw q-icon icons"></i>
                                </a>
                            </span>
                            <span class="icon-span">Questionnaires</span>
                        </div>
                        <div class="icon-row">
                            <span class="icon-vertical"><a class="active" href="#">
                                <i class="fa fa-fw more-icon icons"></i>
                                </a>
                            </span>
                            <span class="icon-span">More</span>
                        </div>
                    </div>
                </div>
            </nav>
            <div class="my-lg-0 layer-three">
                <div class="content">
                    <div class="icon-row">
                        <span class="icon-vertical">
                            <a class="active" href="<?php echo url('/') . '/user' ?>">
                                <i class="fa fa-fw user-icon icons"></i>
                            </a>
                        </span>
                        <span class="icon-span">Users</span>
                    </div>
                    <div class="icon-row">
                        <span class="icon-vertical">
                            <a class="active" href="<?php echo url('/') . '/patients' ?>">
                                <i class="fa fa-fw patient-icon icons"></i>
                            </a>
                        </span>
                        <span class="icon-span">Patients</span>
                    </div>
                    <div class="icon-row">
                        <span class="icon-vertical"><a class="active" href="<?php echo url('/') . '/systemconfiguration' ?>">
                            <i class="fa fa-fw config-icon icons"></i>
                            </a>
                        </span>
                        <span class="icon-span">System Configuration</span>
                    </div>
                    <div class="icon-row">
                        <span class="icon-vertical">
                            <a class="active" href="<?php echo url('/') . '/questionnaireresults' ?>">
                                <i class="fa fa-fw result-icon icons"></i>
                            </a>
                        </span>
                        <span class="icon-span">Results</span>
                    </div>
                    <div class="icon-row">
                        <span class="icon-vertical"><a class="active" href="<?php echo url('/') . '/home' ?>">
                            <i class="fa fa-fw home-icon icons"></i>
                            </a>
                        </span>
                        <span class="icon-span">Home</span>
                    </div>
                </div>
            </div>
        </div>
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
    <script src="{{ asset('js/nav.js') }}"></script>
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
