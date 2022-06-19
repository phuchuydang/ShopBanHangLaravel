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
                        <form role="form" action="{{URL::to('/update-product')}}" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}

                        <div class="form-group">
                            <label for="exampleInputEmail1">Product Name</label>
                            <input type="text" name="product_name" class="form-control" id="exampleInputEmail1" placeholder="Enter product name" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Product Category</label>
                            <select name="product_category" class="form-control input-sm m-bot15" required>
                               @foreach($cate as $key => $category)
                                <option value="{{$category->category_id}}">{{$category->category_name}}</option>
                                @endforeach
                            </select>                       
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Product Brand</label>
                            <select name="product_brand" class="form-control input-sm m-bot15" required>
                                @foreach($brand as $key => $brand)
                                <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                @endforeach
                               
                            </select>                       
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Product Description </label>
                            <textarea style="resize:none" rows="5" name="product_desc" class="form-control" id="exampleInputPassword1" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Product Content</label>
                            <textarea style="resize:none" rows="5" name="product_content" class="form-control" id="exampleInputPassword1" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Product Price</label>
                            <input type="text" name="product_price" class="form-control" id="exampleInputEmail1" placeholder="Enter product price" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Product Image</label>
                            <input type="file" name="product_image" class="form-control" id="exampleInputEmail1" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Product Status</label>
                            <select name="product_status" class="form-control input-sm m-bot15" required>
                                <option value="0">Hide</option>
                                <option value="1">Display</option>
                            </select>                       
                        </div>
                        <button type="submit" name="update_product" class="btn btn-info">Update Product</button>
                    </form>
                    </div>

                </div>
            </section>

    </div>
</div>
@endsection