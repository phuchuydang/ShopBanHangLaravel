@extends('admin_layout')
@section('admin_content')  
@foreach($order_detail as $order_details => $detail)
<a target="blank" href="{{URL::to('/print_order/'.$detail->order_code)}}" ><i style="
  font-size: 50px;
  color: #999;
  border-top: none !important;" class="fa fa-print" aria-hidden="true"></i> </a>
@endforeach
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        CUSTOMER DETAILS
      </div>
      <div class="table-responsive">
        <table class="table table-striped b-t b-light">
          <thead>
            <tr>     
              <th>Customer</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Address</th>
            </tr>
          </thead>
          <tbody>
            
            <tr>
              <td>{{$customer->customer_name}}</td>
              <td>{{$customer->customer_email}}</td>
              <td>{{$customer->customer_phone}}<span class="text-ellipsis"></span></td>
              <td>{{$customer->customer_address}}<span class="text-ellipsis"></span></td>
            </tr> 
            
          </tbody>
        </table>
      </div>
      {{-- <footer class="panel-footer">
        <div class="row">
          
          <div class="col-sm-5 text-center">
            <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
          </div>
          <div class="col-sm-7 text-right text-center-xs">                
            <ul class="pagination pagination-sm m-t-none m-b-none">
              <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
              <li><a href="">1</a></li>
              <li><a href="">2</a></li>
              <li><a href="">3</a></li>
              <li><a href="">4</a></li>
              <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
            </ul>
          </div>
        </div>
      </footer> --}}
    </div>
  </div>
  <br>
  <br>
  <div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        TRANSPORT DETAILS
      </div>
      <div class="table-responsive">
        <table class="table table-striped b-t b-light">
          <thead>
            <tr>     
                <th>Product Name</th>
                <th>Shipping Address</th>
                <th>Shipping Note</th>
                <th>Shipping Method</th>
            </tr>
          </thead>
          <tbody>
         
            <tr>
                <td>{{$shipping->shipping_name}}</td>
                <td>{{$shipping->shipping_address}}</td>
                <td>{{$shipping->shipping_note}}</td>
                @if($shipping->shipping_method == 1)
                <td>
                  <span class="label label-success">Cash On Delivery</span>
                </td>
                @else
                <td>
                  <span class="label label-danger">Banking</span>
                </td>
                @endif
            </tr>
         
          </tbody>
        </table>
      </div>
      
    </div>
  </div>
   <br>
    <br>
    <div class="table-agile-info">
        <div class="panel panel-default">
          <div class="panel-heading">
            ORDER DETAILS
          </div>
          <div class="table-responsive">
            <table class="table table-striped b-t b-light">
              <thead>
                <tr>
                  <th> No </th>
                  <th>Product Name</th>
                  <th>Available In Stock</th>
                  <th>Image</th>
                  <th>Amount Order</th>
                  <th>Price</th>
                  <th style="width:30px;">Total</th>
                  <th></th>
                </tr>
              </thead>
              @php
                $i = 1;
              @endphp
            
              <tbody>
                @foreach($order_detail as $order_details => $detail)
                <tr>
                    <td>{{$i}}</td>
                   
                    <td>{{$detail->product_name}}</td>
                    <td>{{$detail->product->product_quantity}}</td>
                    <td><img src="{{asset('public/uploads/product/'.$detail->product->product_image)}}" height="100" width="100"></td>
                    <td>{{$detail->product_sales_quantity}}</td>
                    <td> {{number_format($detail->product_price,0,',','.').' '.'VNĐ'}}</td>
                    <td>
                        {{number_format($detail->product_price*$detail->product_sales_quantity,0,',','.').' '.'VNĐ'}}
                        <input type="hidden" name="order_quantity" class="order_quantity" value="{{$detail->product_sales_quantity}}"> 
                        
                        <input type="hidden" name="order_quantity_id" class="order_quantity_id" value="{{$detail->product_id}}"> 
                    </td>
                    
                    {{-- <td>
                        <a href="" class="editPro" ui-toggle-class="">
                        <i class="fa fa-pencil-square text-success text-active"></i> </a>
                        <br>
                        <a onclick="return confirm('Are you sure to delete?')" href="" class="delPro" ui-toggle-class="">
                        <i class="fa fa-trash text-danger text"></i></a>
                    </td> --}}
                </tr> 
                <tr >
                  <td colspan="6">
                    @foreach($order as $orders => $ord)
                    @if($ord->order_status == 1)
                    <form>
                      @csrf
                      <select class="form-control change_status" name="change_status" >
                        <option value="">Select Status</option>
                        <option id="{{$ord->order_id}}" value="1">Pending</option>
                        <option id="{{$ord->order_id}}" value="2">Delivered</option>
                        <option id="{{$ord->order_id}}" value="3">Cancelled</option>
                      </select>
                    </form>
                    @elseif($ord->order_status == 2)
                    <form>
                      @csrf
                      <select class="form-control change_status" name="change_status" >
                        <option disabled value="">Select Status</option>
                        <option id="{{$ord->order_id}}" value="1">Pending</option>
                        <option id="{{$ord->order_id}}" selected value="2">Delivered</option>
                        <option id="{{$ord->order_id}}" value="3">Cancelled</option>
                      </select>
                    </form>
                    @else
                    <form>
                      @csrf
                      <select class="form-control change_status" name="change_status" >
                        <option value="">Select Status</option>
                        <option id="{{$ord->order_id}}" value="1">Pending</option>
                        <option id="{{$ord->order_id}}" value="2">Delivered</option>
                        <option id="{{$ord->order_id}}" selected value="3">Cancelled</option>
                      </select>
                    @endif
                    @endforeach
                  </td>
                <tr>
                @php
                  $i++;
                @endphp
                @endforeach
              </tbody>
            </table>
            
          </div>
        </div>
      </div> 
@endsection