<?php
$activePage = basename($_SERVER['PHP_SELF'],".php");
include "menu.php";
include 'dbconnect.php';
include 'toastr-buttons.php';

$id = $_GET['id'];
$existingOrder = 0;
if(isset($_GET['id'])){
  $existingOrder = $_GET['id']; 
}


if (!empty($_SESSION['createSuccess'])) {
  echo  '<script>
  $(document).ready(function () {
    $("#toastNewSuccess").click();
  });
</script>';
unset($_SESSION['createSuccess']);
}
if (!empty($_SESSION['updateSuccess'])) {
  echo  '<script>
  $(document).ready(function () {
    $("#toastUpdateSuccess").click();
  });
</script>';
unset($_SESSION['updateSuccess']);
}
if (!empty($_SESSION['deactivateSuccess'])) {
  echo  '<script>
  $(document).ready(function () {
    $("#toastDeactivateSuccess").click();
  });
</script>';
unset($_SESSION['deactivateSuccess']);
}
if (!empty($_SESSION['reactivateSuccess'])) {
  echo  '<script>
  $(document).ready(function () {
    $("#toastReactivateSuccess").click();
  });
</script>';
unset($_SESSION['reactivateSuccess']);
}
if (!empty($_SESSION['actionFailed'])) {
  echo  '<script>
  $(document).ready(function () {
    $("#toastFailed").click();
  });
</script>';
unset($_SESSION['actionFailed']);
}

?>
<!DOCTYPE html>  
<html lang="en">
<head>
  <title>Update Order</title>
  <link rel="icon" type="image/x-icon" sizes="16x16" href="plugins/images/favicon.ico">

  <script>

  $(document).ready(function () {

    $(".quan").each(function () {
      $(this).keyup(function () {
        qnt = $(this).val();
        calculateSum();

        var id = $(this).attr('id');
        uprice(id);

      });
    });
  });

  function uprice(id){
    id = id.replace('existQ','');
    var tPrice = parseInt($('#uprice'+id).val());
    var tQuant = parseInt($('#existQ'+id).val());
    tPrice = tPrice * tQuant;
    $('#thisPrice'+id).val(tPrice);
    calculatePrice(tPrice);

  }


 //  $(document).ready(function(){
 //   $('#myModal').on('shown.bs.modal',function(){
 //    $("input[name='price']").on('change',function(){
 //      var val = $("input[name='price']").val();
 //      if(val=="0"){
 //        alert('jsadgsad');
 //      }
 //    });
 //  });
 // });
  


  $(document).ready(function(){
   $('#myModal').on('shown.bs.modal',function(){
    $("#penaltyForm").hide();
    var val = $("#status").val();
    if(val=="Ongoing"){
      $("#penaltyForm").show();
    }
  });
 });


  function calculateSum() {
    var sum = 0;
    $(".quan").each(function () {
      if (!isNaN($(this).val()) && $(this).val().length != 0) {
        sum += parseFloat(this.value);
      }
    });

    $("#totalQ").html(sum);
  }

  function calculateTotal() {
    var tot = 0;
    $(".priced").each(function () {
      if (!isNaN($(this).val()) && $(this).val().length != 0) {
        tot += parseFloat(this.value);
      }
    });
    return tot;
  }

  var price = 0;
  function calculatePrice(val) {
    price = val;
    if(val < price){
      price = price - val;
    }else if(price < val){
      price = price + val;
    }
    $('#totalPrice').html(calculateTotal());
    var tot = $("#totalPrice").val();
    if(tot==0){
      alert("jksad");
      var e = "Invalid.";
      $('#error').val(e);
    }
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
                        <form action="save-order-update1.php" method = "post">
                          <div class="form-body">
                            <div class="row">
                              <div class="col-md-6">
                                <h2 style="text-align: center;">Customer Information</h2>
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

                              <div class="col-md-6">
                        <h2 style="text-align: center;">Order Information</h2><!--<button type="button" href="#customization" data-toggle="modal" id="cart" class="btn-info"><span class="glyphicon glyphicon-edit"></span></button>
                        <div class="row">-->
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
                                    <td><i class="fa fa-caret-right text-info"></i><b> Received</b></td>
                                    <td><mark><em><?php 
                                    $date = date_create($row['dateOfReceived']);
                                    $date = date_format($date,"F/d/Y");
                                    echo $date;
                                    ?></mark></em></td>
                                  </tr>
                                  <tr>
                                    <td><i class="fa fa-caret-right text-info"></i><b> Pick Up/Delivery Date</b><span id="x" style="color:red"> *</span></td></td>
                                    <td>
                                      <?php 
                                      $date = date_create($row['dateOfRelease']);
                                      $date = date_format($date,"Y-m-d");
                                      ?>
                                      <div class="col-md-12">
                                        <div class="form-group">
                                          <input type="date" id="pdate" class="form-control" name="pdDate" value="<?php echo $date?>" required/> 
                                        </div>
                                      </div>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td><b> Order Remarks</b></td>
                                  <td><textarea type="text" id="descText" class="form-control" rows="2" name="remarks"><?php echo $row['orderRemarks'];?></textarea></td>
                                </tr>
                              </table>
                            </h5>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row" style="border: 2px solid #E4E7EA;">
                      <div class="col-md-12">
                        <div class="panel-wrapper collapse in" aria-expanded="true">
                          <input type="hidden" name="updateOrder" id="updateOrder" value="<?php echo $existingOrder?>">
                          <div class="panel-body">
                            <h2 style="text-align: center;">Orders</h2>
                            <a class="btn btn-info" style="color:white; margin-top:-15px; position: absolute;" href="ordering.php?id=<?php echo $id;?>"><i class="ti-plus"></i> Add Product</a>
                            <div class="table-responsive">
                              <table class="table product-overview" id="tblOrders" style="border: 2px solid #E4E7EA; margin-top: 35px;">
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
                                    <input id="existQ'.$row['order_requestID'].'" type="number" size="1" min="0" style="text-align:right" class="quan" name="quan[]" value="'.$row['orderQuantity'].'" /></td>';
                                    $tPrice1 = $row['orderQuantity'] * $row['productPrice'];
                                    $tPrice =  $tPrice1;
                                    echo '<td style="text-align:right;" class="prices">&#8369;  <input type="text" style="text-align:right;" class="priced" name="priced[]" border:none" readonly value="'.$tPrice.'" id="thisPrice'.$row['order_requestID'].'"/> 
                                    <input type="hidden" id="price"  name="price" value="'.$tPrice1.'" /></td>';
                                    $tPrice = $row['orderPrice'];
                                    $tQuan = $tQuan + $row['orderQuantity'];
                                    echo '<td style="text-align:center"><button type="button" class="btn btn-danger" onclick="deleteExisting('.$row['order_requestID'].')"><i class="ti-close"></i></button></td>
                                    </tr>';
                                  }
                                  ?>
                                </tbody>
                                <tfoot style="text-align:right;">
                                  <td colspan="3" style="text-align:right;"><i class="fa fa-caret-right text-info"></i><b> GRAND TOTAL</b></td>
                                  <td style="text-align:right;"><mark><strong><span id="totalQ"><?php echo $tQuan;?></span></bold></mark></td>
                                  <td style="text-align:right;"><mark><strong><span name="tPrice" id="totalPrice"><?php echo $tPrice;?></span></strong></mark></td>
                                  <td></td>
                                  <p id="error" style="color:red"></p>
                                </tfoot>
                              </table>
                            </div>
                          </div>
                          <div class="col-md-6" style="padding-bottom: 10px;">
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal" href="order-management-modals.php" data-remote="order-management-modals.php?id='<?php echo $id;?>' #cancelOrder" aria-expanded="false"><i class='ti-close'></i> Cancel Order</button>
                          </div>
                          <div class="col-md-6 pull-right" style="padding-bottom: 10px;">
                            <button type="submit" class="btn btn-success waves-effect pull-right" id="addFab" aria-expanded="false"><i class="ti-check"></i> Save Changes</button>
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
</div>

<div id="myModal" class="modal fade" role="dialog " aria-hidden="true" style="display: none;" tabindex="-1">
  <div class="modal-dialog modal-md">
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