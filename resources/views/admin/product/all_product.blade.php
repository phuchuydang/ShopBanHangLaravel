@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        LIST PRODUCT
      </div>
      <div class="table-responsive">
        <?php $message = Session::get('message');
          if($message){
            echo '<span class="text-alert">'.$message.'</span>';
            Session::put('message',null);   
          }
        ?>
        <form>
          @csrf
        <table id="myTables" class="table table-striped b-t b-light">
          <thead>
            <tr>
              <th>No</th>
              <th>Product Name</th>
              <th>Product Gallery</th>
              <th>Product Quantity</th>
              <th>Price</th>
              <th>Image</th>
              <th>Category</th>
              <th>Brand</th>
              <th>Status</th>
              <th style="width:30px;">Action</th>
            </tr>
          </thead>
          <tbody>
            @php
                $i = 1;
            @endphp
            @foreach($all_product as $key => $pro)
            <tr>
              <td> {{ $i}} </td>
              <td>{{($pro->product_name)}}</td>
              <td><a href="{{URL::to('/add-gallery/'.$pro->product_id)}}">Add Product Gallery</a></td>
              <td>{{($pro->product_quantity)}}</td>
              <td>{{($pro->product_price)}}</td>
              <td><img src="public/uploads/product/{{($pro->product_image)}}" height="100" width="100"></td>
              <td>{{($pro->category->category_name)}}</td>
              <td>{{$pro->brand->brand_name}}</td>
              <td><span class="text-ellipsis">
                <?php
                  if($pro->product_status == 1){
                ?>
                  <a href="{{URL::to('/unactive-product/'.$pro->product_id)}}"> <span class="fa fa-eye" aria-hidden="true"></span></a>
                <?php
                  }else{
                ?>
                  <a href="{{URL::to('/active-product/'.$pro->product_id)}}"> <span class="fa fa-eye-slash" aria-hidden="true"></span></a>
                <?php
                  } 
                ?>
              </span></td>
              
              <td>
                <a href="{{URL::to('/edit-product/'.$pro->product_id)}}" class="editPro" ui-toggle-class="">
                  <i class="fa fa-pencil-square text-success text-active"></i> </a>
                  <br>
                <a data-pro_id="{{$pro->product_id}}" class="del_pro" ui-toggle-class="">
                  <i class="fa fa-trash text-danger text"></i></a>
              </td>
            </tr>
            @php
                $i++;
            @endphp
            @endforeach          
          </tbody>
        </table>
        </form>
      </div>
    </div>
  </div>
@endsection