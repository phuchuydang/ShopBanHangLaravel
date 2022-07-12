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
        <form>
          @csrf
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
            @foreach($all_slider as $key => $sliders)
            <tr>
            
              <td>{{($sliders->slider_name)}}</td>
              <td><img src="{{asset('public/uploads/slider/'.$sliders->slider_image)}}" height="100" width="100"></td>
              <td><span class="text-ellipsis">{{$sliders->slider_desc}}</span></td>
              <td><span class="text-ellipsis">
                <?php
                  if($sliders->slider_status == 1){
                ?>
                  <a href="{{URL::to('/unactive-slider/'.$sliders->slider_id)}}"> <span class="fa fa-eye" aria-hidden="true"></span></a>
                <?php
                  }else{
                ?>
                  <a href="{{URL::to('/active-slider/'.$sliders->slider_id)}}"> <span class="fa fa-eye-slash" aria-hidden="true"></span></a>
                <?php
                  } 
                ?>
              </span></td>
              <td>
                {{-- <a href="{{URL::to('/edit-slider/'.$sliders->slider_id)}}" class="editPro" ui-toggle-class="">
                  <i class="fa fa-pencil-square text-success text-active"></i> </a> --}}
                  <br>
                <a data-slider_id="{{$sliders->slider_id}}" class="del_slider" ui-toggle-class="">
                  <i class="fa fa-trash text-danger text"></i></a>
              </td>
            </tr>
            @endforeach          
          </tbody>
        </table>
      </form>
      </div>
    </div>
  </div>
@endsection