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
        <table class="table table-striped b-t b-light">
          <thead>
            <tr>
              <th>City</th>
              <th>Province</th>
              <th>Ward</th>
              <th>FeeShip</th>
              <th style="width:30px;">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($feeship as $key => $feeships)
            <tr>
              <td>{{($feeships->namecity)}}</td>
              <td>{{$feeships->nameprovince}}</td>
              <td>{{$feeships->nameward}}</td>
              <td>{{number_format($feeships->feeship_price,0,',','.').' '.'VNĐ'}}</td>
              <td>
                <a href="{{URL::to('/edit-delivery/'.$feeships->feeship_id)}}" class="editPro" ui-toggle-class="">
                  <i class="fa fa-pencil-square text-success text-active"></i> </a>
                  <br>
                <a onclick="return confirm('Are you sure to delete?')" href="{{URL::to('/delete-delivery/'.$feeships->feeship_id)}}" class="delPro" ui-toggle-class="">
                  <i class="fa fa-trash text-danger text"></i></a>
              </td>
            </tr>
            @endforeach          
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
@endsection