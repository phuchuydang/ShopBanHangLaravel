@extends('layout')
@section('content')

<div class="features_items"><!--features_items-->
    @foreach($brand_name as $key => $name)
    <h2 class="title text-center">{{$name->brand_name}}</h2>
    @endforeach
    @foreach($brand_by_id as $key => $value)
    <a href="{{URL::to('/product-detail/'.$value->product_id)}}">
        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                        <div class="productinfo text-center">
                            <form>
                                {{ csrf_field() }}
                                <input type="hidden" class="cart_product_id_{{$value->product_id}}" value="{{$value->product_id}}">
                                <input type="hidden" class="cart_product_name_{{$value->product_id}}" value="{{$value->product_name}}">
                                <input type="hidden" class="cart_product_image_{{$value->product_id}}" value="{{$value->product_image}}">
                                <input type="hidden" class="cart_product_price_{{$value->product_id}}" value="{{$value->product_price}}">
                                <input type="hidden" class="cart_product_qty_{{$value->product_id}}" value="1">
                                <a href="{{URL::to('/product-detail/'.$value->product_id)}}">
                                    <img src="{{URL::to('public/uploads/product/'.$value->product_image)}}" alt="" />
                                    <h2>{{number_format($value->product_price).' '.'VNĐ'}}</h2>
                                    <p>{{$value->product_name}}</p>
                                </a>
                                {{-- <button type="button" class="btn btn-default add-to-cart" id="add-to-cart" name="add-to-cart" data-product_id={{$value->product_id}}>
                                    <i class="fa fa-shopping-cart"></i>Add to cart
                                </button> --}}
                            </form>
                            {{-- <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a> --}}
                        </div>
                        <form>
                            <a href="{{URL::to('/product-detail/'.$value->product_id)}}">
                                <div class="product-overlay">
                                    
                                    <div class="overlay-content">
                                        <img style="width:70%;height:70%;" src="{{URL::to('public/uploads/product/'.$value->product_image)}}" alt="" />
                                        <h2>{{number_format($value->product_price).' '.'VNĐ'}}</h2>
                                        <p>{{$value->product_name}}</p>
                                        <a href="{{URL::to('/product-detail/'.$value->product_id)}}" class="btn btn-default add-to-cart"><i class="fa fa-info-circle" aria-hidden="true"></i>View Detail</a>
                                    </div>
                                </div>
                            </a>
                        </form>
                </div>
                {{-- <div class="choose">
                    <ul class="nav nav-pills nav-justified">
                        <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                        <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                    </ul>
                </div> --}}
            </div>
        </div> 
    @endforeach  
</div><!--features_items-->


{{-- <div class="category-tab"><!--category-tab-->
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tshirt" data-toggle="tab">T-Shirt</a></li>
            
        </ul>
    </div>
    <div class="tab-content">
        <div class="tab-pane fade active in" id="tshirt" >
            <div class="col-sm-3">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="{{('public/frontend/images/gallery1.jpg')}}" alt="" />
                            <h2>$56</h2>
                            <p>Easy Polo Black Edition</p>
                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                        </div>
                        
                    </div>
                </div>
            </div>
            
            
            
        </div>
    </div>
</div><!--/category-tab--> --}}

				
					
{{-- 					
<div class="recommended_items"><!--recommended_items-->
    <h2 class="title text-center">Recommended items</h2>
    
    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="item active">	
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{('public/frontend/images/recommend1.jpg')}}" alt="" />
                                <h2>$56</h2>
                                <p>Easy Polo Black Edition</p>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{('public/frontend/images/recommend2.jpg')}}" alt="" />
                                <h2>$56</h2>
                                <p>Easy Polo Black Edition</p>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{('public/frontend/images/recommend3.jpg')}}" alt="" />
                                <h2>$56</h2>
                                <p>Easy Polo Black Edition</p>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">	
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{('public/frontend/images/recommend1.jpg')}}" alt="" />
                                <h2>$56</h2>
                                <p>Easy Polo Black Edition</p>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{('public/frontend/images/recommend2.jpg')}}" alt="" />
                                <h2>$56</h2>
                                <p>Easy Polo Black Edition</p>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{('public/frontend/images/recommend3.jpg')}}" alt="" />
                                <h2>$56</h2>
                                <p>Easy Polo Black Edition</p>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
         <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
            <i class="fa fa-angle-left"></i>
          </a>
          <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
            <i class="fa fa-angle-right"></i>
          </a>			
    </div>
</div> --}}

@endsection

