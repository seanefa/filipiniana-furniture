<?php
include "titleHeader.php";
include "menu.php";
include 'dbconnect.php';
include 'toastr-buttons.php';

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
  <script>

  function redirectBill(id){
    window.open("bill.php?id="+id, "_blank");
  }

  $(document).ready(function(){

var value = $("#selectCat").val(); // on load

$.ajax({
  type: 'post',
  url: 'display-furnitures.php',
  data: {
    id: value,
  },
  success: function (response) {
    $('#tblProd').html(response);
//$("#selectType").attr('disabled','disabled');  
}
});

$('#selectCat').on("change",function() {
  var value = $("#selectCat").val();
  if(isNaN(value)){
    $.ajax({
      type: 'post',
      url: 'display-furnitures.php',
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
      url: 'display-furnitures.php',
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
  alert(value);
  $.ajax({
    type: 'post',
    url: 'display-furnitures.php',
    data: {
      id: value,
    },
    success: function (response) {
      $('#tblProd').html(response);
//$("#selectType").attr('disabled','disabled');  
}
});
});

});

</script>
</head>
<body>
  <div id="page-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
          <div class="panel panel-info">
            <h3>
              <ul class="nav customtab2 nav-tabs" role="tablist">
                <li role="presentation" class="active">
                  <a id="temptitle" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"></span><span class="hidden-xs"></span><i class="ti-shopping-cart"></i>&nbsp;<?php echo $titlePage?></a>
                </li>
              </ul>
            </h3>
            <div class="tab-content">
              <!-- CATEGORY -->
              <div role="tabpanel" class="tab-pane fade active in" id="job">
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">
                    <div class="row">
                      <div class="table-responsive">
                        <table class="table color-bordered-table muted-bordered-table dataTable display" id="tblCategories">
                          <thead>
                            <tr>
                              <th>Order ID</th>
                              <th>Customer Name</th>
                              <th>Release Date</th>
                              <th style="text-align: right;">Total Price</th>
                              <th>Production Status</th>
                              <th class="removeSort">Actions</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            include "dbconnect.php";
                            $sql = "SELECT * FROM tblorders WHERE orderStatus='Pending' OR orderStatus='Ongoing' OR orderStatus='Cancelled' order by orderID;";

                            $result = mysqli_query($conn, $sql);
                            if($result){
                              while ($row = mysqli_fetch_assoc($result))
                              {
$orderID = str_pad($row['orderID'], 6, '0', STR_PAD_LEFT); //format ng display ID
$get_name = getName($row['custOrderID']);
$production_stat = getStatus($row['orderID']);
$date = date_create($row['dateOfRelease']);
$dates = date_format($date,"F d, Y");
echo "<input type='hidden' id='orderID' value='".$row['orderID']."'/>";
echo ('<tr>
  <td style="text-align:left">'.$orderID.'</td>
  <td style="text-align:left">'.$get_name.'</td>
  <td style="text-align:left">'.$dates.'</td>
  <td style="text-align:right">&#8369; '.number_format($row['orderPrice'],2).'</td>
  <td style="text-align:left">'.$production_stat.'</td>
  <td style="text-align:left">');
  if($row['orderStatus']=="Ongoing"){
    echo ('<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#viewOrder" href="order-management-modals.php" data-remote="order-management-modals.php?id='. $row['orderID'].' #viewInfo"><i class="fa fa-info-circle"></i> View</button> 

  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal" href="order-management-modals.php" data-remote="order-management-modals.php?id='.$row['orderID'].' #cancelOrder" aria-expanded="false"><i class="ti-close"></i> Cancel Order</button>

  <button type="button" class="btn btn-success" onclick="redirectBill('.$row['orderID'].')" style="text-align:center;color:white;"><span class=" ti-receipt"></span> Bill </button>

  </td>
  </tr>
  ');
  }
  else if($row['orderStatus']=="Cancelled"){
    echo '<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#viewOrder" href="order-management-modals.php" data-remote="order-management-modals.php?id='. $row['orderID'].' #viewInfo"><i class="fa fa-info-circle"></i> View</button> 
    <a class="btn btn-primary" style="color:white;" href="return-payment.php?id='. $row['orderID'].'">&#8369; Return Payment </a></td></tr>';
  }
  else{
  echo ('<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#viewOrder" href="order-management-modals.php" data-remote="order-management-modals.php?id='. $row['orderID'].' #viewInfo"><i class="fa fa-info-circle"></i> View</button> 

  <a class="btn btn-info" style="color:white;" href="update-order.php?id='. $row['orderID'].'"><span class="ti-pencil-alt"></span> Update</a>

  <button type="button" class="btn btn-success" onclick="redirectBill('.$row['orderID'].')" style="text-align:center;color:white;"><span class=" ti-receipt"></span> Bill </button>

  </td>
  </tr>
  ');
}
}     
}    
//<button type="button" class="btn btn-info" data-toggle="modal" data-target="#viewOrder" href="order-management-modals.php" data-remote="order-management-modals.php?id='. $row['orderID'].' #orderUpdate"><span class="glyphicon glyphicon-edit"></span> Update</button>

function getStatus($id){
  include "dbconnect.php";
  $sql = "SELECT * FROM tblproduction a, tblorder_request b, tblorders c WHERE b.tblOrdersID = c.orderID and b.order_requestID = a.productionOrderReq and c.orderID = '$id'";
  $result = mysqli_query($conn,$sql);
  $stat = "";
  while($row = mysqli_fetch_assoc($result)){
    $stat = $row['productionStatus'];
  }
  if($stat==""){
    return "Not set";
  }
  else{
    return $stat;
  }
}      

function pCount($id){
  include "dbconnect.php";
  $cnt = 0;
  $sql = "SELECT * FROM tblorder_request WHERE tblOrdersID ='$id'";
  $result = mysqli_query($conn,$sql);
  while($row = mysqli_fetch_assoc($result)){
    $cnt = $cnt + $row['orderQuantity'];
  }
  return $cnt;
}
function getDates($id){
  include "dbconnect.php";

  $sql = "SELECT * FROM tblorders WHERE orderID='$id'";
  $result = mysqli_query($conn,$sql);
  $row = mysqli_fetch_assoc($result);
  $date = date_create($row['dateOfReceived']);
  $dates = date_format($date,"F d, Y");
  return $dates;
}
function getName($id){
  include "dbconnect.php";
  $name = "";
  if($id==0){
    $name = "M A N A G E M E N T";
  }
  else{
    $sql = "SELECT * FROM tblcustomer WHERE customerID='$id'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    $name = $row['customerLastName'].','.$row['customerFirstName'].'  '.$row['customerMiddleName'];
  }
  return $name;
}               

?> 
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
<!-- New Framework Mo
  <!-- /.modal -->
</div>
</div>  
</div>
</div>
<!-- /.container-fluid -->
<!--footer class="footer text-center"> 2017 &copy; Filipiniana Furniture </footer-->
</div>
<!-- /#page-wrapper -->
</div>

<div id="viewOrder" class="modal fade" role="dialog " aria-hidden="true" style="display: none;" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-content clearable-content">
        <div class="modal-body">

        </div>
      </div>
    </div>
  </div>
</div>

<div id="custRequest" class="modal fade" role="dialog " aria-hidden="true" style="display: none;" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
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
</body>
</html>