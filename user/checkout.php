<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="image/favicon.ico" rel="icon" />
<title>Check Out - Filipiniana Furniture Shop</title>
<meta name="description" content="Furniture shop">
<?php include"css.php";?>
</head>
<body>
<div class="wrapper-wide">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
<?php include"header.php";?>
  <div id="container">
    <div class="container">
      <script type="text/javascript">
$(document).ready(function(){
    window.onbeforeunload = function(){
            return 'Are you sure you want to leave?';
        };


      $('#aTendered').on('keyup',function(){
        var mat = $("#aTendered").val();
        var bal = $("#dp").val();
        if(isNaN(mat)){
          var e = "Please input a valid number.";
          $("#error").html(e);
          $('#aTendered').css('border-color','red');
          $('#saveBtn').prop('disabled',true);
        }
        else if(mat<0){
          var e = "Numbers less than 0 are not allowed";
          $("#error").html(e);
          $('#aTendered').css('border-color','red');
          $('#saveBtn').prop('disabled',true);
        }
        else if(mat==""){
          var e = "";
          var change = 0.00;
          $("#dChange").val(change);
          $("#error").html(e);
          $('#aTendered').css('border-color','gray');
          $('#saveBtn').prop('disabled',true);
        }
        else if(mat<bal){ //if may malaki diba? hahaha
            var change = mat - bal;
            var e = "The payment has exceeded the amount due";
            $("#error").html(e);
            $('#aTendered').css('border-color','red');
            $('#saveBtn').prop('disabled',true);
          }
          else{
            var e = "";
            var change = mat - bal;
            var change = change + ".00";
            $("#dChange").val(change);
            $("#error").html(e);
            $('#aTendered').css('border-color','gray');
            $('#saveBtn').prop('disabled',false);

          }

      });
  });


  $(document).ready(function(){
      $('#cNum').on('keyup',function(){
        var mat = $("#cNum").val();
        if(isNaN(mat)){
          var e = "Please input a valid number.";
          $("#cNumError").html(e);
          $('#cNum').css('border-color','red');
          $('#saveBtn').prop('disabled',true);
        }
        else if(mat<0){
          var e = "Numbers less than 0 are not allowed";
          $("#cNumError").html(e);
          $('#cNum').css('border-color','red');
          $('#saveBtn').prop('disabled',true);
        }
        else{
          var e = "";
          $("#cNumError").html(e);
          $('#cNum').css('border-color','gray');
          $('#saveBtn').prop('disabled',false);
        }

      });
  });

  $(document).ready(function(){
      $('#cAmount').on('keyup',function(){
        var mat = $("#cAmount").val();
        if(isNaN(mat)){
          var e = "Please input a valid number.";
          $("#cAmountError").html(e);
          $('#cAmount').css('border-color','red');
          $('#saveBtn').prop('disabled',true);
        }
        else if(mat<0){
          var e = "Numbers less than 0 are not allowed";
          $("#cAmountError").html(e);
          $('#cAmount').css('border-color','red');
          $('#saveBtn').prop('disabled',true);
        }
        else{
          var e = "";
          $("#cAmountError").html(e);
          $('#cAmount').css('border-color','gray');
          $('#saveBtn').prop('disabled',false);
        }

      });
  });

  $(document).ready(function(){
    $("#check").hide();
    $("#mop").on('change',function(){
      var val = $("#mop").val();
      if(val==1){
        $("#check").hide();
        $("#cash").show();
        $("#cNum").val("");
        $("#cAmount").val("");
      }
      else if(val==2){
        $("#cash").hide();
        $("#check").show();
        $("#aTendered").val("");
//$("#dChange").val("0");
}
});
  });

  $(document).ready(function(){

    $("#selectCust").hide();
    $("#existCust").on('change',function(){
      if($(this).prop("checked")){
        $("#selectCust").show();
      }
      else{
        $("#selectCust").hide();
      }
    });
  });

  $(document).ready(function(){
    $("#custcont").on('keyup',function(){
      var val = $("#custcont").val(); 
      if(isNaN(val)){
        var e = "Please input a number";
        $('#erCon').html(e);
            $('#custcont').css('border-color','red');
      }
      else if(val<0){
        var e = "Please input a valid number";
        $('#erCon').html(e);
            $('#custcont').css('border-color','red');
      }
      else{
      var t = 0;
      $.ajax({
        type: 'post',
        url: 'next-validation.php',
        data: {
          id: val, t : t,
        },
        success: function (response) {
          $( '#erCon').html(response);
          if(response!=""){
            $('#custcont').css('border-color','red');
          }
          else{
            $('#custcont').css('border-color','black');
          }
        }
      });
    }
    });
  });

  $(document).ready(function(){
    $("#custemail").on('keyup',function(){
      var val = $("#custemail").val(); 
      var t = 1;
      $.ajax({
        type: 'post',
        url: 'next-validation.php',
        data: {
          id: val, t : t,
        },
        success: function (response) {
// We get the element having id of display_info and put the response inside it
$( '#erEmail').html(response);
if(response!=""){
  $('#custemail').css('border-color','red');
}
else{
  $('#custemail').css('border-color','black');
}
}
});
    });
  });
        

  var flag = true;
function inputValidate(id){
    var user = $('#edit'+id).val();
    
    userkey = $('#edit'+id).val();
    userkey = userkey.slice(userkey.length -1 , userkey.length);

      if(userkey == '\\'){
        $('#saveBtn').prop('disabled',true);
      $('#message'+id).html('Symbols not Allowed');
      $('#edit'+id).css('border-color','red');
      }else{
    $.post('next-check.php',{username : user}, function(data){
     
     if(data == 'Symbols not allowed'){
       flag = true;
          $('#saveBtn').prop('disabled',true);
      $('#message'+id).html(data);
      $('#edit'+id).css('border-color','red');
     }
     else if(data == 'White space not allowed'){
       flag = true

          $('#saveBtn').prop('disabled',true);
      $('#message'+id).html(data);
      $('#edit'+id).css('border-color','red');
     }
     else if(data == 'good'){
      flag = false;
       $('#message'+id).html('');
     $('#saveBtn').prop('disabled',false);
      $('#edit'+id).css('border-color','limegreen');
     }
    });
  }

  if(!flag){
    $('#saveBtn').prop('disabled',false);
    $('#nextMessage').html('');
  }else if(flag){
    $('#saveBtn').prop('disabled',true);
    $('#nextMessage').html('Some Fields have errors');
    $('#nextMessage').css('color','red');
  }

  }

  function validate(){
    var val = $('#custemail').val();
    if(validateEmail(val)){
      $('#custemail').css('border-color','limegreen');
       $('#messageEmail').html(''); 
    $('#saveBtn').prop('disabled',false);
    }else{
       $('#custoemail').css('border-color','red');
       $('#messageEmail').html('Email not valid'); 
    $('#saveBtn').prop('disabled',true);
    }

  }
  $(document).ready(function(){
    var options = {};
                $('#ratePick').click(function(){ 

                  if($('#ratePick').is(':checked')){
                    $('#paneldel').hide("blind"); 
                    $('#da').prop('disabled',true);
                    $('#city').prop('disabled',true);
                    $('#zip').prop('disabled',true);
                    $('#delloc').prop('disabled',true);
                    $('#da').val('');
                    $('#city').val('');
                    $('#zip').val('');
                    $('#delloc').val('');

                    $('#dRate').val(0);

                    var x = parseFloat($('#totalPrice').val());
                    $('#ttp').html('&#8369;'+parseFloat(x));
                    $('#paydRate').html('&#8369;'+0.00);
                  }

                });
$('#rateDel').click(function(){
  if($('#rateDel').is(':checked')){
                    $('#paneldel').show("blind");  
    $('#dRate').val(0);
    $('#da').prop('disabled',false);
    $('#city').prop('disabled',false);
    $('#zip').prop('disabled',false);
    $('#delloc').prop('disabled',false);
    $('#da').val('');
    $('#city').val('');
    $('#zip').val('');
    $('#delloc').val('');
  }
});



$('#delloc').change(function(){
  var x = parseFloat($('#totalPrice').val());
  $('#dRate').val(parseFloat($('#delloc').val()));
  $('#paydRate').html('&#8369;'+parseFloat($('#delloc').val()));
  var d = parseFloat($('#delloc').val());
  var due = x + d;
  $('#ttp').html('&#8369;'+parseFloat(due));
});
});

$(document).ready(function(){
  var x = parseFloat($('#totalPrice').html());
  var y = parseFloat($('#dRate').html());

});

  function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
} 

      </script>
      <?php

      $id = $_SESSION["custID"];
      $sql = "SELECT * FROM tblcustomer WHERE customerID = '$id';";
      $result= mysqli_query($conn,$sql);
      $row = mysqli_fetch_assoc($result);

      ?>

      <!-- Breadcrumb Start-->
      <ul class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i></a></li>
        <li><a href="cart.php">Shopping Cart</a></li>
        <li><a href="checkout.php">Checkout</a></li>
      </ul>
      <!-- Breadcrumb End-->
      <div class="row">
        <!--Middle Part Start-->
        <form action="checkout-order.php" method="post">
        <div id="content" class="col-sm-12">
          <h1 class="title">Checkout</h1>
          <div class="row">
            <div class="col-sm-4">
              <!--
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title"><i class="fa fa-sign-in"></i> Create an Account or Login</h4>
                </div>
                  <div class="panel-body">
                        <div class="radio">
                          <label>
                            <input type="radio" value="register" name="account">
                            Register Account</label>
                        </div>
                        <div class="radio">
                          <label>
                            <input type="radio" checked="checked" value="guest" name="account">
                            Guest Checkout</label>
                        </div>
                        <div class="radio">
                          <label>
                            <input type="radio" value="returning" name="account">
                            Returning Customer</label>
                        </div>
                  </div>
              </div>!-->
              
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title"><i class="fa fa-user"></i> Your Personal Details</h4>
                </div>
                  <div class="panel-body">
                        <fieldset id="account">
 
    <div class="form-group required">
      <label class="control-label">First Name</label>
      <input type="text" id="edit1" onkeyup="inputValidate('1')" class="form-control" name="firstn" placeholder="Juan" value="<?php echo $row['customerFirstName'];?>" required readonly/><span id="message1"></span> 
    </div>
    <div class="form-group required">
      <label class="control-label">Middle Name</label>
      <input type="text" id="edit2" onkeyup="inputValidate('2')" class="form-control" name="midn" placeholder="Vito" value="<?php echo $row['customerMiddleName'];?>" readonly/><span id="message2"></span> 
    </div>
    <div class="form-group required">
      <input type="hidden" name="customerIds" id="customerIds">
      <label class="control-label">Last Name</label>
      <input type="text" id="edit3" onkeyup="inputValidate('3')" class="form-control" name="lastn" placeholder="de la Cruz" value="<?php echo $row['customerLastName'];?>" readonly required/><span id="message3"></span>
    </div>
                       
    <div class="form-group required">
      <label class="control-label">Address</label>
      <textarea id="custadd"  class="form-control" name="custadd" placeholder="#123 Brgy. Batasan Hills Quezon City" required readonly><?php echo $row['customerAddress'];?></textarea>
    </div>
    <div class="form-group required">
      <label class="control-label">Contact Number</label>
      <input type="text" id="custcont" class="form-control" name="custocont" style="text-align:right" placeholder="09993387065" value="<?php echo $row['customerContactNum'];?>" readonly required/>
      <p style="color:red" id="erCon"></p>
    </div>
    <div class="form-group required">
      <label class="control-label">Email</label>
      <input type="email" id="custemail" onkeyup="validate()" class="form-control" name="custoemail" placeholder="monkeydluffy@gmail.com" value="<?php echo $row['customerEmail'];?>" readonly required/><span id="messageEmail"></span> 
      <p style="color:red" id="erEmail"></p>
</div>
                        </fieldset>
                      </div>
              </div>
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title"><i class="fa fa-truck"></i> Delivery Method</h4>
                    </div>
                      
                    <div class="row">
            <div class="col-md-6 col-md-offset-3" style="text-align: center;">
              <div class="form-group">
                
                  <label class="radio-inline"><input type="radio" id="ratePick" name="type" value="Pick-up"/> Pick-up</label>
                  <label class="radio-inline"><input type="radio" id="rateDel" name="type" value="Delivery"/> Delivery</label>
                </div>
              </div>
            </div>


                  </div>
              <div class="panel panel-default" id="paneldel" style="display: none">
                <div class="panel-heading">
                  <h4 class="panel-title"><i class="fa fa-book"></i>Delivery Address</h4>
                </div>
                  <div class="panel-body">
                        <fieldset id="address" class="required">
              <div class="deliveryDetails">
             
                  <label class="control-label">Delivery Location</label>
                  <select id="delloc" style="height:40px;" class="form-control" data-placeholder="Choose Delivery Location" tabindex="1" name="delloc" disabled> 
                    <option value="" disabled>Choose a Location</option>
                    <?php
                    $delsql = "SELECT * FROM tbldelivery_rates ORDER BY delLocation;";
                    $delresult = mysqli_query($conn,$delsql);
                    while($delrow = mysqli_fetch_assoc($delresult)){
                      echo('<option value="'.$delrow['delRate'].'">'.$delrow['delLocation'].'</option>');
                    }
                    ?>
                  </select>
                  <div class="form-group">
                    <label class="control-label">Delivery Rate</label>
                    <input type="number" style="text-align:right;" id="dRate" class="form-control" value='0' readonly/>
                  </div>
              
                    <label class="control-label">Delivery Address</label>
                    
                      <div class="form-group required">
                        <input type="text" id="da" class="form-control" name="deladd[]" placeholder="#1528 Kagawad Street" disabled required/>
                        </div>
                      <div class="form-group">
                        <input type="text" id="city" class="form-control" name="deladd[]" placeholder="Brgy.Batasan Hills" disabled required/>
                        </div>
                      <div class="form-group">
                        <input type="text" id="zip" class="form-control" name="deladd[]" placeholder="Quezon City" disabled required/>
                      </div>
                    
                    <br>
            </div>
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" checked="checked" value="1" name="shipping_address">
                              My delivery and billing addresses are the same.</label>
                          </div>
                        </fieldset>
                      </div>
              </div>
            </div>
            <div class="col-sm-8">
              <div class="row">
                <!--
                <div class="col-sm-6">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title"><i class="fa fa-credit-card"></i> Payment Method</h4>
                    </div>
                      <div class="panel-body">
                        <p>Please select the preferred payment method to use on this order.</p>
                        <div class="radio">
                          <label>
                            <input type="radio" checked="checked" name="Cash On Delivery">
                            Cash On Delivery</label>
                        </div>
                        <div class="radio">
                          <label>
                            <input type="radio" name="Bank Transfer">
                            Bank Transfer</label>
                        </div>
                        <div class="radio">
                          <label>
                            <input type="radio" name="Paypal">
                            Paypal</label>
                        </div>
                      </div>
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title"><i class="fa fa-ticket"></i> Use Coupon Code</h4>
                    </div>
                      <div class="panel-body">
                        <label for="input-coupon" class="col-sm-3 control-label">Enter coupon code</label>
                        <div class="input-group">
                          <input type="text" class="form-control" id="input-coupon" placeholder="Enter your coupon here" value="" name="coupon">
                          <span class="input-group-btn">
                          <input type="button" class="btn btn-primary" data-loading-text="Loading..." id="button-coupon" value="Apply Coupon">
                          </span></div>
                      </div>
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title"><i class="fa fa-gift"></i> Use Gift Voucher</h4>
                    </div>
                      <div class="panel-body">
                        <label for="input-voucher" class="col-sm-3 control-label">Enter gift voucher code</label>
                        <div class="input-group">
                          <input type="text" class="form-control" id="input-voucher" placeholder="Enter your gift voucher code here" value="" name="voucher">
                          <span class="input-group-btn">
                          <input type="submit" class="btn btn-primary" data-loading-text="Loading..." id="button-voucher" value="Apply Voucher">
                          </span> </div>
                      </div>
                  </div>
                </div> -->
                <div class="col-sm-12">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title"><i class="fa fa-shopping-cart"></i> Shopping cart</h4>
                    </div>
                      <div class="panel-body">
                        <div class="table-responsive">
                          <table class="table table-bordered">
                            <thead>
                              <tr>
                                <td class="text-center">Image</td>
                                <td class="text-left">Furniture Name</td>
                                <td class="text-left">Furniture Description</td>
                                <td class="text-left">Quantity</td>
                                <td class="text-right">Furniture Price</td>
                              </tr>
                            </thead>
                            <tbody id="checkOut">
                              <script type="text/javascript">
                                $(document).ready(function(){

                                var ttp = sessionStorage.getItem('totalPrice');
                                var ttq = sessionStorage.getItem('totalQuant');
                                var value = sessionStorage.getItem('item');
                                var item = new Array();
                                item = value.split(',');

                                var numItems = item.length/6;
                                
                                

                                var i = 0;

                                var j = 0;
                                $('#stt').html('&#8369;'+ttp)
                                $('#ttp').html('&#8369;'+ttp);
                                $('#ttq').html(''+ttq);
                                $('#totalPrice').val(ttp);


                                while(i != numItems){

                                if(i == 0){
                                $('#checkOut').append('<tr id="'+item[0]+'"><td class="text-center"><img src="'+item[5]+'" style="height: 100px; width: 105px;" alt="Product" title="'+item[1]+'" class="img-thumbnail"></td><td class="text-left">'+item[1]+'</td><td>'+item[2]+'</td><td style="text-align: right;">'+item[4]+'</td></div><td style="text-align: right;">&#8369;'+item[3]+'</td></tr>');
                                $('#orders').append('<input type="hidden" name="cart[]" value="'+item[0]+'"/>     <input type="hidden" name="prices[]" value="'+item[3]+'"/>                      <input type="hidden" name="quant[]" value="'+item[4]+'"/>');
                                }else{
                                   j = 6 * (i);
                                  $('#checkOut').append('<tr id="'+item[0+j]+'"><td class="text-center"><img src="'+item[5+j]+'" style="height: 100px; width: 105px;" alt="Product" title="'+item[1+j]+'" class="img-thumbnail"></td><td class="text-left">'+item[1+j]+'</td><td>'+item[2+j]+'</td><td style="text-align: right;">'+item[4+j]+'</td></div><td style="text-align: right;">&#8369;'+item[3+j]+'</td></tr>');
                                  $('#orders').append('<input type="hidden" name="cart[]" value="'+item[0+j]+'"/>     <input type="hidden" name="prices[]" value="'+item[3+j]+'"/>                      <input type="hidden" name="quant[]" value="'+item[4+j]+'"/>');
                                }

                                i++;
                                }
                              });
                                $(document).ready(function(){

                                  var pvalue = sessionStorage.getItem('pitem');
                                var pitem = new Array();
                                pitem = pvalue.split(',');

                                var pnumItems = pitem.length/6;
                                
                                
                                alert(pnumItems);
                                var pi = 0;

                                var pj = 0;
                                while(pi != pnumItems){

                                if(pi == 0){
                                $('#checkOut').append('<tr id="'+pitem[0]+'"><td class="text-center"><img src="'+pitem[5]+'" style="height: 100px; width: 105px;" alt="Product" title="'+pitem[1]+'" class="img-thumbnail"></td><td class="text-left">'+pitem[1]+'</td><td>'+pitem[2]+'</td><td style="text-align: right;">'+pitem[4]+'</td></div><td style="text-align: right;">&#8369;'+pitem[3]+'</td></tr>');
                                $('#orders').append('<input type="hidden" name="P_cart[]" value="'+pitem[0]+'"/>     <input type="hidden" name="P_prices[]" value="'+pitem[3]+'"/>                      <input type="hidden" name="P_quant[]" value="'+pitem[4]+'"/>');
                                }else{
                                   pj = 6 * (pi);
                                  $('#checkOut').append('<tr id="'+pitem[0+pj]+'"><td class="text-center"><img src="'+pitem[5+pj]+'" style="height: 100px; width: 105px;" alt="Product" title="'+pitem[1+pj]+'" class="img-thumbnail"></td><td class="text-left">'+pitem[1+pj]+'</td><td>'+pitem[2+pj]+'</td><td style="text-align: right;">'+pitem[4+pj]+'</td></div><td style="text-align: right;">&#8369;'+pitem[3+pj]+'</td></tr>');
                                  $('#orders').append('<input type="hidden" name="P_cart[]" value="'+pitem[0+pj]+'"/>     <input type="hidden" name="P_prices[]" value="'+pitem[3+pj]+'"/>                      <input type="hidden" name="P_quant[]" value="'+pitem[4+pj]+'"/>');
                                }

                                pi++;
                                }

                                });
                              </script>


                              


                                <?php
                  //PRODUCT VARIABLES
                  /*              
                  $removed = $_POST['removed'];
                  $priceremoved = $_POST['priceremoved'];
                  $quantremoved = $_POST['quantremoved'];
                  $selected = $_POST['cart'];
                  $selectedQuant = $_POST['quant'];
                  $selectedPrice = $_POST['price'];

                  $ctr = 0;
                  $pCtr = 0;
                  $quantarray = array();
                  $pricearray = array();
                  $removearray = array();
                  $priceremovearray = array();
                  $quantremovearray = array();

                   $tempPrice = 0;
                  $tempQuant = 0;
                  //


                  //PACKAGE VARIABLES

                  $P_removed = $_POST['P_removed'];
                  $P_priceremoved = $_POST['P_priceremoved'];
                  $P_quantremoved = $_POST['P_quantremoved'];
                  $P_selected = $_POST['P_cart'];
                  $P_selectedQuant = $_POST['P_quant'];
                  $P_selectedPrice = $_POST['P_price'];

                   $P_tempPrice = 0;
                  $P_tempQuant = 0;
                  $P_ctr = 0;
                  $P_pCtr = 0;

                  $P_quantarray = array();
                  $P_pricearray = array();
                  $P_removearray = array();
                  $P_priceremovearray = array();
                  $P_quantremovearray = array();

                 

                  $totPrice = $_POST['totalPrice'];
                  $totQuant = $_POST['totalQuant'];
                  //

                  ///DISPLAY PACKGAGEGE
                  if($P_selected[0] != 0){
                    echo count($P_selected);
                  }
                  else{
                  foreach ($P_removed as $P_removedItem) {
                    array_push($P_removearray, $P_removedItem);
                  }
                  foreach ($P_priceremoved as $P_priceremovedItem) {
                    array_push($P_priceremovearray, $P_priceremovedItem);
                  }
                  foreach ($P_quantremoved as $P_quantremovedItem) {
                    array_push($P_quantremovearray, $P_quantremovedItem);
                  }

                  foreach ($P_selectedQuant as $P_itemQuant) {
                    if(!in_array($P_itemQuant, $P_quantremovearray)){
                      $P_tempQuant =+ $P_itemQuant;
                      array_push($P_quantarray,$P_itemQuant);
                    }
                    else{
                    }
                  } 
                  foreach ($P_selectedPrice as $P_itemPrice) {
                    if(!in_array($P_itemPrice, $P_priceremovearray)){
                      $P_tempPrice =+ $P_itemPrice;
                      array_push($P_pricearray,$P_itemPrice);
                    }
                    else{
                    }
                  }
                  foreach ($P_selected as $P_items) {
                    if(!in_array($P_items, $P_removearray)){
                      echo 'oke';
                      $sql = "SELECT * FROM tblpackages where packageID = '$P_items';";
                      $result = mysqli_query($conn, $sql);

                      if($result){
                        while ($row = mysqli_fetch_assoc($result)) {
                          $P_ctr++; 
                          $P_pCtr++;                            
                          echo ('
                            <tr><td><img src="image/product/sony_vaio_1-50x75.jpg" alt="Xitefun Causal Wear Fancy Shoes" title="Xitefun Causal Wear Fancy Shoes" class="img-thumbnail"></td><td><input id="cart'.$P_ctr.'" name="P_cart[]" value="'.$P_items.'" type="hidden"/>'. $row['packageDescription'].'</td>

                            <td>PACKAGE '); ?><button type="button" class="btn btn-info " data-toggle="viewPackageModal" href="packages-form.php" data-remote="packages-form.php?id=<?php echo $row['packageID']; ?> #view" data-target="#myModal">
                            <span class='glyphicon glyphicon-eye-open'></span> View</button> <?php echo('</td>
                            <td style="text-align: right;">'.$P_quantarray[$P_ctr-1].'<input id="quant'.$P_ctr.'" name="P_quant[]" value="'.$P_quantarray[$P_ctr-1].'" type="hidden"/></td>
                            <td id="price'.$P_ctr.'"style="text-align: right;">&#8369; '.number_format($P_pricearray[$P_pCtr-1],2).'<input id="price'.$P_ctr.'" name="P_prices[]" value="'.$P_pricearray[$P_pCtr-1].'" type="hidden"/></td></tr>');
        
    }
  }
}
}
}


                  //

  if($selected[0] != 0){
                  foreach ($removed as $removedItem) {
                    array_push($removearray, $removedItem);
                  }
                  foreach ($priceremoved as $priceremovedItem) {
                    array_push($priceremovearray, $priceremovedItem);
                  }
                  foreach ($quantremoved as $quantremovedItem) {
                    array_push($quantremovearray, $quantremovedItem);
                  }

                  foreach ($selectedQuant as $itemQuant) {
                    if(!in_array($itemQuant, $quantremovearray)){
                      $tempQuant =+ $itemQuant;
                      array_push($quantarray,$itemQuant);
                    }
                    else{
                    }
                  } 
                  foreach ($selectedPrice as $itemPrice) {
                    if(!in_array($itemPrice, $priceremovearray)){
                      $tempPrice =+ $itemPrice;
                      array_push($pricearray,$itemPrice);
                    }
                    else{
                    }
                  }
                  foreach ($selected as $items) {
                    if(!in_array($items, $removearray)){
                      $sql = "SELECT * FROM tblproduct where productID = '$items';";
                      $result = mysqli_query($conn, $sql);
                      if($result){
                        while ($row = mysqli_fetch_assoc($result)) {
                          $ctr++; 
                          $pCtr++;                            
                          echo ('

                            <tr><td class="text-center"><a href="product.php"><img src="image/product/sony_vaio_1-50x75.jpg" alt="Xitefun Causal Wear Fancy Shoes" title="Xitefun Causal Wear Fancy Shoes" class="img-thumbnail"></a></td>
                                <td class="text-left"><input id="cart'.$ctr.'" name="cart[]" value="'.$items.'" type="hidden"/>'.$row['productName'].'</td>
                                <td>'.$row['productDescription'].'</td>
                                   <td style="text-align: right;">'.$quantarray[$ctr-1].'<input id="quant'.$ctr.'" name="quant[]" value="'.$quantarray[$ctr-1].'" type="hidden"/></td>
                                    </div>
                                 <td id="price'.$ctr.'"style="text-align: right;">&#8369; '.number_format($pricearray[$pCtr-1],2).'<input id="price'.$ctr.'" name="prices[]" value="'.$pricearray[$pCtr-1].'" type="hidden"/></td></tr>');
         
    }
  }
}
}
}
*/
?>
                            </tbody>
                            <tfoot>
                              <tr>
                                <td class="text-right" colspan="4"><strong>Total Quantity:</strong></td>
                                <td class="text-right" id="ttq"></td>
                              </tr>
                              <tr>
                                <td class="text-right" colspan="4"><strong>Sub-Total:</strong></td>
                                <td class="text-right" id="stt">&#8369;</td>
                              </tr>
                              <tr>
                                <td class="text-right" colspan="4"><strong>Delivery Rate:</strong></td>
                                <td class="text-right" id="paydRate">&#8369; 0.00</td>
                              </tr>
                              <tr>
                                <td class="text-right" colspan="4"><strong>Total:</strong></td>
                                <td class="text-right" id="ttp"></td>
                                <input id="totalPrice" name="totalPrice" type="hidden"/>
                              </tr>
                            </tfoot>
                          </table>
                        </div>
                      </div>
                  </div>
                </div>
                <div id="orders">
                  
                </div>

                <div class="col-sm-12">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title"><i class="fa fa-pencil"></i> Add Comments About Your Order</h4>
                    </div>
                      <div class="panel-body">
                        <textarea rows="4" class="form-control" id="confirm_comment" name="orderremarks"></textarea>
                        <br>
                        <label class="control-label" for="confirm_agree">
                          <input type="checkbox" checked="checked" value="1" required="" class="validate required" id="confirm_agree" name="confirm agree">
                          <span>I have read and agree to the <a class="agree" href="#"><b>Terms &amp; Conditions</b></a></span> </label>
                        <div class="buttons">
                          <div class="pull-right">
                            <button type="submit" class="btn btn-primary" id="button-confirm" onclick="sessionStorage.clear();">Confirm Order</button>
                          </div>
                        </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
        <!--Middle Part End -->
      </div>
    </div>
  </div>
<?php include"footer.php";?>
</div>
<?php include"scripts.php";?>
</body>
</html>