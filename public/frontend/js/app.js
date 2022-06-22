
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
     if(customer_conf_password == ''){
          alert('Please enter your confirm password');
          return false;
     }
     if(customer_phone == ''){
          alert('Please enter your phone');
          return false;
     }
     if(customer_password != customer_conf_password){
          alert('Password and Confirm Password not match');
          return false;
     }
     return true;
}