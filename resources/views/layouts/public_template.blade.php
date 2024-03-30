<!DOCTYPE HTML><!--
	Justice by freehtml5.co
	Twitter: http://twitter.com/fh5co
	URL: http://freehtml5.co
--><html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
@yield('extra_meta')
	<title>{{ isset($pageTitle) ? ($pageTitle . ' |') : '' }} {{ config('app.name') }}</title>
    <link rel="icon" href="{{ asset('storage/public_template/images/' . $siteSettingsMiddlewareData->favicon_logo) }}">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Free HTML5 Website Template by FreeHTML5.co" />
	<meta name="keywords" content="free website templates, free html5, free template, free bootstrap, free website template, html5, css3, mobile first, responsive" />
	<meta name="author" content="FreeHTML5.co" />

  	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400, 900" rel="stylesheet"> -->
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="{{ asset('storage/public_template/css/animate.css') }}">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="{{ asset('storage/public_template/css/icomoon.css') }}">
	<!-- Themify Icons-->
	<link rel="stylesheet" href="{{ asset('storage/public_template/css/themify-icons.css') }}">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="{{ asset('storage/public_template/css/bootstrap.css') }}">
	<!-- Magnific Popup -->
	<link rel="stylesheet"  href="{{ asset('storage/public_template/css/magnific-popup.css') }}">
	<!-- Owl Carousel  -->
	<link rel="stylesheet"  href="{{ asset('storage/public_template/css/owl.carousel.min.css') }}">
	<link rel="stylesheet"  href="{{ asset('storage/public_template/css/owl.theme.default.min.css') }}">
	<!-- Flexslider -->
	<link rel="stylesheet"  href="{{ asset('storage/public_template/css/flexslider.css') }}">
	<!-- Theme style  -->
	<link rel="stylesheet"  href="{{ asset('storage/public_template/css/style.css') }}">

	<!-- Modernizr JS -->
	<script src="{{ asset('storage/public_template/js/modernizr-2.6.2.min.js') }}"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	<!-- reCaptcha -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

	</head>
	<body>
		
	<div class="gtco-loader"></div>
	
	<div id="page">
	<nav class="gtco-nav" role="navigation">
		<div class="container">
			<div class="row">
				<div class="col-sm-2 col-xs-12">
					<div id="gtco-logo"><a href="{{ route('index') }}">Just<em>ice</em></a></div>
				</div>
				<div class="col-xs-10 text-right menu-1 main-nav">
					<ul>
						<li class="active"><a href="#" data-nav-section="home">Home</a></li>
						<li><a href="#" data-nav-section="about">About</a></li>
						<li><a href="#" data-nav-section="practice-areas">Practice Areas</a></li>
						<li><a href="#" data-nav-section="our-team">Our Team</a></li>
						<li class="btn-cta"><a href="#" data-nav-section="contact"><span>Contact</span></a></li><?php /*
						<li class="btn-cta"><a href="{{ route('contactus') }}" data-nav-section="contact"><span>Contact</span></a></li><?php /*
						<!-- For external page link -->
						<!-- <li><a href="http://freehtml5.co/" class="external">External</a></li> -->*/ ?>
					</ul>
				</div>
			</div>
			
		</div>
	</nav>

@yield('main_contents')
	
	<footer id="gtco-footer" role="contentinfo">
		<div class="container">
			
			<div class="row copyright">
				<div class="col-md-12">
					<p class="text-center">
						Template edited by <a href="#">Wasiu Adisa</a> | <a>{{ config('app.name') }}</a> demo is developed by <a href="#" target="_blank">Wasiu Adisa</a>
					</p>
					<p class="pull-left">
						<small class="block">&copy; 2016 Free HTML5. All Rights Reserved.</small> 
						<small class="block">Designed by <a href="http://freehtml5.co/" target="_blank">FreeHTML5.co</a> Demo Images: <a href="http://unsplash.co/" target="_blank">Unsplash</a></small>
					</p>
					<p class="pull-right">
						<ul class="gtco-social-icons text-center">
							<a href="{{ route('login') }}" >Admin Login</a>
						</ul>
						<ul class="gtco-social-icons pull-right">
							<li><a href="{{ $siteSettingsMiddlewareData->url_twitter }}"><i class="icon-twitter"></i></a></li>
							<li><a href="{{ $siteSettingsMiddlewareData->url_facebook }}"><i class="icon-facebook"></i></a></li>
							<li><a href="{{ $siteSettingsMiddlewareData->url_linkedin }}"><i class="icon-linkedin"></i></a></li>
							<li><a href="{{ $siteSettingsMiddlewareData->url_picassa }}"><i class="icon-dribbble"></i></a></li>
						</ul>
					</p>
				</div>
			</div>

		</div>
	</footer>
	</div>

    <!-- Bootstrap 5 -->
    <div class="floating-button-div">
        <a id="button" class="btn btn-dark" style="background-color: black; padding: 10px; color: white; top:40%;right:1%;position:fixed;z-index: 9999" href="../../../">Developer Website</a>
    </div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
	</div>
	
	<!-- Custom script -->
	<script>
/*		window.onload = function(event)
		{
			var errorOrMessageTop = document.getElementById("errorOrMessage");

			if(errorOrMessageTop) {
				e.preventDefault();
				window.scroll(0, errorOrMessageTop.offsetTop);
			}
		}
*/	</script>
	<!-- ./end of Custom script -->

	<!-- jQuery -->
	<script src="{{ asset('storage/public_template/js/jquery.min.js') }}"></script>
	<!-- jQuery Easing -->
	<script src="{{ asset('storage/public_template/js/jquery.easing.1.3.js') }}"></script>
	<!-- Bootstrap -->
	<script src="{{ asset('storage/public_template/js/bootstrap.min.js') }}"></script>
	<!-- Waypoints -->
	<script src="{{ asset('storage/public_template/js/jquery.waypoints.min.js') }}"></script>
	<!-- Stellar -->
	<script src="{{ asset('storage/public_template/js/jquery.stellar.min.js') }}"></script>
	<!-- Magnific Popup -->
	<script src="{{ asset('storage/public_template/js/jquery.magnific-popup.min.js') }}"></script>
	<script src="{{ asset('storage/public_template/js/magnific-popup-options.js') }}"></script>
	<!-- Main -->
	<script src="{{ asset('storage/public_template/js/main.js') }}"></script>

	</body>
</html>