@extends('layout')
@section('content')

<div class="features_items"><!--features_items-->
    <h2 class="title text-center">All Tag Items of {{$product_tag}}</h2>
    @foreach($relative_product as $key => $value)
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
                         
                        </form>
                        
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
        </div>
    </div>  
</a>
    @endforeach  
</div>

@endsection

