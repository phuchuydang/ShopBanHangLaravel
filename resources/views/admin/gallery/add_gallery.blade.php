@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    ADD GALLERY PRODUCT
                </header>
                <?php $message = Session::get('message');
                    if($message){
                        echo '<span class="text-alert">'.$message.'</span>';
                        Session::put('message',null);   
                    }
                ?>
                 <form action="{{URL::to('/insert-gallery/'.$product_id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            
                        </div>
                        <div class="col-md-6" >
                            <input type="file" id="file" name="file[]" accept="image/*" multiple required="">
                            <span id="error-gallery"> </span>
                        </div>
                        <div class="col-md-3">
                            <input type="submit" name="upload" class="btn-success" value="Upload Image">
                            
                        </div>
                    </div>
                </form>
              
               
                <form>
                    @csrf
                    <div class="panel-body">
                        <input type="hidden" name="product_id" class="product_id" value="{{$product_id}}">
                    </div>
                    <div class="table-responsive" id="table-responsive">
                       
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>
@endsection