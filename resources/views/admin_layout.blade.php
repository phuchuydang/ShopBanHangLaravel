
<!DOCTYPE html>
<head>
<title>Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="{{asset('public/backend/css/bootstrap.min.css')}}" >

<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="{{asset('public/backend/css/style.css')}}" rel='stylesheet' type='text/css' />
<link href="{{asset('public/backend/css/style-responsive.css')}}" rel="stylesheet"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="{{asset('public/backend/css/font.css')}}" type="text/css"/>
<link href="{{asset('public/backend/css/font-awesome.css')}}" rel="stylesheet"> 
<link rel="stylesheet" href="{{asset('public/backend/css/morris.css')}}" type="text/css"/>
<!-- calendar -->
<link rel="stylesheet" href="{{asset('public/backend/css/monthly.css')}}">
<!-- //calendar -->
<!-- //font-awesome icons -->
<script src="{{asset('public/backend/js/jquery2.0.3.min.js')}}"></script>
<script src="{{asset('public/backend/js/raphael-min.js')}}"></script>
<script src="{{asset('public/backend/js/morris.js')}}"></script>
<script src="{{asset('public/backend/ckeditor5-build-classic/ckeditor.js')}}"></script>
{{-- <script>
    CKEDITOR.replace('ckeditor1');
</script> --}}
</head>
<body>
<section id="container">
<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">
    <a href="{{URL::to('/dashboard')}}" class="logo">
        ADMIN
    </a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>
<!--logo end-->
{{--  --}}
<div class="top-nav clearfix">
    <!--search & user info start-->
    <ul class="nav pull-right top-menu">
        <li>
            <input type="text" class="form-control search" placeholder=" Search">
        </li>
        <!-- user login dropdown start-->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img alt="" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTEqUPHsU4ebuzz1VkrvE2aQE5r5e6g76UJu3l6_EGVZCyA3kn0GQoQ8urtDyGxDvRhJMA&usqp=CAU">
                <span class="username">
                    <?php
                        $name = Session::get('name');
                        if($name){
                            echo $name;
                        }
                    ?>
                </span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                <li><a href="{{URL::to('/my_profile')}}"><i class=" fa fa-suitcase"></i>Profile</a></li>
                <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                <li><a href="{{URL::to('/logout')}}"><i class="fa fa-key"></i> Log Out</a></li>
            </ul>
        </li>
        <!-- user login dropdown end -->
       
    </ul>
    <!--search & user info end-->
</div>
</header>
<!--header end-->
<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a class="active" href="{{URL::to('/dashboard')}}">
                        <i class="fa fa-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                        <span>Order</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/manage-order')}}">Manage Order</a></li>
                    </ul>
                </li>
                
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-list-alt" aria-hidden="true"></i>
                        <span>Category</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add-category-product')}}">Add Category</a></li>
						<li><a href="{{URL::to('/all-category-product')}}">List Category</a></li>
                        {{-- <li><a href="grids.html">Grids</a></li> --}}
                    </ul>
                </li>

				<li class="sub-menu">
                    <a href="javascript:;">
                        <i class = "fa fa-adjust custom" aria-hidden="true"></i>
                        <span>Brand</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add-brand-product')}}">Add Brand </a></li>
						<li><a href="{{URL::to('/all-brand-product')}}">List Brand</a></li>
                        {{-- <li><a href="grids.html">Grids</a></li> --}}
                    </ul>
                </li>

                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-gift"></i>
                        <span>Voucher</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add-voucher')}}">Add Voucher</a></li>
						<li><a href="{{URL::to('/all-voucher')}}">List Voucher</a></li>
                        {{-- <li><a href="grids.html">Grids</a></li> --}}
                    </ul>
                </li>

                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-product-hunt" aria-hidden="true"></i>
                        <span>Product</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add-product')}}">Add Product</a></li>
						<li><a href="{{URL::to('/all-product')}}">List Product</a></li>
                        {{-- <li><a href="grids.html">Grids</a></li> --}}
                    </ul>
                </li>

                <li class="sub-menu">
                    <a >
                        <i class='fa-solid fa-truck-fast'></i>
                        <span>Delivery</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/delivery-detail')}}">Add Delivery</a></li>
						<li><a href="{{URL::to('/list-delivery')}}">List Delivery</a></li>
                     
                    </ul>
                </li>
                
            </ul>            
		</div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
	<section class="wrapper">
       @yield('admin_content')
</section>
 <!-- footer -->
		  <div class="footer">
			<div class="wthree-copyright">
			  <p style="text-align: center;">All rights reserved</p>
			</div>
		  </div>
  <!-- / footer -->
</section>
<!--main content end-->
</section>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script src="{{asset('public/backend/js/bootstrap.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{asset('public/backend/js/scripts.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.nicescroll.js')}}"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="{{asset('public/backend/js/jquery.scrollTo.js')}}"></script>
<script>
    // function fetch_delivery(){
    //     var _token = $('input[name="_token"]').val();
    //     $.ajax({
    //             url:'{{url('/select-delivery')}}',
    //             method : 'POST',
    //             data: {
    //                 _token: _token
    //             },
    //             success: function(data) {
    //                 $('#load_delivery').html(data);
    //             }
    //         });
    // }
    // fetch_delivery();
    $(document).ready(function() {
       
        $('.add_delevery').click(function() {
            var city = $('.city').val();
            var province = $('.province').val();
            var ward = $('.ward').val();
            var feeship = $('.feeship').val();
            var _token = $('input[name="_token"]').val();
            // alert(city +"\n" + province+"\n"  + ward+"\n" + feeship);
            $.ajax({
                url:'{{url('/add-delivery')}}',
                method : 'POST',
                data: {
                    city: city,
                    province: province,
                    ward: ward,
                    feeship: feeship,
                    _token: _token
                },
                success: function(data) {
                    alert('Add Feeship Success');
                    //reset form
                    $('.city').val('');
                    $('.province').val('Choose Province');
                    $('.ward').val('Choose Ward');
                    $('.feeship').val('');
                }
            });
           
        });

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
                url:'{{url('/get-districts')}}',
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
<!-- morris JavaScript -->	
<script>
	$(document).ready(function() {
		//BOX BUTTON SHOW AND CLOSE
	   jQuery('.small-graph-box').hover(function() {
		  jQuery(this).find('.box-button').fadeIn('fast');
	   }, function() {
		  jQuery(this).find('.box-button').fadeOut('fast');
	   });
	   jQuery('.small-graph-box .box-close').click(function() {
		  jQuery(this).closest('.small-graph-box').fadeOut(200);
		  return false;
	   });
    });
    
</script>


</body>
</html>
