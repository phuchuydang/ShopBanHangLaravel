@extends('admin_layout')
@section('admin_content')

        
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        LIST BRANDS PRODUCT
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
              <th style="width:20px;">
                No
              </th>
              <th>Brand Name</th>
              <th>Description</th>
              <th>Display</th>
              <th>Create At</th>
              <th style="width:30px;">Action</th>
            </tr>
          </thead>
          <tbody>
            @php
              $i = 1;
            @endphp
            @foreach($all_brand_product as $key => $brand_pro)
            <tr>
              <td>{{$i}}</td>
              <td>{{($brand_pro->brand_name)}}</td>
              <td><span class="text-ellipsis">{{$brand_pro->brand_desc}}</span></td>
              <td><span class="text-ellipsis">
                <?php
                  if($brand_pro->brand_status == 1){
                ?>
                  <a href="{{URL::to('/unactive-brand-product/'.$brand_pro->brand_id)}}"> <span class="fa fa-eye" aria-hidden="true"></span></a>
                <?php
                  }else{
                ?>
                  <a href="{{URL::to('/active-brand-product/'.$brand_pro->brand_id)}}"> <span class="fa fa-eye-slash" aria-hidden="true"></span></a>
                <?php
                  } 
                ?>
              </span></td>
              <td><span class="text-ellipsis">{{$brand_pro->created_at}}</span></td>
              <td>
                <a href="{{URL::to('/edit-brand-product/'.$brand_pro->brand_id)}}" class="editPro" ui-toggle-class="">
                  <i class="fa fa-pencil-square text-success text-active"></i> </a>
                  <br>
                <a data-brand_id ="{{$brand_pro->brand_id}}" class="del_brand" ui-toggle-class="">
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