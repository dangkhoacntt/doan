<!DOCTYPE html>
<html>
<head>
	<base href="{{asset('frontend')}}/">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">	
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>Dang Khoa - @yield('title')</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/home.css">
	<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script type="text/javascript">
		$(function() {
			var pull        = $('#pull');
			menu        = $('nav ul');
			menuHeight  = menu.height();

			$(pull).on('click', function(e) {
				e.preventDefault();
				menu.slideToggle();
			});
		});

		$(window).resize(function(){
			var w = $(window).width();
			if(w > 320 && menu.is(':hidden')) {
				menu.removeAttr('style');
			}
		});
	</script>
</head>
<body>    
	<!-- header -->
	<header id="header">
		<div class="container">
			<div class="row">
				<div id="logo" class="col-md-3 col-sm-12 col-xs-12">
					<h1>
						<a href="{{asset('/')}}"><img src="img/home/2.png"></a>						
						<nav><a id="pull" class="btn btn-danger" href="#">
							<i class="fa fa-bars"></i>
						</a></nav>			
					</h1>
				</div>
				<div id="search-bar" class="col-md-7 col-sm-12 col-xs-12">
				<form class="navbar-form" role="search" method="GET" action="{{asset('search/')}}">
    <div class="input-group">
        <div class="input-group-btn">
            <input type="text" class="form-control" placeholder="Search" name="result">
        </div>
        <div class="input-group-btn">
            <input type="number" class="form-control" placeholder="Min Price" name="min_price">
        </div>
        <div class="input-group-btn">
            <input type="number" class="form-control" placeholder="Max Price" name="max_price">
        </div>
        <div class="input-group-btn">
            <button class="btn btn-default" type="submit"> <i class="glyphicon glyphicon-search"></i> Tìm Kiếm </button>
        </div>
    </div>
</form>

					</form>
					@if(auth()->check())
                    <!-- Hiển thị tên người dùng và nút đăng xuất nếu đã đăng nhập -->
                    <div id="user-actions" class="col-md-12 text-right">
                        <p>Xin chào, {{ auth()->user()->name }}</p>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger">Đăng xuất</button>
                        </form>
                    </div>
                    @else
                    <!-- Hiển thị nút đăng nhập và đăng ký nếu chưa đăng nhập -->
                    <div id="user-actions" class="col-md-12 text-right">
                        <a href="{{ route('loginfe') }}" class="btn btn-primary">Đăng nhập</a>
                        <a href="{{ route('registerfe') }}" class="btn btn-success">Đăng ký</a>
                    </div>
                    @endif
				</div>
				<div id="cart" class="col-md-2 col-sm-12 col-xs-12">
    @auth
        <a class="display" href="{{asset('cart/show/')}}">Giỏ Hàng</a>
        <a href="{{asset('cart/show/')}}">{{Cart::count()}}</a>
    @endauth
</div>

			</div>			
		</div>
	</header><!-- /header -->
	<!-- endheader -->

	<!-- main -->
	<section id="body">
		<div class="container">
			<div class="row">
				<div id="sidebar" class="col-md-3">
					<nav id="menu">
						<ul>
							<li class="menu-item">Danh Mục Sản Phẩm </li>
							@foreach ($categories as $cate)
							<li class="menu-item"><a href="{{asset('category/'.$cate->cate_id)}}" title="">{{$cate->cate_name}}</a></li>
							@endforeach					
						</ul>
						<!-- <a href="#" id="pull">Danh mục</a> -->
					</nav>
					<div id="banner-l" class="text-center">
        @foreach($banners as $baner)
            <div class="banner-item">
             <a href="{{$baner->link ?? '#'}}">   <img src="{{ asset($baner->baner) }}" alt="Banner Image"></a>
            </div>
        @endforeach
</div>
				</div>
				<div id="main" class="col-md-9">
					<!-- main -->
					<!-- phan slide la cac hieu ung chuyen dong su dung jquey -->
					<div id="slider">
						<div id="demo" class="carousel slide" data-ride="carousel">

							<!-- Indicators -->
							<ul class="carousel-indicators">
								<li data-target="#demo" data-slide-to="0" class="active"></li>
								<li data-target="#demo" data-slide-to="1"></li>
								<li data-target="#demo" data-slide-to="2"></li>
							</ul>
					
							<!-- The slideshow -->
							<div class="carousel-inner">
								<div class="carousel-item active">
									<img src="img/home/slide-1.png" alt="Los Angeles" >
								</div>
								<div class="carousel-item">
									<img src="img/home/slide-2.png" alt="Chicago">
								</div>
								<div class="carousel-item">
									<img src="img/home/slide-3.png" alt="New York" >
								</div>
							</div>

							<!-- Left and right controls -->
							<a class="carousel-control-prev" href="#demo" data-slide="prev">
								<span class="carousel-control-prev-icon"></span>
							</a>
							<a class="carousel-control-next" href="#demo" data-slide="next">
								<span class="carousel-control-next-icon"></span>
							</a>
						</div>
					</div>
					

					<div id="banner-t" class="text-center">
						<div class="row">
							<div class="banner-t-item col-md-6 col-sm-12 col-xs-12">
								<a href="#"><img src="img/home/banner-t-1.png" alt="" class="img-thumbnail"></a>
							</div>
							<div class="banner-t-item col-md-6 col-sm-12 col-xs-12">
								<a href="#"><img src="img/home/banner-t-1.png" alt="" class="img-thumbnail"></a>
							</div>
						</div>					
					</div>
					@yield('main')
					<!-- end main -->
				</div>
			</div>
		</div>
	</section>
	<!-- endmain -->

	<!-- footer -->
	<footer id="footer">			
		<div id="footer-t">
			<div class="container">
				<div class="row">				
					<div id="logo-f" class="col-md-3 col-sm-12 col-xs-12 text-center">						
					<a href="{{asset('/')}}"><img src="img/home/2.png"></a>			
					</div>
					<div id="hotline" class="col-md-3 col-sm-12 col-xs-12">
						<h3>Hotline</h3>
						<p>Phone Sale: (+84) 0828909126 </p>
						<p>Email: Cubom882001@gmailcom</p>
					</div>
				</div>				
		</div>
	</footer>
	<!-- endfooter -->
</body>
</html>
