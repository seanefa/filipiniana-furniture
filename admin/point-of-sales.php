<?php
include "menu.php";
include "titleHeader.php";
include 'dbconnect.php';
?>
<!DOCTYPE html>  
<html lang="en">
<body class ="fix-header fix-sidebar">
  <head>
    <script>
    
    var added_new_cust = false;

    $(document).ready(function(){

var value = $("#selectCat").val(); // on load
$.ajax({
  type: 'post',
  url: 'display-furnitures-pos.php',
  data: {
    id: value,
  },
  success: function (response) {
    $('#tblProd').html(response);
  }
});

$('#selectCat').on("change",function() {
  var value = $("#selectCat").val();
  if(isNaN(value)){
    $.ajax({
      type: 'post',
      url: 'display-furnitures-pos.php',
      data: {
        id: value,
      },
      success: function (response) {
        $('#tblProd').html(response);
        $("#selectType").empty();  
        $("#selectType").attr('disabled','disabled');  
      }
    });
  }
  else{
    var drop = 1;
    $.ajax({
      type: 'post',
      url: 'display-furnitures-pos.php',
      data: {
        id: value,
      },
      success: function (response) {
        $('#tblProd').html(response);
      }
    });

    $.ajax({
      type: 'post',
      url: 'load-drop-downs.php',
      data: {
        id: value, type : drop,
      },
      success: function (response) {
        $('#selectType').html(response);
        $("#selectType").removeAttr('disabled');
      }
    });
  }
});

$('#selectType').on("change",function() {
  var value = $("#selectType").val();
  $.ajax({
    type: 'post',
    url: 'display-furnitures-pos.php',
    data: {
      id: value,
    },
    success: function (response) {
      $('#tblProd').html(response); 
    }
  });
});
/*
$('#savedCustomer').on('focus', function(){
  $.ajax({
    type: 'post',
    url: 'POS-load-customer.php',
    data: {

    },
    success: function (response) {
      $('#savedCustomer').empty().append(response);
    }
  });
});
*/
//end of document
});

/*
 $('body').on('focus','.modal' function(){
$('#saveCustBtn').on('click',function(){
  


});


 }); 
*/
function addnewCust(){
  var lName = $('#edit1').val();
  var fName = $('#edit2').val();
  var mName = $('#edit3').val();
  var addrs = $('#edit4').val();
  var conts= $('#edit5').val();
  var emails = $('#edit6').val();
  
if(lName == ""){
  
  $('#edit1').css('border-color','red');
}
else{
  $('#edit1').css('border-color','limegreen');
}
if(mName == ""){
  $('#edit2').css('border-color','red');
}
else{
  $('#edit2').css('border-color','limegreen');
}
if(fName == ""){
  $('#edit3').css('border-color','red');
}
else{
  $('#edit3').css('border-color','limegreen');
}
if(addrs == ""){
  $('#edit4').css('border-color','red');
}
else{
  $('#edit4').css('border-color','limegreen');
}
if(conts == ""){
  $('#edit5').css('border-color','red');
}
else{
  $('#edit5').css('border-color','limegreen');
}
if(emails == ""){
  $('#edit6').css('border-color','red');
}
else{
  $('#edit6').css('border-color','limegreen');
}



if(lName != "" && fName != "" && mName !=  "" && addrs != "" && conts != "" && emails != ""){
  $.ajax({
    type: 'post',
    url: 'add-new-cust.php',
    data: {
      ln: lName, fn: fName, mn: mName, addr: addrs, cont: conts, email: emails, 
    },
    success: function (response){
      $('#msg').html(response);
      $('#myModal').modal('hide');
      $.ajax({
        type: 'post',
        url: 'POS-load-customer.php',
        data: {

        },
        success: function (response) {
          $('#savedCustomer').empty().append(response);
        }
      });
    }
  });
   added_new_cust = true; 
}
else if(error != 0){
  alert('Fill up the required fields');
}

 


}


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

//new customer validation
var flag = true;
function inputValidate(id){
    var user = $('#edit'+id).val();
    
    userkey = $('#edit'+id).val();
    userkey = userkey.slice(userkey.length -1 , userkey.length);

      if(userkey == '\\'){
        $('#saveCustBtn').prop('disabled',true);
      $('#message'+id).html('Symbols not Allowed');
      $('#edit'+id).css('border-color','red');
      }else{
    $.post('pos-check.php',{username : user}, function(data){
     
     if(data == 'Symbols not allowed'){
       flag = true;
          $('#saveCustBtn').prop('disabled',true);
      $('#message'+id).html(data);
      $('#edit'+id).css('border-color','red');
     }
     else if(data == 'White space not allowed'){
       flag = true

          $('#saveCustBtn').prop('disabled',true);
      $('#message'+id).html(data);
      $('#edit'+id).css('border-color','red');
     }
     else if(data == 'good'){
      flag = false;
       $('#message'+id).html('');
     $('#saveCustBtn').prop('disabled',false);
      $('#edit'+id).css('border-color','limegreen');
     }
    });
  }

  if(!flag){
    $('#saveCustBtn').prop('disabled',false);
  }else if(flag){
    $('#saveCustBtn').prop('disabled',true);
  }

  }

  function validate(id){
    var val = $('#edit'+id).val();
    if(validateEmail(val)){
      $('#edit'+id).css('border-color','limegreen');
       $('#message'+id).html(''); 
    $('#saveCustBtn').prop('disabled',false);
    }else{
       $('#edit'+id).css('border-color','red');
       $('#message'+id).html('Email not valid'); 
    $('#saveCustBtn').prop('disabled',true);
    }

  }

  function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
} 

//
</script>
</head>

<!-- Preloader -->
<div id="page-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8">
        <div class="row">
          <div class="panel panel-info">
            <!-- nav start -->
            <h3>
              <ul class="nav customtab2 nav-tabs" role="tablist">
                <li role="presentation" class="active">
                  <a aria-controls="ordermanagement.php" role="tab" aria-expanded="false" href="point-of-sales.php"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs"></span><i  class="ti-shopping-cart-full"></i> <?php echo $titlePage?></a>
                </li>
              </ul>
            </h3>

            <div class="tab-content">
              <!-- CATEGORY -->
              <div role="tabpanel" class="tab-pane fade active in" id="type">
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">
                    <div class="col-md-12">
                      <div class="tab-content">
                        <!-- brochure -->
                        <div role="tabpanel" class="tab-pane fade active in" id="allprod">
                          <div class="panel-wrapper collapse in" aria-expanded="true">
                            <div class="panel-body">  
                              <div class="row" style="margin: 0 auto; margin-top: -100px;">
                                <button type="button" href="#myCart" data-toggle="modal" class="fcbtn btn-lg btn-info btn-outline btn-1e wave effect"><i class="fa fa fa-shopping-cart"></i> MY CART <span class="badge" id="totalBadge"></span></button>
                              </div>
                              <div class="row">
                                <div style="margin: 0 auto;">
                                  <input type="text" id="my-input-field" class="form-control navbar-form navbar-right" placeholder="&#128269; Search..." size="30" style="margin-top: -40px;">
                                </div>
                              </div>

                              <div class="row">

                                <div class="categories">
                                  <ul class="nav customtab2 nav-tabs col-md-12" role="tablist" id="myTab" style="margin-bottom: 20px;">

                                    <div class="col-md-6" style="padding: 0px 20px;">
                                      <div class="row">
                                        <label class="control-label">CATEGORY</label>
                                        <select id="selectCat" style="height:40px;" class="form-control" data-placeholder="Choose Category" tabindex="1" name="selectCat">
                                          <option value="On-Hand">All On-Hand Furnitures</option>
                                          <?php
                                          include 'ew.php';
                                          $delsql = "SELECT * FROM tblfurn_category ORDER BY categoryName ASC;";
                                          $delresult = mysqli_query($conn,$delsql);
                                          while($delrow = mysqli_fetch_assoc($delresult)){
                                            if($delrow['categoryStatus']!="Archived"){
                                              echo('<option value="'.$delrow['categoryID'].'">'.$delrow['categoryName'].'</option>');
                                            }
                                          }
                                          ?>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="col-md-6" style="padding: 0px 20px;">
                                      <div class="row">
                                        <label class="control-label">TYPE</label>
                                        <select id="selectType" style="height:40px;" class="form-control" data-placeholder="Choose Category" tabindex="1" name="selectType" disabled>

                                        </select>
                                      </div>
                                    </div>
                                  </ul>
                                </div>
                                <!-- categories -->
                              </div>

                              <div class="row" id="allprod">


                                <div class="row formScroll" id="tblProd">

                                </div>
                              </div>

                              <div id="myModal1" class="modal fade" role="dialog " aria-hidden="true" style="display: none;" tabindex="-1">
                                <div class="modal-dialog modal-lg">
                                  <div class="modal-content">
                                    <!-- Modal content -->
                                    <div class="modal-content">
                                      <div class="modal-body">
                                        <h2 style="text-align:center;"> Successfully added to cart!<br>
                                        </h2>
                                        <div class="orderconfirm">
                                          <div class="descriptions">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="modal-footer">
                                        <button input="theCloseBtn" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>



                              <div id="myProduct" class="modal fade" role="dialog " aria-hidden="true" style="display: none;" tabindex="-1">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <!-- Modal content -->
                                    <div class="modal-content">
                                      <div class="modal-body">
                                      </div>
                                      <div class="modal-footer">
                                        <button input="theCloseBtn" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>

                            </div> <!-- panel body -->
                          </div> <!-- panel wrapper -->
                        </div> <!-- tab panel -->
                      </div> <!-- tab-content -->
                    </div> <!-- col inside -->

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>


      </div> <form id="myForm" method="post">
      <div id="thisIsCart" style="display: none">
      </div>

      <div class="col-md-4">
        <form id="myForm" method="post">
          <div id="thisIsCart">
          </div>
          <div id="myCart" class="modal fade" role="dialog " aria-hidden="true" style="display: none;" tabindex="-1">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <div class="panel-heading"> My Cart </div>
                </div>
                <div class="orderconfirm">
                  <div class="descriptions">
                    <div class="form-body">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="panel-wrapper collapse in" aria-expanded="true">
                            <div class="panel-body">
                              <div class="table-responsive">
                                <table class="table product-overview" id="cartTbl">
                                  <thead>
                                    <tr>
                                      <!--th>Image</th-->
                                      <th>Furniture Name</th>
                                      <th>Furniture Description</th>
                                      <th>Quantity</th>
                                      <th>Total Price</th>
                                      <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <!--td width="150"><img src="../plugins/images/chair.jpg" alt="No Image Available" width="80"></td-->
                                    </tr>
                                  </tbody>
                                  <tfoot>
                                    <td colspan="2" style="text-align:right"> GRAND TOTAL </td>
                                    <td id="totalQ">0</td>
                                    <td id="totalPrice">0</td>
                                    <td></td>
                                  </tfoot>
                                </table>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button input="theCloseBtn" type="button" class="fcbtn btn btn-warning btn-outline btn-1b wave effect" data-dismiss="modal"><i class="fa fa-arrow-left"></i> Continue Shopping</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="panel panel-info" style="margin-top: -20px;">
            <div class="tab-content thumbnail">
              <!-- CATEGORY -->
              <div role="tabpanel" class="tab-pane fade active in" id="job">
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">
                    <div id="hidebuttoncustomer">
                      <div class="row">
                        <div class="col-md-6">
                         <h4>Customer Information</h4>
                       </div>
                       <div class="col-md-6">
                        <button type="button" class="btn btn-info" data-toggle="modal" href="point-of-sales-form.php" data-remote="point-of-sales-form.php #newCustomer" data-target="#myModal" id="newCust"><i class="ti-user"></i> New</button>
                      </div> 
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-md-12">
                     <input type="hidden" name="customerIds" id="customerIds">
                     <select id="savedCustomer" style="height:40px;" class="form-control" data-placeholder="Choose Customer Name" tabindex="1" name="customer">
                      <option value="">Select a Customer</option>
                      <?php
                      include 'dbconnect.php';
                      $sql = "SELECT * FROM tblcustomer ORDER BY customerFirstName;";
                      $result = mysqli_query($conn, $sql);
                      while ($row = mysqli_fetch_assoc($result))
                      {
                        if($row['customerStatus'] != "Archived"){
                          if($row['customerLastName'] != ""){
                            echo('<option value='.$row['customerID'].'>'.$row['customerFirstName'].' '.$row['customerMiddleName'].' '.$row['customerLastName'].'</option>
                              ');
                          }
                        }
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <?php
                $sql = "SELECT * FROM tblcustomer ORDER BY customerLastName ASC;";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result))
                {
                  if($row['customerStatus'] != "Archived"){
                    if($row['customerLastName'] != ""){
                      echo ('
                        <input type="hidden" id="ln'.$row['customerID'].'" class="form-control" value=""/>
                        <input type="hidden" id="fn'.$row['customerID'].'" class="form-control" value=""/>
                        <input type="hidden" id="mn'.$row['customerID'].'" class="form-control" value=""/>

                        <input type="hidden" id="caddr'.$row['customerID'].'" class="form-control" value=""/>
                        <input type="hidden" id="ccont'.$row['customerID'].'" class="form-control" value=""/>
                        <input type="hidden" id="cemail'.$row['customerID'].'" class="form-control" value=""/>
                        ');
                    }
                  }
                }
                ?>


                <input type="hidden" id="putFname" class="form-control" name="firstn" value=""/>
                <input type="hidden" id="putMname" class="form-control" name="midn" value=""/>
                <input type="hidden" id="putLname" class="form-control" name="lastn" value=""/>

                <input type="hidden" id="putAddr" class="form-control" name="custAdd" value=""/>
                <input type="hidden" id="putContact" class="form-control" name="custocont" value=""/>
                <input type="hidden" id="putEmail" class="form-control" name="custoemail" value=""/>


              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="panel panel-info" style="margin-top: -15px;">
        <div class="tab-content thumbnail">
          <!-- CATEGORY -->
          <div role="tabpanel" class="tab-pane fade active in" id="job">
            <div class="panel-wrapper collapse in" aria-expanded="true">
              <div class="panel-body">
                <div class="row" style="background-color: #FCF8E3;">
                  <h4>Items In Cart:<span class="pull-right" id="sideItemsInCart"></span></h4>
                </div>
                <hr>
                <!--<div class="row" style="background-color: #FCF8E3;">
                  <h4>Sub-Total: &#8369; <span class="pull-right" id="sideSubtotal"></span></h4>
                </div>-->
                <div class="row" style="background-color: #DFF0D8;">
                  <h4 style="color: #335E05; font-weight: bold;">Sub-Total: &#8369; <span class="pull-right" id="sideTotal"></span></h4>
                </div>
                <hr>
              </div>
            </div>
          </div>
        </div>
      </div>




      <div class="panel panel-info" style="margin-top: -15px;">
        <div class="tab-content thumbnail">
          <!-- CATEGORY -->
          <div role="tabpanel" class="tab-pane fade active in" id="job">
            <div class="panel-wrapper collapse in" aria-expanded="true">
              <div class="panel-body">
                <div class="descriptions">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group"><h4><b>For:</b> 
                        <label class="radio-inline"><input type="radio" id="ratePick" name="type" value="Pick-up"/> Pick-up</label>
                        <label class="radio-inline"><input type="radio" id="rateDel" name="type" value="Delivery"/> Delivery</label></h4>
                      </div>
                    </div>
                  </div>

                  <div class="deliveryDetails" id="deliveryDetails" style="display: none;">
                    <label class="control-label">Delivery Address</label><span id="x" style="color:red"> *</span>
                    <div class="row">
                          <div class="col-md-6">
                            <input type="text" id="da" class="form-control" name="deladd[]" placeholder="#1528 Kagawad Street" disabled required/>
                          </div>
                          <div class="col-md-6">
                            <input type="text" id="city" class="form-control" name="deladd[]" placeholder="Brgy.Batasan Hills" disabled required/>
                          </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-12">
                          <input type="text" id="zip" class="form-control" name="deladd[]" placeholder="Quezon City" disabled required/>
                      </div>
                    </div>
<br>
                    <div class="row">
                      <div class="col-md-8">
                        <div class="form-group">
                          <label class="control-label">Delivery Location: </label>
                          <select id="delloc" style="height:40px;" class="form-control" data-placeholder="Choose Delivery Location" tabindex="1" name="delloc" disabled>
                            <option value="">Choose a Location</option>
                            <?php
                            include "dbconnect.php";
                            $delsql = "SELECT * FROM tbldelivery_rates ORDER BY delLocation;";
                            $delresult = mysqli_query($conn,$delsql);
                            while($delrow = mysqli_fetch_assoc($delresult)){
                              echo('<option value="'.$delrow['delRate'].'">'.$delrow['delLocation'].'</option>');
                            }
                            ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label">Delivery Rate</label>
                          <input type="number" style="text-align:right;" id="dRate" class="form-control" name="ln" value='0' readonly/>
                        </div>
                      </div>
                    </div>
                  </div>
                </div> <!--Delivery Details-->
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="panel panel-info" style="margin-top: -15px;">
        <div class="tab-content thumbnail">
          <div role="tabpanel" class="tab-pane fade active in" id="job">
            <div class="panel-wrapper collapse in" aria-expanded="true">
              <div class="panel-body">
                <h4>Amount Due: &#8369;<span class="pull-right" id="sideAmountDue"></span></h4>
                <hr><b>Mode of Payment:</b>
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
                      <input type="text" style="text-align:right;" id="aTendered" class="form-control" name="aTendered" value=""/>
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

      <div class="panel panel-info" style="margin-top: -15px;">
        <div class="tab-content thumbnail">
          <div role="tabpanel" class="tab-pane fade active in" id="job">
            <div class="panel-wrapper collapse in" aria-expanded="true">
              <div class="panel-body">
                <div class="row">
                  <div class="row">
                    <div class="col-md-5 pull-right">
                      <button class="btn btn-success waves-effect pull-right" id="submitBtn" onclick="checkout()"><i class="ti-check"></i> Save & Print</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>


    </div>



    <div id="myModal" class="modal fade" role="dialog " aria-hidden="true" style="display: none;" tabindex="-1">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <!-- Modal content -->
          <div class="modal-content clearable-content">
            <div class="modal-body">

            </div>
          </div>
        </div>
      </div>
    </div>


    <script>
    $(document).ready(function () {
      $('#my-input-field').instaFilta();
    });
    </script>

    <script type="text/javascript">
                    //global variables
                    var prv_id = 0;
                    var idArray = [];
                    var qCtr = 0;
                    var totalQuant = 0;
                    var tempPrice = 0;
                    var xTotal;

                    function deleteRow(row){
                      var qunatityy = parseInt($('#quants'+row.value).val());
                      var x = totalQuant - parseInt($('#quants'+row.value).val());
                      var y = tempPrice - parseInt($('#prices'+row.value).val());
                      var result;

                      result = parseInt(prompt('Remove how many products?'));
                      if(result == null || isNaN(result) || result > qunatityy ||  result == 0 || result < 0) {
                        if(result > qunatityy){
                          alert('Input must be less than '+qunatityy);
                        }
                        else if(result == 0){
                          alert(result);
                          alert('Input number');
                        }
                        else if(isNaN(result)){
                          alert('Input number');
                        }
                        else if(result < 0){
                          alert('Input positive number');

                        }
                        return;
                      }

                      else{
                        if(qunatityy != 0){
                          var remover = qunatityy;
                          var a = parseInt($('#prices'+row.value).val());
                          var b = parseInt($('#quants'+row.value).val());

                          var totalP= $('#totalPrice').html();
                      totalP=totalP.replace(/\,/g,''); //deletes comma
                      totalP=parseInt(totalP,10);

                      var totalQ= $('#totalQ').html();
                      totalQ=totalQ.replace(/\,/g,''); //deletes comma
                      totalQ=parseInt(totalQ,10);
                      
                      var realPrice =  a / b;
                      //quantity
                      $('#quants'+row.value).val(0);
                      remover = remover - result;
                      $('#quants'+row.value).val(qunatityy - result);
                      $('#qt'+row.value+'').html($('#quants'+row.value).val());
                      var newQuantt = $('#quants'+row.value).val();
                      //price
                      $('#prices'+row.value).val(0);
                      $('#prices'+row.value).val(realPrice * newQuantt);
                      $('#pr'+row.value+'').html($('#prices'+row.value).val());



                      //total
                      $('#ttp').val(totalP - (realPrice * result));
                      $('#ttq').val(totalQ - result);

                      $('#totalPrice').html(String(totalP - (realPrice * result) ));
                      $('#totalQ').html(String(totalQ - result));
                      $('#totalBadge').html(String(totalQ - result));


                      $('#sideItemsInCart').html(
                        ''+String(totalQ - result)+'');
                      $('#sideSubtotal').html(
                        '<span class="pull-right" id="sideSubtotal">'+String(totalP - (realPrice * result) )+'</span>');

                      $('#sideTotal').html(
                        '<span class="pull-right" id="sideTotal">'+String(totalP - (realPrice * result) )+'</span>');

                      $('#sideAmountDue').html(
                        '<span class="pull-right" id="sideAmountDue">'+String(totalP - (realPrice * result) )+'</span>');
                      
                      $('#aTendered').prop('disabled',false);
                      xTotal = parseInt($('#totalPrice').html());
                      Math.round($('#aTendered').val( xTotal));
                      Math.round($('#dChange').val(xTotal - $('#aTendered').val()));

                      //if quantity is zero delete row
                      if(remover == 0){
                       var t = idArray.indexOf(row.value);
                       idArray.splice(t,1);


                       $('#totalQ').html(String(x));
                       $('#totalPrice').html(String(y));
                       qCtr--;
                       var i=row.parentNode.parentNode.rowIndex;
                       $('#thisIsCart').append('<input type="hidden" name="removed[]" value="'+$('#id'+row.value).val()+'">');
                       $('#thisIsCart').append('<input type="hidden" name="priceremoved[]" value="'+$('#prices'+row.value).val()+'">');
                       $('#thisIsCart').append('<input type="hidden" name="quantremoved[]" value="'+$('#quants'+row.value).val()+'">');
                       document.getElementById('cartTbl').deleteRow(i);

                     }

                   }
                   else if(qunatityy == 0){
                    var t = idArray.indexOf(row.value);
                    idArray.splice(t,1);
                    

                    $('#totalQ').html(String(x));
                    $('#totalPrice').html(String(y));
                    qCtr--;
                    var i=row.parentNode.parentNode.rowIndex;
                    
                    $('#thisIsCart').append('<input type="hidden" name="removed[]" value="'+$('#id'+row.value).val()+'">');
                    $('#thisIsCart').append('<input type="hidden" name="priceremoved[]" value="'+$('#prices'+row.value).val()+'">');
                    $('#thisIsCart').append('<input type="hidden" name="quantremoved[]" value="'+$('#quants'+row.value).val()+'">');
                    document.getElementById('cartTbl').deleteRow(i);

                    

                  }
                }




              }
                 ////////             ADD OF PRODUCTS TO CART ///////////////
                 function addRow(row){
                  var qunatityy = parseInt($('#quants'+row.value).val());
                  var x = totalQuant - parseInt($('#quants'+row.value).val());
                  var y = tempPrice - parseInt($('#prices'+row.value).val());
                  var result;

                  result = parseInt(prompt('Add how many products?'));
                  if(result == null || isNaN(result) ||  result == 0 || result < 0) {

                    if(result == 0){
                      alert('Input a number');
                    }
                    else if(isNaN(result)){
                      alert('Input a number');
                    }

                    else if(result < 0){
                      alert('Input positive number');

                    }
                    return;
                  }
                  else{
                    if(qunatityy != 0){
                      var remover = qunatityy;
                      var a = parseInt($('#prices'+row.value).val());
                      var b = parseInt($('#quants'+row.value).val());

                      var totalP= $('#totalPrice').html();
                      totalP=totalP.replace(/\,/g,''); //deletes comma
                      totalP=parseInt(totalP,10);

                      var totalQ= $('#totalQ').html();
                      totalQ=totalQ.replace(/\,/g,''); //deletes comma
                      totalQ=parseInt(totalQ,10);
                      
                      var realPrice =  a / b;
                      //quantity
                      remover = remover + result;
                      $('#quants'+row.value).val(qunatityy + result);
                      $('#qt'+row.value+'').html($('#quants'+row.value).val());
                      var newQuantt = $('#quants'+row.value).val();
                      //price
                      $('#prices'+row.value).val(0);
                      $('#prices'+row.value).val(realPrice * newQuantt);
                      $('#pr'+row.value+'').html($('#prices'+row.value).val());



                      //total
                      $('#ttp').val(totalP + (realPrice * result));
                      $('#ttq').val(totalQ + result);

                      $('#totalPrice').html(String(totalP + (realPrice * result) ));
                      $('#totalQ').html(String(totalQ + result));
                      $('#totalBadge').html(String(totalQ + result));
                      $('#sideItemsInCart').html(
                        ''+String(totalQ + result)+'');
                      $('#sideSubtotal').html(
                        '<span class="pull-right" id="sideSubtotal">'+String(totalP + (realPrice * result) )+'</span>');

                      $('#sideTotal').html(
                        '<span class="pull-right" id="sideTotal">'+String(totalP + (realPrice * result) )+'</span>');

                      $('#sideAmountDue').html(
                        '<span class="pull-right" id="sideAmountDue">'+String(totalP + (realPrice * result) )+'</span>');
                      $('#aTendered').prop('disabled',false);
                      xTotal = parseInt($('#totalPrice').html());
                      Math.round($('#aTendered').val( xTotal));
                      Math.round($('#dChange').val(xTotal - $('#aTendered').val()));
                      
                    }
                  }



                  
                }

                function isInArray(value, array) {
                  return array.indexOf(value) > -1;
                }

                function btnClick(id){
                 tempPrice = parseInt($('#totalPrice').text().slice());
                 var quant =parseInt($('#quant'+id).val());


                 totalQuant = parseInt($('#totalQ').text());
                 var tP = $('#price'+id).val().toString();
                 var price =parseInt(tP.replace(',',''));
                 price = price * quant;
                 tempPrice = tempPrice+price;
                 totalQuant = totalQuant+quant;
                 xTotal = tempPrice;


                 if(isInArray(id,idArray)){

                  if(quant > 0){
                    $('#quant'+id).val(0);
                    $('#'+id).attr('data-toggle','modal');
                    $('#'+id).attr('href','#myModal1');

                    //price parser
                    var priced= $('#prices'+id+'').val();
                  priced=priced.replace(/\,/g,''); //deletes comma
                  priced=parseInt(priced,10);

                  var tPriced= tP;
                  tPriced=tPriced.replace(/\,/g,''); //deletes comma
                  tPriced=parseInt(tPriced,10);
                  
                  //quantity parser
                  var quantd= $('#quants'+id+'').val();
                  quantd=quantd.replace(/\,/g,''); //deletes comma
                  quantd=parseInt(quantd,10);

                  var q = parseInt(quant);

                  //total price parser

                  var totalP= $('#totalPrice').html();
                  totalP=totalP.replace(/\,/g,''); //deletes comma
                  totalP=parseInt(totalP,10);

                  var totalQ= $('#totalQ').html();
                  totalQ=totalQ.replace(/\,/g,''); //deletes comma
                  totalQ=parseInt(totalQ,10);

                  var newPrice = priced + tPriced;
                  var newQuant = quantd + q;

                  $('#quants'+id+'').val(newQuant);
                  $('#qt'+id+'').html(''+newQuant);

                  $('#prices'+id+'').val(newPrice);
                  $('#pr'+id+'').html(''+newPrice);

                  $('#ttq').val(0);
                  $('#ttp').val(0); 
                  $('#ttp').val(totalP + tPriced);
                  $('#ttq').val(totalQ + q);

                  $('#totalPrice').html(String(totalP + tPriced));
                  $('#totalQ').html(String(totalQ + q));

                  $('#sideItemsInCart').html(
                    ''+totalQuant+'');
                  $('#sideSubtotal').html(
                    '<span class="pull-right" id="sideSubtotal">'+tempPrice+'</span>');

                  $('#sideTotal').html(
                    '<span class="pull-right" id="sideTotal">'+tempPrice+'</span>');

                  $('#sideAmountDue').html(
                    '<span class="pull-right" id="sideAmountDue">'+tempPrice+'</span>');

                  $('#aTendered').prop('disabled',false);
                  Math.round($('#aTendered').val( xTotal));
                  Math.round($('#dChange').val(xTotal - $('#aTendered').val()));

                }
                else{
                  alert('Please input quantity');
                  $('#'+id).attr('data-toggle','');
                  $('#'+id).attr('href','');
                }
                
              }
              else{

                if(quant > 0){
                 prv_id = id;
                 qCtr++;
                 var name = $('#product'+id).val();
                 var size =$('#size'+id).val();
                 $('#'+id).attr('data-toggle','modal');
                 $('#'+id).attr('href','#myModal1');
                 $('#quant'+id).val(0);
                  //push id to array
                  idArray.push(id);

                  $('#thisIsCart').append('<input type="hidden" name="priceremoved[]" value=""><input type="hidden" name="quantremoved[]" value=""><input type="hidden" name="removed[]" value=""><input type="hidden" id="id'+id+'" name="Pcart[]" value="'+id+'"/><input type="hidden" name="Pquant[]" id="quants'+id+'" value="'+quant+'"/><input type="hidden" name="Pprice[]" id="prices'+id+'" value="'+price+'"/><input type="hidden" id="ttp" name="PtotalPrice" value="'+tempPrice+'"/> <input type="hidden" name="totalQuant" id="ttq" value="'+totalQuant+'" />');
                  $('#cartTbl').append(
                    '<tr><td><h5 class="font-500">'+name+'</h5></td><td>'+size+'</td><td width="70" id="qt'+id+'">'+quant+'</td><td id="pr'+id+'"class="font-500">'+price+'</td><td><button type="button" class="btn btn-success" onclick="addRow(this)" value="'+id+'" style="margin:5px;">+</button><button type="button" class="btn btn-danger" onclick="deleteRow(this)" value="'+id+'">x</button></td></tr>');



                  $('#totalPrice').html(String(tempPrice));
                  $('#totalQ').html(String(totalQuant));
                  $('#totalBadge').html(String(totalQuant));
                  $('#sideItemsInCart').html(
                    ''+totalQuant+'');

                  $('#sideSubtotal').html(
                    '<span class="pull-right" id="sideSubtotal">'+tempPrice+'</span>');

                  $('#sideTotal').html(
                    '<span class="pull-right" id="sideTotal">'+tempPrice+'</span>');

                  $('#sideAmountDue').html(
                    '<span class="pull-right" id="sideAmountDue">'+tempPrice+'</span>');
                  $('#aTendered').prop('disabled',false);
                  Math.round($('#aTendered').val( xTotal));
                  Math.round($('#dChange').val(xTotal - $('#aTendered').val()));
                }
                else if(quant == 0){
                  alert('please input the quantity');
                  $('#'+id).attr('data-toggle','');
                  $('#'+id).attr('href','');
                }
              }
            }


            $(document).ready(function(){
              var x,y;

              $('#ratePick').click(function(){ 

                if($('#ratePick').is(':checked')){ 
                  $('#da').prop('disabled',true);
                  $('#city').prop('disabled',true);
                  $('#state').prop('disabled',true);
                  $('#zip').prop('disabled',true);
                  $('#delloc').prop('disabled',true);
                  $('#da').val('');
                  $('#city').val('');
                  $('#state').val('');
                  $('#zip').val('');
                  $('#delloc').val('');

                  $('#dRate').val(0);

                  if($('#aTendered').val() < (x)){
                   Math.round($('#aTendered').val( (x)+d));
                 }
                 else if($('#aTendered').val() >= (x)){
                  var e = parseInt($('#aTendered').val());
                  Math.round($('#dChange').val((x-$('#aTendered').val())+d));
                }
              }

            });
              $('#rateDel').click(function(){
                if($('#rateDel').is(':checked')){ 
                  $('#dRate').val(0);
                  $('#da').prop('disabled',false);
                  $('#city').prop('disabled',false);
                  $('#state').prop('disabled',false);
                  $('#zip').prop('disabled',false);
                  $('#delloc').prop('disabled',false);
                  $('#da').val('');
                  $('#city').val('');
                  $('#state').val('');
                  $('#zip').val('');
                  $('#delloc').val('');

                  if($('#aTendered').val() < (x)){
                   Math.round($('#aTendered').val( (x)+d));
                 }
                 else if($('#aTendered').val() >= (x)){
                  var e = parseInt($('#aTendered').val());
                  Math.round($('#aTendered').val((x-$('#aTendered').val())+d));
                }
              }
            });



              $('#delloc').change(function(){
                var y =  parseInt($('#aTendered').val());
                Math.round($('#aTendered').val( xTotal));
                $('#dRate').val(parseInt($('#delloc').val()));
                var d = parseInt($('#dRate').val());

                if($('#aTendered').val() < (xTotal)){
                 Math.round($('#aTendered').val( (xTotal)+d));
                 Math.round($('#dChange').val($('#aTendered').val( (x)+d)));
               }
               else if($('#aTendered').val() >= (xTotal / 2)){
                var e = parseInt($('#aTendered').val());
                Math.round($('#aTendered').val((xTotal-$('#aTendered').val())+d));
              }
            });
            });

$(document).ready(function(){
  var y =  parseInt($('#aTendered').val());

  var d = parseInt($('#dRate').val());
  if($('#aTendered').val() < (xTotal)){
   Math.round($('#aTendered').val( (xTotal))+d);
 }
 else if($('#aTendered').val() >= (xTotal)){
  var e = parseInt($('#aTendered').val());
  Math.round($('#dChange').val((xTotal-$('#aTendered').val())+d));
}
/*
$('#aTendered').keyup(function(){

  if($('#aTendered').val() < (xTotal / 2)){
   Math.round($('#aTendered').val( (xTotal / 2)+d));
 }
 else if($('#aTendered').val() >= (xTotal / 2)){
  var e = parseInt($('#aTendered').val());
  Math.round($('#dChange').val((xTotal-$('#aTendered').val())+d));
}
});
*/
});
function checkout(){
  var cust = document.getElementById('savedCustomer');
  if(qCtr== 0){
    alert("Cart is Empty.");
  }
  else if(qCtr > 0){
    if(cust.options[cust.selectedIndex].value !=""){
     $('#submitBtn').attr('type','submit');
     $('#myForm').attr('action','add-custPOS.php');
   }
   else{
    alert('Please select a customer');
  }
}
}


</script>
<script type="text/javascript">
/*
$(document).ready(function(){

  $('#savedCustomer').change(function(){
    var id = $(this).val();
    var cust = document.getElementById('savedCustomer');
    if(id == 0){
      id=+1;
    }
    if(cust.options[cust.selectedIndex].value !=""){
     $('#isBool').attr('value','changed');
     $('#customerIds').attr('value',id);
     $('#hidebuttoncustomer').hide();
     $('#putFname').attr('value',$('#fn'+id+'').val());
     $('#putLname').attr('value',$('#ln'+id+'').val());
     $('#putMname').attr('value',$('#mn'+id+'').val());
     $('#putAddr').attr('value',$('#caddr'+id+'').val());
     $('#putEmail').attr('value',$('#cemail'+id+'').val());
     $('#putContact').attr('value',$('#ccont'+id+'').val());
   }
   else{
    $('#customerIds').attr('value',id+1);
    $('#hidebuttoncustomer').show();
    $('#isBool').attr('value','not change');
    $('#ln').attr('value',"");
    $('#fn').attr('value',"");
    $('#mn').attr('value',"");
  }
});
});*/


$(document).ready(function(){

  $('#rateDel').on('change', function(){
    $('#deliveryDetails').show();
  });

  $('#ratePick').on('change',function(){
    $('#deliveryDetails').hide();
    $('#da').val(" ");
    $('#city').val(" ");
    $('#zip').val(" ");
  });

});
</script>

<script>
$(document).on('hidden.bs.modal', function (e) {
  var target = $(e.target);
  target.removeData('bs.modal')
  .find(".clearable-content").html('');
});
</script>
<script>
$(document).on('hidden.bs.modal', function (e) {
  var target = $(e.target);
  target.removeData('bs.modal')
  .find(".clearable-content").html('');
});
</script>
<!-- Editable -->
<script src="../plugins/bower_components/jquery-datatables-editable/jquery.dataTables.js"></script>
<script src="../plugins/bower_components/datatables/dataTables.bootstrap.js"></script>
<script src="../plugins/bower_components/tiny-editable/mindmup-editabletable.js"></script>
<script src="../plugins/bower_components/tiny-editable/numeric-input-example.js"></script>
<script>
$('#mainTable').editableTableWidget().numericInputExample().find('td:first').focus();
$('#editable-datatable').editableTableWidget().numericInputExample().find('td:first').focus();
$(document).ready(function(){
  $('#editable-datatable').DataTable();
});
</script>

<script>
$(document).ready(function () {
  $('.formScroll').slimScroll({
    height: '832px',
    size: '8px',
    wheelStep: 3,
    railVisible: true
  });
});
</script>

</div>
</div>
</div>
</body> 
</html>