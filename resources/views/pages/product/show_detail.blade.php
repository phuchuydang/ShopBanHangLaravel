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
        </div><!--/product-information-->
    </div>
   
</div><!--/product-details-->



<div class="category-tab shop-details-tab"><!--category-tab-->
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            <li  class="active"><a href="#details" data-toggle="tab">Description</a></li>
            <li><a href="#companyprofile" data-toggle="tab">Details</a></li>
            <li><a href="#reviews" data-toggle="tab">Reviews</a></li>
        </ul>
    </div>
  
    <div id="fb-root">{{$value->product_desc}}</div>
    {{-- <div id="fb-root">{{$value->product_content}}</div> --}}
    <div id="fb-root"></div>
    
</div><!--/category-tab-->

					
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
