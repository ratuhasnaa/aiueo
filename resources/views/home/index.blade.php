<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"><!--<![endif]-->
<head>

@include('home.css')
</head>
	<body class="header_sticky">
		
@include('home.preloader')

@include('home.header')

@include('home.section1')
		
@include('home.categories')
						
@include('home.partner')

@include('home.popup')

@include('home.footer')				

		<div class="button-go-top">
			<a href="#" title="" class="go-top">
				<i class="fa fa-chevron-up"></i>
			</a><!-- /.go-top -->
		</div><!-- /.button-go-top -->
		
		<!-- Javascript -->
	    <script type="text/javascript" src="javascript/jquery.min.js"></script>
	    <script type="text/javascript" src="javascript/bootstrap.min.js"></script>
	    <script type="text/javascript" src="javascript/easing.js"></script>
	    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtRmXKclfDp20TvfQnpgXSDPjut14x5wk&region=GB"></script>
   		<script type="text/javascript" src="javascript/gmap3.min.js"></script>
   		<script type="text/javascript" src="javascript/parallax.js"></script>
	    <script type="text/javascript" src="javascript/owl.carousel.js"></script>
	    <script type="text/javascript" src="javascript/main.js"></script>
		<script type="text/javascript" src="javascript/custom.js"></script>
		<script type="text/javascript" src="{{ asset('javascript/login.js') }}"></script>
		<script>
      document.addEventListener('DOMContentLoaded', function () {
    const loginForm = document.querySelector('#loginForm'); // Ganti dengan ID form login Anda
    if (loginForm) {
        const returnUrlInput = document.createElement('input');
        returnUrlInput.type = 'hidden';
        returnUrlInput.name = 'return_url';
        returnUrlInput.value = window.location.href; // URL halaman saat ini
        loginForm.appendChild(returnUrlInput);
    }
});

    </script>
		</body>
</html>