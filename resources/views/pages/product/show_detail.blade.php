@extends('layout')
@section('content')
@foreach($product_details as $key => $value)
<div class="product-details"><!--product-details-->
    <style type="text/css">
        .lSSlideOuter .lSPager.lSGallery img {
                display: block;
                height: 100px;
                max-width: 100%;
        }
        li.lslide.active {
            border: 2px solid #FE980F;
        }
    </style>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{URL::to('/')}}">Home</a></li>
          <li class="breadcrumb-item"><a >{{$product_cate_name}}</a></li>
          <li class="breadcrumb-item"><a >{{$product_brand_name}}</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{$product_name}}</li>
        </ol>
      </nav>
    <div class="col-sm-5">
        <ul id="imageGallery">
            @foreach($gallery as $key => $gal)
            <li data-thumb="{{asset('public/uploads/gallery/'.$gal->gallery_image)}}" data-src="{{asset('public/uploads/gallery/'.$gal->gallery_image)}}" class="active">
              <img width="100%" alt="{{$gal->gallery_name}}"  src="{{asset('public/uploads/gallery/'.$gal->gallery_image)}}" />
            </li>
            @endforeach
        </ul>

    </div>

    <div class="col-sm-7">
        <div class="product-information"><!--/product-information-->
            <img src="images/product-details/new.jpg" class="newarrival" alt="" />
            <form method="POST">
                <h2>{{$value->product_name}}</h2>
                <p>Product ID: {{$value->product_id}}</p>
                @if($value->product_quantity > 0)
                <h3>Available: {{$value->product_quantity}} Item</h3>
                @else
                <h3>Out of stock</h3>
                @endif
                <img src="images/product-details/rating.png" alt="" />
                    @csrf
                    <span>
                        <span>{{number_format($value->product_price,0,',','.').' '.'VNĐ'}}</span>
                        {{-- <label>Quantity:</label> --}}
                        <input type="hidden" value="{{$value->product_id}}" class="cart_product_id_{{$value->product_id}}">
                        <input type="hidden" value="{{$value->product_name}}" class="cart_product_name_{{$value->product_id}}">
                        <input type="hidden" value="{{$value->product_price}}" class="cart_product_price_{{$value->product_id}}">
                        <input type="hidden" value="{{$value->product_image}}" class="cart_product_image_{{$value->product_id}}">
                        <input type="hidden" value="{{1}}" class="cart_product_qty_{{$value->product_id}}">
                        {{-- <input name="quantity" type="number" min="1" value="1" /> --}}
                        <input name="product_id_hidden" type="hidden" min="1" value="{{$value->product_id}}" />
                       
                        {{-- <button type="button" name="add-to-cart" class="btn btn-fefault add-to-cart">
                            <i class="fa fa-shopping-cart"></i>
                            Add to cart
                        </button> --}}
                    </span>
                    <style type="text/css">
                        a.tags_style {
                            background-color: #FE980F;
                            color: #fff;
                            padding: 5px;
                            margin: 5px;
                            border-radius: 5px;
                            font-size: 12px;
                            font-weight: bold;
                        }
                        a.tags_style:hover {
                            background-color: #fff;
                            color: #FE980F;
                        }
                    </style>
                    @if(Session::has('customer_email'))
                        @if(($value->product_quantity > 0))
                            <button name="add-to-cart" type="button" class="btn btn-default add-to-cart" data-id_product="{{$value->product_id}}">
                            <i class="fa fa-shopping-cart"></i>Add to cart
                            </button>
                        @else
                            <button disabled name="add-to-cart" type="button" class="btn btn-default add-to-cart" data-id_product="{{$value->product_id}}">
                                <i class="fa fa-shopping-cart"></i>Add to cart
                            </button>
                        @endif
                    @elseif(!Session::has('customer_email'))
                        <h2> Please Log in to buy or add product to cart!! </h2>
                    @endif
            </form>
            <p><b>Availability:</b> In Stock</p>
            <p><b>Condition:</b> New</p>
            <p><b>Brand:</b> {{$value->brand_name}}</p>
            <p><b>Category:</b> {{$value->category_name}}</p>
            <a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
            <fieldset>
                <legend>Tags</legend>
                <p><i class="fa fa-tag"></i>
                    @php $tags = explode(',',$value->product_tag); @endphp
                    @foreach($tags as $tag)
                    <a class="tag_style" href="{{url('/tag/'.Str::slug($tag))}}">{{$tag}}</a>
                    @endforeach
                </p>
            </fieldset>
        </div><!--/product-information-->
    </div>
   
</div><!--/product-details-->



<div class="category-tab shop-details-tab"><!--category-tab-->
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            <li ><a href="#details" data-toggle="tab">Description</a></li>
            <li><a href="#companyprofile" data-toggle="tab">Details</a></li>
            <li  class="active"><a href="#reviews" data-toggle="tab">Reviews</a></li>
        </ul>
    </div>
  
    <div id="fb-root"></div>
    <div id="fb-root"></div>
    <div id="fb-root">
        <div class="tab-pane fade active in" id="reviews" >
            <div class="col-sm-12">
                {{-- <ul>
                    <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                    <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                    <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                </ul> --}}
                <style type="text/css">
                    .style_comment {
                        border: 1px solid #ddd;
                        border-radius: 10px;
                        background : #f0f0e9;
                    }
                </style>
                <form>
                    @csrf
                    <input type="hidden" value="{{$value->product_id}}" name="product_id_comment" class="product_id_comment">
                    <div id="comment-show"> </div>
                
                </form>
                
                <p><b>Write Your Review</b></p>
                
                <form>
                    @csrf
                    <span>
                        <input type="text" name="comment_name" type="text" placeholder="Your Name" required/>
                        <input type="email" name="comment_email" type="email" placeholder="Email Address" required/>
                    </span>
                    <textarea name="comment-content" class="comment_content"placeholder="Write your comment" required ></textarea>
                    {{-- <b>Rating: </b> <img src="{{asset('public/frontend/images/rating.png')}}" alt="" /> --}}
                    <button data-product_id="{{$value->product_id}}" type="button" class="btn btn-default send_comment pull-right">
                        Submit
                    </button>
                </form>
            </div>
        </div>
    </div>
    
</div><!--/category-tab-->
<script type="text/javascript">
	$(document).ready(function(){
		loadComment();
		function loadComment(){
			var product_id = $('.product_id_comment').val();
			var _token = $('input[name="_token"]').val();
			//alert(product_id);
			$.ajax({
				url:"{{url('/load-comment')}}",
				method:"POST",
				data:{product_id:product_id, _token:_token},
				success:function(data){
					$('#comment-show').html(data);
				}
			});
		}

        $('.send_comment').click(function(){
            var product_id = $(this).data('product_id');
            var comment_name = $('input[name="comment_name"]').val();
            var comment_email = $('input[name="comment_email"]').val();
            var comment_content = $('textarea[name="comment-content"]').val();
            var _token = $('input[name="_token"]').val();
            alert(product_id + "\n" + comment_name + "\n" + comment_email + "\n" + comment_content + "\n" + _token);
            $.ajax({
                url:"{{url('/send-comment')}}",
                method:"POST",
                data:{product_id:product_id, comment_name:comment_name, comment_email:comment_email, comment_content:comment_content, _token:_token},
                success:function(data){
                  
                        swal ( "Success" ,  "Comment send successfully" ,  "success" );
                        loadComment();
                        //set null value for input
                        $('input[name="comment_name"]').val('');
                        $('input[name="comment_email"]').val('');
                        $('textarea[name="comment-content"]').val('');
                  
                }
            });
        });
	});

</script>
					
<div class="recommended_items"><!--recommended_items-->
    <h2 class="title text-center">Relative Products</h2>
    
    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="item active">
                @foreach($relative_product as $key => $value)
                <a href="{{URL::to('/product-detail/'.$value->product_id)}}">	
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{URL::to('public/uploads/product/'.$value->product_image)}}" alt="" />
                                <h2>{{number_format($value->product_price,0,',','.').' '.'VNĐ'}}</h2>
                                <p>{{$value->product_name}}</p>
                                <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                            </div>
                        </div>
                    </div>
                </div>
                </a>
                @endforeach
               
            </div>
        </div>
         <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
            <i class="fa fa-angle-left"></i>
          </a>
          <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
            <i class="fa fa-angle-right"></i>
          </a>			
    </div>
</div><!--/recommended_items-->
@endforeach
@endsection
