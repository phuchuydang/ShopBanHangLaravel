@extends('layout')
@section('content')

<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="{{URL::to('/')}}">Home</a></li>
              <li class="active">Checkout</li>
            </ol>
        </div>
        {{-- <div class="register-req">
            <p>Please use Register or Login to easily Checkout and get access to your order history</p>
        </div><!--/register-req--> --}}

        <div class="shopper-informations">
            <div class="row">
                {{-- <div class="col-sm-3">
                    <div class="shopper-info">
                        
                        <p>Customer Information</p>
                        <form>
                        <?php if($customer != ''){     
                            $customer = DB::table('tbl_customer')->where('customer_id',$customer)->first();
                        
                        ?>
                            <input type="text"  placeholder="{{$customer->customer_name}}" disabled>
                            <input type="text"  placeholder="{{$customer->customer_email}}" disabled>
                            <input type="text" placeholder="{{$customer->customer_phone}}" disabled>
                            <input type="text" placeholder="{{$customer->customer_address}}" disabled>
                            <?php

                        } else {

                        ?>
                         <div class="register-req">
                            <p>Please use Register or Login to ewatch customer information</p>
                         </div>
                        <?php 
                            } 
                        ?>
                        </form>
                     
                    </div>
                </div> --}}
                <div class="col-sm-9 clearfix">
                    <div class="bill-to">
                        <p>Bill To</p>
                        <div class="form-one">
                            <form action="{{URL::to('/save-checkout')}}" method="POST">
                                {{ csrf_field() }}
                                <input type="text" name="shipping_email" required placeholder="Email*">
                                <input type="text" name="shipping_name" placeholder="Name *" required>
                                <input type="text" name="shipping_address" placeholder="Address 1 *" required>
                                <input type="text" name="shipping_phone" placeholder="Phone *" required>
                                <textarea  rows="5" name="shipping_note"  placeholder="Notes about your order, Special Notes for Delivery *" rows="16" required></textarea>
                                <input type="submit" name="send_order" value="Checkout" class="btn btn-primary btn-sm">
                            </form>
                    </div>
                </div>
                		
            </div>
        </div>
        <div class="review-payment">
            <h2>Review & Payment</h2>
            

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
        </div>
        {{-- <div class="payment-options">
                <span>
                    <label><input type="checkbox"> Direct Bank Transfer</label>
                </span>
                <span>
                    <label><input type="checkbox"> Check Payment</label>
                </span>
                <span>
                    <label><input type="checkbox"> Paypal</label>
                </span>
            </div> --}}
    </div>
</section> <!--/#cart_items-->
@endsection