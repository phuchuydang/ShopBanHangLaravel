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
                    @foreach($feeship as $feeships)
                      <form role="form" action="{{URL::to('/save-delivery/'.$feeships->feeship_id)}}" method="POST"> 
                            {{ csrf_field() }}
                            
                            <div class="form-group">
                            
                                <label for="exampleInputPassword1">City</label>
                                <select id="city" name="city" class="form-control input-sm m-bot15  chooses city" required>
                        
                                
                                    <option value="{{$feeships->matp}}" selected disabled>{{$feeships->namecity}}</option>
                                
                                </select>                       
                            </div>
                            <div class="form-group">
                            <label for="exampleInputPassword1">Province</label>
                            <select id="province" name="province" class="form-control input-sm m-bot15  province chooses" required>
                                
                                <option selected value="{{$feeships->maqh}}" disabled>{{$feeships->nameprovince}}</option>

                            
                            </select>                       
                            </div>
                            <div class="form-group">
                            <label for="exampleInputPassword1">Ward</label>
                            <select id="ward" name="ward"class="form-control input-sm m-bot15  wards" required >
                    
                        
                                <option selected value="{{$feeships->xaid}}" disabled>{{$feeships->nameward}}</option>
                            
                            </select>                         
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Shipping Fee</label>
                            <input type="number" value="{{$feeships->feeship_price}}" name="feeship" class="form-control feeship " id="exampleInputEmail1" placeholder="Enter feeship" required>
                            <input type="text" name="id" id="id" hidden value="{{$feeships->feeship_id}}" >
                        </div>
                        
                            <button type="submit" name="update-delivery" class="btn btn-info add_delevery">Update Delivery Fee</button>
                       
                  </form>
                  @endforeach
                  </div>

              </div>
             
          </section>

  </div>

  <div id="load_delivery">

  </div>
</div>

</section>
@endsection