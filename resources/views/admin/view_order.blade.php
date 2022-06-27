@extends('admin_layout')
@section('admin_content')  
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
              <td>{{$order_by_id->customer_name}}</td>
                <td>{{$order_by_id->customer_email}}</td>
              <td>{{$order_by_id->customer_phone}}<span class="text-ellipsis"></span></td>
              <td>{{$order_by_id->customer_address}}<span class="text-ellipsis"></span></td>
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
            </tr>
          </thead>
          <tbody>
            <tr>
                <td>{{$order_by_id->product_name}}</td>
                <td>{{$order_by_id->shipping_address}}</td>
                <td>{{$order_by_id->shipping_note}}</td>
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
            ORDER DETAILS
          </div>
          <div class="table-responsive">
            <table class="table table-striped b-t b-light">
              <thead>
                <tr>
                  
                  <th>Product Name</th>
                  <th>Image</th>
                  <th>Amount</th>
                  <th>Total Price</th>
                  <th>Time Order</th>
                  <th>Status</th>
                  <th style="width:30px;">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($order_by_id as $key => $pro)
        
                echo '{{$pro->product_name}}';
                {{-- <tr>
                    <td>{{$pro->product_name}}</td>
                    <td><img src"{{URL::to('public/uploads/product/232413731210993083.jpg')}}" height="100" width="100"></td>
                    <td>{{$key->product_sales_quantity}}</td>
                    <td>{{$key->order_total}}<span class="text-ellipsis"></span></td>
                    <td><span class="text-ellipsis">{{$key->created_at}}</span></td>
                    <td>{{$key->order_status}}</td>
                    <td>
                        <a href="" class="editPro" ui-toggle-class="">
                        <i class="fa fa-pencil-square text-success text-active"></i> </a>
                        <br>
                        <a onclick="return confirm('Are you sure to delete?')" href="" class="delPro" ui-toggle-class="">
                        <i class="fa fa-trash text-danger text"></i></a>
                    </td>
                </tr>  --}}
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
@endsection