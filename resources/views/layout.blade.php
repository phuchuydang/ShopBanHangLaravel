<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | E-Shopper</title>
    <title>Home | E-Shopper</title>
    <link href="{{asset('public/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/price-range.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/sweetalert.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/animate.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/main.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/responsive.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/lightslider.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/lightgallery.min.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/prettify.css')}}" rel="stylesheet">
	{{-- <link href="{{asset('public/frontend/css/style.css')}}" rel="stylesheet"> --}}
    <!--[if lt IE 9]>
   
    <script src="js/respond.min.js"></script>
    <![endif]-->   
	<script src="{{URL::to('public/frontend/js/html5shiv.js')}}"></script> 
	<script src="{{URL::to('https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js')}}"></script>   
	<script src="{{URL::to('https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js')}}"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="shortcut icon" href="{{('public/frontend/images/ico/favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
	<script type="text/javascript">
		$(document).ready(function() {
		$('#imageGallery').lightSlider({
			gallery:true,
			item:1,
			loop:true,
			thumbItem:3,
			slideMargin:0,
			enableDrag: false,
			currentPagerPosition:'left',
			onSliderLoad: function(el) {
				el.lightGallery({
					selector: '#imageGallery .lslide'
				});
			}   
		});  
	});
  </script>
</head><!--/head-->

<body>

	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href=""><i class="fa fa-phone"></i> +0 33 24 20477</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> dphuytdt@gmail.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="{{URL::to('https://www.facebook.com/dphuy.tdt/')}}"><i class="fa-brands fa-facebook"></i></a></li>
								<li><a href="{{URL::to('https://github.com/dphuytdt')}}"><i class="fa-brands fa-github"></i></a></li>
								{{-- <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li> --}}
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="{{URL::to('/')}}"><img src="{{URL::to('public/frontend/images/logo.png')}}" alt="" /></a>
						</div>
						<div class="btn-group pull-right">
							{{-- <div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									USA
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="#">Canada</a></li>
									<li><a href="#">UK</a></li>
								</ul>
							</div>
							
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									DOLLAR
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="#">Canadian Dollar</a></li>
									<li><a href="#">Pound</a></li>
								</ul>
							</div> --}}
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<li><a href="{{URL::to('/account-info')}}"><i class="fa fa-user"></i> Account</a></li>
								<li><a href="#"><i class="fa fa-star"></i> Wishlist</a></li>
								<?php

									$customer_id = Session::get('customer_id');
									$shipping_id = Session::get('shipping_id');
									if($customer_id != NULL && $shipping_id == NULL){

								?>
								<li><a href="{{URL::to('/show-checkout')}}"><i class="fa fa-shopping-cart"></i> Checkout</a></li>
								<?php }else if($customer_id != NULL && $shipping_id != NULL){ ?>

									<li><a href="{{URL::to('/payment')}}"><i class="fa fa-crosshairs"></i> Checkout</a></li>

								<?php
								} else {
								?>
								<li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-crosshairs"></i> Checkout</a></li>
								<?php } ?>
								<li><a href="{{URL::to('/show-cart')}}"><i class="fa fa-shopping-cart"></i> Cart</a></li>
								<?php 
									$customer_id=Session::get('customer_id'); 
									if($customer_id!=NULL){


								?>
								<li><a href="{{URL::to('/video-shop')}}"><i class="fas fa-newspaper"></i>News</a></li>
								{{-- <li><a href="{{URL::to('/show-checkout')}}"><i class="fa fa-crosshairs"></i> Checkout</a></li> --}}
								<li><a href="{{URL::to('/logout-checkout')}}"><i class="fa fa-lock"></i> Logout</a></li>

								<?php 
								}
								else {

								?>
									<li><a href="{{URL::to('/video-shop')}}"><i class="fas fa-newspaper"></i> News</a></li>
									<li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-lock"></i> Login</a></li>
								<?php 

									}
								?>
								
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-8">
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
								<li><a href="{{URL::to('/home')}}" class="active">Home</a></li>
								<li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="shop.html">Products</a></li>
                                    </ul>
                                </li> 
								<li class="dropdown"><a href="#">Blog<i class="fa fa-angle-down"></i></a>
                                    {{-- <ul role="menu" class="sub-menu">
                                        <li><a href="blog.html">Blog List</a></li>
										<li><a href="blog-single.html">Blog Single</a></li>
                                    </ul> --}}
                                </li> 
								<li><a href="{{URL::to('/show-cart')}}">Cart</a></li>
								<li><a href="contact-us.html">Contact</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-4">
						<form action="{{URL::to('/search')}}" method="POST" >
							{{csrf_field()}}
							<div class="search_box pull-right">
								<input type="text" name = "keyword" placeholder="Search"/>
								<button type="submit" style="margin-top: 0px;" class="btn btn-default get">Search</button>
								
							</div>
						</form>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->
	
	<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
							<li data-target="#slider-carousel" data-slide-to="2"></li>
						</ol>
						
						{{-- <div class="carousel-inner">
							@php
								$i = 0;
							@endphp
							@foreach($slider as $v_slider => $slider_value)
							@php
								$i++;
							@endphp
							<div class="item {{$i == 1 ? 'active' : ''}}"> --}}
								{{-- <div class="col-sm-6">
									
									<h2>{{$slider_value->slider_name}}</h2>
									<p>{{$slider_value->slider_desc}} </p>
									<button type="button" class="btn btn-default get">Get it now</button>
								</div> --}}
								{{-- <div class="col-sm-6">
									<img alt="{{$slider_value->slider_desc}}" src="{{asset('public/uploads/slider/'.$slider_value->slider_image)}}" class="img img-responsive" alt="" />
									
								</div>
							</div>
							@endforeach
						</div> --}}
					
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
					
				</div>
			</div>
		</div>
	</section><!--/slider-->
	
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Category</h2>

						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
						@foreach($cate_product as $key => $category)
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="{{URL::to('/category-product-home/'.$category->category_id)}}">{{$category->category_name}}</a></h4>
								</div>
							</div>
							<div id="{{URL::to('/category-product-home/'.$category->category_id)}}" class="panel-collapse collapse">
								<div class="panel-body">
									<ul>
										<li><a href="#">Nike </a></li>
										<li><a href="#">Under Armour </a></li>
										<li><a href="#">Adidas </a></li>
										<li><a href="#">Puma</a></li>
										<li><a href="#">ASICS </a></li>
									</ul>
								</div>
							</div>
						@endforeach
						</div><!--/category-products-->
					
						<div class="brands_products"><!--brands_products-->
							<h2>Brands</h2>
							<div class="brands-name">
								<ul class="nav nav-pills nav-stacked">
									@foreach($brand_product as $key => $brand)
										<li><a href="{{URL::to('/brand-product-home/'.$brand->brand_id)}}"> <span class="pull-right"></span>{{$brand->brand_name}}</a></li>
									@endforeach
									
								</ul>
							</div>
						</div><!--/brands_products-->
						
						{{-- <div class="price-range"><!--price-range-->
							<h2>Price Range</h2>
							<div class="well text-center">
								 <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
								 <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
							</div>
						</div><!--/price-range--> --}}
						
						<div class="shipping text-center"><!--shipping-->
							<img src="{{URL::to('public/frontend/images/shipping.jpg')}}" alt="" />
						</div><!--/shipping-->
					
					</div>
				</div>
				
				<div class="col-sm-9 padding-right">
						@yield('content')
					
				</div>
			</div>
		</div>
	</section>
	
	<footer id="footer"><!--Footer-->
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="companyinfo">
							<h2><span>e</span>-shopper</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,sed do eiusmod tempor</p>
						</div>
					</div>
					<div class="col-sm-7">
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="{{URL::to('public/frontend/images/iframe1.png')}}" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="{{URL::to('public/frontend/images/iframe2.png')}}" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="{{URL::to('public/frontend/images/iframe3.png')}}" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="{{URL::to('public/frontend/images/iframe4.png')}}" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="address">
							<img src="{{URL::to('public/frontend/images/map.png')}}" alt="" />
							<p>505 S Atlantic Ave Virginia Beach, VA(Virginia)</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="footer-widget">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Service</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Online Help</a></li>
								<li><a href="#">Contact Us</a></li>
								<li><a href="#">Order Status</a></li>
								<li><a href="#">Change Location</a></li>
								<li><a href="#">FAQ’s</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Quock Shop</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">T-Shirt</a></li>
								<li><a href="#">Mens</a></li>
								<li><a href="#">Womens</a></li>
								<li><a href="#">Gift Cards</a></li>
								<li><a href="#">Shoes</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Policies</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Terms of Use</a></li>
								<li><a href="#">Privecy Policy</a></li>
								<li><a href="#">Refund Policy</a></li>
								<li><a href="#">Billing System</a></li>
								<li><a href="#">Ticket System</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>About Shopper</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Company Information</a></li>
								<li><a href="#">Careers</a></li>
								<li><a href="#">Store Location</a></li>
								<li><a href="#">Affillate Program</a></li>
								<li><a href="#">Copyright</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3 col-sm-offset-1">
						<div class="single-widget">
							<h2>About Shopper</h2>
							<form action="#" class="searchform">
								<input type="text" placeholder="Your email address" />
								<button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
								<p>Get the most recent updates from <br />our site and be updated your self...</p>
							</form>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">E-SHOPPER Inc. All rights reserved.</p>
					<p class="pull-right"></p>
				</div>
			</div>
		</div>
		
	</footer><!--/Footer-->

    <script src="{{asset('public/frontend/js/jquery.js')}}"></script>
	<script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('public/frontend/js/jquery.scrollUp.min.js')}}"></script>
	<script src="{{asset('public/frontend/js/price-range.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('public/frontend/js/main.js')}}"></script>
	{{-- <script src="https://www.google.com/recaptcha/api.js" async defer></script> --}}
	<script src="{{asset('public/frontend/js/lightgallery-all.min.js')}}"></script>
	<script src="{{asset('public/frontend/js/lightslider.js')}}"></script>
	<script src="{{asset('public/frontend/js/prettify.js')}}"></script>
	{{-- <script src="{{asset('public/frontend/js/sweetalert.js')}}"></script> --}}
	<script src="{{asset('https://unpkg.com/sweetalert/dist/sweetalert.min.js')}}"></script>
	
	<script type="text/javascript">
			$(document).ready(function(){
			$('.send_order').click(function(){
				swal({
						title: "Yay! Your did it >.<. ",
						text: "Please comfirm to order",
						icon: "success",
						//2 buttons
						buttons : {
							cancel: {
								text: "No",
								value: null,
								visible: true,
								className: "",
								closeModal: true,
							},
							confirm: {
								text: "Confirm",
								// value: true,
								// visible: true,
								// className: "",
								// closeModal: true
								//daneger
								value: true,
								visible: true,
								className: "",
								closeModal: true
								
							}
						}
					
					}).then((value) => {
						if (value) {
							
							var shipping_email = $('.shipping_email').val();
							var shipping_name = $('.shipping_name').val();
							var shipping_address = $('.shipping_address').val();
							var shipping_phone = $('.shipping_phone').val();
							var shipping_note = $('.shipping_note').val();
							var voucher_code = $('.voucher_code').val();
							var shipping_method = $('.shipping_method').val();
							var _token = $('input[name="_token"]').val();

							//add to array
							$.ajax({
								url: '{{url('/confirm-order')}}',
								method: 'POST',
								data: {
									shipping_email: shipping_email,
									shipping_name: shipping_name,
									shipping_address: shipping_address,
									shipping_phone: shipping_phone,
									shipping_note: shipping_note,
									voucher_code: voucher_code,
									shipping_method: shipping_method,
									_token: _token
								},
								success: function(data){
									swal("Confirm Success", "Thanks for your ordering", "success");
								},
								//set timeout
								timeout: 3000,
								
							});

									}
					});
				
			});
		});

	</script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.add-to-cart').click(function(){
				var id = $(this).data('id_product');
				var cart_product_id = $('.cart_product_id_' + id).val();
				var cart_product_name = $('.cart_product_name_' + id).val();
				var cart_product_price = $('.cart_product_price_' + id).val();
				var cart_product_image = $('.cart_product_image_' + id).val();
				var cart_product_qty = $('.cart_product_qty_' + id).val();
				var _token = $('input[name="_token"]').val();
			
				//add to array
				// alert(cart_product_id + " "+);
				$.ajax({
					url: '{{url('/add-cart')}}',
					method: 'POST',
					data: {
						cart_product_id: cart_product_id,
						cart_product_name: cart_product_name,
						cart_product_price: cart_product_price,
						cart_product_image: cart_product_image,
						cart_product_qty: cart_product_qty,
						_token: _token
					},
					success: function(data){
						swal({
						title: "Add " + cart_product_name + " to cart successfully!",
						text: "You can continue to purchase or go to the shopping cart to proceed to checkout",
						icon: "success",
						//2 buttons
						buttons : {
							cancel: {
								text: "Continue Shopping",
								value: null,
								visible: true,
								className: "",
								closeModal: true,
							},
							confirm: {
								text: "Go to Shopping Cart",
								value: true,
								visible: true,
								className: "",
								closeModal: true
							}
						}
					
					}).then((value) => {
						if (value) {
							window.location.href = "{{url('/show-carts')}}";
						}
					});
						
					
					}
				});
				//swal("Hello world!");
			
			});
		});
			$(document).ready(function(){
				$('.choose').on('change', function() {
					var action = $(this).attr('id');
					var ma_id = $(this).val();
					var _token = $('input[name="_token"]').val();
					var result = '';
					if(action == 'city'){
						result = 'province'
					} else {
						result = 'ward'
					}
					$.ajax({
						url:'{{url('/get-districts-customer')}}',
						method : 'POST',
						data: {
							ma_id: ma_id,
							action: action,
							_token: _token
						},
						success: function(data) {
							$('#'+result).html(data);
						}
					});
				});
			});

	</script>

{{-- <script type="text/javascript">
	$(document).ready(function(){
		$('.cal_feeship').click(function(){
		
			var feeship = $('.feeship').val();
			var city = $('.city').val();
			var province = $('.province').val();
			var ward = $('.ward').val();
			var _token = $('input[name="_token"]').val();
			if(city == ''){
				swal({
					title: "Please choose city!",
					text: "",
					icon: "warning",
					button: "OK",
				});
			} else if(province == ''){
				swal({
					title: "Please choose province!",
					text: "",
					icon: "warning",
					button: "OK",
				});
			} else if(ward == ''){
				swal({
					title: "Please choose ward!",
					text: "",
					icon: "warning",
					button: "OK",
				});
			} else {
				$.ajax({
					url:'{{url('/cal-feeship')}}',
					method : 'POST',
					data: {
						feeship: feeship,
						city: city,
						province: province,
						ward: ward,
						_token: _token
					},
					success: function(data) {
						
					}
				});
			}
		});
	});
</script> --}}
</body>
</html>
