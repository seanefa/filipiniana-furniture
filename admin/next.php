<?php
include 'dbconnect.php';
include "menu.php";
/*
if(isset($_GET['customerId'])){
$jsID = $_GET['customId']; 
}*/
//$_SESSION['varname'] = 3;

$jsID = "";

if(isset($_POST['id'])){
  $jsID = $_POST['id']; 
}

if(isset($_GET['id'])){
  $jsID = $_GET['id']; 
}
?>
<!DOCTYPE html>  
<html lang="en">
<head>
  <title>Check-Out</title>
  <script>
    $(document).ready(function(){
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
  $(document).ready(function(){
    $('#frequency').change(function(){
      var value = $("#frequency").val();
      $.ajax({
        type: 'post',
        url: 'reports-drop.php',
        data: {
          id: value,
        },
        success: function (response) {
          $( '#range' ).html(response);
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

  function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
} 


  </script>
</head>
<body class ="fix-header fix-sidebar">
  <!-- Preloader -->
  <div id="page-wrapper">
    <div class="container-fluid">
      <div class="row" style="margin-top: 20px;">
        <div class="col-sm-12">
          <!--h4 class="box-title">
            <h3>
              <ul class="nav customtab2 nav-tabs" role="tablist">
                <li role="presentation" class="active">
                  <a aria-controls="proorders" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs">Check-Out</span></a>
                </li>
              </ul>
            </h3>
          </h4-->
          <div class="orderconfirm">
            <form action="add-customer.php" method = "post">
              <div class="panel-group wiz-aco" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                  <div class="panel-heading" role="tab" id="headingOne">
                    <h4 class="panel-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <h3>Customer Information</h3><h6><span id="nextMessage"></span></h6>
                      </a>
                    </h4>
                  </div>
                  <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
                      <div class="row">
                        <div class="descriptions">
                          <div class="form-body">
                            <div class="row">
                              <div class="col-md-4">
                                <input type="checkbox" name="existCust" id="existCust" value="existing"/>
                                Existing Customer Information?
                              </div>
                            </div>
                            <br>
                            <div class="row">
                              <div class="col-md-4" id="selectCust">
                                <input type="hidden" id="isBool" name="isBool" value="new">
                                <select id="savedCustomer" style="height:40px;" class="form-control" data-placeholder="Choose Customer Name" tabindex="1" name="customer"> 
                                  <option value="">Choose a Customer</option>
                                  <?php
                                  $sql = "SELECT * FROM tblcustomer ORDER BY customerLastName ASC;";
                                  $result = mysqli_query($conn, $sql);
                                  while ($row = mysqli_fetch_assoc($result))
                                  {
                                    if($row['customerStatus'] != "Archived"){
                                      echo('<option value='.$row['customerID'].'>'.$row['customerLastName'].' '.$row['customerFirstName'].' '.$row['customerMiddleName'].'</option>
                                        ');
                                    }
                                  }
                                  ?>
                                </select>
                              </div>

                              <?php
                              $sql = "SELECT * FROM tblcustomer;";
                              $result = mysqli_query($conn, $sql);
                              while ($row = mysqli_fetch_assoc($result))
                              {
                                if($row['customerStatus'] != "Archived"){
                                  echo('
                                    <input type="hidden" id="lstName'.$row['customerID'].'" value="'.$row['customerLastName'].'">
                                    <input type="hidden" id="firstName'.$row['customerID'].'" value="'.$row['customerFirstName'].'">
                                    <input type="hidden" id="midName'.$row['customerID'].'" value="'.$row['customerMiddleName'].'">
                                    <input type="hidden" id="address'.$row['customerID'].'" value="'.$row['customerAddress'].'">
                                    <input type="hidden" id="contact'.$row['customerID'].'" value="'.$row['customerContactNum'].'">
                                    <input type="hidden" id="email'.$row['customerID'].'" value="'.$row['customerEmail'].'">
                                    ');
                                }
                              }
                              ?>

                              <script type="text/javascript">
                              $(document).ready(function(){
                                $('#thisBtnSucks').removeAttr('href');

                                $('#savedCustomer').change(function(){

                                  var id = $('#savedCustomer').val();

                                  if(id==""){
                                    $('#customerIds').attr('value',"");
                                    $('#saveBtn').attr('type',"submit");
                                    $('#isBool').attr('value','new');
                                    $('#saveBtn').attr('onclick',"");
                                    $('#edit3').attr('value',"");
                                    $('#edit3').attr('readonly',false);
                                    $('#edit1').attr('value',"");
                                    $('#edit1').attr('readonly',false);
                                    $('#edit2').attr('value',"");
                                    $('#edit2').attr('readonly',false);
                                    $('#custadd').val("");
                                    $('#custadd').attr('readonly',false);
                                    $('#custcont').attr('value',"");
                                    $('#custcont').attr('readonly',false);
                                    $('#custemail').attr('value',"");
                                    $('#custemail').attr('readonly',false);
                                  }
                                  else{
                                    $('#isBool').attr('value','existing');
                                    $('#saveBtn').attr('type',"button");
                                    $('#saveBtn').attr('onclick',"location.href='receipt.php';");
                                    $('#customerIds').attr('value',id);
                                    $('#edit3').attr('value',$('#lstName'+id+'').val());
                                    $('#edit3').html($('#lstName'+id+'').val());
                                    $('#edit3').attr('readonly',true);
                                    $('#edit1').attr('value',$('#firstName'+id+'').val());
                                    $('#edit1').attr('readonly',true);
                                    $('#edit2').attr('value',$('#midName'+id+'').val());
                                    $('#edit2').attr('readonly',true);
                                    $('#custadd').val($('#address'+id+'').val());
                                    $('#custadd').attr('readonly',true);
                                    $('#custcont').attr('value',$('#contact'+id+'').val());
                                    $('#custcont').attr('readonly',true);
                                    $('#custemail').attr('value',$('#email'+id+'').val());
                                    $('#custemail').attr('readonly',true);
                                  }
                                });
});
</script>

<div class="col-md-4">
</div>
<div class="col-md-4">
</div>
</div>
<br>
<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label class="control-label">First Name</label><span id="x" style="color:red"> *</span>
      <input type="text" id="edit1" onkeyup="inputValidate('1')" class="form-control" name="firstn" placeholder="Juan" required/><span id="message1"></span> 
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label class="control-label">Middle Name</label>
      <input type="text" id="edit2" onkeyup="inputValidate('2')" class="form-control" name="midn" placeholder="Vito"/><span id="message2"></span> 
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <input type="hidden" name="customerIds" id="customerIds">
      <label class="control-label">Last Name</label><span id="x" style="color:red"> *</span>
      <input type="text" id="edit3" onkeyup="inputValidate('3')" class="form-control" name="lastn" value="" placeholder="de la Cruz" required/><span id="message3"></span>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="form-group">
      <label class="control-label">Address</label><span id="x" style="color:red"> *</span>
      <textarea id="custadd"  class="form-control" name="custadd" placeholder="#123 Brgy. Batasan Hills Quezon City" required></textarea>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="form-group">
      <label class="control-label">Contact Number</label><span id="x" style="color:red"> *</span>
      <input type="number" id="custcont" data-mask="+63 (999) 999-9999" class="form-control" name="custocont" style="text-align:right" placeholder="09993387065" required/>
      <p style="color:red" id="erCon"></p>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label class="control-label">Email</label><span id="x" style="color:red"> *</span>
      <input type="email" id="custemail" onkeyup="validate()" class="form-control" name="custoemail" placeholder="monkeydluffy@gmail.com" required/><span id="messageEmail"></span> 
      <p style="color:red" id="erEmail"></p>
    </div>
  </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="panel panel-default">
  <div class="panel-heading" role="tab" id="headingTwo">
    <h4 class="panel-title">
      <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
        <h3>Order Details</h3>
      </a>
    </h4>
  </div>
  <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
    <div class="panel-body">
      <div class="row">
        <div class="descriptions">
          <div class="col-md-12">
            <div class="table-responsive" style="clear: both;">
              <table class="table table-bordered display nowrap" id="tblPackages">
                <thead>
                  <tr>
                    <h4>
                      <th>Furniture Name</th>
                      <th>Furniture Description</th>
                      <th style="text-align: right;">Unit Price</th>
                      <th style="text-align: right;">Quantity</th>
                      <th style="text-align: right;">Total Price</th></h4>
                      <!--<th style="text-align: center;">Customizations</th>-->
                    </h4>
                  </tr>
                </thead>
                <tbody>

                  <?php 

                  //PRODUCT VARIABLES
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
                  if($P_selected[0] == 0){

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
                      $sql = "SELECT * FROM tblpackages where packageID = '$P_items';";
                      $result = mysqli_query($conn, $sql);

                      if($result){
                        while ($row = mysqli_fetch_assoc($result)) {
                          $P_ctr++; 
                          $P_pCtr++;                            
                          echo ('
                            <tr>
                            <td><input id="cart'.$P_ctr.'" name="P_cart[]" value="'.$P_items.'" type="hidden"/>'. $row['packageDescription'].'</td>

                            <td>PACKAGE '); ?><button type="button" class="btn btn-info " data-toggle="modal" href="packages-form.php" data-remote="packages-form.php?id=<?php echo $row['packageID']; ?> #view" data-target="#myModal">
                            <span class='glyphicon glyphicon-eye-open'></span> View</button> <?php echo('</td>

                            <td style="text-align: right;">&#8369; '.number_format($row['packagePrice'],2).'</td>
                            <td style="text-align: right;">'.$P_quantarray[$P_ctr-1].'<input id="quant'.$P_ctr.'" name="P_quant[]" value="'.$P_quantarray[$P_ctr-1].'" type="hidden"/></td>
                            <td id="price'.$P_ctr.'"style="text-align: right;">&#8369; '.number_format($P_pricearray[$P_pCtr-1],2).'<input id="price'.$P_ctr.'" name="P_prices[]" value="'.$P_pricearray[$P_pCtr-1].'" type="hidden"/></td>');
      echo'</tr>';   
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
                            <tr>
                            <td><input id="cart'.$ctr.'" name="cart[]" value="'.$items.'" type="hidden"/>'.$row['productName'].'</td>
                            <td>'.$row['productDescription'].'</td>
                            <td style="text-align: right;">&#8369; '.number_format($row['productPrice'],2).'</td>
                            <td style="text-align: right;">'.$quantarray[$ctr-1].'<input id="quant'.$ctr.'" name="quant[]" value="'.$quantarray[$ctr-1].'" type="hidden"/></td>
                            <td id="price'.$ctr.'"style="text-align: right;">&#8369; '.number_format($pricearray[$pCtr-1],2).'<input id="price'.$ctr.'" name="prices[]" value="'.$pricearray[$pCtr-1].'" type="hidden"/></td>');
      echo'</tr>';   
    }
  }
}
}
}
?>

<tfoot>
  <td colspan="3" style="text-align:right;"><b> GRAND TOTAL</b></td>
  <td style="text-align: right;"><b><?php echo ('<input id="totalQuant" name="totalQuant" value ="'.$totQuant.'" type="hidden"/>'.$totQuant.''); ?></b></td>
  <td style="text-align: right;"><b>&#8369; <?php echo number_format($totPrice,2); ?></b></td>
  <input type="hidden" name="totalPrice" id="totalPrice" value="<?php echo $totPrice; ?>">
</tfoot>
</tbody>

<script type="text/javascript">
var tempPrice = parseInt($('#totalPrice').html());
var tempTQuant = parseInt($('#totalQuant').val());
var realPrice = 0;
var totalPrice =0;
var price = 0;
var quant = 0;
var flag = 0;
function sendData(ctr){
  realPrice = parseInt($('#prices'+ctr).val())/ parseInt($('#quant'+ctr).val()) ;
  price = parseInt($('#prices'+ctr).val());
}

function passValue(ctr){

  quant = parseInt($('#quant'+ctr).val());
  var temRice = quant * price;
  alert(temRice);
  $('#price'+ctr).html(0);
  $('#price'+ctr).html(String(quant * realPrice));

//total Score

if(flag == 0 ){
  totalPrice = tempPrice - price;
  var e = totalPrice +(quant * realPrice);
  alert(e);
  $('#totalPrice').html(0);
  $('#totalPrice').html(String(e));
  flag = 1;
}
else if(flag == 1){
  var tPrice = parseInt($('#totalPrice').html());
  alert(quant * parseInt($('#prices'+ctr).val()));
  $('#totalPrice').html(0);
  $('#totalPrice').html(tPrice+(quant * parseInt($('#prices').val())));
}
}
</script>

</table>
</div>

<div class="row">
  <div class="col-md-8">
    <div class="form-group">
      <label class="control-label">Order Remarks</label>
      <textarea name="orderremarks" id="orderremarks" class="form-control"></textarea>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label class="control-label">Pick up/Delivery Date</label>
      <input type="date" id="pdate" class="form-control" name="pidate" required/> 
    </div>
  </div>
</div>

<!--<div class="row">
<div class="col-md-6">
<label class="control-label">Received By:</label>
<select id="emp" style="height:40px;" class="form-control" data-placeholder="Choose Employee" tabindex="1" name="emp"> <option value="" ></option>
<?php
$delsql = "SELECT * FROM tblemployee;";
$delresult = mysqli_query($conn,$delsql);
while($delrow = mysqli_fetch_assoc($delresult)){
echo('<option value="'.$delrow['empID'].'">'.$delrow['empLastName'].','.$delrow['empFirstName'].','.$delrow['empMidName'].'</option>');
}
?>
</select>
</div> 
</div>-->

</div>
</div>
</div>  
</div>
</div>
</div>
<div class="panel panel-default">
  <div class="panel-heading" role="tab" id="headingThree">
    <h4 class="panel-title">
      <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
        <h3>Delivery Information</h3>
      </a>
    </h4>
  </div>
  <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
    <div class="panel-body">
      <div class="row">
        <div class="descriptions">
          <div class="row">
            <div class="col-md-6 col-md-offset-3" style="text-align: center;">
              <div class="form-group">
                <h4><b>For:</b> 
                  <label class="radio-inline"><input type="radio" id="ratePick" name="type" value="Pick-up"/> Pick-up</label>
                  <label class="radio-inline"><input type="radio" id="rateDel" name="type" value="Delivery"/> Delivery</label></h4>
                </div>
              </div>
            </div>

            <div class="deliveryDetails">
              <div class="row">
                <div class="col-md-6">
                  <label class="control-label">Delivery Location</label>
                  <select id="delloc" style="height:40px;" class="form-control" data-placeholder="Choose Delivery Location" tabindex="1" name="delloc" disabled> 
                    <option value="">Choose a Location</option>
                    <?php
                    $delsql = "SELECT * FROM tbldelivery_rates ORDER BY delLocation;";
                    $delresult = mysqli_query($conn,$delsql);
                    while($delrow = mysqli_fetch_assoc($delresult)){
                      echo('<option value="'.$delrow['delRate'].'">'.$delrow['delLocation'].'</option>');
                    }
                    ?>
                  </select>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label">Delivery Rate</label>
                    <input type="number" style="text-align:right;" id="dRate" class="form-control" value='0' readonly/>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="control-label">Delivery Address</label>
                    <div class="row">
                      <div class="col-md-5">
                        <input type="text" id="da" class="form-control" name="deladd[]" placeholder="#1528 Kagawad Street" disabled required/>
                      </div>
                      <div class="col-md-4">
                        <input type="text" id="city" class="form-control" name="deladd[]" placeholder="Brgy.Batasan Hills" disabled required/>
                      </div>
                      <div class="col-md-3">
                        <input type="text" id="zip" class="form-control" name="deladd[]" placeholder="Quezon City" disabled required/>
                      </div>
                    </div>
                    <br>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <script type="text/javascript">
              $(document).ready(function(){
                $('#ratePick').click(function(){ 

                  if($('#ratePick').is(':checked')){ 
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
                    $('#amountDue').val(parseFloat(x));
                  }

                });
$('#rateDel').click(function(){
  if($('#rateDel').is(':checked')){ 
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
  $('#paydRate').val(parseFloat($('#delloc').val()));
  var d = parseFloat($('#delloc').val());
  var due = x + d;
  $('#amountDue').val(parseFloat(due));
});
});

$(document).ready(function(){
  var x = parseFloat($('#totalPrice').html());
  var y = parseFloat($('#dRate').html());

});

</script>
</div>
</div>
</div>
</div>
</div>
</div>


<div class="panel panel-default">
  <div class="panel-heading" role="tab" id="headingFour">
    <h4 class="panel-title">
      <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
        <h3>Payment</h3>
      </a>
    </h4>
  </div>
  <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
    <div class="panel-body">

      <div class="row">
        <div class="col-md-6">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label class="control-label">Order Price</label>
                <input style="text-align:right;" id="oPrice" class="form-control" value="Php <?php echo number_format($totPrice,2)?>" disabled/>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label class="control-label">Delivery Rate</label>
                <input type="number" style="text-align:right;" id="paydRate" class="form-control" value='0' name="paydRate" readonly/>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              
            <div class="form-group">
              <label class="control-label">Downpayment
                <h6><em> Downpayment must be 50% of the total order price</em></h6></label>
                <input type="text" style="text-align:right;" class="form-control" value="<?php echo "Php " . number_format($totPrice * .5,2); ?>" readonly/>
                <input type="hidden" id="dp" value="<?php $dp = $totPrice * .5; echo $dp;?>" readonly/>
              </div>
            </div>
          </div>
          </div>
          <div class="col-md-6">
            <div class="col-md-12"> 
              <div style="padding-left: 25px;">
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body" style="">
                    <!--<h4>Amount Due <span class="pull-right" id="sideAmountDue"> &#8369; <?php echo number_format($totPrice,2); ?>  </span></h4>-->
                    <b>Mode of Payment:</b>
                    <select class="form-control" data-placeholder="Add Payment" tabindex="1" name="mop" id="mop">
                     <?php
                     $delsql = "SELECT * FROM tblmodeofpayment;";
                     $delresult = mysqli_query($conn,$delsql);
                     while($delrow = mysqli_fetch_assoc($delresult)){
                      echo('<option value="'.$delrow['modeofpaymentID'].'">'.$delrow['modeofpaymentDesc'].'</option>');
                    }
                    ?>
                  </select>
                  <hr>
                  <input type="hidden" id="balance" value="<?php echo $bal?>">
                  <div id="cash">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="control-label">Amount Paid</label><span id="x" style="color:red"> *</span>
                          <input type="number" style="text-align:right;" id="aTendered" class="form-control" name="aTendered" value="<?php echo $totPrice * .5; ?>" required/>
                          <p id="error"></p>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div id="check">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="control-label">Check Number</label><span id="x" style="color:red"> *</span>
                          <input type="text" style="text-align:right;" id="cNum" class="form-control" name="cNumber"/>
                          <p id="cNumError"></p>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="control-label">Amount</label><span id="x" style="color:red"> *</span>
                          <input type="text" id="cAmount" style="text-align:right;" class="form-control" name="cAmount"/> 
                          <p id="cAmountError"></p>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="control-label">Remarks</label>
                          <textarea style="text-align:right;" class="form-control" name="remarks"></textarea> 
                          <p id="cAmountError"></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <button data-wizard="finish" type="submit" class="btn btn-success waves-effect pull-right" id="saveBtn"><i class="fa fa-check"></i> Save & Print</button>
        
<!--<div class="col-md-5 pull-right">
<button type="submit" class="btn btn-success waves-effect pull-right" id="addFab"><i class="fa fa-check"></i> Save & Print</button>
</div>-->
</div>
<h6><span class="pull-right" id="nextMessage"></span></h6>
</div>
</div>
</div>
</div>
</form>
</div>
</div>
</div>

<div id="customization" class="modal fade" role="dialog " aria-hidden="true" style="display: none;" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <div class="panel-heading"> Customizations </div>
      </div>
      <div class="orderconfirm">
        <div class="descriptions">
          <div class="form-body">
            <div class="row">
              <div class="col-md-12">
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">

                    <div class="row">
                      <div class="col-md-12">
                        <input type="hidden" id="isBool" name="isBool" value="new">
                        <select id="savedCustomer" style="height:40px;" class="form-control" data-placeholder="Choose Customer Name" tabindex="1" name="customer"> 
                          <option value="">Select Product</option>
                          <?php
                          foreach ($selected as $items) {
                            if(!in_array($items, $removearray)){
                              $sql = "SELECT * FROM tblproduct where productID = '$items';";
                              $result = mysqli_query($conn, $sql);
                              if($result){
                                while ($row = mysqli_fetch_assoc($result)) {
                                  $ctr++; 
                                  $pCtr++;                            
                                  echo ('<option value="'.$row['productID'].'">'.$row['productName'].'</option>');?>
                                  <?php    
                                }
                              }
                            }
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button input="theCloseBtn" type="button" class="fcbtn btn btn-warning btn-outline btn-1b wave effect" data-dismiss="modal"><i class="fa fa-arrow-left"></i> Done</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body> 

<script type="text/javascript">
(function(){
  $('#accordion').wizard({
    step: '[data-toggle="collapse"]',
    buttonsAppendTo: '.panel-collapse',
    templates: {
      buttons: function(){
        var options = this.options;
        return '<div class="panel-footer"><ul class="pager">' +
        '<li class="previous">'+
        '<a href="#'+this.id+'" data-wizard="back" role="button">'+options.buttonLabels.back+'</a>' +
        '</li>' +
        '<li class="next">'+
        '<a href="#'+this.id+'" data-wizard="next" role="button">'+options.buttonLabels.next+'</a>' +
        '' +
        '</li>'+
        '</ul></div>';
      }
    },
    onBeforeShow: function(step){
      step.$pane.collapse('show');
    },
    onBeforeHide: function(step){
      step.$pane.collapse('hide');
    },
    onFinish: function(){
      window.location.href = 'receipt.php?id='+id;
    }
  });
})();

</script>
<div id="myModal" class="modal fade" role="dialog " aria-hidden="true" style="display: none;" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <!-- Modal content-->
      <div class="modal-content clearable-content">
        <div class="modal-body">

        </div>
      </div>
    </div>
  </div>
</div>
</html>