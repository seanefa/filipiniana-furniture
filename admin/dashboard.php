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

$sql = "SELECT * FROM tblorders WHERE orderStatus='WFP' order by orderID";
$ctr = 0;
$AR = 0;
$res = mysqli_query($conn,$sql);
while($row = mysqli_fetch_assoc($res)){
  $dateRel = $row['dateOfReceived'];
  $over = date('Y-m-d',strtotime($dateRel."+ 8 days"));
  $date = new DateTime();
  $dateToday = date_format($date, "Y-m-d");
  if($dateToday > $over){
    //echo "<input type='hidden' id='archived' value=1/>";
    $AR = 1;
    $ctr++;
  }
  if($ctr==0){
    //echo "<input type='hidden' id='archived' value=0/>";
    $AR = 0;
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <script>

  $(document).ready(function(){
      //$('#archivedOrders').modal('show');
    var val = $("#archived").val();
    if(val!=0){
      $('#archivedOrders').modal('show');
    }
  });

  var divs = ["Menu1", "Menu2", "Menu3", "Menu4", "Menu5", "Menu6", "Menu7"];
  var visibleDivId = null;
  function toggleVisibility(divId) {
    if(visibleDivId === divId) {
//visibleDivId = null;
} else {
  visibleDivId = divId;
}
hideNonVisibleDivs();
}
function hideNonVisibleDivs() {
  var i, divId, div;
  for(i = 0; i < divs.length; i++) {
    divId = divs[i];
    div = document.getElementById(divId);
    if(visibleDivId === divId) {
      div.style.display = "block";
    } else {
      div.style.display = "none";
    }
  }
}

function redirectBill(id){
  window.open("bill.php?id="+id, "_blank");
}
</script>
</head>
<body>
  <div id="page-wrapper">
    <div class="container-fluid">

      <div class="col-md-9 col-lg-9 col-sm-9 col-xs-12">
        <div class="row">
          <div class="panel panel-info">
            <div id="Menu1">
              <input type="hidden" id="archived" value="<?php echo $AR?>">
              <h3>
                <ul class="nav customtab2 nav-tabs" role="tablist">
                  <li role="presentation" class="active" >
                    <a id="temptitle" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"></span><span class="hidden-xs"></span><i class="fa fa-bell"></i>&nbsp; Payment Notifications</a>
                  </li>
                </ul>
              </h3>
              <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade active in" id="fabrics">
                  <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                      <div class="row">
                        <div class="table-responsive">
                          <table class="table color-bordered-table muted-bordered-table dataTable display" id="tblFabricTexture">
                            <thead>
                              <tr>
                                <th>ORDER ID</th>
                                <th>Customer Name</th>
                                <th>Date Paid</th>
                                <th>Amount Paid</th>
                                <th>Actions</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              $sql = "SELECT * FROM tblnotification a, tblorders b, tblcustomer c WHERE b.orderID = a.tblorderID and a.tblcustomerID = c.customerID and a.notifStatus = 'Pending'";
                              $res = mysqli_query($conn,$sql);
                              while($row = mysqli_fetch_assoc($res)){
                                echo "<tr>
                                <td>".$row['orderID']."</td>
                                <td>".$row['customerLastName'].','.$row['customerFirstName'].'  '.$row['customerMiddleName']."</td>
                                <td>".$row['datePaid']."</td>
                                <td>".$row['amountPaid']."</td>
                                <td><a class='btn btn-success' style='color:white;' href='confirm-payment.php?id=". $row['orderID']."&notif=".$row['id']."'>&#8369; Payment </a></td>
                                </tr>";
                              }
                              ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div id="Menu2" style="display: none;">
              <h3>
                <ul class="nav customtab2 nav-tabs" role="tablist">
                  <li role="presentation" class="active" >
                    <a id="temptitle" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"></span><span class="hidden-xs"></span><i class="ti-write"></i>&nbsp;Order Request</a>
                  </li>
                </ul>
              </h3>
              <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade active in" id="fabrics">
                  <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                      <div class="row">
                        <div class="table-responsive">
                          <table class="table color-bordered-table muted-bordered-table dataTable display" id="tblCategories">
                            <thead>
                              <tr>
                                <th>Order ID</th>
                                <th>Customer Name</th>
                                <th>Request Date</th>
                                <th>Total Quantity</th>
                                <th>Price</th>
                                <th class="removeSort" style="text-align:left">Actions</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              include "dbconnect.php";
                              $sql = "SELECT * FROM tblorders WHERE orderStatus='WFA' order by orderID;";

                              $result = mysqli_query($conn, $sql);
                              if($result){
                                while ($row = mysqli_fetch_assoc($result))
                                {
$orderID = str_pad($row['orderID'], 6, '0', STR_PAD_LEFT); //format ng display ID
$count_prod = pCount($row['orderID']);
$get_date = getDates($row['orderID']);
$get_name = getName($row['custOrderID']);
echo ('
  <tr>
  <td style="text-align:left">'.$orderID.'</td>
  <td style="text-align:left">'.$get_name.'</td>
  <td style="text-align:left">'.$get_date.'</td>
  <td style="text-align:center">'.$count_prod.'</td>
  <td>&#8369;'.number_format($row['orderPrice'],2).'</td>
  <td style="text-align:left">
  <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" href="order-management-modals.php" data-remote="order-management-modals.php?id='. $row['orderID'].' #viewInfo"><i class="fa fa-info-circle"></i> View</button>

  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal" href="order-management-modals.php" data-remote="order-management-modals.php?id='. $row['orderID'].' #orderReqaccept"><i class="ti-check"></i> Accept</button>

  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal" href="order-management-modals.php" data-remote="order-management-modals.php?id='. $row['orderID'].' #orderReqreject"><i class="ti-close"></i> Reject</button>
  </td>
  </tr>');
}
}


function pCount($id){
  include "dbconnect.php";
  $cnt = 0;
  $sql = "SELECT COUNT(*) AS NO FROM tblorder_request WHERE tblOrdersID ='$id'";
  $result = mysqli_query($conn,$sql);
  while($row = mysqli_fetch_assoc($result)){
    $cnt = $row['NO'];
  }
  return $cnt;
}
function getDates($id){
  include "dbconnect.php";

  $sql = "SELECT * FROM tblorders WHERE orderID='$id'";
  $result = mysqli_query($conn,$sql);
  $row = mysqli_fetch_assoc($result);
  $dates = $row['dateOfReceived'];
  return $dates;
}
function orderCon($id){
  include "dbconnect.php";
  $sql = "SELECT * FROM tblorders WHERE orderID='$id'";
  $result = mysqli_query($conn,$sql);
  $row = mysqli_fetch_assoc($result);
  $dates = $row['custOrderID'];
  return getName($dates);
}

function getName($id){
  include "dbconnect.php";

  $sql = "SELECT * FROM tblcustomer WHERE customerID='$id'";
  $result = mysqli_query($conn,$sql);
  $row = mysqli_fetch_assoc($result);
  $name = $row['customerLastName'].','.$row['customerFirstName'].'  '.$row['customerMiddleName'];
  return $name;
}
function getuserID($id){
  include "dbconnect.php";
  $sql = "SELECT * FROM tbluser WHERE userID='$id'";
  $result = mysqli_query($conn,$sql);
  $row = mysqli_fetch_assoc($result);
  $name = $row['userCustID'];
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
</div>
</div>

<div id="Menu3" style="display: none;">
  <h3>
    <ul class="nav customtab2 nav-tabs" role="tablist">
      <li role="presentation" class="active" >
        <a id="temptitle" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"></span><span class="hidden-xs"></span><i class="ti-marker-alt"></i>&nbsp;Customization Request</a>
      </li>
    </ul>
  </h3>
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane fade active in" id="fabrics">
      <div class="panel-wrapper collapse in" aria-expanded="true">
        <div class="panel-body">
          <div class="row">
            <div class="table-responsive">
              <table class="table color-bordered-table muted-bordered-table dataTable display" id="tblCategories">
                <thead>
                  <tr>
                    <th>Request ID</th>
                    <th>Customer Name</th>
                    <th>Request Date</th>
                    <th class="removeSort">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php  $sql = "SELECT * from tbluser a, tblcustomize_request b, tblcustomer c WHERE b.tblcustomerID = a.userID and a.userCustID = c.customerID and customStatus = 'WFA' order by customizedID;";

                  $result = mysqli_query($conn, $sql);
                  if($result){
                    
                    while ($row = mysqli_fetch_assoc($result))
                    {
                      $orderID = str_pad($row['customizedID'], 6, '0', STR_PAD_LEFT); //format ng display ID
                      $date = date_create($row['dateRequest']);
                      $date = date_format($date,"F d, Y");
                      $name = $row["customerFirstName"] . " " . $row["customerMiddleName"] . " " . $row["customerLastName"];
                      ?>
                      <tr>
                        <td><?php echo $orderID;?></td>
                        <td><?php echo $name;?></td>
                        <td><?php echo $date;?></td>
                        <td>

                          <a type="button" class="btn btn-info" style="color:white" href="accept-customization.php?id=<?php echo $row['customizedID']?>"><i class="fa fa-info-circle"></i> View Details</a>
                        </td>
                      </tr>
                      <?php 
                    }
                  }
                  ?>
                </tbody>
              </table>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div id="Menu4" style="display: none;">
  <h3>
    <ul class="nav customtab2 nav-tabs" role="tablist">
      <li role="presentation" class="active" >
        <a id="temptitle" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"></span><span class="hidden-xs"></span><i class="ti-alert"></i>&nbsp;Balances</a>
      </li>
    </ul>
  </h3>
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane fade active in" id="fabrics">
      <div class="panel-wrapper collapse in" aria-expanded="true">
        <div class="panel-body">
          <div class="row">
            <div class="table-responsive">
              <table class="table color-bordered-table muted-bordered-table dataTable display" id="tblCategories">
                <thead>
                  <tr>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th style="text-align:right">Order Price</th>
                    <th style="text-align:right">Delivery Fee</th>
                    <th style="text-align:right">Penalty Fee</th>
                    <th style="text-align:right">Remaining Balance</th>
                    <th class="removeSort" style="text-align:left">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  include "dbconnect.php";
                  $sql = "SELECT * FROM tblorders a, tblinvoicedetails b WHERE b.invorderID = a.orderID AND a.orderStatus != 'Archived' AND a.orderStatus != 'WFA' AND a.orderStatus != 'Finished' AND a.orderStatus != 'Cancelled' AND a.orderType!='Management Order' order by orderID ;";

                  $result = mysqli_query($conn, $sql);
                  if($result){
                    while ($row = mysqli_fetch_assoc($result))
                    {
                      $orderID = str_pad($row['orderID'], 6, '0', STR_PAD_LEFT);
                      $count_prod = pCount($row['custOrderID']);
                      $get_date = getDates($row['orderID']);
                      $get_name = orderCon($row['orderID']);
                      $bal = getBal($row['orderID'], $row['orderPrice']);
                      $paymentStat = getStat($row['orderID'], $row['orderPrice']);
                      $overDue = isOverDue($row['orderID'],$row['invPenID']);
                      if($bal!=0){
                        echo ('
                          <tr>
                          <td>'.$orderID.'</td>
                          <td>'.$get_name.'</td>
                          <td style="text-align:right">&#8369; '.number_format($row['orderPrice'],2).'</td>
                          <td style="text-align:right">&#8369; '.number_format($row['invDelrateID'],2).'</td>
                          <td style="text-align:right">&#8369; '.number_format($row['invPenID'],2).'</td>
                          <td style="text-align:right; color: red;">&#8369; '.number_format($bal,2).'</td>');
                        if($overDue){
                          echo ('<td><a class="btn btn-info" style="color:white;" href="order-penalty.php?id='. $row['orderID'].'">&#8369; Add Penalty </a>
                            </td>
                            </tr>
                            ');

                        }
                        else{
                          echo ('<td style="text-align:left"><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal" href="order-management-modals.php" data-remote="order-management-modals.php?id='. $row['orderID'].' #viewInfo"><span class="fa fa-info-circle"></span> View</button>  
                           <button type="button" class="btn btn-success" onclick="redirectBill('.$row['orderID'].')" style="text-align:center;color:white;"><span class=" ti-receipt"></span> Bill </button>');
                          if($row['orderStatus']=="Cancelled"){
                           echo ('<a class="btn btn-info" style="color:white;" href="cancelled-payment.php?id='. $row['orderID'].'" >&#8369; Payment </a>
                            </td>
                            </tr>
                            ');
                         }
                         else{
                          echo ('<a class="btn btn-info" style="color:white;" href="order-payment.php?id='. $row['orderID'].'">&#8369; Payment </a>
                            </td>
                            </tr>
                            ');
                        }

                      }
                    }
                  }     
                }  
                function getBal($id,$price){
                  include "dbconnect.php";
                  $down = 0;
                  $bal = 0;
                  $delFee = 0;
                  $status = 0;
                  $penFee = 0;
                  $sql = "SELECT * FROM tblinvoicedetails a, tblpayment_details b, tblorders c WHERE c.orderID = a.invorderID and a.invoiceID = b.invID and c.orderID = '$id'";
                  $res = mysqli_query($conn,$sql);
                  $tpay = 0;
                  while($trow = mysqli_fetch_assoc($res)){
                    $tpay = $tpay + $trow['amountPaid'];
                    $price = $trow['balance'];
                    $delFee = $trow['invDelrateID'];
                    $penFee = $trow['invPenID'];
                    $status = $trow['orderStatus'];
                  }
                  if($status=="Cancelled"){
                    $bal = 0;
                  }
                  else{
                    $p = $price + $delFee + $penFee;
                    $down = $tpay;
                    $bal = $p - $down;
                  }
                  return $bal;
                }    
                function getStat($id,$price){
                  include "dbconnect.php";
                  $down = 0;
                  $bal = 0;
                  $sql = "SELECT * FROM tblinvoicedetails a, tblpayment_details b, tblorders c WHERE c.orderID = a.invorderID and a.invoiceID = b.invID and c.orderID = '$id'";
                  $res = mysqli_query($conn,$sql);
                  $tpay = 0;
                  while($trow = mysqli_fetch_assoc($res)){
                    $tpay = $tpay + $trow['amountPaid'];
                  }
                  $down = $tpay;
                  $bal = $price - $down;
                  if($bal==$price){
                    return "No downpayment";
                  }
                  else if($bal==0){
                    return "Paid";
                  }
                  else{
                    return "Not fully paid";
                  }
                }

                function isOverDue($id,$pen){
                  include "dbconnect.php";
                  $dateRel = 0;
                  $sql = "SELECT * FROM tblorders WHERE orderID = '$id'";
                  $res = mysqli_query($conn,$sql);
                  while($row = mysqli_fetch_assoc($res)){
                    $dateRel = $row['dateOfRelease'];
                  }
                              // echo $dateRel . '<br>';
                  $over = date('Y-m-d',strtotime($dateRel."+ 7 days"));
                  $date = new DateTime();
                  $dateToday = date_format($date, "Y-m-d");
                  if(($dateToday > $over) && ($pen==0)){
                                // echo $dateToday . '<br>';
                                // echo $over. '<br>';
                    return true;
                  }
                  else{
                    return false;
                  }
                }
                ?> 
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<div id="Menu5" style="display: none;">
  <h3>
    <ul class="nav customtab2 nav-tabs" role="tablist">
      <li role="presentation" class="active" >
        <a id="temptitle" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"></span><span class="hidden-xs"></span><i class="ti-package"></i>&nbsp;Order Productions</a>
      </li>
    </ul>
  </h3>
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane fade active in" id="fabrics">
      <div class="panel-wrapper collapse in" aria-expanded="true">
        <div class="panel-body">
          <div class="row">
            <div class="table-responsive">
              <table class="table color-bordered-table muted-bordered-table dataTable display" id="tblCategories">
                <thead>
                  <tr>
                    <th>Order ID</th>
                    <th>Order Status</th>
                    <th>Production</th>
                    <th class="removeSort" style="text-align:left">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  include "dbconnect.php";
                  $sql = "SELECT * FROM tblorders WHERE orderStatus!='Ready for release' AND orderStatus!='Archived' AND orderStatus!='Rejected' AND orderStatus!='finished' AND orderStatus!='WFA' AND orderType='Pre-Order' order by orderID;";
                  $result = mysqli_query($conn, $sql);
                  if($result){
                    while ($row = mysqli_fetch_assoc($result))
                    {
                      $orderID = "OR" . str_pad($row['orderID'], 6, '0', STR_PAD_LEFT);
                      $production = production($row['orderID']);
                      if($row['orderStatus']=='Pending'){
                        echo ('
                          <tr>
                          <td style="text-align:left">'.$orderID.'</td>
                          <td style="text-align:left">'.$row['orderStatus'].'</td>
                          <td style="text-align:left">'.$production.'</td>
                          <td style="text-align:left">
                          <a class="btn btn-success" href="production-start.php?id='.$row['orderID'].'" style="font-family:inherit; margin-top:25px; color:white;">Start Production</a><input type="hidden" id="idBtn" value="'.$row['orderID'].'"/> 
                          </td>
                          </tr>
                          ');
                      }
                      else if($row['orderStatus']=='Ongoing'){
                        echo ('
                          <tr>
                          <td style="text-align:left">'.$orderID.'</td>
                          <td style="text-align:left">'.$row['orderStatus'].'</td>
                          <td style="text-align:left">'.$production.'</td>
                          <td style="text-align:left">
                          <a class="btn btn-primary" href="production-tracking-details.php?id='.$row['orderID'].'" style="font-family:inherit; margin-top:25px; color:white;">View Details</a><input type="hidden" id="idBtn" value="'.$row['orderID'].'"/>
                          </td>
                          </tr>
                          ');
                      }
                      else if($row['orderStatus']=='Cancelled'){
                        echo ('
                          <tr>
                          <td style="text-align:left">'.$orderID.'</td>
                          <td style="text-align:left">'.$row['orderStatus'].'</td>
                          <td style="text-align:left">'.$production.'</td>
                          <td style="text-align:left">
                          <a class="btn btn-primary" href="production-tracking-details.php?id='.$row['orderID'].'" style="font-family:inherit; margin-top:25px; color:white;">View Details</a><input type="hidden" id="idBtn" value="'.$row['orderID'].'"/>
                          </td>
                          </tr>
                          ');
                      }
                    }
                  }


                  function production($id){
                    include "dbconnect.php";
                    $rowCount = 0;
                    $finProduction = 0;
                    $sql2 = "SELECT * FROM tblproduction b, tblorder_request c, tblorders a WHERE b.productionOrderReq = c.order_requestID and a.orderID = c.tblOrdersID and a.orderID = '$id' GROUP BY productionID;";
                    $res2 = mysqli_query($conn,$sql2);
                    while($row2 = mysqli_fetch_assoc($res2)){
                      $rowCount++;
                      if($row2['productionStatus']=='Finished'){
                        $finProduction++;
                      }
                    }

                    $output = $finProduction . " finished out of " . $rowCount;
                    return($output);
                  }   
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div id="Menu6" style="display: none;">
  <h3>
    <ul class="nav customtab2 nav-tabs" role="tablist">
      <li role="presentation" class="active" >
        <a id="temptitle" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"></span><span class="hidden-xs"></span><i class="ti-clipboard"></i>&nbsp;Materials Monitoring</a>
      </li>
    </ul>
  </h3>
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane fade active in" id="fabrics">
      <div class="panel-wrapper collapse in" aria-expanded="true">
        <div class="panel-body">
          <div class="row">
            <div class="table-responsive">
              <table class="table color-bordered-table muted-bordered-table dataTable display" id="tblFabricTexture">
                <thead>
                  <tr>
                    <th>Material</th>
                    <th>Variant Description</th>
                    <th>Quantity</th>
                    
                    <th class="removeSort">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sql1 = "SELECT * FROM tblmat_inventory b, tblmat_var a, tblmaterials c WHERE b.matVariantID = a.mat_varID AND a.materialID = c.materialID";
                  $result1 = mysqli_query($conn, $sql1);
                  while ($row1 = mysqli_fetch_assoc($result1))
                  {
                    if($row1['mat_varStatus']=="Active"){
                      echo('<tr><td>'.$row1['materialName'].'</td><td>'.$row1['mat_varDescription'].'</td>  <td>'.$row1['matVarQuantity'].'</td>');
                      
                      ?>
                      <td>
                        <a type="button" class="btn btn-info" style="color:white" href="raw-materials-monitoring.php">View</a>
                      </td>
                      <?php echo('</tr>'); }}
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div id="Menu7" style="display: none;">
      <h3>
        <ul class="nav customtab2 nav-tabs" role="tablist">
          <li role="presentation" class="active" >
            <a id="temptitle" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"></span><span class="hidden-xs"></span><i class="ti-face-smile"></i>&nbsp;Customer Monitoring</a>
          </li>
        </ul>
      </h3><h3>
      <ul class="nav customtab2 nav-tabs" role="tablist">
        <button id="tempbtn" class="btn btn-lg btn-warning pull-right" data-toggle="modal"  href="newsletter-form.php" data-remote="newsletter-form.php #new" data-target="#myModal1" aria-expanded="false" style="margin-right: 20px;"><span class="btn-label"><i class="ti-plus"></i></span> Create Newsletter</button>
      </ul>
    </h3>
    <div class="tab-content">
      <div role="tabpanel" class="tab-pane fade active in" id="fabrics">
        <div class="panel-wrapper collapse in" aria-expanded="true">
          <div class="panel-body">
            <div class="row">
              <div class="table-responsive">
                <table class="table color-bordered-table muted-bordered-table dataTable display" id="tblFabricTexture">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Address</th>
                      <th>Contact Number</th>
                      <th>Email</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    include "dbconnect.php";
                    $sql = "SELECT * FROM tblcustomer WHERE customerStatus='active' AND customerStatus='Active' order by customerID;";

                    $result = mysqli_query($conn, $sql);
                    if($result){
                      while ($row = mysqli_fetch_assoc($result))
                      {
$custID = str_pad($row['customerID'], 6, '0', STR_PAD_LEFT); //format ng display ID
$custLName = $row['customerLastName'];
$custFName = $row['customerFirstName'];
$custMName = $row['customerMiddleName'];
$custAddress = $row['customerAddress'];
$custNumber = $row['customerContactNum'];
$custEmail = $row['customerEmail'];
echo ('
  <tr>
  <td style="text-align:left">' . $custLName . ", " . $custFName . " " . $custMName . '</td>
  <td style="text-align:left">' . $custAddress . '</td>
  <td style="text-align:center">' . $custNumber . '</td>
  <td style="text-align:center">' . $custEmail . '</td>
  <td style="text-align:left">

  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal" href="customers-forms.php" data-remote="customers-forms.php?id=' . $row['customerID']. ' #update"><i class="ti-pencil-alt"></i> Update</button>
  </td>
  </tr>
  ');
}
}
?>
</tbody>
</table>
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

<div class="col-lg-3 col-sm-3 col-xs-12" style="margin-top: -20px;">
  <div class="panel panel-info">
    <div class="tab-content">
      <?php

      $sql = "SELECT * FROM tblnotification a, tblorders b, tblcustomer c WHERE b.orderID = a.tblorderID and a.tblcustomerID = c.customerID and a.notifStatus = 'Pending'";
      $res = mysqli_query($conn,$sql);

      ?>
      <button class="fcbtn btn btn-outline btn-info btn-lg btn-block btn-1c" onclick="toggleVisibility('Menu1');">PAYMENT<br>NOTIFICATIONS<br><?php echo mysqli_num_rows($res); ?></button>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12 col-sm-12 col-xs-12" style="margin-top: -35px;">
      <div class="panel panel-info">
        <div class="tab-content">
          <?php

          $sql = "SELECT * FROM tblcustomer WHERE customerStatus='active' AND customerStatus='Active' order by customerID;";

          $result = mysqli_query($conn, $sql);

          ?>
          <button class="fcbtn btn btn-outline btn-info btn-lg btn-block btn-1c" onclick="toggleVisibility('Menu7');">CUSTOMERS<br><?php echo mysqli_num_rows($result); ?></button>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12 col-sm-12 col-xs-12" style="margin-top: -35px;">
      <div class="panel panel-info">
        <div class="tab-content">
          <?php

          $sql = "SELECT * FROM tblorders WHERE orderStatus='WFA' order by orderID;";

          $result = mysqli_query($conn, $sql);

          ?>
          <button class="fcbtn btn btn-outline btn-info btn-lg btn-block btn-1c" onclick="toggleVisibility('Menu2');">ORDER REQUEST<br><?php echo mysqli_num_rows($result); ?></button>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12 col-sm-12 col-xs-12" style="margin-top: -35px;">
      <div class="panel panel-info">
        <div class="tab-content">
         <?php

         $sql = "SELECT * FROM tblcustomize_request WHERE customStatus='WFA' order by customizedID;";

         $result = mysqli_query($conn, $sql);

         ?>
         <button class="fcbtn btn btn-outline btn-info btn-lg btn-block btn-1c" onclick="toggleVisibility('Menu3');">CUSTOMIZATION<br>REQUEST<br><?php echo mysqli_num_rows($result); ?></button>
       </div>
     </div>
   </div>
 </div>

 <div class="row">
  <div class="col-lg-12 col-sm-12 col-xs-12" style="margin-top: -35px;">
    <div class="panel panel-info">
      <div class="tab-content">
        <?php

        $sql = "SELECT * FROM tblorders a, tblinvoicedetails b WHERE b.invorderID = a.orderID AND a.orderStatus != 'Archived' AND a.orderStatus != 'WFA' AND a.orderStatus != 'Finished' order by orderID ;";

        $result = mysqli_query($conn, $sql);

        ?>
        <button class="fcbtn btn btn-outline btn-info btn-lg btn-block btn-1c" onclick="toggleVisibility('Menu4');">BALANCES<br><?php echo mysqli_num_rows($result); ?></button>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-12 col-sm-12 col-xs-12" style="margin-top: -35px;">
    <div class="panel panel-info">
      <div class="tab-content">
        <?php

        $sql = "SELECT * FROM tblorders WHERE orderStatus!='Ready for release' AND orderStatus!='Archived' AND orderStatus!='Rejected' AND orderStatus!='finished' AND orderStatus!='WFA' AND orderType='Pre-Order' order by orderID;";

        $result = mysqli_query($conn, $sql);

        ?>
        <button class="fcbtn btn btn-outline btn-info btn-lg btn-block btn-1c" onclick="toggleVisibility('Menu5');">ORDER PRODUCTION<br><?php echo mysqli_num_rows($result); ?></button>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-12 col-sm-12 col-xs-12" style="margin-top: -35px;">
    <div class="panel panel-info">
      <div class="tab-content">
        <?php
        $sql1 = "SELECT * FROM tblmat_inventory b, tblmat_var a, tblmaterials c WHERE b.matVariantID = a.mat_varID AND a.materialID = c.materialID";
        $result1 = mysqli_query($conn, $sql1);
        ?>
        <button class="fcbtn btn btn-outline btn-info btn-lg btn-block btn-1c" onclick="toggleVisibility('Menu6');">MATERIALS<br>MONITORING<br><?php echo mysqli_num_rows($result); ?></button>
      </div>
    </div>
  </div>
</div>

<!-- /.container-fluid -->
<!--footer class="footer text-center"> 2017 &copy; Filipiniana Furniture </footer-->
</div>
<!-- /#page-wrapper -->
</div>

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

<div id="myModal1" class="modal fade" role="dialog " aria-hidden="true" style="display: none;" tabindex="-1">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <!-- Modal content-->
      <div class="modal-content clearable-content">
        <div class="modal-body">

        </div>
      </div>
    </div>
  </div>
</div>


<div id="archivedOrders" class="modal fade" role="dialog " aria-hidden="true" style="display: none;" tabindex="-1">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-content clearable-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h3 class="modal-title" id="modalProduct" style="text-align:center;">Unclaimed Orders</h3>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body">
                  <div class="table-responsive">
                    <h4>Note: The following order records are automatically archived for failure to pay for their order(s) within seven (7) days.</h4>
                    <h3><label class="control-label" style="text-align:left;">Orders</label></h3>
                    <table class="table product-overview" id="cartTbl">
                      <thead>
                        <th style="text-align:left">ORDER ID</th>
                        <th style="text-align:left">Customer Name</th>
                        <th>Order Status</th>
                        <th style="text-align:right;">Date Received</th>
                        <th style="text-align:right;">Status</th>
                      </thead>
                      <tbody>
                        <?php
                        include "dbconnect.php";
                        $sql = "SELECT * FROM tblorders WHERE orderStatus='WFP' order by orderID";
                        $ctr = 0;
                        $res = mysqli_query($conn,$sql);
                        while($row = mysqli_fetch_assoc($res)){
                          $dateRel = $row['dateOfRelease'];
                          $over = date('Y-m-d',strtotime($dateRel."+ 8 days"));
                          $date = new DateTime();
                          $dateToday = date_format($date, "Y-m-d");
                          if($dateToday > $over){
                            $oID = $row['orderID'];
                            $orderID = str_pad($row['orderID'], 6, '0', STR_PAD_LEFT);
                            $get_name = getName($row['custOrderID']);
                            $date = date_create($row['dateOfReceived']);
                            $dates = date_format($date,"F d, Y");
                            echo '<tr>
                            <td>'.$orderID.'</td>
                            <td>'.$get_name.'</td>
                            <td>Waiting for Payment</td>
                            <td style="text-align:right">'.$dates.'</td>
                            <td style="color:red">Archived</td>
                            </tr>';
                            $ctr++;
                            $uSQL = "UPDATE tblorders SET orderStatus = 'Archived' WHERE orderID = ".$oID.";";
                            mysqli_query($conn,$uSQL);
                          }
                        }
                        if($ctr==0){
                          echo "<tr><td colspan='5' style='text-align:right'>Nothing to show.</td></tr>";
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php
          ?>
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

<!--script>
$(document).ready(function() {
//ex.2 simple view, city name only, yahoo weather
var example2 = $("#flatWeather").flatWeatherPlugin({
location: "Manila",
country: "Philippines",
api: "yahoo",
view : "simple"
});
});
</script-->
</body>
</html>
