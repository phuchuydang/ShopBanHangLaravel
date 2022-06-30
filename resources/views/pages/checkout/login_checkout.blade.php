@extends('layout')
@section('content')
<section id="form"><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form"><!--login form-->
                    <h2>Login to your account</h2>

                   
                    <form action="{{URL::to('/login-customer')}}" method="POST">
                        {{ csrf_field() }}
                        <input type="email" name="customer_email" placeholder="Email Address" required />
                        <input type="password" name="customer_password" placeholder="Password"  required />
                        <span>
                            <input type="checkbox" class="checkbox"> 
                            Keep me signed in
                        </span>
                      
                        <?php $message = Session::get('message');
                        if($message){
                            echo '  <br>  <br>';
                            echo '<span STYLE="font-size:18px; color: red; font-weight: bold;" class="text-alert">'.$message.'</span>';
                            Session::put('message',null);   
                        }
                        ?>
                        <button type="submit" class="btn btn-default">Login</button>
                    </form>
                </div><!--/login form-->
            </div>
            <div class="col-sm-1">
                <h2 class="or">OR</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form"><!--sign up form-->
                    <h2>New User Signup!</h2>
                    <form onsubmit="return checkRegister();" action="{{URL::to('/add-customer')}}"   method="POST">
                        {{ csrf_field() }}
                        <input type="text" id="customer_name" name="customer_name" placeholder="Name"/>
                        <input type="email" id="customer_email" name="customer_email" placeholder="Email Address"/>
                        <input type="text" id="customer_phone" name="customer_phone" placeholder="Phone"/>
                        <input type="text" id="customer_address" name="customer_address" placeholder="Address"/>
                        <input type="password" id="customer_password" name="customer_password" placeholder="Password"/>
                        <input type="password" id="customer_conf_password" name="customer_conf_password" placeholder="Confirm Password"/>
                        <button type="submit" class="btn btn-default">Signup</button>
                    </form>

                    <script type="text/javascript">
                       function checkRegister(){
                           var customer_name = document.getElementById('customer_name').value;
                           var customer_email = document.getElementById('customer_email').value;
                           var customer_password = document.getElementById('customer_password').value;
                           var customer_conf_password = document.getElementById('customer_conf_password').value;
                           var customer_phone = document.getElementById('customer_phone').value;
                           if(customer_name == ''){
                               alert('Please enter your name');
                               return false;
                           }
                           if(customer_email == ''){
                               alert('Please enter your email');
                               return false;
                           }
                            if(customer_password == ''){
                                 alert('Please enter your password');
                                 return false;
                            }
                            if(customer_password.length < 6 || customer_password.length > 20){
                                alert('Password must be 6-20 characters');
                                return false;
                            }
                            if(customer_conf_password == ''){
                                 alert('Please enter your confirm password');
                                 return false;
                            }
                            if(customer_phone == ''){
                                 alert('Please enter your phone');
                                 return false;
                            }
                            if(!customer_phone.match(/^[0-9]{10}$/)){
                                alert('Phone number must be 10 digits');
                                return false;
                            }
                            if(customer_address == ''){
                                 alert('Please enter your address');
                                 return false;
                            }
                            if(customer_password != customer_conf_password){
                                 alert('Password and Confirm Password not match');
                                 return false;
                            }
                            return true;
                        }
                    </script>
                </div><!--/sign up form-->
            </div>
        </div>
    </div>
</section><!--/form-->
@endsection

