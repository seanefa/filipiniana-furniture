<?php
include "titleHeader.php";
include "menu.php";
include 'dbconnect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <script>
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
</script>
</head>
<body>
  <div id="page-wrapper">
    <div class="container-fluid">

      <div class="col-md-9 col-lg-9 col-sm-9 col-xs-12">
        <div class="row">
          <div class="panel panel-info">
            <div id="Menu1">
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
                  <?php  $sql = "SELECT * FROM tblcustomize_request WHERE customStatus='WFA' order by customizedID;";

                      $result = mysqli_query($conn, $sql);
                      if($result){
                        while ($row = mysqli_fetch_assoc($result))
                        {

                        
                          ?>
                  <tr>
                    <td><?php echo $row['customizedID'];?></td>
                    <td><?php echo getName(getuserID($row['tblcustomerID']));?></td>
                    <td><?php echo $row['dateRequest'];?></td>
                    <td>
                      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" href="order-management-modals.php" data-remote="order-management-modals.php?id='. $row['orderID'].' #viewCustRequest"><i class="fa fa-info-circle"></i> View</button>
                      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal" href="order-management-modals.php" data-remote="order-management-modals.php?id='. $row['orderID'].' #acceptCustRequest"><i class="ti-check"></i> Accept</button>
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
                              <th style="text-align:right">Remaining Balance</th>
                              <th class="removeSort" style="text-align:left">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php

                     $sql = "SELECT * FROM tblorders a, tblinvoicedetails b WHERE b.invorderID = a.orderID AND a.orderStatus != 'Archived' AND a.orderStatus != 'WFA' AND a.orderStatus != 'Finished' order by orderID ;";

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
                                if($bal!=0){
                                echo ('
                                  <tr>
                                  <td>'.$orderID.'</td>
                                  <td>'.$get_name.'</td>
                                  <td style="text-align:right">&#8369; '.number_format($row['orderPrice'],2).'</td>
                                  <td style="text-align:right; color: red;">&#8369; '.number_format($bal,2).'</td>
                                  <td style="text-align:left"><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal" href="order-management-modals.php" data-remote="order-management-modals.php?id='. $row['orderID'].' #viewInfo"><span class="fa fa-info-circle"></span> View</button>  

                                     <button type="button" class="btn btn-success" onclick="redirectBill('.$row['orderID'].')" style="text-align:center;color:white;"><span class=" ti-receipt"></span> Bill </button>');
                                  if($row['orderStatus']=="Cancelled"){
                                   echo ('<a class="btn btn-info" style="color:white;" href="cancelled-payment.php?id='. $row['orderID'].'">&#8369; Payment </a>
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
                            <td><button type="button" class="btn btn-warning" data-toggle="modal" href="raw-materials-management-form.php" data-remote="raw-materials-management-form.php?id=<?php echo $row1['mat_varID']?> #restock" data-target="#myModal">Restock</button>

                              <button type="button" class="btn btn-danger" data-toggle="modal" href="raw-materials-management-form.php" data-remote="raw-materials-management-form.php?id=<?php echo $row1['mat_varID']?> #deduct" data-target="#myModal">Deduct</button>
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

<!-- <div class="row">
<div class="panel panel-info">
<h3>
<ul class="nav customtab2 nav-tabs" role="tablist">
<li role="presentation" class="active" >
<a id="temptitle" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"></span><span class="hidden-xs"></span><i class="fa fa-clock-o"></i>&nbsp;Order History</a>
</li>
</ul>
</h3>

<div class="tab-content">
<div role="tabpanel" class="tab-pane fade active in" id="fabrics">
<div class="panel-wrapper collapse in" aria-expanded="true">
<div class="panel-body">
<ul class="nav customtab2">
<li class style="border-top:1px solid darkgray;">
<p class="text-success">
<span class="badge" style="background-color:forestgreen;">4</span> Mr. Publico, Doc ordered 2 pieces of Yellow Seat. Mar. 11, 2017
<br>
</p>
</li>
<li class style="border-top:1px solid darkgray;">
<p class="text-warning">
<span class="badge" style="background-color:red;">3</span> Mr. Dela Cruz, John cancelled his order request. Mar. 6, 2017
<br>
</p>
</li>
<li class style="border-top:1px solid darkgray;">
<p class="text-success">
<span class="badge" style="background-color:forestgreen;">2</span> Ms. Garcia, Jocelyn ordered 3 Brown Couch. Feb. 25, 2017
<br>
</p>
</li>
<li class style="border-top:1px solid darkgray;">
<p class="text-muted">
<span class="badge" style="background-color:darkgray;">1</span> Mr. Cruz, Juan order is still pending. Feb. 23, 2017
<br>
</p>
</li>
</ul>

</div>
</div>
</div>
</div>
</div>
</div> -->
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
