<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'Laravel') }}@yield('title')</title>

	<!-- Styles -->
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('css/common.css') }}" rel="stylesheet">

	<!-- jQuery読み込み -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<!-- BootstrapのJS読み込み -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	
</head>

  <!-- Branding Image -->
  <!--<a class="navbar-brand" href="{{ url('/') }}">-->
  <a class="el_headerLogo" href="{{ url('/') }}">
      <!--{{ config('app.name', 'Laravel') }}-->
      <svg version="1.1" class="el_headerLogo_img" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
           y="0px" viewBox="0 0 187.438 160.121" enable-background="new 0 0 187.438 160.121"
           xml:space="preserve">
      <path class="el_headerLogo_part el_headerLogo_part__1" fill="" d="M113.625,112.122l29.404,24.475c0,0-9.094,5.518-13.874,1.875c-4.781-3.643-40.536-33.21-40.536-33.21
          l3.816-5.219l15.101,1.66L113.625,112.122z"/>
      <path class="el_headerLogo_part el_headerLogo_part__2" fill="" d="M8,71.611l-8-14.5c0,0,10-33,40.5-46s61-11,61-11l-6,58.5l-53,2l-13,13h-10L8,71.611z"/>
      <polygon class="el_headerLogo_part el_headerLogo_part__3" fill="" points="19.5,72.611 19.705,86.689 63,107.611 82.588,106.536 137.5,92.111 145,59.111 95.5,57.611 
          42.5,59.611 29,72.611 "/>
      <polygon class="el_headerLogo_part el_headerLogo_part__4" fill="" points="101.5,0.111 140.298,7.558 160.648,30.184 187.438,51.445 187.213,86.4 176.677,91.375 
          137.163,93.037 123,60.861 95.5,58.611 "/>
      <polygon class="el_headerLogo_part el_headerLogo_part__5" fill="" points="176.677,91.375 166,111.611 127.672,114.943 119.174,116.741 93.736,103.607 137.163,92.037 "/>
      <path class="el_headerLogo_part el_headerLogo_part__6" fill="" d="M140.298,6.558"/>
      <path class="el_headerLogo_part el_headerLogo_part__7" fill="" d="M35.575,156.111c0,0,79.5-18.5,132-6.5c0,0,19,5.5-19,6.5S7.075,164.611,35.575,156.111z"/>
      </svg>
  </a>

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


				</div>

				<div class="collapse navbar-collapse" id="app-navbar-collapse">
					<!-- Left Side Of Navbar -->
					<ul class="nav navbar-nav">
						&nbsp;
					</ul>

					<!-- Right Side Of Navbar -->
					<ul class="nav navbar-nav navbar-right">
						<!-- Authentication Links -->
						@if (Auth::guest())
							<li><a href="{{ route('login') }}">Login</a></li>
							<li><a href="{{ route('register') }}">Register</a></li>
						@else
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
									{{ Auth::user()->name }} <span class="caret"></span>
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
<body id="@yield('slug')">