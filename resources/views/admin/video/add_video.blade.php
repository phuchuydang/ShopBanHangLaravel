@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    ADD VIDEO
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
                            <input type="text" name="video_title" class="form-control" id="exampleInputEmail1" placeholder="Enter product name" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Video Link</label>
                            <input type="text" name="video_link" class="form-control" id="exampleInputEmail1" placeholder="Enter product name" required>
                        </div>
                        {{-- <div class="form-group" >
                            <label for="exampleInputEmail1">Video Image</label>
                            <input type="file" id="video-image" name="video-image" accept="image/*" >
                            
                        </div> --}}
                        <div class="form-group">
                            <label for="exampleInputPassword1">Video Description</label>
                            <textarea style="resize:none" rows="5" name="video_desc" class="form-control" id="exampleInputPassword1" required></textarea>
                        </div>
                        <button type="button" name="add_video" class="btn btn-info add_video">Add Brand Product</button>
                    </form>
                    </div>

                </div>
            </section>

    </div>
</div>
@endsection