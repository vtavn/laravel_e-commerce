<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home</title>
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/favicon.ico') }}">
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,400italic,700,700italic,900,900italic&amp;subset=latin,latin-ext" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Open%20Sans:300,400,400italic,600,600italic,700,700italic&amp;subset=latin,latin-ext" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/animate.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/owl.carousel.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/flexslider.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/chosen.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/color-01.css') }}">
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
  @livewireStyles
</head>
<body class="home-page home-01 ">

	<!-- mobile menu -->
    <div class="mercado-clone-wrap">
        <div class="mercado-panels-actions-wrap">
            <a class="mercado-close-btn mercado-close-panels" href="#">x</a>
        </div>
        <div class="mercado-panels"></div>
    </div>

	<!--header-->
	<header id="header" class="header header-style-1">
		<div class="container-fluid">
			<div class="row">
				<div class="topbar-menu-area">
					<div class="container">
						<div class="topbar-menu left-menu">
							<ul>
								<li class="menu-item" >
									<a title="Hotline: (+123) 456 789" href="#" ><span class="icon label-before fa fa-mobile"></span>Hotline: (+123) 456 789</a>
								</li>
							</ul>
						</div>
						<div class="topbar-menu right-menu">
							<ul>
								<li class="menu-item lang-menu menu-item-has-children parent">

									@if (Session::get('website_language')=='vi')
										<a title="Tiếng Việt" href="#">
											<span class="img label-before">
												<img src="{{ asset('assets/images/lang-vn.png') }}" width="20" alt="lang-vi">
											</span>
											Tiếng Việt<i class="fa fa-angle-down" aria-hidden="true"></i>
										</a>
									@else
										<a title="English" href="#">
											<span class="img label-before">
												<img src="{{ asset('assets/images/lang-en.png') }}" width="20" alt="lang-en">
											</span>
											English<i class="fa fa-angle-down" aria-hidden="true"></i>
										</a>
									@endif
									<ul class="submenu lang" >
										<li class="menu-item" ><a title="Việt Nam" href="{!! route('user.change-language', ['vi']) !!}"><span class="img label-before"><img src="{{ asset('assets/images/lang-vn.png') }}" width="20" alt="lang-vi"></span>Việt Nam</a></li>
										<li class="menu-item" ><a title="English" href="{!! route('user.change-language', ['en']) !!}"><span class="img label-before"><img src="{{ asset('assets/images/lang-en.png') }}" width="20" alt="lang-en"></span>English</a></li>
									</ul>
								</li>
		
								@if (Route::has('login'))
									@auth
										@if (Auth::user()->roles === 'admin')
											<li class="menu-item menu-item-has-children parent" >
												<a title="{{ __('My Account') }}" href="#">{{ __('My Account') }} ({{Auth::user()->name}}) <i class="fa fa-angle-down" aria-hidden="true"></i></a>
												<ul class="submenu curency" >
													<li class="menu-item" >
														<a title="Dashboard" href="{{ route('admin.dashboard') }}">Dashboard</a>
													</li>
													<li class="menu-item" >
														<a title="Categories" href="{{ route('admin.categories') }}">Categories</a>
													</li>
													<li class="menu-item" >
														<a title="Products" href="{{ route('admin.products') }}">Products</a>
													</li>
													<li class="menu-item" >
														<a title="Home Slider" href="{{ route('admin.homeslider') }}">Home Slider</a>
													</li>
													<li class="menu-item" >
														<a title="Home Categories Products" href="{{ route('admin.homecategories') }}">Home Categories Products</a>
													</li>
													<li class="menu-item" >
														<a title="Sale Time" href="{{ route('admin.sale') }}">Sale Time</a>
													</li>
													<li class="menu-item" >
														<a title="Coupons" href="{{ route('admin.coupons') }}">Coupons</a>
													</li>
													<li class="menu-item" >
														<a title="Manger Orders" href="{{ route('admin.orders') }}">Manger Orders</a>
													</li>
													<li class="menu-item" >
														<a title="Contacts Message" href="{{ route('admin.contact') }}">Contacts Message</a>
													</li>
													<li class="menu-item" >
														<a title="Manager Attributes" href="{{ route('admin.attributes') }}">Manager Attributes</a>
													</li>
													<li class="menu-item" >
														<a title="Admin Setting" href="{{ route('admin.settings') }}">Settings</a>
													</li>
													<li class="menu-item">
														<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
													</li>
													<form id="logout-form" action="{{ route('logout') }}" method="post">
														@csrf
													</form>
												</ul>
											</li>
										@else
											<li class="menu-item menu-item-has-children parent" >
												<a title="{{ __('My Account') }}" href="#">{{ __('My Account') }} ({{Auth::user()->name}}) <i class="fa fa-angle-down" aria-hidden="true"></i></a>
												<ul class="submenu curency" >
													<li class="menu-item" >
														<a title="{{ __('Dashboard') }}" href="{{ route('user.dashboard') }}">{{ __('Dashboard') }}</a>
													</li>
													<li class="menu-item" >
														<a title="{{ __('Profile') }}" href="{{ route('user.profile') }}">{{ __('Profile') }}</a>
													</li>
													<li class="menu-item" >
														<a title="{{ __('My Orders') }}" href="{{ route('user.orders') }}">{{ __('My Orders') }}</a>
													</li>
													<li class="menu-item" >
														<a title="{{ __('Change Password') }}" href="{{ route('user.change-password') }}">{{ __('Change Password') }}</a>
													</li>
													<li class="menu-item">
														<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
													</li>
													<form id="logout-form" action="{{ route('logout') }}" method="post">
														@csrf
													</form>
												</ul>
											</li>
										@endif
									@else
										<li class="menu-item" ><a title="{{ __('Login') }}" href="{{ route('login') }}">{{ __('Login') }}</a></li>
										<li class="menu-item" ><a title="{{ __('Register') }}" href="{{ route('register') }}">{{ __('Register') }}</a></li>
									@endif
								@endif
							</ul>
						</div>
					</div>
				</div>

				<div class="container">
					<div class="mid-section main-info-area">

						<div class="wrap-logo-top left-section">
							<a href="/" class="link-to-home"><img src="{{ asset('assets/images/logo-top-1.png') }}" alt=""></a>
						</div>

						@livewire('header-search-component')

						<div class="wrap-icon right-section">
							@livewire('wish-list-count-component')
							@livewire('cart-count-component')
							<div class="wrap-icon-section show-up-after-1024">
								<a href="#" class="mobile-navigation">
									<span></span>
									<span></span>
									<span></span>
								</a>
							</div>
						</div>

					</div>
				</div>

				<div class="nav-section header-sticky">
					<div class="header-nav-section">
						<div class="container">
							<ul class="nav menu-nav clone-main-menu" id="mercado_haead_menu" data-menuname="Sale Info" >
								<li class="menu-item"><a href="#" class="link-term">Weekly Featured</a><span class="nav-label hot-label">hot</span></li>
								<li class="menu-item"><a href="#" class="link-term">Hot Sale items</a><span class="nav-label hot-label">hot</span></li>
								<li class="menu-item"><a href="#" class="link-term">Top new items</a><span class="nav-label hot-label">hot</span></li>
								<li class="menu-item"><a href="#" class="link-term">Top Selling</a><span class="nav-label hot-label">hot</span></li>
								<li class="menu-item"><a href="#" class="link-term">Top rated items</a><span class="nav-label hot-label">hot</span></li>
							</ul>
						</div>
					</div>

					<div class="primary-nav-section">
						<div class="container">
							<ul class="nav primary clone-main-menu" id="mercado_main" data-menuname="Main menu" >
								<li class="menu-item home-icon">
									<a href="/" class="link-term mercado-item-title"><i class="fa fa-home" aria-hidden="true"></i></a>
								</li>
								<li class="menu-item">
									<a href="/shop" class="link-term mercado-item-title">{{ __('Shop') }}</a>
								</li>
								<li class="menu-item">
									<a href="/cart" class="link-term mercado-item-title">{{ __('Cart') }}</a>
								</li>
								<li class="menu-item">
									<a href="/checkout" class="link-term mercado-item-title">{{ __('Checkout') }}</a>
								</li>
								<li class="menu-item">
									<a href="{{route('contact')}}" class="link-term mercado-item-title">{{ __('Contact us') }}</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>

	<!--main area-->

  	{{$slot}}
	<!--main area-->

	@livewire('footer-component')

	<script src="{{ asset('assets/js/jquery-1.12.4.minb8ff.js?ver=1.12.4') }}"></script>
	<script src="{{ asset('assets/js/jquery-ui-1.12.4.minb8ff.js?ver=1.12.4') }}"></script>
	<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('assets/js/jquery.flexslider.js') }}"></script>
	<script src="{{ asset('assets/js/chosen.jquery.min.js') }}"></script>
	<script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
	<script src="{{ asset('assets/js/jquery.countdown.min.js') }}"></script>
	<script src="{{ asset('assets/js/jquery.sticky.js') }}"></script>
	<script src="{{ asset('assets/js/functions.js') }}"></script>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
  @livewireScripts
	@stack('scripts')
</body>
</html>
