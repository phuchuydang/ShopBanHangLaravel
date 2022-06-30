@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    ADD CATEGORY PRODUCT
                </header>
                <?php $message = Session::get('message');
                    if($message){
                        echo '<span class="text-alert">'.$message.'</span>';
                        Session::put('message',null);   
                    }
                ?>
                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" action="{{URL::to('/save-category-product')}}" method="POST">
                            {{csrf_field()}}
                            
                        <div class="form-group">
                            <label for="exampleInputEmail1">Category Product Name</label>
                            <input type="text" name="category_product_name" class="form-control" id="exampleInputEmail1" placeholder="Enter product name" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Description Category Product</label>
                            <textarea style="resize:none" rows="5" name="category_product_desc" class="form-control" id="exampleInputPassword1" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Status</label>
                            <select name="category_product_status" class="form-control input-sm m-bot15" required>
                                <option value="0">Hide</option>
                                <option value="1">Display</option>
                            </select>                       
                        </div>
                        <button type="submit" name="add_category_product" class="btn btn-info">Add Category Product</button>
                    </form>
                    </div>

                </div>
            </section>

    </div>
</div>
@endsection