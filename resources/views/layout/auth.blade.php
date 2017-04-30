
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/apple-icon.png') }}">
	<link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Login Page - Material Kit PRO by Creative Tim</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
	<!--     Fonts and icons     -->
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

	<!-- CSS Files -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/material-kit.min.css?v=1.1.0') }}" rel="stylesheet"/>
</head>

<body class="login-page">

	<div class="page-header header-filter" style="background-image: url('{{ asset('img/bg7.jpg') }}'); background-size: cover; background-position: top center;">
		<div class="container">
			<div class="row">
                @yield('content')
			</div>
		</div>
		<footer class="footer">
	        <div class="container">
	            <nav class="pull-left">
					<ul>
						<li>
							<a href="http://www.creative-tim.com">
								Creative Tim
							</a>
						</li>
						<li>
							<a href="http://presentation.creative-tim.com">
							   About Us
							</a>
						</li>
						<li>
							<a href="http://blog.creative-tim.com">
							   Blog
							</a>
						</li>
						<li>
							<a href="http://www.creative-tim.com/license">
								Licenses
							</a>
						</li>
					</ul>
	            </nav>
	            <div class="copyright pull-right">
	                &copy; <script>document.write(new Date().getFullYear())</script>, made with <i class="fa fa-heart heart"></i> by <a href="http://www.creative-tim.com" target="_blank">Creative Tim</a>
	            </div>
	        </div>
	    </footer>

	</div>

</body>
	<!--   Core JS Files   -->

    <script src="{{ asset('js/app.js') }}"></script>
	<!-- <script src="{{ asset('js/jquery.min.js') }}" type="text/javascript"></script> -->
	<!-- <script src="{{ asset('js/bootstrap.min.js') }}" type="text/javascript"></script> -->
	<script src="{{ asset('js/material.min.js') }}"></script>

	<!--    Plugin for Date Time Picker and Full Calendar Plugin   -->
	<script src="{{ asset('js/moment.min.js') }}"></script>

	<!--	Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/   -->
	<script src="{{ asset('js/nouislider.min.js') }}" type="text/javascript"></script>

	<!--	Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker   -->
	<script src="{{ asset('js/bootstrap-datetimepicker.js') }}" type="text/javascript"></script>

	<!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select   -->
	<script src="{{ asset('js/bootstrap-selectpicker.js') }}" type="text/javascript"></script>

	<!--	Plugin for Tags, full documentation here: http://xoxco.com/projects/code/tagsinput/   -->
	<script src="{{ asset('js/bootstrap-tagsinput.js') }}"></script>

	<!--	Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput   -->
	<script src="{{ asset('js/jasny-bootstrap.min.js') }}"></script>

	<!--    Plugin for 3D images animation effect, full documentation here: https://github.com/drewwilson/atvImg    -->
	<script src="{{ asset('js/atv-img-animation.js') }}" type="text/javascript"></script>

	<!--    Control Center for Material Kit: activating the ripples, parallax effects, scripts from the example pages etc    -->
	<script src="{{ asset('js/material-kit.min.js?v=1.1.0') }}" type="text/javascript"></script>
</html>
