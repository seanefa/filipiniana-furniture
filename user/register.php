<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="image/favicon.ico" rel="icon" />
<title>Register - Filipiniana Furniture Shop</title>
<meta name="description" content="Furniture shop">
<script type="text/javascript" src="js/myScript.js"></script>
<?php include"css.php";?>
</head>
<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    if (isset($_POST['register'])) { //user registering
        
        require 'process-registration.php';
        
    }
}
?>
<body>
<div class="wrapper-wide">
<?php include"header.php";?>
  <div id="container">
    <div class="container">
      <!-- Breadcrumb Start-->
      <ul class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i></a></li>
        <li><a href="login.php">Account</a></li>
        <li><a href="register.php">Register</a></li>
      </ul>
      <!-- Breadcrumb End-->
      <div class="row">
        <!--Middle Part Start-->
        <div class="col-sm-12" id="content">
          <h1 class="title">Register Account</h1>
          <p>If you already have an account with us, please login at the <a href="login.php">Login Page</a>.</p>
          <form action="add-user.php" method="post" autocomplete="off" onsubmit="check_if_capcha_is_filled" class="form-horizontal" method="post">
            <fieldset id="account">
              <legend>Your Personal Details</legend>
              <!--div style="display: none;" class="form-group required">
                <label class="col-sm-2 control-label">Customer Group</label>
                <div class="col-sm-10">
                  <div class="radio">
                    <label>
                      <input type="radio" checked="checked" value="1" name="customer_group_id">
                      Default</label>
                  </div>
                </div>
              </div-->
              <div class="form-group required">
                <label for="input-firstname" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                  <input type="text" class="form-control" id="input-firstname" placeholder="First Name" value="" name="fname" required>
                </div>
                <div class="col-sm-3">
                  <input type="text" class="form-control" id="input-middlename" placeholder="Middle Name" value="" name="mname">
                </div>
                <div class="col-sm-3">
                  <input type="text" class="form-control" id="input-lastname" placeholder="Last Name" value="" name="lname" required>
                </div>
              </div>
              <div class="form-group required">
                <label for="input-email" class="col-sm-2 control-label">E-Mail</label>
                <div class="col-sm-10">
                  <input type="email" class="form-control" id="input-email" placeholder="E-Mail" value="" name="email" required>
                </div>
              </div>
              <div class="form-group required">
                <label for="input-telephone" class="col-sm-2 control-label">Contact</label>
                <div class="col-sm-10">
                  <input type="tel" class="form-control" id="input-telephone" placeholder="Contact" value="" name="number" required>
                </div>
              </div>
              <div class="form-group required">
                <label for="input-block" class="col-sm-2 control-label">Address</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="input-address" placeholder="e.g. #1255 Saint Francis St., Brgy. Parang, Marikina City" value="" name="address" required>
                </div>
              </div>
            </fieldset>
            <fieldset>
              <legend>Your Account&nbsp;<i><small class="text-danger" id="_lblAccountMsg"></small></i></legend>
              <div class="form-group required">
                <label for="input-password" class="col-sm-2 control-label">Username</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="input-username" placeholder="Username" value="" name="uname" required>
                </div>
              </div>
              <div class="form-group required">
                <label for="input-password" class="col-sm-2 control-label">Password</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" id="input-password" placeholder="Password" value="" name="upass" required>
                </div>
              </div>
              <div class="form-group required">
                <label for="input-confirm" class="col-sm-2 control-label">Confirm Password</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" id="input-confirm" placeholder="Confirm Password" value="" name="cpass" required>
                </div>
              </div>
            </fieldset>
            <fieldset>
              <legend>Newsletter</legend>
              <div class="form-group required">
                <div id="captc" class="g-recaptcha pull-right" data-callback="capcha_filled"
   data-expired-callback="capcha_expired" data-sitekey="6Ld4ijMUAAAAAL1AtLFjYMZPzteuwd4l6VUDvfGz"></div>
                <span id="capmsg" style="color: red;"></span>
                <label class="col-sm-2 control-label">I want to receive exclusive offers by e-mail</label>
                <div class="col-sm-5">
<!--                  <input type="checkbox" id="_cbxNewsletter" value="1" name="newsletter">-->
					<label>Yes</label>&nbsp;<input type="radio" name="newsletter" value="1" checked><br>
					<label>No</label>&nbsp;<input type="radio" name="newsletter" value="0">
                </div>
              </div>
            </fieldset>
            <div class="buttons">
              <div class="pull-right">
                <input type="checkbox" value="1" name="agree" id="_cbxPolicy" required>
                &nbsp;I have read and agree to the <a class="agree" href="#"><b>Privacy Policy</b></a> &nbsp;
                <input onclick="validate()" class="btn btn-primary" value="Register" name="register" id="_btnRegister">
              </div>
            </div>
          </form>
        </div>
        <!--Middle Part End -->
      </div>
    </div>
  </div>
<?php include"footer.php";?>
</div>
<?php include"scripts.php";?>
<script type="text/javascript">
  var allowSubmit = false;

function validate(){

if(allowSubmit == false){

  $('#_btnRegister').prop('type','');
  alert('check captcha first');

}

}


  function capcha_filled () {
    allowSubmit = true;
    $('#_btnRegister').prop('type','submit');
    $('#capmsg').html('');
}
function capcha_expired () {
    allowSubmit = false;
}

var onloadCallback = function() {
    grecaptcha.render('captc', {
      'sitekey' : '6Ld4ijMUAAAAAL1AtLFjYMZPzteuwd4l6VUDvfGz',
      'callback': capcha_filled,
      'expired-callback': capcha_expired,
    });
  };

  function check_if_capcha_is_filled (e) {
    if(allowSubmit) return true;
    e.preventDefault();
    alert('Fill in the capcha!');
}



</script>
</body>
</html>