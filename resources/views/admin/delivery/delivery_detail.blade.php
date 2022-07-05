@extends('admin_layout')
@section('admin_content')

<div class="row">
  <div class="col-lg-12">
          <section class="panel">
              <header class="panel-heading">
                  DELIVERY DETAILS
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
                          @csrf
                        <div class="form-group">
                            <label for="exampleInputPassword1">City</label>
                            <select id="city" name="city" class="form-control input-sm m-bot15  choose city" required>
                              <option value="">Choose City</option>
                              @foreach($cities as $city)
                                <option value="{{$city->matp}}">{{$city->namecity}}</option>
                              @endforeach
                            </select>                       
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Province</label>
                          <select id="province" name="province" class="form-control input-sm m-bot15  province choose" required>
                            <option value="">Choose Province</option>
                            
                          </select>                       
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Ward</label>
                          <select id="ward" name="ward"class="form-control input-sm m-bot15  ward" required >
                            <option value="">Choose Ward</option>
                          </select>                       
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Shipping Fee</label>
                        <input type="number" name="feeship" class="form-control feeship " id="exampleInputEmail1" placeholder="Enter feeship" required>
                      </div>
              
                        <button type="button" name="add_delevery" class="btn btn-info add_delevery">Add Delivery Fee</button>
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