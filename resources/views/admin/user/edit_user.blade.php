@extends('admin_layout')
@section('admin_content')

        
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        LIST SLIDER
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
              <th>Slider Name</th>
              <th>Slider Image</th>
              <th>Description</th>
              <th>Status</th>
              <th style="width:30px;">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($user as $key => $users)
            <tr>
            
              <td>{{($users->customer_name)}}</td>
              <td>>{{($users->customer_email)}}</td>
              <td><span class="text-ellipsis">{{$users->customer_phone}}</span></td>
              <td><span class="text-ellipsis">{{$users->customer_address}}</span></td>
              <td>
                {{-- <a href="{{URL::to('/edit-slider/'.$users->customer_id)}}" class="editPro" ui-toggle-class="">
                  <i class="fa fa-pencil-square text-success text-active"></i> </a> --}}
                  <br>
                <a onclick="return confirm('Are you sure to delete slider?')" href="{{URL::to('/delete-slider/'.$users->customer_id)}}" class="delPro" ui-toggle-class="">
                  <i class="fa fa-trash text-danger text"></i></a>
              </td>
            </tr>
            @endforeach          
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection