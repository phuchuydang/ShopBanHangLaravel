
<!DOCTYPE html>
<head>
<title>Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="csrf-token" content="{{ csrf_token() }}" />
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
<script src="{{URL::to('https://cdn.ckeditor.com/4.19.0/standard/ckeditor.js')}}"></script>
<script src="{{URL::to('https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.add_video').click(function() {
            var video_title = $('input[name="video_title"]').val();
            var video_link = $('input[name="video_link"]').val();
            var video_desc = $('textarea[name="video_desc"]').val();
            //var video_image =  $('#video-image')[0].files;
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{url('/save-video')}}",
                type: "POST",
                data: {
                    video_title: video_title,
                    video_link: video_link,
                    video_desc: video_desc,
                   
                    _token: _token
                },
                success: function(data) {
                    swal("Success", "Add video success", "success");
                    setTimeout(function(){
                        location.reload();
                    }, 1000);
                }
                ,error: function(data) {
                    swal("Error", "Add video error", "error");
                }
            });
        });

        $('.save_video').click(function(){
            var video_id = $('input[name="video_id"]').val();
            var video_title = $('input[name="video_title"]').val();
            var video_link = $('input[name="video_link"]').val();
           
            var video_desc = $('textarea[name="video_desc"]').val();
            var _token = $('input[name="_token"]').val();
            //alert(video_id +"\n" + video_title + "\n" + video_link + "\n" + video_desc + "\n" + _token);
            $.ajax({
                url: "{{url('/update-video')}}",
                type: "POST",
                data: {
                    video_id: video_id,
                    video_title: video_title,
                    video_link: video_link,
                    video_desc: video_desc,
                    _token: _token
                },
                success: function(data) {
                    swal("Success", "Update video success", "success");
                    setTimeout(function(){
                        location.href = "{{url('/video')}}";
                    }, 1000);
                }
            });
        });
       
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        load_video();
        function load_video(){
            $.ajax({
                url: '{{url('/load_video')}}',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content')
                },
                contentType: false,
                cache: false,
                processData: false,
                success: function(data){
                    $('#video_load').html(data);
                }
            });
            
        }
        $(document).on('click', '.del_video', function(){
            var video_id = $(this).data('video_id');
            var _token = $('input[name="_token"]').val();
            swal({
                title: "Confirm Delete",
                text: "Do you want to delete this video?",
                icon: "warning",
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
                        text: "Yes",
                        value: true,
                        visible: true,
                        className: "",
                        closeModal: true
                    }
                }
                }).then((value) => {
                    if (value) {
                        $.ajax({
                            url: '{{url('/del-video')}}',
                            method:  'POST',
                            data: {
                                'video_id': video_id,
                                '_token': _token
                            },
                            success: function(data){
                                // load_video();
                                swal({
                                    title: "Success!",
                                    text: "Video has been deleted!",
                                    icon: "success",
                                    button: "OK",
                                });
                                setTimeout(function(){
                                    location.reload();
                                }, 1000);
                                
                        
                            }
                        })
                    }
                });
            
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        loaddGallery();
        function loaddGallery(){
            var product_id = $('.product_id').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: '{{url('/load-gallery')}}',
                method:  'POST',
                data : {
                    product_id: product_id,
                    _token: _token,
                },
                success: function(data){
                    $('#table-responsive').html(data);
                }
            })
       
        }

        $('#file').change(function(){
            var error = '';
            var files = $('#file')[0].files;
            if(files.length > 3){
                error += '<p>You can not select more than 3 files</p>';
            }
            else if(files.length == ''){
                error += '<p>Please select at least one file</p>';
            
            }
            else if(files.size > 2000000){
                error += '<p>You can not select more than 2MB</p>';
            }
            if(error == ''){
                $('#form').submit();
            }
            else{
                loaddGallery();
                $('#file').val('');
                $('#error-gallery').html('<span class="text-danger">' + error + '</span>');
                return false;
            }
        });

    $(document).on('blur', '.edit_gallery_name', function(){
        var gallery_id = $(this).data('gala_id');
        var gallery_name = $(this).text();
        // alert(gallery_id + ' ' + gallery_name);
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: '{{url('/edit-gallery-name')}}',
            method:  'POST',
            data : {
                gallery_id: gallery_id,
                gallery_name: gallery_name,
                _token: _token,
            },
            success: function(data){
                loaddGallery();
                swal({
                    title: "Success!",
                    text: "Gallery name has been updated!",
                    icon: "success",
                    button: "OK",
                });
                setTimeout(function(){
                    location.reload();
                }, 1000);
            }
        })
    });

    $(document).on('click', '.del_gala', function(){
        var gallery_id = $(this).data('gala_id');
        var _token = $('input[name="_token"]').val();
        swal({
			title: "Confirm Delte",
			text: "Do you want to delete this gallery?",
			icon: "warning",
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
					text: "Yes",
					value: true,
					visible: true,
					className: "",
					closeModal: true
				}
			}
			}).then((value) => {
				if (value) {
                    $.ajax({
                    url: '{{url('/del-gallery')}}',
                    method:  'POST',
                    data : {
                        gallery_id: gallery_id,
                        _token: _token,
                    },
                    success: function(data){
                        loaddGallery();
                        swal({
                            title: "Success!",
                            text: "Gallery has been deleted!",
                            icon: "success",
                            button: "OK",
                        });
                        setTimeout(function(){
                            location.reload();
                        }, 1000);
                    
                    }
                })
			}
		});
       
    });

    $(document).on('click', '.del_pro', function(){
        var product_id = $(this).data('pro_id');
        var _token = $('input[name="_token"]').val();
        swal({
			title: "Confirm Delte",
			text: "Do you want to delete this product?",
			icon: "warning",
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
					text: "Yes",
					value: true,
					visible: true,
					className: "",
					closeModal: true
				}
			}
			}).then((value) => {
				if (value) {
                    $.ajax({
                    url: '{{url('/del-product')}}',
                    method:  'POST',
                    data : {
                        product_id: product_id,
                        _token: _token,
                    },
                    success: function(data){
                      
                        swal({
                            title: "Success!",
                            text: "Product has been deleted!",
                            icon: "success",
                            button: "OK",
                        });
                        //set time reload page
                        setTimeout(function(){
                            location.reload();
                        }, 1000);
                    
                    }
                })
			}
		}); 
    });

    $(document).on('click', '.del_brand', function(){
        var brand_id = $(this).data('brand_id');
        var _token = $('input[name="_token"]').val();
        swal({
			title: "Confirm Delte",
			text: "Do you want to delete this brand?",
			icon: "warning",
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
					text: "Yes",
					value: true,
					visible: true,
					className: "",
					closeModal: true
				}
			}
			}).then((value) => {
				if (value) {
                    $.ajax({
                    url: '{{url('/del-brand')}}',
                    method:  'POST',
                    data : {
                        brand_id: brand_id,
                        _token: _token,
                    },
                    success: function(data){
                      
                        swal({
                            title: "Success!",
                            text: "Brand has been deleted!",
                            icon: "success",
                            button: "OK",
                        });
                        //set time reload page
                        setTimeout(function(){
                            location.reload();
                        }, 1000);
                    
                    }
                })
			}
		}); 
    });

    $(document).on('click', '.del_cate', function(){
        var cate_id = $(this).data('cate_id');
        var _token = $('input[name="_token"]').val();
        swal({
			title: "Confirm Delte",
			text: "Do you want to delete this category?",
			icon: "warning",
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
					text: "Yes",
					value: true,
					visible: true,
					className: "",
					closeModal: true
				}
			}
			}).then((value) => {
				if (value) {
                    $.ajax({
                    url: '{{url('/del-brand')}}',
                    method:  'POST',
                    data : {
                        cate_id: cate_id,
                        _token: _token,
                    },
                    success: function(data){
                      
                        swal({
                            title: "Success!",
                            text: "Category has been deleted!",
                            icon: "success",
                            button: "OK",
                        });
                        //set time reload page
                        setTimeout(function(){
                            location.reload();
                        }, 1000);
                    
                    }
                })
			}
		}); 
    });

    
    $(document).on('click', '.del_slider', function(){
        var slider_id = $(this).data('slider_id');
        var _token = $('input[name="_token"]').val();
        swal({
			title: "Confirm Delte",
			text: "Do you want to delete this slider?",
			icon: "warning",
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
					text: "Yes",
					value: true,
					visible: true,
					className: "",
					closeModal: true
				}
			}
			}).then((value) => {
				if (value) {
                    $.ajax({
                    url: '{{url('/del-slider')}}',
                    method:  'POST',
                    data : {
                        slider_id: slider_id,
                        _token: _token,
                    },
                    success: function(data){
                      
                        swal({
                            title: "Success!",
                            text: "Slider has been deleted!",
                            icon: "success",
                            button: "OK",
                        });
                        //set time reload page
                        setTimeout(function(){
                            location.reload();
                        }, 1000);
                    
                    }
                })
			}
		}); 
    });

    
    $(document).on('click', '.del_voucher', function(){
        var voucher_id = $(this).data('voucher_id');
        var _token = $('input[name="_token"]').val();
        swal({
			title: "Confirm Delte",
			text: "Do you want to delete this voucher?",
			icon: "warning",
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
					text: "Yes",
					value: true,
					visible: true,
					className: "",
					closeModal: true
				}
			}
			}).then((value) => {
				if (value) {
                    $.ajax({
                    url: '{{url('/del-voucher')}}',
                    method:  'POST',
                    data : {
                        voucher_id : voucher_id,
                        _token: _token,
                    },
                    success: function(data){
                      
                        swal({
                            title: "Success!",
                            text: "Voucher has been deleted!",
                            icon: "success",
                            button: "OK",
                        });
                        //set time reload page
                        setTimeout(function(){
                            location.reload();
                        }, 1000);
                    
                    }
                })
			}
		}); 
    });

    
    $(document).on('click', '.del_user', function(){
        var user_id = $(this).data('user_id');
        var _token = $('input[name="_token"]').val();
        swal({
			title: "Confirm Delte",
			text: "Do you want to delete this user?",
			icon: "warning",
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
					text: "Yes",
					value: true,
					visible: true,
					className: "",
					closeModal: true
				}
			}
			}).then((value) => {
				if (value) {
                    $.ajax({
                    url: '{{url('/del-user')}}',
                    method:  'POST',
                    data : {
                        user_id : user_id,
                        _token: _token,
                    },
                    success: function(data){
                      
                        swal({
                            title: "Success!",
                            text: "User has been deleted!",
                            icon: "success",
                            button: "OK",
                        });
                        //set time reload page
                        setTimeout(function(){
                            location.reload();
                        }, 1000);
                    
                    }
                })
			}
		}); 
    });

    
    $(document).on('click', '.del_deli', function(){
        var id = $(this).data('deli_id');
        var _token = $('input[name="_token"]').val();
        swal({
			title: "Confirm Delte",
			text: "Do you want to delete this delivery?",
			icon: "warning",
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
					text: "Yes",
					value: true,
					visible: true,
					className: "",
					closeModal: true
				}
			}
			}).then((value) => {
				if (value) {
                    $.ajax({
                    url: '{{url('/del-deli')}}',
                    method:  'POST',
                    data : {
                        id : id,
                        _token: _token,
                    },
                    success: function(data){
                      
                        swal({
                            title: "Success!",
                            text: "Delivery has been deleted!",
                            icon: "success",
                            button: "OK",
                        });
                        //set time reload page
                        setTimeout(function(){
                            location.reload();
                        }, 1000);
                    
                    }
                })
			}
		}); 
    });

    
    $(document).on('change', '.file_image', function(){
        var gala_id = $(this).data('gal_id');
        var image = document.getElementById("file-"+gala_id).files[0];
        var form_data = new FormData();
        form_data.append('image', image);
        form_data.append('file',document.getElementById("file-"+gala_id).files[0]);
        form_data.append('gala_id', gala_id);
        form_data.append('_token', '{{csrf_token()}}');
        // /alert(image);
        $.ajax({
            url: '{{url('/update-gallery')}}',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            success: function(data){
                    swal({
                        title: "Success!",
                        text: "Image has been uploaded!",
                        icon: "success",
                        button: "OK",
                    });
                    //set time reload page
                    setTimeout(function(){
                        location.reload();
                    }, 1000);
                
            }
            
        });
    });

});
</script>


<script type="text/javascript">
    $(document).ready(function() {
        $(document).on('click', '.update_delevery', function(){
            var fee_id = $(this).data('fee_id');
            var fee_price = $('.fee_price').val();
           // alert(fee_price);
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: '{{url('/save-delivery')}}',
                method:  'POST',
                data : {
                    fee_id : fee_id,
                    fee_price : fee_price,
                    _token: _token,
                },
                success: function(data){
                  
                    swal({
                        title: "Success!",
                        text: "Delivery has been updated!",
                        icon: "success",
                        button: "OK",
                    });
                    //set after 100 second redicrect page
                    setTimeout(function(){
                        location.href = "{{url('/list-delivery')}}";
                    }, 1000);
                }
            })
                 
        });
    });
</script>
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
                <li>
                    <a href="{{URL::to('/list-user')}}">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        <span>List Users</span>
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
                        <i class="fa fa-sliders" aria-hidden="true"></i>
                        <span>Slider</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add-slider')}}">Add Slider</a></li>
						<li><a href="{{URL::to('/all-slider')}}">List Slider</a></li>
                        {{-- <li><a href="grids.html">Grids</a></li> --}}
                    </ul>
                </li>

                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fas fa-video"></i>
                        <span>Video</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add-video')}}">Add Video</a></li>
                        <li><a href="{{URL::to('/video')}}">List Video</a></li>
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
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
                    swal("Success!", "Add Delivery Success!", "success");
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
<script type="text/javascript">
    $('.change_status').change(function() {
        var id = $(this).children("option:selected").attr('id');
        var status = $(this).val();
        //alert(id +"\n" + status);
        var _token = $('input[name="_token"]').val();
        var order_product_quanity = [];
        $("input[name='order_quantity']").each(function(){
            order_product_quanity.push($(this).val());
        });

        var order_product_id = [];
        $("input[name='order_quantity_id']").each(function(){
            order_product_id.push($(this).val());
        });
        //alert(quanity + "\n" + order_product_id);
        $.ajax({
            url:'{{url('/change-quanity')}}',
            method : 'POST',
            data: {
                id: id,
                status: status,
                order_product_quanity: order_product_quanity,
                order_product_id: order_product_id,
                _token: _token
            },
            success: function(data) {
                swal("Good job!", "You clicked the button!", "success");
                //reload page
                location.reload();
            }
        });
    });

</script>
{{-- <script>
    CKEDITOR.replace( 'ck_editor1' );
</script> --}}
<script>
    ClassicEditor
        .create( document.querySelector( '#ck_editor1' ) );
       
        ClassicEditor
        .create( document.querySelector( '#ck_editor2' ) );
       
</script>

<script type="text/javascript">
    $('#myModal').on('hidden.bs.modal', function () {
        callPlayer('yt-player', 'stopVideo');
    });
</script>
</body>
</html>
