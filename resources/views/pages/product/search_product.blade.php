@extends('layout')
@section('content')

<div class="features_items"><!--features_items-->
    <h2 class="title text-center">Result</h2>
    @foreach($all_product as $key => $value)
    <a href="{{URL::to('/product-detail/'.$value->product_id)}}">
    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <div class="single-products">
                    <div class="productinfo text-center">
                        <img src="{{('public/uploads/product/'.$value->product_image)}}" alt="" />
                        <h2>{{number_format($value->product_price).' '.'VNĐ'}}</h2>
                        <p>{{$value->product_name}}</p>
                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                    </div>
                    {{-- <div class="product-overlay">
                        <div class="overlay-content">
                            <h2>{{number_format($value->product_price).' '.'VNĐ'}}</h2>
                            <p>{{$value->product_name}}</p>
                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                        </div>
                    </div> --}}
            </div>
            <div class="choose">
                <ul class="nav nav-pills nav-justified">
                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                </ul>
            </div>
        </div>
    </div>  
</a>
    @endforeach  
</div><!--features_items-->


@endsection

