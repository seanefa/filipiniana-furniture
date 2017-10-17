<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link href="image/favicon.ico" rel="icon" />
  <title>Register - Filipiniana Furniture Shop</title>
  <meta name="description" content="Furniture shop">
  <script type="text/javascript" src="js/myScript.js"></script>
  <script src="http://maps.googleapis.com/maps/api/js?libraries=places"></script>

  <link href="css/select2.min.css" rel="stylesheet">
  <link href="css/select2.css" rel="stylesheet">
  <script src="js/select2.min.js"></script>
  <script src="js/select2.js"></script>
  <script src="js/maskmaster/src/jquery.mask.js"></script>
  <script src="jquery.geocomplete.js"></script>
  <?php include"css.php";?>
  <style>
    /* hide up/down arrows ("spinners") on input fields marked type="number" */
    .no-spinners {
      -moz-appearance:textfield;
    }

    .no-spinners::-webkit-outer-spin-button,
    .no-spinners::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }
  </style>
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
<script type="text/javascript">

  $(document).ready(function(){
    $('#telNumber').mask('(000) 000-0000');

  });

  var c1 = 0;
  var c2 = 0;
  function checkAll(c,check){
    if(c==1){
      if(check != 0){
        c1 = 1;
      }
      else{
        c1 = 0;
      }
    }else if(c==2){
      if(check != 0){
        c2 = 1;
      }else{
        c2 = 0;
      }
    }

    if(c1 == 0 && c2 == 0){
      $('#messageall').html('There are errors in your Inputs');
      $('#_btnRegister').prop('disabled',true);
    }else{

      $('#messageall').html('');
      $('#_btnRegister').prop('disabled',false);
    }
  }


  $(document).ready(function(){
    $('#input-email').on('keyup', function(){
      var value = this.value;
      $.ajax({

        type: 'post',
        url: 'check-email.php',
        data: {
          val: value,
        },
        success: function (response) {
          if(response ==''){
            checkAll(1,0);
            $('#messageemail').html('');
            $('#messageemail').prop('style','color: green;');
            $('#messageemail').prop('class','glyphicon glyphicon-ok');
            $('#input-email').css('border-color','');
          }else{
            checkAll(2,1);
            if(response == 'Not a valid Email'){
              $('#messageemail').prop('class','');
              $('#messageemail').prop('style','color: red;');
              $('#input-email').css('border-color','red');
              $('#messageemail').html('Not a valid Email');
            }
            else if(response == 'Email Already used!'){
              $('#messageemail').prop('class','');
              $('#messageemail').prop('style','color: red;');
              $('#input-email').css('border-color','red');
              $('#messageemail').html('Email Already used!');
            }


          }
        }
      });
    });

    $('#input-username').on('keyup', function(){
      var value = this.value;
      $.ajax({
        type: 'post',
        url: 'check-username.php',
        data: {
          val: value,
        },
        success: function (response) {
          if(response ==''){
            checkAll(2,0);
            $('#messageuser').html('');
            $('#messageuser').prop('class','glyphicon glyphicon-ok');
            $('#messageuser').prop('style','color: green;');
            $('#input-username').css('border-color','green');
          }else{
            checkAll(2,1);
            $('#messageuser').prop('class','');
            $('#messageuser').prop('style','color: red;');
            $('#input-username').css('border-color','red');
            $('#messageuser').html(response);

          }
        }
      });
    });

    $('#input-password').on('keyup', function(){
      var passw= this.value;
      var confi = $('#input-conf').val();
      $.ajax({
        type: 'post',
        url: 'check-password.php',
        data: {
          pass: passw, conf: confi,
        },
        success: function (response) {
          if(response ==''){
            $('#messagepass').html('');
            $('#messagepass').prop('class','glyphicon glyphicon-ok');
            $('#messagepass').prop('style','color: green;');
            $('#input-password').css('border-color','green');
            $('#input-conf').css('border-color','green');
          }else{
            $('#messagepass').prop('class','');
            $('#messagepass').prop('style','color: red;');
            $('#input-password').css('border-color','red');
            $('#input-conf').css('border-color','red');
            $('#messagepass').html(response);

          }
        }
      });
    });

    $('#input-confirm').on('keyup', function(){
      var confr = this.value;
      var passw = $('#input-password').val();
      $.ajax({
        type: 'post',
        url: 'check-password.php',
        data: {
          conf: confr, pass: passw,
        },
        success: function (response) {
          if(response ==''){
            $('#messagepass').html('');
            $('#messagepass').prop('class','glyphicon glyphicon-ok');
            $('#messagepass').prop('style','color: green;');
            $('#input-password').css('border-color','green');
            $('#input-conf').css('border-color','green');
          }else{
            $('#messagepass').prop('class','');
            $('#messagepass').prop('style','color: red;');
            $('#input-password').css('border-color','red');
            $('#input-conf').css('border-color','red');
            $('#messagepass').html(response);

          }
        }
      });
    });




  });


</script>
<div class="form-group required">
  <label for="input-email" class="col-sm-2 control-label">E-Mail Address</label>
  <div class="col-sm-10">
    <input type="email" class="form-control" id="input-email" placeholder="E-Mail Address" value="" name="email" required><span id="messageemail" style=""></span>
  </div>
</div>
<div class="form-group required">
  <label for="input-telephone" class="col-sm-2 control-label">Contact Number</label>
  <div class="col-sm-10">
    <input type="number" class="form-control no-spinners" name="number" id='telNumber' placeholder="Enter your contact number" required/>
  </div>
</div>
<div class="form-group required">
  <label for="input-block" class="col-sm-2 control-label">Address</label>
  <div class="col-sm-10">
      <input class="form-control" id="autocomplete" placeholder="Enter your address" name="adr" type="text"></input>
    </div>
  </div>
<fieldset>
  <legend>Your Account&nbsp;<i><small class="text-danger" id="_lblAccountMsg"></small></i></legend>
  <div class="form-group required">
    <label for="input-password" class="col-sm-2 control-label">Username</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="input-username" placeholder="Username" value="" name="uname" required><span id="messageuser" style=""></span>
    </div>
  </div>
  <div class="form-group required">
    <label for="input-password" class="col-sm-2 control-label">Password</label>
    <div class="col-sm-10">
      <input type="password" min="4" class="form-control" id="input-password" placeholder="Password" value="" name="upass" required><span id="messagepass"></span>
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
  <legend>Subscribe to Our Newsletter</legend>
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
    <span id="messageall" style="color: red;"></span>
    <input type="checkbox" value="1" name="agree" id="_cbxPolicy" required>
    &nbsp;I have read and agree to the <a class="agree" href="privacy-policy.php" target="_blank"><b>Privacy Policy</b></a> &nbsp;
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
  var register = document.getElementById("_btnRegister");
  var policy = document.getElementById("_cbxPolicy");

  register.disabled = true;

  policy.addEventListener('click', function(event){
    register.disabled = !register.disabled;
  });

  var message = document.getElementById("_lblAccountMsg");
  var password = document.getElementById("input-password");

  password.addEventListener("focus", function(event){
    password.setAttribute("placeholder", "Make sure to pick a strong password");
  });

  password.addEventListener("focusout", function(event){
    password.setAttribute("placeholder", "Password");
  });

  var allowSubmit = false;

  function validate(){
    var pass = $('#input-password').val();
    var conf = $('#input-confirm').val();
    if(pass != conf && pass != '' && conf != ''){
      alert('Incorrect Password!');
    }else{
      if(allowSubmit == false){

        $('#_btnRegister').prop('type','');
        alert('Please Check the Captcha.');

      }
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
    alert('Please Check the Captcha.');
  }
</script>
</body>
</html>