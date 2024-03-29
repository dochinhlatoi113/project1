
<header id="header"><!--header-->
	<div class="header_top"><!--header_top-->
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					<div class="contactinfo">
						<ul class="nav nav-pills">
							<li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
							<li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
						</ul>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="social-icons pull-right">
						<ul class="nav navbar-nav">
							<li><a href="#"><i class="fa fa-facebook"></i></a></li>
							<li><a href="#"><i class="fa fa-twitter"></i></a></li>
							<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
							<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
							<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div><!--/header_top-->
	
	<div class="header-middle"><!--header-middle-->
		<div class="container">
			<div class="row">
				<div class="col-md-4 clearfix">
					<div class="logo pull-left">
						<a href="index.html"><img src="images/home/logo.png" alt="" /></a>
					</div>
					<div class="btn-group pull-right clearfix">
						<div class="btn-group">
							<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
								USA
								<span class="caret"></span>
							</button>
							<ul class="dropdown-menu">
								<li><a href="">Canada</a></li>
								<li><a href="">UK</a></li>
							</ul>
						</div>
						
						<div class="btn-group">
							<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
								DOLLAR
								<span class="caret"></span>
							</button>
							<ul class="dropdown-menu">
								<li><a href="">Canadian Dollar</a></li>
								<li><a href="">Pound</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-md-8 clearfix">
					<div class="shop-menu clearfix pull-right">
						<ul class="nav navbar-nav">
							<!-- <li><a href=""><i class="fa fa-user"></i> Account</a></li> -->
							<li><a href=""><i class="fa fa-star"></i> Wishlist</a></li>
							<li><a href="checkout.html"><i class="fa fa-crosshairs"></i> Checkout</a></li>

							<?php $value = session('cart');?>
							@if($value !== NULL) 
							
								<li>

									<a href="{{route('cart_list')}}"><i class="fa fa-shopping-cart"></i> Cart 
									
									<?php $arrCart = []; ?>
									@foreach($value as $item)
										<?php array_push($arrCart, $item['quantity']); ?>		
									@endforeach
									<?php $total = array_sum($arrCart); ?>
																
									<span style="color:red" class="cartNumber">@if($total > 0) {{ $total }} @endif</span>				
									
									</a>
							
								</li>
							@endif	
													
							@if(Auth::user())

							<li>								
							
								<div class="dropdown">
									<button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										xin chào:{{ Auth::user()->name }}	
									</button>
									<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
										
										<a class="dropdown-item" href="{{ route('user_update_info') }}">Cập nhật thông tin</a><br>
										<a class="dropdown-item" href="{{ route('logout') }}">Đăng xuất</a>
									</div>
								</div>
							</li>

							@else

							<li><a href="{{route('auth_login')}}"><i class="fa fa-lock"></i> 
							Login</a></li>
							
							@endif
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div><!--/header-middle-->

	<div class="header-bottom"><!--header-bottom-->
		<div class="container">
			<div class="row">
				<div class="col-sm-9">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>
					<div class="mainmenu pull-left">
						<ul class="nav navbar-nav collapse navbar-collapse">
							<li><a href="{{route('home')}}" class="active">Home</a></li>
							<li class="dropdown"><a href="{{route('shop_index')}}">Shop<i class="fa fa-angle-down"></i></a>
								<ul role="menu" class="sub-menu">
									<li><a href="">Products</a></li>
									<li><a href="product-details">Product Details</a></li> 
									<li><a href="checkout.html">Checkout</a></li> 
								
									<li><a href="" value="">cart</a></li> 
									
									<li><a href="{{route('auth_login')}}">Login</a></li> 
								</ul>
							</li> 
							<li class="dropdown"><a href="#">Blog<i class="fa fa-angle-down"></i></a>
								<ul role="menu" class="sub-menu">
									<li><a href="blog.html">Blog List</a></li>
									<li><a href="blog-single.html">Blog Single</a></li>
								</ul>
							</li> 
							<li><a href="404.html">404</a></li>
							<li><a href="contact-us.html">Contact</a></li>
						</ul>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="search_box pull-right">
						<input type="text" placeholder="Search"/>
					</div>
				</div>
			</div>
		</div>
	</div><!--/header-bottom-->
</header><!--/header-->
