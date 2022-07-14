@extends('layout')
@section('content')

<div class="features_items"><!--features_items-->
    <h2 class="title text-center">New Items</h2>
    @foreach($all_product as $key => $value)
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
                            {{-- <button data-product_id="{{$value->product_id}}"  type="button" class="btn btn-primary quickview" data-toggle="modal" data-target="#quickView">
                                Quick view
                            </button>

                            <div class="modal fade" id="quickView" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="model-title product_quickview_title">
                                        <span id="product_quickview_title"></span>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <span id="product_quickview_image"></span>
                                            </div>
                                            <div class="col-md-7">
                                                <span id="product_quickview_id"></span>
                                                <span id="product_quickview_price"></span>
                                                <span id="product_quickview_desc"></span>
                                                <span id="product_quickview_content"></span>
                                               
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        
                                    </div>
                                  </div>
                                </div>
                              </div>
                            --}}
                        </form>
                        <div class="choose">
                            <style>
                                ul.nav.nav-pills.nav-justified li {
                                    text-align: center;
                                    font-size: 20px;
                                }
                                .button_wishlist{
                                    background-color: #ffff;
                                    color: #B3AFA8;
                                    border: none;
                                    
                                }
                                ul.nav.nav-pills.nav-justified i {
                                    color: #B3AFA8;
                                }
                                /* .button_wishlist span:hover{
                                    color: #fe980f;
                                } */
                                /* .button_wishlist:focus {
                                    outline: none;
                                    border: none;
                                } */
                            </style>
                            <ul class="nav nav-pills nav-justified">
                                <li>
                                    <button class="button_wishlist" id="{{$value->product_id}}" 
                                        onclick="add_wishlist(this.id);"><span>Add to Wishlist</span></button>
                                </li>
                                {{-- <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li> --}}
                            </ul>
                        </div>
                        
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
                    <li><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Launch demo modal
                      </button></li>
                </ul>
            </div> --}}
        </div>
    </div>  
</a>
    @endforeach  
</div><!--features_items-->
<script type="text/javascript">
    function add_wishlist(clicked_id){
        var id = clicked_id;
        // var name = document.getElementById("wishlist_productname"+id).value;
        // var image = document.getElementById("wishlist_productimage"+id).src;
        // var price = document.getElementById("wishlist_productprice"+id).value;
        // var url = document.getElementById("wishlist_producturl"+id).href;
        // var newItem = {
        //     id: id,
        //     name: name,
        //     image: image,
        //     price: price,
        //     url: url
        // };
        // var old_data = JSON.parse(localStorage.getItem("data"));
        // if(localStorage.getItem("data") == null){
        //     localStorage.setItem("data", []);
        // } 
        // var matches = $.grep(old_data, function(e){ return e.id == id; });
        // if(matches.length == 0){
        //    old_data.push(newItem);
        //    $('#row_wishlist').append('<div class="row" style="margin:10px 0"><div class="col-md-4"><img src="'+image+'" style="width:100px;height:100px;"></div><div class="col-md-8"><a href="'+url+'">'+name+'</a><br><span>'+price+'</span></div></div>');
          
        // } else {
        //     swal ( "Error" ,  "Product has already been added to wishlist" ,  "error" );
        // }

        // localStorage.setItem("data", JSON.stringify(old_data));
    }
</script>
@endsection

