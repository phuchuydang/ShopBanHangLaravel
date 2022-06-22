@extends('layout')
@section('content')

<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="{{URL::to('/')}}">Home</a></li>
              <li class="active">Payment</li>
            </ol>
        </div>
        <div class="review-payment">
            <h2>Review & Payment</h2>
        </div>
        <div class="table-responsive cart_info">
            <?php 
                $content = Cart::content();
                
            ?>
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Image</td>
                        <td class="description">Description</td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($content as $v_content)
                    <tr>
                        <td class="cart_product">
                            <a href=""><img height="100px" width="100px" src="{{URL::to('public/uploads/product/'.$v_content->options->image)}}" alt=""></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{$v_content->name}}</a></h4>
                            <p></p>
                        </td>
                        <td class="cart_price">
                            <p>{{number_format($v_content->price).' '.'VNĐ'}}</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                               <form action="{{URL::to('/update-cart-quantity')}}" method="POST">
                                    {{ csrf_field() }}
                                    <input class="cart_quantity_input" type="text" name="quantity" value="{{$v_content->qty}}" autocomplete="off" size="2">
                                    <input type="text" name="id_product" value="{{$v_content->rowId}}" hidden>
                                    <input type="submit" name="update_qty" value="Update" class="btn btn-default btn-sm">
                               </form>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">
                            
                                {{Cart::priceTotal(0,',','.').' '.'VNĐ'}}
                            </p>
                        </td>
                        <td class="cart_delete">
                            <a href="{{URL::to('/delete-cart/'.$v_content->rowId)}}" class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                      @endforeach                
                </tbody>
            </table>
        </div>
        </div>
        <h4 style="margin-top: 40px 0; font-size:20px;"></h4>
        <form method="POST" action="{{URL::to('/order-place')}}">
            {{ csrf_field() }}
            <div class="payment-options">
                <span>
                    <label><input name="paymnet_option" value="1" type="checkbox"> Direct Bank Transfer</label>
                </span>
                <span>
                    <label><input name="paymnet_option" value="2" type="checkbox"> Cash</label>
                </span>
                <span>
                    <label><input name="paymnet_option" value="3" type="checkbox"> Momo</label>
                    
                </span>   
                <input type="submit" name="send_order_item" value="Order" class="btn btn-primary btn-sm">   
            </div>
        </form>
    </div>
</section> <!--/#cart_items-->
@endsection