@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    ADD VOUCHER
                </header>
                <?php $message = Session::get('message');
                    if($message){
                        echo '<span class="text-alert">'.$message.'</span>';
                        Session::put('message',null);   
                    }
                ?>
                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" action="{{URL::to('/save-voucher')}}" method="POST">
                            {{csrf_field()}}
                            
                        <div class="form-group">
                            <label for="exampleInputEmail1">Voucher Name</label>
                            <input type="text" name="voucher_name" class="form-control" id="exampleInputEmail1" placeholder="Enter product name" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Voucher Code</label>
                            <input type="text" name="voucher_code" class="form-control" id="exampleInputEmail1" placeholder="Enter product name" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Voucher Amount</label>
                            <input type="text" name="voucher_amount" class="form-control" id="exampleInputEmail1" placeholder="Enter product name" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Voucher Type</label>
                            <select name="voucher_condition" class="form-control input-sm m-bot15" required>
                                <option value="0">Choose</option>
                                <option value="1">% Discount</option>
                                <option value="1">Money Discount</option>
                            </select>                       
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">% for Discount</label>
                            <input type="number"  min="0" max="100" name="voucher_percent_discount"" class="form-control" id="exampleInputEmail1" placeholder="Enter product name" required>
                
                        </div>
                        <button type="submit" name="add_brand_product" class="btn btn-info">Add Voucher</button>
                    </form>
                    </div>

                </div>
            </section>

    </div>
</div>
@endsection