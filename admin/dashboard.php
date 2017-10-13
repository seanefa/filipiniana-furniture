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
  <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" href="order-management-modals.php" data-remote="order-management-modals.php?id='. $row['orderID'].' #orderReqview"><i class="fa fa-info-circle"></i> View</button>

  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal" href="order-management-modals.php" data-remote="order-management-modals.php?id='. $row['orderID'].' #orderReqaccept"><i class="ti-check"></i> Accept</button>

  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal" href="order-management-modals.php" data-remote="order-management-modals.php?id='. $row['orderID'].' #orderReqreject"><i class="ti-close"></i> Reject</button>
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
  <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" href="order-management-modals.php" data-remote="order-management-modals.php?id='. $row['orderID'].' #orderReqview"><i class="fa fa-info-circle"></i> View</button>

  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal" href="order-management-modals.php" data-remote="order-management-modals.php?id='. $row['orderID'].' #orderReqaccept"><i class="ti-check"></i> Accept</button>

  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal" href="order-management-modals.php" data-remote="order-management-modals.php?id='. $row['orderID'].' #orderReqreject"><i class="ti-close"></i> Reject</button>
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
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>

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
      <button class="fcbtn btn btn-outline btn-info btn-lg btn-block btn-1c" onclick="toggleVisibility('Menu1');">PAYMENT NOTIFICATIONS<br><?php echo mysqli_num_rows($res); ?></button>
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
          <button class="fcbtn btn btn-outline btn-info btn-lg btn-block btn-1c" onclick="toggleVisibility('Menu3');">CUSTOMIZATION REQUEST<br><?php echo mysqli_num_rows($result); ?></button>
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

           $sql = "SELECT * FROM tblorders WHERE orderStatus='WFA' order by orderID;";

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
          <button class="fcbtn btn btn-outline btn-info btn-lg btn-block btn-1c" onclick="toggleVisibility('Menu6');">MATERIALS<br>MONITORING<br>0</button>
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
