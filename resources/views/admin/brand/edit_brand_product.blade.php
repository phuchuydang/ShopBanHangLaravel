@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    UPDATE BRAND PRODUCT
                </header>
                <?php $message = Session::get('message');
                    if($message){
                        echo '<span class="text-alert">'.$message.'</span>';
                        Session::put('message',null);   
                    }
                ?>
                <div class="panel-body">
                    {{-- @foreach($edit_brand_product as $key => $edit_brand)
                    <div class="position-center">
                        <form role="form" action="{{URL::to('/update-brand-product/'.$edit_brand->brand_id)}}" method="POST">
                            {{csrf_field()}}
                            
                        <div class="form-group">
                            <label for="exampleInputEmail1">Brand Product Name</label>
                            <input type="text" value="{{$edit_brand->brand_name}}" name="brand_product_name" class="form-control" id="exampleInputEmail1" placeholder="Enter product name" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Description Brand Product</label>
                            <textarea style="resize:none" rows="5" name="brand_product_desc" class="form-control" id="exampleInputPassword1" required>{{$edit_brand->brand_desc}}</textarea>
                        </div>
                        <button type="submit" name="add_brand_product" class="btn btn-info">Update Brand Product</button>
                    </form>
                    </div>
                    @endforeach --}}
                    <div class="position-center">
                        <form role="form" action="{{URL::to('/update-brand-product/'.$edit_brand_product->brand_id)}}" method="POST">
                            {{csrf_field()}}
                            
                        <div class="form-group">
                            <label for="exampleInputEmail1">Brand Product Name</label>
                            <input type="text" value="{{$edit_brand_product->brand_name}}" name="brand_product_name" class="form-control" id="exampleInputEmail1" placeholder="Enter product name" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Description Brand Product</label>
                            <textarea style="resize:none" rows="5" name="brand_product_desc" class="form-control" id="exampleInputPassword1" required>{{$edit_brand_product->brand_desc}}</textarea>
                        </div>
                        <button type="submit" name="add_brand_product" class="btn btn-info">Update Brand Product</button>
                    </form>
                    </div>
                </div>
            </section>

    </div>
</div>
@endsection