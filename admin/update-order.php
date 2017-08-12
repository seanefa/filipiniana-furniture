<?php
$activePage = basename($_SERVER['PHP_SELF'],".php");
include "menu.php";
include 'dbconnect.php';
$id = $_GET['id'];
//session_start();
/*
if(isset($_GET['customerId'])){
$jsID = $_GET['customId']; 
}*/
//$_SESSION['varname'] = 3;
$existingOrder = 0;
if(isset($_GET['id'])){
  $existingOrder = $_GET['id']; 
}

?>
<!DOCTYPE html>  
<html lang="en">
<head>
  <title>Update Order</title>
  <link rel="icon" type="image/x-icon" sizes="16x16" href="plugins/images/favicon.ico">

  <script>

  $(document).ready(function () {
    calculateSum();
    $(".quan").each(function () {
      $(this).keyup(function () {
        calculateSum();
      });
    });
  });

  function calculateSum() {
    var sum = 0;
    $(".quan").each(function () {
      if (!isNaN($(this).val()) && $(this).val().length != 0) {
        sum += parseFloat(this.value);
      }
    });
    $("#totalQ").val(sum.toFixed(2));
  }

/*
$(document).ready(function(){ //quan
  $('.quan').on('keyup',function(){
    var quan = $(this).val();
    if(quan!=""){
      $(this).css('border-color','grey');
    }
    if(quan<0){
      $(this).css('border-color','red');
    }
    if(quan==""){
      $(this).css('border-color','red');
    }
  });
});*/


function deleteExisting(row){
  var result = confirm("Remove Product?");
  if(result){
    $('#trowID'+row).hide();
    $('#exist'+row).attr('name','deleted[]');
    $('#existQ'+row).attr('name','deleted[]');
  }
}
/*
$(document).ready(function(){ //wala lang
  $('#quan').on('keyup',function(){
    var quan = $("input[name='quan']").val();
    if(quan!=""){
      $("#addBtn").prop("disabled",false);
      $('#quant').css('border-color','grey');
    }
    if(isNaN(quan)){
      $("#addBtn").prop("disabled",true);
      $('#quant').css('border-color','red');
    }
    if(quan==""){
      $("#addBtn").prop("disabled",true);
      $('#quant').css('border-color','grey');
    }
  });
});*/

</script>
</head>
<body class ="fix-header fix-sidebar">
  <!-- Preloader -->
  <div id="page-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
          <div class="panel panel-info">
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane fade active in" id="fabrics">
                <div class="panel-wrapper collapse in" aria-expanded="true">
            <div class="panel-body">
              <div class="orderconfirm">
                  <div class="descriptions">
                    <div class="form-body">
                      <div class="row">
                        <h2>Customer Information</h2>
                        <div class="row">
                          <?php
                          $sql = "SELECT * FROM tblcustomer a, tblorders b WHERE a.customerID = b.custOrderID and b.orderID = '$id'";
                          $result = mysqli_query($conn,$sql);
                          $row = mysqli_fetch_assoc($result);
                          ?>
                          <div class="row">
                            <div class="col-md-12" style="text-align:left;">
                              <h5>
                                <table class="table">
                                  <tr>
                                    <td><b>Name</b></td>
                                    <td><?php echo $row['customerFirstName'].' '.$row['customerMiddleName'].'  '.$row['customerLastName'];?></td>
                                  </tr>
                                  <tr>
                                    <td><b>Address</b></td>
                                    <td><?php echo $row['customerAddress'];?></td>
                                  </tr>
                                  <tr>
                                    <td><b>Contact Number</b></td>
                                    <td><?php echo $row['customerContactNum'];?></td>
                                  </tr>
                                  <tr>
                                    <td><b>Email Address</b></td>
                                    <td><?php echo $row['customerEmail'];?></td>
                                  </tr>
                                </table>
                              </h5>
                            </div>
                          </div>
                        </div>
                        <br>
                      </div>

                      
                      <h2>Order Information</h2><!--<button type="button" href="#customization" data-toggle="modal" id="cart" class="btn-info"><span class="glyphicon glyphicon-edit"></span></button>
                      <div class="row">-->
                        <div class="row"> <!-- AYOKO  NG DESIGN NETO HAHA BAKET KO GINAWA HAHAH-->
                          <?php
                          $sql = "SELECT * FROM tblorders WHERE orderID = '$id'";
                          $result = mysqli_query($conn,$sql);
                          $row = mysqli_fetch_assoc($result);
                          ?>
                          <div class="row">
                            <div class="col-md-12" style="text-align:left;">
                              <h5>
                                <table class="table">
                                  <tr>
                                    <td><b>Order Remarks</b></td>
                                    <td><?php echo $row['orderRemarks'];?></td>
                                  </tr>
                                  <tr>
                                    <td><b>Received</b></td>
                                    <td><?php 
                                    $date = date_create($row['dateOfReceived']);
                                    $date = date_format($date,"F/d/Y");
                                    echo $date;
                                    ?></td>
                                  </tr>
                                  <tr>
                                    <td><b>Pick Up/Delivery Date</b></td>
                                    <td><?php 
                                    $date = date_create($row['dateOfRelease']);
                                    $date = date_format($date,"F/d/Y");
                                    echo $date;?>
                                  </td>
                                </tr>
                              </table>
                            </h5>
                          </div>
                        </div>
                      </div>
                      <br>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="panel-wrapper collapse in" aria-expanded="true">
                            <form action="save-order-update1.php" method = "post">
                          <input type="hidden" name="updateOrder" id="updateOrder" value="<?php echo $existingOrder?>">
                          <div class="panel-body">
                            <div class="table-responsive">
                              <h3><label class="control-label" style="text-align:left;">Orders</label></h3>
                              <table class="table product-overview" id="tblOrders">
                                <thead>
                                  <th style="text-align:left">Furniture Name</th>
                                  <th style="text-align:left">Furniture Description</th>
                                  <th style="text-align:right;">Unit Price</th>
                                  <th style="text-align:right;">Quantity</th>
                                  <th style="text-align:right;">Total Price</th>
                                  <th style="text-align:center">Actions</th>
                                </thead>
                                <tbody>
                                  <?php
                                  include "dbconnect.php";
                                  $tQuan = 0;
                                  $tPrice = 0;
                                  $tPrice1 = 0;

                                  $sql1 = "SELECT * FROM tblorder_request a, tblorders b, tblproduct c WHERE c.productID = a.orderProductID and b.orderID = a.tblOrdersID and b.orderID = '$id'";
                                  $res = mysqli_query($conn,$sql1);
                                  while($row = mysqli_fetch_assoc($res)){
                                    echo '<tr id="trowID'.$row['order_requestID'].'"><input type="hidden" name="existRec[]" id="exist'.$row['order_requestID'].'" value="'.$row['order_requestID'].'">
                                    <td>'.$row['productName'].'</td>
                                    <td>'.$row['productDescription'].'</td>
                                    <td style="text-align:right;">&#8369; '.number_format($row['productPrice'],2).'<input type="hidden" style="text-align:right" class="uprice" id="uprice'.$row['order_requestID'].'" value="'.$row['productPrice'].'"/></td>
                                    <td style="text-align:right; class="quantity">
                                    <input id="existQ'.$row['order_requestID'].'" type="number" size="1" style="text-align:right" class="quan" name="quan[]" value="'.$row['orderQuantity'].'" /></td>';
                                    $tPrice1 = $row['orderQuantity'] * $row['productPrice'];
                                    $tPrice =  number_format($tPrice1,2);
                                    echo '<td style="text-align:right;" class="prices">&#8369; '.$tPrice.'
                                    <input type="hidden" id="price"  value="'.$tPrice1.'" /></td>';
                                    $tPrice = $row['orderPrice'];
                                    $tQuan = $tQuan + $row['orderQuantity'];
                                    echo '<td style="text-align:center"><button type="button" class="btn btn-danger" onclick="deleteExisting('.$row['order_requestID'].')">X</button></td>
                                    </tr>';
                                  }
                                  ?>
                                </tbody>
                                <tfoot style="text-align:right;">
                                  <td colspan="3" style="text-align:right;"><b> GRAND TOTAL</b></td>
                                  <td  style="text-align:right;"><input type="text" id="totalQ" style="text-align:right; border:none" value="<?php echo $tQuan?>" disabled/></td>
                                  <td  style="text-align:right;"><input type="text" id="totalPrice" style="text-align:right; border:none" value="<?php echo number_format($tPrice,2)?>" disabled/></td>
                                  <td></td>
                                </tfoot>
                              </table>
                            </div>
                        </div>
                    <div class="row">
                      <div class="col-md-6">
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal" href="order-management-modals.php" data-remote="order-management-modals.php?id='<?php echo $id;?>' #cancelOrder" aria-expanded="false">Cancel Order</button>
                      </div>
                      <div class="col-md-6 pull-right">
                        <button type="submit" class="btn btn-success waves-effect pull-right" id="addFab" aria-expanded="false"><i class="fa fa-check"></i> Save</button>
                      </div>
                    </div>
                  </form>
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
$(document).on('hidden.bs.modal', function (e) {
  var target = $(e.target);
  target.removeData('bs.modal')
  .find(".clearable-content").html('');
});
</script>
</body> 
</html>