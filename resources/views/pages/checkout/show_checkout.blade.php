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
                            <form method="POST">
                                @csrf
                                <input type="text" class="shipping_email" name="shipping_email" required placeholder="Email*">
                                <input type="text" class="shipping_name" name="shipping_name" placeholder="Name *" required>
                                <input type="text" class="shipping_address" name="shipping_address" placeholder="Address  *" required>
                                <input type="text" class="shipping_phone" name="shipping_phone" placeholder="Phone *" required>
                                <textarea  rows="5" class="shipping_note" name="shipping_note"  placeholder="Notes about your order, Special Notes for Delivery *" rows="16" required></textarea>
                                @if(Session::get('voucher'))
                                    @foreach(Session::get('voucher') as $voucher => $value)
                                        <input type="text" class="voucher_code" name="voucher_code" value="{{$value['voucher_code']}}" hidden>
                                    @endforeach
                                @else
                                    <input type="text" class="voucher_code" name="voucher_code" value="0" hidden>
                                @endif
                                <br>
                               
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Payment option</label>
                                        <select id="shipping_method" name="shipping_method" class="form-control input-sm m-bot15 shipping_method" required >
                                          <option value="0">Cash</option>
                                          <option value="1">Bank</option>
                                        </select>                       
                                    </div>        
                              
                                <input type="button" name="send_order" value="Checkout" class="btn btn-primary btn-sm send_order">
                            </form>
                            {{-- <form role="form">
                                @csrf
                              <div class="form-group">
                                  <label for="exampleInputPassword1">City</label>
                                  <select id="city" name="city" class="form-control input-sm m-bot15  choose city" required>
                                    <option value="">Choose City</option>
                                    @foreach($cities as $city)
                                      <option value="{{$city->matp}}">{{$city->namecity}}</option>
                                    @endforeach
                                  </select>                       
                              </div>
                              <div class="form-group">
                                <label for="exampleInputPassword1">Province</label>
                                <select id="province" name="province" class="form-control input-sm m-bot15  province choose" required>
                                  <option value="">Choose Province</option>
                                  
                                </select>                       
                              </div>
                              <div class="form-group">
                                <label for="exampleInputPassword1">Ward</label>
                                <select id="ward" name="ward"class="form-control input-sm m-bot15  ward" required >
                                  <option value="">Choose Ward</option>
                                </select>                       
                            </div>
                          
                    
                            <input type="button" name="cal_feeship" value="Caluclate Feeship" class="btn btn-primary btn-sm cal_feeship">   
                        </form>
                        <h1 class="temp"></h1> --}}
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
                            <td class="description">Name</td>
                            <td class="price">Price</td>
                            <td class="quantity">Quantity</td>
                            <td class="total">Total</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total= 0;
                            $totaltax = 0;
                            $totalall = 0;
                        @endphp
                       @foreach(Session::get('cart') as $key => $cart)
                       @php
                        if($cart['product_total'] > 0)
                           $subtotal = $cart['product_total'];
                        else 
                           $subtotal = $cart['product_price'] * $cart['product_qty'];
    
                        //total
                        $total += $subtotal;
                        $totaltax += $cart['product_price'] * 0.02;
                      
                       @endphp
                        <tr>
                            <input hidden type="text" name="id_product" value="">
                            <td class="cart_product">
                                <a href=""><img height="100px" width="100px" src="{{asset('public/uploads/product/'.$cart['product_image'])}}" alt=""></a>
                            </td>
                            
                            <td class="cart_anme">
                              
                                <p>{{$cart['product_name']}}</p>
                            </td>
                            <td class="cart_price">
                                <p>
                                    {{number_format($cart['product_price'],0,',','.').' '.'VNĐ'}}
                                </p>
                            </td>
                            <td class="cart_quantity">
                                <div class="cart_quantity_button">
                                
                                        <input class="cart_quantity_input" min="1" type="number" name="cart_quantity[{{$cart['session_id']}}]" value="{{$cart['product_qty']}}" disabled autocomplete="off" size="2">
                                      
                                        
                                
                                </div>
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price">
                                    {{number_format($subtotal,0,',','.').' '.'VNĐ'}}
                                  
                                </p>
                            </td>
                            {{-- <td class="cart_delete">
                                <a href="{{URL::to('/delete-item/'.$cart['session_id'])}}" class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
                            </td> --}}
                        </tr>
                         @endforeach       
                    </tbody>
                </table>
            </div>
        </div>
        </div>

        @if(Session::has('cart'))
	<div class="container">

        <div class="col-sm-6">
            <div class="total_area">
                <ul>
                    <li>Cart Sub Total <span>{{number_format($total,0,',','.').' '.'VNĐ'}}</span></li>
                    <li>Tax <span>{{number_format($totaltax,0,',','.').' '.'VNĐ'}}</span></li>
                    <li>Shipping Cost <span>Free</span></li>
                    <li>Voucher Discount <span>
              
                        @if(Session::get('voucher'))
                            @foreach(Session::get('voucher') as $voucher => $value)
                                @if($value['voucher_condition'] == 1)
                                    @if($value['voucher_percent_discount'] <= 100 && $value['voucher_percent_discount'] > 0)
                                        {{$value['voucher_percent_discount'].'%'}}
                                       
                                    @endif
                                @else
                                    0
                                @endif
                                @php
                                    $totalall += ($total + $totaltax)-($total*(($value['voucher_percent_discount']/100))); 
                                @endphp
                            @endforeach  
                        @else
                            None
                        @endif 
                        
     
                    </span></li>
                    <li>Total <span>
                      
                        @if(Session::get('voucher'))
                            @foreach(Session::get('voucher') as $voucher => $value)
                                @if($value['voucher_condition'] == 1)
                                    @if($value['voucher_percent_discount'] <= 100 && $value['voucher_percent_discount'] > 0)
                                        {{number_format(($total + $totaltax)-($total*(($value['voucher_percent_discount']/100))),0,',','.').' '.'VNĐ'}}
                                    @else
                                        {{number_format(($total + $totaltax),0,',','.').' '.'VNĐ'}}
                                    @endif
                                @else
                                    {{number_format(($total + $totaltax),0,',','.').' '.'VNĐ'}}
                                @endif
                              
                            @endforeach
                        @else
                            {{number_format(($total + $totaltax),0,',','.').' '.'VNĐ'}}
                        @endif
                    </span></li>
                    {{-- <a class="btn btn-default update" href="">Update</a> --}}
{{-- 
                    <?php

                            $customer_id = Session::get('customer_id');
                            $shipping_id = Session::get('shipping_id');
                            if($customer_id != NULL && $shipping_id == NULL){

                        ?>
                        <a class="btn btn-default check_out" href="{{URL::to('/show-checkout')}}">Check Out</a>

                        @if(Session::get('voucher'))
                            <a class="btn btn-default check_out" href="{{URL::to('/remove-voucher')}}">Remove Voucher</a>
                        @endif
                        <?php }else if($customer_id != NULL && $shipping_id != NULL){ ?>
                            <a class="btn btn-default check_out" href="{{URL::to('/payment')}}">Check Out</a>

                        <?php
                        } else {
                        ?>
                        <a class="btn btn-default check_out" href="{{URL::to('/login-checkout')}}">Check Out</a>
                        <?php } ?> --}}
            </div>
                    
            </div>
    </div>
    @endif
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