@extends('admin_layout')
@section('admin_content')

        
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        LIST DELIVERY
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
              <th>City</th>
              <th>Province</th>
              <th>Ward</th>
              <th>FeeShip</th>
              <th style="width:30px;">Action</th>
            </tr>
          </thead>
          <tbody>
            @php
              $i = 1;
            @endphp
            @foreach($feeship as $key => $feeships)
            <tr>
              <td>{{$i}}</td>
              <td>{{($feeships->city->namecity)}}</td>
              <td>{{$feeships->province->nameprovince}}</td>
              <td>{{$feeships->ward->nameward}}</td>
              <td>{{number_format($feeships->feeship_price,0,',','.').' '.'VNĐ'}}</td>
              <td>
                <a href="{{URL::to('/edit-delivery/'.$feeships->feeship_id)}}" class="editPro" ui-toggle-class="">
                  <i class="fa fa-pencil-square text-success text-active"></i> </a>
                  <br>
                <a data-deli_id="{{$feeships->feeship_id}}" class="del_deli" ui-toggle-class="">
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