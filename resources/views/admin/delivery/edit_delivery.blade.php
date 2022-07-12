@extends('admin_layout')
@section('admin_content')

<div class="row">
  <div class="col-lg-12">
          <section class="panel">
              <header class="panel-heading">
                  EDIT DELIVERY DETAILS
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
                            {{ csrf_field() }}
                            
                            <div class="form-group">
                            
                                <label for="exampleInputPassword1">City</label>
                                <select id="city" name="city" class="form-control input-sm m-bot15  chooses city" required>
                        
                                
                                    <option value="{{$feeships->city->matp}}" selected disabled>{{$feeships->city->namecity}}</option>
                                
                                </select>                       
                            </div>
                            <div class="form-group">
                            <label for="exampleInputPassword1">Province</label>
                            <select id="province" name="province" class="form-control input-sm m-bot15  province chooses" required>
                                
                                <option selected value="{{$feeships->province->maqh}}" disabled>{{$feeships->province->nameprovince}}</option>

                            
                            </select>                       
                            </div>
                            <div class="form-group">
                            <label for="exampleInputPassword1">Ward</label>
                            <select id="ward" name="ward"class="form-control input-sm m-bot15  wards" required >
                    
                        
                                <option selected value="{{$feeships->ward->xaid}}" disabled>{{$feeships->ward->nameward}}</option>
                            
                            </select>                         
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Shipping Fee</label>
                            <input type="number" data-fee_price="{{$feeships->feeship_price}}" value="{{$feeships->feeship_price}}" name="feeship" class="form-control fee_price" id="exampleInputEmail1" placeholder="Enter feeship" required>
                            <input type="text" name="id" id="id" hidden value="{{$feeships->feeship_id}}" >
                        </div>
                        
                            <button type="button" data-fee_id="{{$feeships->feeship_id}}" name="update-delivery" class="btn btn-info update_delevery">Update Delivery Fee</button>
                       
                  </form>
                
                  </div>

              </div>
             
          </section>

  </div>

  <div id="load_delivery">

  </div>
</div>

</section>
@endsection