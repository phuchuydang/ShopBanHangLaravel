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
                                      
                </tbody>
            </table>
        </div>
    </div>
</section> <!--/#cart_items-->
<section id="do_action">
		<div class="container">

				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Cart Sub Total <span>{{Cart::priceTotal(0,',','.').' '.'VNĐ'}}</span></li>
							<li>Eco Tax <span>{{Cart::tax(0,',','.').' '.'VNĐ'}}</span></li>
							<li>Shipping Cost <span>Free</span></li>
							<li>Total <span>{{Cart::total(0,',','.').' '.'VNĐ'}}</span></li>
						</ul>
							{{-- <a class="btn btn-default update" href="">Update</a> --}}

                            <?php

									$customer_id = Session::get('customer_id');
									$shipping_id = Session::get('shipping_id');
									if($customer_id != NULL && $shipping_id == NULL){

								?>
                                <a class="btn btn-default check_out" href="{{URL::to('/show-checkout')}}">Check Out</a>
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
			</div>
		</div>
	</section><!--/#do_action-->
    @endforeach    
@endsection
