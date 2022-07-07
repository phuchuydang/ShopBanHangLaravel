@extends('admin_layout')
@section('admin_content')

        
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        ALL ORDERS
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
              <th> No </th>
              <th>Order Code</th>
              <th>Oder Status</th>
              <th>Order Time</th>
              <th>Action</th>
            </tr>
          </thead>
          @php
            $i = 1;
          @endphp
          <tbody>
            @foreach($order as $key => $orders)
            <tr>
              <td>{{$i}}</td>
             
              <td>{{($orders->order_code)}}</td>
             
                <?php
                  if($orders->order_status == 1){
                ?>
                 <td>
                  <span class="label label-success">New</span>
                </td>
                <?php
                  }else{
                ?>
                <td>
                  <span class="label label-danger">Processed</span>
                </td>
                <?php
                  } 
                ?>
              </span></td>
              <td><span class="text-ellipsis">{{$orders->created_at}}</span></td>
              <td>
                <a href="{{URL::to('/view-order/'.$orders->order_code)}}" class="editPro" ui-toggle-class="">
                  <i class="fa fa-eye"></i> </a>
                  <br>
               
              </td>
            </tr>
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