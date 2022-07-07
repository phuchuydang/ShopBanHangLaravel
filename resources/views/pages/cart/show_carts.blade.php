@extends('layout')
@section('content')

<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="{{URL::to('/')}}">Home</a></li>
              <li class="active">Shopping Cart</li>
            </ol>
        </div>
        @if(Session::has('message'))
            <div class="alert alert-success">
                {{Session::get('message')}}
            </div>
        @elseif(Session::has('error'))
            <div class="alert alert-danger">
                {{Session::get('error')}}
            </div>
        @endif
        <div class="table-responsive cart_info">
            <form action="{{URL::to('/update-cart-quantities')}}" method="POST">
                {{csrf_field()}}
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
                            
                                    <input class="cart_quantity_input" min="1" type="number" name="cart_quantity[{{$cart['session_id']}}]" value="{{$cart['product_qty']}}" autocomplete="off" size="2">
                                  
                                    
                            
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">
                                {{number_format($subtotal,0,',','.').' '.'VNĐ'}}
                              
                            </p>
                        </td>
                        <td class="cart_delete">
                            <a href="{{URL::to('/delete-item/'.$cart['session_id'])}}" class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                     @endforeach       
                </tbody>
            </table>
           
            @if(Session::has('cart'))
            <input type="submit" name="update_cart" value="Update All" class="btn btn-default check_out"></a>
            {{-- <a href="{{URL::to('/delete-all-cart')}}"><input type="submit" name="delete_all" value="Delete All" class="btn btn-default check_out"></a> --}}
        </form>
            @endif
        </div>
    </div>
</section> <!--/#cart_items-->
@if(Session::has('cart'))
<section id="do_action">
    <form method="POST" action="{{URL::to('/check-voucher')}}">
        {{ csrf_field() }}
        <div class="col-sm-6">
            <ul>
              
            </ul>
            <div class="total_area">
               
                <ul>
                    <li><input type="text" name="voucher_code" class="form-control" placeholder="Use Discount Voucher"required></li>
                </ul>                
                {{-- <a class="btn btn-default check_out" onclick="document.getElementById('useVoucher').submit()">Use</a> --}}
                <ul>
                    <input type="submit" name="use_voucher" value="Use" class="btn btn-default use_voucher">
                </ul> 
            </div>                       
        </div>
    </form>

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
                                        @php
                                            $totalall += ($total + $totaltax)-($total*(($value['voucher_percent_discount']/100))); 
                                        @endphp

                                    @endif
                                @else
                                    0
                                    @php
                                        $totalall += ($total + $totaltax);
                                    @endphp
                                @endif
                              
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
                </ul>
                    {{-- <a class="btn btn-default update" href="">Update</a> --}}
{{-- 
                    <?php

                            $customer_id = Session::get('customer_id');
                            $shipping_id = Session::get('shipping_id');
                            if($customer_id != NULL && $shipping_id == NULL){

                        ?> --}}
                        <a class="btn btn-default check_out" href="{{URL::to('/show-checkout')}}">Check Out</a>

                        @if(Session::get('voucher'))
                            <a class="btn btn-default check_out" href="{{URL::to('/remove-voucher')}}">Remove Voucher</a>
                        @endif
                        {{-- <?php }else if($customer_id != NULL && $shipping_id != NULL){ ?>
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
</section><!--/#do_action-->
@endsection
