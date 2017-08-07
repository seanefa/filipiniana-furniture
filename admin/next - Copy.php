<?php
$activePage = basename($_SERVER['PHP_SELF'],".php");
include "menu.php";
//session_start();
/*
if(isset($_GET['customerId'])){
$jsID = $_GET['customId']; 
}*/
//$_SESSION['varname'] = 3;
include 'dbconnect.php';
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>
<!DOCTYPE html>  
<html lang="en">
<head>
  <title>Order Management</title>
  <link rel="icon" type="image/x-icon" sizes="16x16" href="plugins/images/favicon.ico">
</head>
<body class ="fix-header fix-sidebar">
  <!-- Preloader -->
  <div id="page-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
          <div class="panel panel-info">
            <h3>
              <ul class="nav customtab2 nav-tabs" role="tablist">
                <li role="presentation" class="active">
                  <a aria-controls="proorders" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs">Order Management</span></a>
                </li>
              </ul>
            </h3>
            <!-- brochure -->
            <div class="panel-body">
              <div class="orderconfirm">
                <form action="add-customer.php" method = "post">

                  <div class="row">
                    <div class="descriptions">
                      <div class="form-body">
                        <h2>Customer Information:</h2>
                        <div class="row">
                          <div class="col-md-4">
                            <input type="hidden" id="isBool" name="isBool" value="new">
                            Existing Customer Information? 
                            <select id="savedCustomer" style="height:40px;" class="form-control" data-placeholder="Choose Customer Name" tabindex="1" name="customer"> 
                              <option value="">Choose a Customer</option>
                              <?php
                              $sql = "SELECT * FROM tblcustomer;";
                              $result = mysqli_query($conn, $sql);
                              while ($row = mysqli_fetch_assoc($result))
                              {
                                if($row['customerStatus'] != "Archived"){
                                  echo('<option value='.$row['customerID'].'>'.$row['customerLastName'].', '.$row['customerFirstName'].', '.$row['customerMiddleName'].'</option>
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
                          $(document).ready(function(){ //customer
                            $('#thisBtnSucks').removeAttr('href');
                            $('#savedCustomer').change(function(){
                              var id = $('#savedCustomer').val();
                              alert(id);

                              if(id==""){
                                $('#customerIds').attr('value',"");
                                $('#submitBtn').attr('type',"submit");
                                $('#isBool').attr('value','new');
                                $('#submitBtn').attr('onclick',"");
                                $('#ln').attr('value',"");
                                $('#ln').attr('readonly',false);
                                $('#fn').attr('value',"");
                                $('#fn').attr('readonly',false);
                                $('#mn').attr('value',"");
                                $('#mn').attr('readonly',false);
                                $('#custadd').attr('value',"");
                                $('#custadd').attr('readonly',false);
                                $('#custcont').attr('value',"");
                                $('#custcont').attr('readonly',false);
                                $('#custemail').attr('value',"");
                                $('#custemail').attr('readonly',false);
                              }

                              else{

                                $('#isBool').attr('value','existing');
                                $('#submitBtn').attr('type',"button");
                                $('#submitBtn').attr('onclick',"location.href='next1.php';");

                                $('#customerIds').attr('value',id);
                                $('#ln').attr('value',$('#lstName'+id+'').val());
                                $('#ln').html($('#lstName'+id+'').val());
                                $('#ln').attr('readonly',true);
                                $('#fn').attr('value',$('#firstName'+id+'').val());
                                $('#fn').attr('readonly',true);
                                $('#mn').attr('value',$('#midName'+id+'').val());
                                $('#mn').attr('readonly',true);
                                $('#custadd').attr('value',$('#address'+id+'').val());
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
      <input type="hidden" name="customerIds" id="customerIds">
      <label class="control-label">Last Name:</label><span id="x" style="color:red"> *</span>
      <input type="text" id="ln" class="form-control" name="lastn" value="" required/>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label class="control-label">First Name:</label><span id="x" style="color:red"> *</span>
      <input type="text" id="fn" class="form-control" name="firstn" required/> 
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label class="control-label">Middle Name:</label>
      <input type="text" id="mn" class="form-control" name="midn"/> 
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="form-group">
      <label class="control-label">Address</label><span id="x" style="color:red"> *</span>
      <textarea id="custadd" class="form-control" name="custoadd" required ></textarea>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="form-group">
      <label class="control-label">Contact number</label><span id="x" style="color:red"> *</span>
      <input type="number" id="custcont" class="form-control" name="custocont" required/>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label class="control-label">Email</label><span id="x" style="color:red"> *</span>
      <input type="email" id="custemail" class="form-control" name="custoemail" required/> 
    </div>
  </div>
</div>
</div>
</div>
</div>

<div class="row">
  <div class="descriptions">
    <h2>Order Information:</h2>
    <div class="col-md-12">
      <div class="table-responsive" style="clear: both;">
        <table class="table table-bordered display nowrap" id="tblPackages">
          <thead>
            <tr>
              <h4>
                <th>Furniture Name</th>
                <th style="text-align: center;">Furniture Description</th>
                <th style="text-align: center;">Unit Price</th>
                <th style="text-align: center;">Quantity</th>
                <th style="text-align: center;">Total Price</th></h4>
              </tr>
            </thead>
            <tbody>

              <?php 
              $removed = $_POST['removed'];
              $priceremoved = $_POST['priceremoved'];
              $quantremoved = $_POST['quantremoved'];
              $selected = $_POST['cart'];
              $selectedQuant = $_POST['quant'];
              $selectedPrice = $_POST['price'];
              $tempPrice = 0;
              $tempQuant = 0;

              $totPrice = $_POST['totalPrice'];
              $totQuant = $_POST['totalQuant'];

              $ctr = 0;
              $pCtr = 0;
              $quantarray = array();
              $pricearray = array();
              $removearray = array();
              $priceremovearray = array();
              $quantremovearray = array();

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
                        <td style="text-align: center;">'.$row['prodSizeSpecs'].'</td><td style="text-align: center;">'.$quantarray[$ctr-1].'<input id="quant'.$ctr.'" name="quant[]" value="'.$quantarray[$ctr-1].'" type="hidden"/></td>
                        <td id="price'.$ctr.'"  style="text-align: center;">&#8369;'.number_format($pricearray[$pCtr-1],2).'<input id="price'.$ctr.'" name="prices[]" value="'.$pricearray[$pCtr-1].'" type="hidden"/></td></tr>');?>
                      <?php    
                    }
                  }
                }
              }
              ?>

              <tfoot>
                <td colspan="3" style="text-align:right;"><b> GRAND TOTAL</b></td>
                <td style="text-align: center;"><?php echo ('<input id="totalQuant" name="totalQuant" value ="'.$totQuant.'" type="hidden"/>'.$totQuant.''); ?></td>
                <td id="totalPrice" style="text-align: center;">&#8369;<?php echo number_format($totPrice,2); ?></td>
                <input type="hidden" name="totalPrice" value="<?php echo $totPrice; ?>">
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

<div class="row">
  <div class="row">
  <h2>Delivery Information</h2>
  <div class="descriptions">
      <div class="col-md-12">
        <div class="form-group">
          <h4><b>For:</b></><label class="radio-inline"><input type="radio" id="ratePick" name="type" value="Pick-up" checked/> Pick-up</label>
            <label class="radio-inline"><input type="radio" id="rateDel" name="type" value="Delivery"/> Delivery</label></h4>
          </div>
        </div>
      </div>

      <div class="deliveryDetails">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label class="control-label"><b>Delivery Address</b></label><span id="x" style="color:red"> *</span>
              <div class="row">
                <div class="col-md-1">
                  <input type="text" id="da" class="form-control" style="text-align:right" name="deladd[]" placeholder="#91" disabled required/>
                </div>
                <div class="col-md-2">
                  <input type="text" id="zip" class="form-control" name="deladd[]" placeholder="Kagawad Street" disabled required/>
                </div>
                <div class="col-md-3">
                  <input type="text" id="city" class="form-control" name="deladd[]" placeholder="Brgy.Batasan" disabled required/>
                </div>
                <div class="col-md-3">
                  <input type="text" id="state" class="form-control" name="deladd[]" placeholder="Quezon City" disabled required/>
                </div>
                <div class="col-md-3">
                  <select id="delloc" style="height:40px;" class="form-control" data-placeholder="Choose Delivery Location" tabindex="1" name="delloc" disabled> 
                    <option value="">Choose a Location</option>
                    <?php
                    $delsql = "SELECT * FROM tbldelivery_rates;";
                    $delresult = mysqli_query($conn,$delsql);
                    while($delrow = mysqli_fetch_assoc($delresult)){
                      echo('<option value="'.$delrow['delRate'].'">'.$delrow['delLocation'].'</option>');
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6 row">
        <div class="col-md-6">
        </div>
        <script type="text/javascript">
        $(document).ready(function(){
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

              if($('#aTendered').val() < (x / 2)){
                Math.round($('#aTendered').val( (x / 2)+d));
              }
              else if($('#aTendered').val() >= (x / 2)){
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

              if($('#aTendered').val() < (x / 2)){
                Math.round($('#aTendered').val( (x / 2)+d));
              }
              else if($('#aTendered').val() >= (x / 2)){
                var e = parseInt($('#aTendered').val());
                Math.round($('#dChange').val((x-$('#aTendered').val())+d));
              }
            }
          });



          $('#delloc').change(function(){
            var x = parseInt($('#totalPrice').html());
            var y =  parseInt($('#aTendered').val());
            Math.round($('#aTendered').val( x / 2));
            $('#dRate').val(parseInt($('#delloc').val()));
            var d = parseInt($('#dRate').val());

            if($('#aTendered').val() < (x / 2)){
              Math.round($('#aTendered').val( (x / 2)+d));
              Math.round($('#dChange').val($('#aTendered').val( (x / 2)+d)));
            }
            else if($('#aTendered').val() >= (x / 2)){
              var e = parseInt($('#aTendered').val());
              Math.round($('#dChange').val((x-$('#aTendered').val())+d));
            }
          });
        });

$(document).ready(function(){
  var x = parseInt($('#totalPrice').html());
  var y =  parseInt($('#aTendered').val());
  Math.round($('#aTendered').val( x / 2));

  var d = parseInt($('#dRate').val());
  if($('#aTendered').val() < (x / 2)){
    Math.round($('#aTendered').val( (x / 2))+d);
  }
  else if($('#aTendered').val() >= (x / 2)){
    var e = parseInt($('#aTendered').val());
    Math.round($('#dChange').val((x-$('#aTendered').val())+d));
  }

  $('#aTendered').keyup(function(){
    if($('#aTendered').val() < (x / 2)){
      Math.round($('#aTendered').val( (x / 2)+d));
    }
    else if($('#aTendered').val() >= (x / 2)){
      var e = parseInt($('#aTendered').val());
      Math.round($('#dChange').val((x-$('#aTendered').val())+d));
    }
  });
});
</script>
</div>
</div> <!--Delivery Details-->

<div class="pull-right">
  <h2>Payment Information:</h2>
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label class="control-label">Order Price</label>
        <input style="text-align:right;" id="oPrice" class="form-control" value="Php <?php echo number_format($totPrice,2)?>" disabled/>
      </div>
    </div>
    <div class="col-md-12">
      <div class="form-group">
        <label class="control-label">Delivery Rate</label>
        <input type="number" style="text-align:right;" id="dRate" class="form-control" value='' readonly/>
      </div>
    </div>
    <div class="col-md-12">
      <div class="form-group">
        <label class="control-label">Amount Due</label>
        <input type="number" style="text-align:right;" id="" class="form-control" name="a" disabled/></div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label class="control-label">Amount Tendered:(Must be 50% of the total amount)</label><span id="x" style="color:red"> *</span>
          <input type="number" style="text-align:right;" id="aTendered" class="form-control" name="aTendered" required/></div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label class="control-label">Change</label><span id="x" style="color:red"> *</span>
            <input type="number" id="dChange" class="form-control" name="change" disabled/> </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-5 pull-right">
            <button type="submit" class="btn btn-success waves-effect pull-right" id="addFab"><i class="fa fa-check"></i> Save & Print</button>
          </div>
        </div>
      </div>


    </div>
  </div>

</form>
</div>
</div>
</div>
</body> 
</html>