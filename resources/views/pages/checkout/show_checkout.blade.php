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
        <div class="register-req">
            <p>Please use Register or Login to easily Checkout and get access to your order history</p>
        </div><!--/register-req-->

        <div class="shopper-informations">
            <div class="row">
                <div class="col-sm-3">
                    <div class="shopper-info">
                        
                        <p>Customer Information</p>
                        <form>
                        <?php if($customer_id != NULL){     
                            $customer = DB::table('tbl_customer')->where('customer_id',$customer_id)->first();
                        
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
                </div>
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