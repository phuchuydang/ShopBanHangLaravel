@extends('admin_layout')
@section('admin_content')

        
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        LIST USER
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
              <th>Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Address</th>
             
              <th style="width:30px;">Action</th>
            </tr>
          </thead>
          <tbody>
            @php
              $i = 1;
            @endphp
            @foreach($user as $key => $user)
           
            <tr>
              <td>{{$i}}</td>
              <td>{{($user->customer_name)}}</td>
              <td>{{($user->customer_email)}}</td>
              <td><span class="text-ellipsis">{{$user->customer_phone}}</span></td>
              <td><span class="text-ellipsis">{{$user->customer_address}}</span></td>
              <td>
                <a href="{{URL::to('/edit-user-role/'.$user->customer_id)}}" class="editRole" ui-toggle-class="">
                  <i class="fa fa-pencil-square text-success text-active"></i> </a>
                  <br>
                <a data-user_id="{{$user->customer_id}}" class="del_user" ui-toggle-class="">
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