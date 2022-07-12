
<!DOCTYPE html>
<head>
    <title>Admin Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
    Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- bootstrap-css -->
    <link rel="stylesheet" href="css/bootstrap.min.css" >
    <!-- //bootstrap-css -->
    <!-- Custom CSS -->
    <link href="{{asset('public/backend/css/style.css')}}" rel='stylesheet' type='text/css' />
    <link href="{{asset('public/backend/css/style-responsive.css')}}" rel="stylesheet"/>
    <!-- font CSS -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <!-- font-awesome icons -->
    <link rel="stylesheet" href="css/font.css" type="text/css"/>
    <link href="{{asset('public/backend/css/font-awesome.css')}}" rel="stylesheet"> 
    <!-- //font-awesome icons -->
    <script src="js/jquery2.0.3.min.js"></script>
</head>
    <body>
        <div class="log-w3">
            <div class="w3layouts-main">
                <h2>REGISTER</h2>
                <?php 
                    $message = Session::get('message');
                    if($message){
                        echo '<span class="text-alert">'.$message.'</span>';
                        Session::put('message',null);
                    }

                ?>  
                    <form action="{{URL::to('/register')}}" method="post">
                        {{csrf_field()}}
                        <input type="text" class="ggg" id="auth_name" name="auth_name" placeholder="NAME">
                        <input type="email" class="ggg" id="auth_email"  name="auth_email" placeholder="E-MAIL">
                        <input type="phone" class="ggg" id="auth_phone" name="auth_phone" placeholder="PHONE" >
                        <input type="password" class="ggg" id="auth_password" name="auth_password" placeholder="PASSWORD">
                        <input type="password" class="ggg" id="auth_re_password" name="auth_re_password" placeholder="CONFIRM PASSWORD">
                        {{-- <div class="clearfix">
                            {!! NoCaptcha::renderJs() !!}
                            {!! NoCaptcha::display() !!}
                        </div> --}}
                        <input type="submit" value="Register" id="register" class="register" name="register">
                      
                    </form>
                    {{-- <p>Don't Have an Account ?<a href="registration.html">Create an account</a></p> --}}
                    <a  href="{{URL::to('/admin')}}">Login Now</a>
            </div>
        </div>
        <script src="{{asset('public/backend/js/bootstrap.js')}}"></script>
        <script src="{{asset('public/backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
        <script src="{{asset('public/backend/js/scripts.js')}}"></script>
        <script src="{{asset('public/backend/js/jquery.slimscroll.js')}}"></script>
        <script src="{{asset('public/backend/js/jquery.nicescroll.js')}}"></script>
        <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
        <script src="{{asset('public/backend/js/jquery.scrollTo.js')}}"></script>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        {{-- <script type="text/javascript">
            //check all field register
            //function formValidation()
            function formValidation()
            {
                var auth_name = document.getElementById('auth_name').value;
                var auth_email = document.getElementById('auth_email').value;
                var auth_phone = document.getElementById('auth_phone').value;
                var auth_password = document.getElementById('auth_password').value;
                var auth_re_password = document.getElementById('auth_re_password').value;
                // var auth_g_recaptcha_response = document.getElementById('g-recaptcha-response').value;
                if(auth_name == "")
                {
                    swal("Hmmm", "You must fill email", "danger");
                    return false;
                }
                else if(auth_email == "")
                {
                    swal("Hmmm", "You must fill email", "danger");
                    return false;
                }
                else if(auth_phone == "")
                {
                    swal("Hmmm", "You must fill phone", "danger");
                    return false;
                }
                else if(auth_password == "")
                {
                    swal("Hmmm", "You must fill password", "danger");
                    return false;
                }
                else if(auth_re_password == "")
                {
                    swal("Hmmm", "You must fill confirm password", "danger");
                    return false;
                }
                else if(auth_password != auth_re_password)
                {
                    swal("Hmmm", "Password and confirm password not match", "danger");
                    return false;
                }
                else
                {
                    return true;
                }
            }
        </script> --}}
    </body>
</html>
