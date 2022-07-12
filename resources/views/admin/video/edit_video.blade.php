@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    UPDATE VIDEO
                </header>
                <?php $message = Session::get('message');
                    if($message){
                        echo '<span class="text-alert">'.$message.'</span>';
                        Session::put('message',null);   
                    }
                ?>
                <div class="panel-body">
                    <div class="position-center">
                        <form role="form">
                            {{csrf_field()}}
                       
                        <div class="form-group">
                            <label for="exampleInputEmail1">Video Title</label>
                            <input type="text" value="{{$video->video_title}}" name="video_title" class="form-control" id="exampleInputEmail1" placeholder="Enter product name" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Video Link</label>
                            <input type="text" value="{{$video->video_link}}" name="video_link" class="form-control" id="exampleInputEmail1" placeholder="Enter product name" required>
                        </div>
                        <div class="form-group">
                            <input type="hidden" value="{{$video->video_id}}" name="video_id" class="form-control" id="exampleInputEmail1" placeholder="Enter product name" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Video Description</label>
                            <textarea style="resize:none" rows="5" name="video_desc" class="form-control" id="exampleInputPassword1" required>{{$video->video_desc}}</textarea>
                        </div>
                        <button data-video_id="{{$video->video_id}}" type="button" name="save_video" class="btn btn-info save_video">Update video</button>
                    </form>
                    </div>
                </div>
            </section>

    </div>
</div>
@endsection