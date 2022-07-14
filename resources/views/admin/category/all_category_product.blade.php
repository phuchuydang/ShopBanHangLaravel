@extends('admin_layout')
@section('admin_content')

        
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        LIST CATEGORY PRODUCT
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
              <th>Category Name</th>
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
            @foreach($all_category_product as $key => $cate_pro)
            <tr>
              <td>{{$i}}</td>
              <td>{{($cate_pro->category_name)}}</td>
              <td><span class="text-ellipsis">{{$cate_pro->category_desc}}</span></td>
              <td><span class="text-ellipsis">
                <?php
                  if($cate_pro->category_status == 1){
                ?>
                  <a href="{{URL::to('/unactive-category-product/'.$cate_pro->category_id)}}"> <span class="fa fa-eye" aria-hidden="true"></span></a>
                <?php
                  }else{
                ?>
                  <a href="{{URL::to('/active-category-product/'.$cate_pro->category_id)}}"> <span class="fa fa-eye-slash" aria-hidden="true"></span></a>
                <?php
                  } 
                ?>
              </span></td>
              <td><span class="text-ellipsis">{{$cate_pro->created_at}}</span></td>
              <td>
                <a href="{{URL::to('/edit-category-product/'.$cate_pro->category_id)}}" class="editPro" ui-toggle-class="">
                  <i class="fa fa-pencil-square text-success text-active"></i> </a>
                  <br>
                <a data-cate_id="{{$cate_pro->category_id}}" class="del_cate" ui-toggle-class="">
                  <i class="fa fa-trash text-danger text"></i></a>
              </td>
            </tr>
            @php
              $i++;
            @endphp
            @endforeach          
          </tbody>
        </form>
        </table>
      </div>
      
    </div>
  </div>
@endsection