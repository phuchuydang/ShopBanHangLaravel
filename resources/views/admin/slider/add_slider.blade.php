@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    ADD SLIDER
                </header>
                <?php $message = Session::get('message');
                    if($message){
                        echo '<span class="text-alert">'.$message.'</span>';
                        Session::put('message',null);   
                    }
                ?>
                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" action="{{URL::to('/save-slider')}}" method="POST"  enctype="multipart/form-data">
                           @csrf
                            
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slider Name</label>
                            <input type="text" name="slider_name" class="form-control" id="exampleInputEmail1" placeholder="Enter product name" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Slider Image</label>
                            <input type="file" name="slider_image" class="form-control" id="exampleInputEmail1" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Slider Description</label>
                            <textarea style="resize:none" rows="5" name="slider_desc" class="form-control" id="exampleInputPassword1" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Status</label>
                            <select name="slider_status" class="form-control input-sm m-bot15" required>
                                <option value="0">Hide</option>
                                <option value="1">Display</option>
                            </select>                       
                        </div>
                        <button type="submit" name="add_slider" class="btn btn-info">Add Brand Product</button>
                    </form>
                    </div>

                </div>
            </section>

    </div>
</div>
@endsection