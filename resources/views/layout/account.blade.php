<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="keywords" content="">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,500,700,800'>

    <!-- Styles -->
    <!-- Font Awesome css -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Css animations  -->
    @yield('head')
    
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <!-- Theme stylesheet, if possible do not edit this stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/style.default.css') }}">
    <!-- Custom stylesheet - for your changes -->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    <!-- Responsivity for older IE -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Favicon and apple touch icons-->
    <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon" />

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>

    <div id="all">

        @include('layout.account_nav')

        @yield('breadcrumbs')

        <div id="content">
            <div class="container">

                @if (session('success'))

                    @component('components.alert.dismissible')
                        @slot('style')
                            success
                        @endslot

                        @slot('messaage')
                            {{ session('success') }}
                        @endslot
                    @endcomponent

                @elseif (session('warning'))

                    @component('components.alert.dismissible')
                        @slot('style')
                            warning
                        @endslot

                        @slot('messaage')
                            {{ session('warning') }}
                        @endslot
                    @endcomponent
                    
                @endif
        
                <div class="row">

                    @yield('content')

                </div>

            </div>
        </div>

        @yield('account_footer')

    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/front.js') }}"></script>
    @yield('script')
    
</body>
</html>