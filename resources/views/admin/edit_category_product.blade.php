@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    UPDATE CATEGORY PRODUCT
                </header>
                <?php $message = Session::get('message');
                    if($message){
                        echo '<span class="text-alert">'.$message.'</span>';
                        Session::put('message',null);   
                    }
                ?>
                <div class="panel-body">
                    @foreach($edit_category_product as $key => $edit_category)
                    <div class="position-center">
                        <form role="form" action="{{URL::to('/update-category-product/'.$edit_category->category_id)}}" method="POST">
                            {{csrf_field()}}
                            
                        <div class="form-group">
                            <label for="exampleInputEmail1">Category Product Name</label>
                            <input type="text" value="{{$edit_category->category_name}}" name="category_product_name" class="form-control" id="exampleInputEmail1" placeholder="Enter product name" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Description Category Product</label>
                            <textarea style="resize:none" rows="5" name="category_product_desc" class="form-control" id="exampleInputPassword1" required>{{$edit_category->category_desc}}</textarea>
                        </div>
                        <button type="submit" name="add_category_product" class="btn btn-info">Update Category Product</button>
                    </form>
                    </div>
                    @endforeach
                </div>
            </section>

    </div>
</div>
@endsection