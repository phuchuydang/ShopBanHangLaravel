@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        LIST commentDUCT
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
              <th>User Name</th>
              <th>User Email</th>
              <th>Comment Content</th>
              <th>Comment Date</th>
              <th>Status</th>
              <th style="width:30px;">Action</th>
            </tr>
          </thead>
          <tbody>
            @php
                $i = 1;
            @endphp
            @foreach($comments as $key => $comment)
            @if($comment->comment_parent == 0)
            <tr>
                <td> {{ $i}} </td>
                <td>{{($comment->comment_name)}}</td>
                <td>{{($comment->comment_email)}}</td>
                <td>
                    {{($comment->comment_content)}}
                    <style type="text/css">
                        ul.comment-reply{
                            list-style-type: decimal;
                            color: blue;
                            margin: 5px 40px;
                          
                        }
                    </style>
                    <br>
                    <b>Admin reply:</b>
                    <ul class="comment-reply">
                        @foreach($comments as $key => $reply)
                            @if($reply->comment_parent == $comment->comment_id)
                                <li>{{($reply->comment_content)}}</li>
                            @endif
                        @endforeach
                    <ul>
                    <br>
                    @if($comment->comment_parent == 0)
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal-{{$comment->comment_id}}">
                            Reply Comment
                        </button>
                    @endif

                    <div class="modal fade" id="exampleModal-{{$comment->comment_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              
                                <div class="form-group">
                                    <label for="exampleInputEmail1">{{($comment->comment_name)}}</label>
                                    <textarea style="text-align: left;resize: none;" readonly style="resize:none" rows="5"  class="form-control" id="exampleInputPassword1" required>
                                        {{$comment->comment_content}}
                                    </textarea>
                                </div>
                               
                         
                              <span>
                                <form action="{{URL::to('/reply-comment/'.$comment->comment_id)}}" method="POST">
                                    {{csrf_field()}}
                                    <input type="hidden" name="comment_product_id" value="{{$comment->comment_product_id}}">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Reply Comment</label>
                                        <textarea style="resize:none" rows="5" name="reply_comment" class="form-control reply_comment-{{$comment->comment_id}}" id="exampleInputEmail1" placeholder="Enter product name" required></textarea>
                                    </div>
                                    <button type="button" data-comment_id="{{$comment->comment_id}}"  class="btn btn-info reply-comment">Reply Comment</button>
                                </form>
                                </span>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                </td>
                <td>{{$comment->comment_date}}</td>
                <td><span class="text-ellipsis">
                    <?php
                    if($comment->comment_status == 1){
                    ?>
                    <a> <span data-comment_id="{{$comment->comment_id}}" class="fa fa-eye hide_comment" aria-hidden="true"></span></a>
                    <?php
                    }else{
                    ?>
                    
                    <a > <span  data-comment_id="{{$comment->comment_id}}" class="fa fa-eye-slash display_comment" aria-hidden="true"></span></a>
                    <input type="hidden" name="comment_id" id="id_comment" class="id_comment" value="{{$comment->comment_id}}">
                    <?php
                    } 
                    ?>
                </span></td>
                
                <td>
                    <a data-comment_id="{{$comment->comment_id}}" class="del_comment" ui-toggle-class="">
                    <i class="fa fa-trash text-danger text"></i></a>
                </td>
            </tr>
            @endif
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

