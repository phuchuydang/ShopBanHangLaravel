@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    EDIT PRODUCT
                </header>
                <?php $message = Session::get('message');
                    if($message){
                        echo '<span class="text-alert">'.$message.'</span>';
                        Session::put('message',null);   
                    }
                ?>
                <div class="panel-body">
                    <div class="position-center">
                        @foreach($product as $key => $edit_value)
                        <form role="form" action="{{URL::to('/update-product/'.$edit_value->product_id)}}" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Product Name</label>
                            <input type="text" name="product_name" class="form-control" id="exampleInputEmail1" value="{{$edit_value->product_name}}" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Product Category</label>
                            <select name="product_category" class="form-control input-sm m-bot15" required>                            
                                @foreach($cate as $key => $category)
                                @if($edit_value->category_id == $category->category_id){
                                    <option selected value="{{$category->category_id}}">{{$category->category_name}}</option>
                                @else
                                    <option value="{{$category->category_id}}">{{$category->category_name}}</option>
                                @endif
                                @endforeach
                            </select>                       
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Product Brand</label>
                            <select name="product_brand" class="form-control input-sm m-bot15" required>
                                @foreach($brand as $key => $brand)
                                @if($edit_value->brand_id == $brand->brand_id){
                                    <option selected value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                @else
                                    <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                @endif
                                @endforeach
                               
                            </select>                       
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Product Description </label>
                            <textarea style="resize:none" rows="5" name="product_desc" class="form-control" id="ck_editor1" required>{{$edit_value->product_desc}}</textarea>
                            
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Product Content</label>
                            <textarea style="resize:none" rows="5" name="product_content" class="form-control" id="ck_editor2" required>{{$edit_value->product_content}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Product Price</label>
                            <input type="text" name="product_price" class="form-control" id="exampleInputEmail1" value="{{$edit_value->product_price}}"" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Product Quantity</label>
                            <input type="text" name="product_quantity" class="form-control" id="exampleInputEmail1" value="{{$edit_value->product_quantity}}"" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Product Image</label>
                            <input type="file" name="product_image" class="form-control" value="{{URL::to('public/uploads/product/'.$edit_value->product_image)}}" id="exampleInputEmail1">
                            <img src="{{URL::to('public/uploads/product/'.$edit_value->product_image)}}" height="100" width="100">
                        </div>
                        <button type="submit" name="update_product" class="btn btn-info">Update Product</button>
                    </form>
                    @endforeach
                    </div>

                </div>
            </section>

    </div>
</div>
@endsection