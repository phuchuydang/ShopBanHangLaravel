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
                    @foreach($content as $v_content)
                    <tr>
                        <input hidden type="text" name="id_product" value="{{$v_content->rowId}}">
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
                                    <input type="submit" name="update_qty_{{$v_content->rowId}}" value="Update" class="btn btn-default btn-sm">
                               </form>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">
                            
                                {{number_format($v_content->price * $v_content->qty,0, '.', ' ').' '.'VNĐ'}}
                            </p>
                        </td>
                        <td class="cart_delete">
                            <a href="{{URL::to('/delete-cart/'.$v_content->rowId)}}" class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach              
                </tbody>
            </table>
            @if(Session::has('cart'))
            <a href="{{URL::to('/delete-all-cart')}}"><input type="submit" name="delete_all" value="Delete All" class="btn btn-default check_out"></a>
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
                      
                <?php $message = Session::get('message');
                    if($message){
                        echo '<span class="text-alert">'.$message.'</span>';
                        Session::put('message',null);   
                    }
                ?>
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
@endif
    @if(Session::has('cart'))
	<div class="container">

        <div class="col-sm-6">
            <div class="total_area">
                <ul>
                    <li>Cart Sub Total <span>{{Cart::priceTotal(0,',','.').' '.'VNĐ'}}</span></li>
                    <li>Tax <span>{{Cart::tax(0,',','.').' '.'VNĐ'}}</span></li>
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
                            @endforeach  
                        @else
                            None
                        @endif 
                        
     
                    </span></li>
                    <li>Total <span>
                        {{Cart::total(0,',','.').' '.'VNĐ'}}
                        {{-- @if(Session::get('voucher'))
                            @foreach(Session::get('voucher') as $voucher => $value)
                                @if($value['voucher_condition'] == 1)
                                    @if($value['voucher_percent_discount'] <= 100 && $value['voucher_percent_discount'] > 0)
                                    {{Cart::total(0,',','.')-$value['voucher_percent_discount'].' '.'VNĐ'}} 
                                    @endif
                                @endif
                            @endforeach
                        @else
                            {{Cart::total(0,',','.').' '.'VNĐ'}}
                        @endif
                     --}}
                    </span></li>
                </ul>
                    {{-- <a class="btn btn-default update" href="">Update</a> --}}

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
                        <?php } ?>
            </div>
                    
            </div>
    </div>
    @endif
</section><!--/#do_action-->
@endsection
