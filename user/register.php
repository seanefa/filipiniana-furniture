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
<script src="jquery.geocomplete.js"></script>
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
              <script type="text/javascript">
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


                  });
              </script>
              <div class="form-group required">
                <label for="input-email" class="col-sm-2 control-label">E-Mail</label>
                <div class="col-sm-10">
                  <input type="email" class="form-control" id="input-email" placeholder="E-Mail" value="" name="email" required><span id="messageemail" style=""></span>
                </div>
              </div>
              <div class="form-group required">
                <label for="input-telephone" class="col-sm-2 control-label">Contact</label>
                <div class="col-sm-10">
                  <input type="text" data-mask="+63 (999) 999-9999"  class="form-control" id="input-telephone" name="number" required>
                </div>
              </div>
              <div class="form-group required">
                <label for="input-block" class="col-sm-2 control-label">Address</label>
                <div class="col-sm-10">

                  <div id="locationField">
      <input class="form-control" id="autocomplete" placeholder="Enter your address"
             onFocus="geolocate()" type="text"></input>
    </div>
    <br>
    <br>
    <table id="address">
      <tr>
        <td class="label">Street address</td>
        <td class="slimField"><input class="field form-control" id="street_number"
              disabled="true" name="street"></input></td>
        <td class="wideField" colspan="2"><input class="field form-control" id="route"
              disabled="true" name="route"></input></td>
      </tr>
      <tr>
        <td class="label">City</td>
        <!-- Note: Selection of address components in this example is typical.
             You may need to adjust it for the locations relevant to your app. See
             https://developers.google.com/maps/documentation/javascript/examples/places-autocomplete-addressform
        -->
        <td class="wideField" colspan="3"><input class="field form-control" id="locality"
              disabled="true" name="localcity"></input></td>
      </tr>
      <tr>
        <td class="label">State</td>
        <td class="slimField"><input class="field form-control"
              id="administrative_area_level_1" disabled="true" name="state"></input></td>
        <td class="label">Zip code</td>
        <td class="wideField"><input class="field form-control" id="postal_code"
              disabled="true" name="zipcode"></input></td>
      </tr>
      <tr>
        <td class="label">Country</td>
        <td class="wideField" colspan="3"><input class="field form-control"
              id="country" disabled="true" name="-country"></input></td>
      </tr>
    </table>


    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500">
    <style>
      #locationField, #controls {
        position: relative;
        width: 480px;
      }
      #autocomplete {
        position: absolute;
        top: 0px;
        left: 0px;
        width: 99%;
      }
      .label {
        text-align: right;
        font-weight: bold;
        width: 100px;
        color: #303030;
      }
      #address {
        border: 1px solid #000090;
        background-color: #f0f0ff;
        width: 480px;
        padding-right: 2px;
      }
      #address td {
        font-size: 10pt;
      }
      .field {
        width: 99%;
      }
      .slimField {
        width: 80px;
      }
      .wideField {
        width: 200px;
      }
      #locationField {
        height: 20px;
        margin-bottom: 2px;
      }
    </style>

    <script>
      // This example displays an address form, using the autocomplete feature
      // of the Google Places API to help users fill in the information.

      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      var placeSearch, autocomplete;
      var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
      };

      function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
            {types: ['geocode']});

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);
      }

      function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();

        for (var component in componentForm) {
          document.getElementById(component).value = '';
          document.getElementById(component).disabled = false;
        }

        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
          var addressType = place.address_components[i].types[0];
          if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]];
            document.getElementById(addressType).value = val;
          }
        }
      }

      // Bias the autocomplete object to the user's geographical location,
      // as supplied by the browser's 'navigator.geolocation' object.
      function geolocate() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            var circle = new google.maps.Circle({
              center: geolocation,
              radius: position.coords.accuracy
            });
            autocomplete.setBounds(circle.getBounds());
          });
        }
      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAzYIlmIb2ANzzbcNj559IoRSD7Od0ndF8&libraries=places&callback=initAutocomplete"
        async defer></script>
                </div>
              </div>
            </fieldset>
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
                  <input type="password" min="4" class="form-control" id="input-password" placeholder="Password" value="" name="upass" required>
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
                <span id="messageall" style="color: red;"></span>
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
var pass = $('#input-password').val();
var conf = $('#input-confirm').val();
if(pass != conf && pass != '' && conf != ''){
  alert('Incorrect Password');
}else{
if(allowSubmit == false){

  $('#_btnRegister').prop('type','');
  alert('Fill Captcha');

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
    alert('Fill in the capcha!');
}



</script>
</body>
</html>
