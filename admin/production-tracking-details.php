<?php
$activePage = basename($_SERVER['PHP_SELF'],".php");
include "menu.php";
include 'dbconnect.php';
include 'toastr-buttons.php';
$id = 0;
if(isset($_GET['id'])){
  $id = $_GET['id']; 
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
  <title>Production Details</title>
  <link rel="icon" type="image/x-icon" sizes="16x16" href="plugins/logo/favicon.ico">
  <script>

  function redirectJob(id){
    window.open("job-order.php?id="+id, "_blank");
  }


  $(document).ready(function(){
   $('#myModal').on('shown.bs.modal',function(){
    $('#finish').hide();
    $("#finPhase").on('change',function(){
      if($(this).prop("checked")){
        $('#finish').show();
        $('#update').hide();
        $('#dateStart').val("");
        $('#handler').val("");
        $('#Uremarks').val("");
      }
      else{
        $('#finish').hide();
        $('#update').show();
        $('#dateFinish').val("");
        $('#remarks').val("");
      }
    });
  });
 });

  $(document).ready(function(){
   $('#myModal').on('shown.bs.modal',function(){
    $('#materials').hide();
    $("#matQuantity").on('change',function(){
      if($(this).prop("checked")){
        $('#materials').show();
      }
      else{
        $('#materials').hide();
      }
    });
  });
 });

  $(document).ready(function(){
   $('#myModal').on('shown.bs.modal',function(){
    $("#estDate").on('change',function(){
      allValidation();
      // var est = new Date($("#estDate").val());
      // var start = new Date($("#dateStart").val());
      // if(start>est){
      //   var e = "Estimated date must not be earlier than the Start Date";
      //   $("#estError").html(e);
      //   $('#estDate').css('border-color','red');
      // }
      // else{
      //   var e = "";
      //   $("#estError").html(e);
      //   $('#estDate').css('border-color','grey');
      // }
    });
  });
 });

  $(document).ready(function(){
   $('#myModal').on('shown.bs.modal',function(){
    $("#handler").on('change',function(){
      allValidation();
    });
  });
 });


  function allValidation(){
    var h = $("#handler").val();
    var est = new Date($("#estDate").val());
    var start = new Date($("#dateStart").val());
    var ctr = 0;
    if(start>est){
      var e = "Estimated date must not be earlier than the Start Date";
      $("#estError").html(e);
      $('#estDate').css('border-color','red');
      $('#saveBtn').prop('disabled',true);
      ctr = 0;
    }
    else{
      var e = "";
      $("#estError").html(e);
      $('#estDate').css('border-color','grey');
      $('#saveBtn').prop('disabled',false);
      ctr++;
    }


    if(h!=""){
      var e = "";
      $("#hError").html(e);
      $('#handler').css('border-color','grey');
      ctr++;
    }
    else{
      var e = "Please select a handler";
      $("#hError").html(e);
      $('#handler').css('border-color','red');
    }

    if(ctr==2){
      $('#saveBtn').prop('disabled',false);
    }
    else{
      $('#saveBtn').prop('disabled',true);
    }


  }

  function deleteRow(row){
    var result = confirm("Remove Material?");
    if(result){
      var i=row.parentNode.parentNode.rowIndex;
      document.getElementById('selectedMaterials').deleteRow(i);
    }
  }
  </script>
</head>
<body class ="fix-header fix-sidebar">
  <!-- Preloader -->
  <div id="page-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
          <div class="panel panel-info">
            <h3>

              <?php
              $orderID = "OR" . str_pad($id, 6, '0', STR_PAD_LEFT);   
              $sql = "SELECT * FROM tblorders WHERE orderID = '$id'";
              $res = mysqli_query($conn,$sql);
              $row = mysqli_fetch_assoc($res);
              $status = $row['orderStatus'];  
              ?>

              <ul class="nav customtab2 nav-tabs" role="tablist">
                <li role="presentation" class="active">
                  <a aria-controls="proorders" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs"><?php echo $orderID?></span></a>
                </li>
              </ul>
              <ul class="nav customtab2 nav-tabs pull-right" role="tablist">
                <li role="presentation" class="active">
                  <a aria-controls="proorders" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"></span><span class="hidden-xs"><?php echo $status?></span></a>
                </li>
              </ul>
            </h3>
            <!-- brochure -->
            <div class="panel-body">
              <div class="orderconfirm">
                <form action="" method = "post">
                  <div class="row">
                    <div class="descriptions">
                      <div class="form-body">
                        <div class="col-md-12">
                          <div class="row">
                            <div class="col-md-6">
                              <h2>Customer Information</h2>
                              <?php
                              $sql = "SELECT * FROM tblcustomer a, tblorders b WHERE a.customerID = b.custOrderID and b.orderID = '$id'";
                              $result = mysqli_query($conn,$sql);
                              $row = mysqli_fetch_assoc($result);
                              $orderPrice = $row['orderPrice'];
                              ?>
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

                            <div class="col-md-6">
                              <h2>Payment History</h2>
                              <table class="table color-bordered-table">
                                <thead>
                                  <th style="text-align:left"><b>Date Paid</b></th>
                                  <th style="text-align:left"><b>Mode of Payment</b></th>
                                  <th style="text-align:right"><b>Amount Paid</b></th>
                                </thead>
                                <tbody>
                                  <?php
                                  $down = 0;
                                  $bal = 0;
                                  $sql = "SELECT * FROM tblinvoicedetails a, tblpayment_details b, tblorders c, tblmodeofpayment d WHERE c.orderID = a.invorderID and d.modeofpaymentID = b.mopID and a.invoiceID = b.invID and c.orderID = '$id'";
                                  $res = mysqli_query($conn,$sql);
                                  $tpay = 0;
                                  while($trow = mysqli_fetch_assoc($res)){
                                    $date = date_create($trow['dateCreated']);
                                    $date = date_format($date,"F d, Y");
                                    $tpay = $tpay + $trow['amountPaid'];
                                    echo '<tr><td>'.$date.'</td>
                                    <td>'.$trow['modeofpaymentDesc'].'</td>
                                    <td style="text-align:right;">&#8369; '.number_format($trow['amountPaid'],2).'</td>
                                    </tr>';
                                  }
                                  $down = $tpay;
                                  $bal = $orderPrice - $down;
                                  ?>
                                  <tr>
                                    <td colspan="2" style="text-align:right;"><i class="fa fa-caret-right text-info"></i><b> TOTAL AMOUNT PAID</b></td>
                                    <td style="text-align:right;"><mark><strong><span>&#8369;&nbsp;<?php echo number_format($down,2)?></span></strong></mark></td>
                                  </tr>
                                  <tr>
                                    <td colspan="2" style="text-align:right;"><b> REMAINING BALANCE</b></td>
                                    <td style="text-align:right; color:red;"><mark style="text-align:right; color:red;"><strong><span>&#8369;&nbsp;<?php echo number_format($bal,2)?></span></strong></mark></td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                        <br>

                        <div class="row">
                         <div class="col-md-12">
                          <div class="descriptions">
                            <h2>Order Information</h2>
                            <?php
                            $isFinish = 0;
                            include "dbconnect.php";
                            //$sql = "SELECT * from tblorder_request a, tblproduct b, tblorders c WHERE c.orderID='$id' and a.orderProductID = b.productID and a.orderRequestStatus!='Archived' and a.tblOrdersID = '$id'";
                            $sql = "SELECT * FROM tblorders c, tblproduction a, tblorder_request b, tblproduct d WHERE c.orderID = b.tblOrdersID and b.order_requestID = a.productionOrderReq and c.orderID = '$id' and b.orderRequestStatus!='Archived' and b.orderProductID = d.productID";
                            $res = mysqli_query($conn,$sql);
                            while($row = mysqli_fetch_assoc($res)){
                              $isFirst = 0;
                              $isFinish = 0;

                              $prodRec = str_pad($row['productionID'], 8, '0', STR_PAD_LEFT); //format ng display ID
                              $prodRec = "#" . $prodRec; 
                              echo '
                              <div class="col-md-12">
                              <div class="panel panel-info" style="margin-top: -20px;">
                              <div class="tab-content thumbnail">
                              <div role="tabpanel" class="tab-pane fade active in" id="job">
                              <div class="panel-wrapper collapse in" aria-expanded="true">
                              <div class="panel-body"><div class="row">
                              <div class="col-md-12">
                              <div class="col-md-6">
                              <h2 style="margin-top: -20px; color:black"><b>'. $prodRec .' - '.$row['productName'].'</b></h2>
                              </div>
                              <div class="col-md-6">';

                              echo '<h2 class="pull-right" style="margin-top: -20px;"><a data-toggle="modal" data-target="#myModal" href="production-start-update-forms.php" data-remote="production-start-update-forms.php?id='.$id.'&pID='.$row['productionID'].' #history"><i class="ti-menu-alt pull-right" style="margin-left: 20px; margin-top:5px;"></i></a>Production History</h2>

                              <h2></h2>
                              </div>
                              </div>
                            </div>';?>

                            <div class="row">
                              <div class="col-md-12">
                                <div class="panel panel-info" style="margin-top: -20px;">
                                  <div class="tab-content thumbnail">
                                    <div role="tabpanel" class="tab-pane fade active in" id="job">
                                      <div class="panel-wrapper collapse in" aria-expanded="true">
                                        <div class="panel-body">
                                          <div class="row">
                                            <div class="col-md-12">
                                              <?php
                                              include "dbconnect.php";
                                              $productionID = $row['productionID'];
                                              $pSQL = "SELECT * FROM tblproduction_phase a, tblproduction b, tblorder_request c, tblphases d WHERE b.productionID = a.prodID and a.prodPhase = d.phaseID and b.productionOrderReq = c.order_requestID and b.productionID = '$productionID'";
                                              $prResult = mysqli_query($conn,$pSQL);
                                              $ctr = mysqli_num_rows($prResult);
                                              $isFirst = 0;
                                              $isFirst = 0;
                                              while($pRow = mysqli_fetch_assoc($prResult)){

                                                if($pRow['prodStatus']=="Pending"){
                                                  echo '<div class="col-lg-2 col-md-2 col-sm-6 col-xs-12" style="margin-right:27px;">
                                                  <h4 style="text-align:center;">'.$pRow['phaseName'].'</h4>
                                                  <div class="thumbnail">
                                                  <div class="product-img">
                                                  <img height="115px" width="115px" style="filter:gray; -webkit-filter: grayscale(1); filter: grayscale(1);" src="plugins/production/'.$pRow['phaseIcon'].'" alt="Unavailable">
                                                  <div class="pro-img-overlay">';
                                                  if($isFinish==1){
                                                    echo '<button type="button" class="fcbtn btn btn-outline btn-success btn-1f col-md-12" data-toggle="modal" data-target="#myModal" href="production-start-update-forms.php" data-remote="production-start-update-forms.php?id='.$id.'&pID='.$pRow['prodHistID'].'&phase='.$pRow['prodPhase'].'&orderReq='.$pRow['order_requestID'].' #startproduction" style="text-align:center;"><span class="glyphicon glyphicon-edit"></span> Start </button>';
                                                    $isFinish = 0;
                                                  }
                                                  if($isFirst==0){
                                                    echo '<button type="button" class="fcbtn btn btn-outline btn-success btn-1f col-md-12" data-toggle="modal" data-target="#myModal" href="production-start-update-forms.php" data-remote="production-start-update-forms.php?id='.$id.'&pID='.$pRow['prodHistID'].'&phase='.$pRow['prodPhase'].'&orderReq='.$pRow['order_requestID'].'&first=yes #startproduction" style="text-align:center;"><span class="glyphicon glyphicon-edit"></span> Start </button>';
                                                    $isFirst = 1;
                                                  }
                                                  echo '</div>
                                                  </div>
                                                  </div>
                                                  <div class="progress progress-md" style="margin-top:15px;">
                                                  <h3 class="progress-bar progress-bar-warning active progress-bar-striped" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%; font-family:system-ui;" role="progressbar">'.$pRow['prodStatus'].'</h3>
                                                  </div>
                                                  </div>';
                                                }

                                                if($pRow['prodStatus']=="Finished"){
                                                  $isFinish = 1;
                                                  $isFirst = 1;
                                                  echo '<div class="col-lg-2 col-md-2 col-sm-6 col-xs-12" style="margin-right:27px;">
                                                  <h4 style="text-align:center;">'.$pRow['phaseName'].'</h4>
                                                  <div class="thumbnail">
                                                  <img height="115px" width="115px" src="plugins/production/'.$pRow['phaseIcon'].'" alt="Unavailable">
                                                  </div>
                                                  <div class="progress progress-md" style="margin-top:15px;">
                                                  <h3 class="progress-bar progress-bar-success active progress-bar-striped" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%; font-family:system-ui;" role="progressbar">'.$pRow['prodStatus'].'</h3>
                                                  </div>
                                                  </div>';

                                                }

                                                if($pRow['prodStatus']=="Ongoing"){
                                                  echo "<input type='hidden' id='histID' value='".$pRow['prodHistID']."'>";
                                                  echo "<input type='hidden' id='oID' value='".$id."'>";
                                                  echo '<div class="col-lg-2 col-md-2 col-sm-6 col-xs-12" style="margin-right:27px;">
                                                  <h4 style="text-align:center;">'.$pRow['phaseName'].'</h4>
                                                  <div class="thumbnail">
                                                  <div class="product-img">
                                                  <img height="115px" width="115px" src="plugins/production/'.$pRow['phaseIcon'].'" alt="Unavailable">
                                                  <div class="pro-img-overlay">';
                                                  if($isFinish==1){
                                                    echo '<button type="button" class="fcbtn btn btn-outline btn-success btn-1f col-md-12" data-toggle="modal" data-target="#myModal" href="production-start-update-forms.php" data-remote="production-start-update-forms.php?id='.$id.'&pID='.$pRow['prodHistID'].' #updateproduction" style="text-align:center;"><span class="glyphicon glyphicon-edit"></span> Update </button>';
                                                    echo '<button type="button" class="fcbtn btn btn-outline btn-success btn-1f col-md-12" onclick="redirectJob('.$pRow['prodHistID'].')" style="text-align:center;"><span class="glyphicon glyphicon-edit"></span> Job Order </button>';
                                                   // echo '<a class="btn btn-info" style="color:white;" href="redirect-jt.php?id='. $pRow['prodHistID'].'&oID='.$id.'"><span class="ti-receipt"></span>  Job Order</a>';
                                                    $isFinish = 0;
                                                  }
                                                  if($isFirst==0){
                                                    echo '<button type="button" class="fcbtn btn btn-outline btn-success btn-1f col-md-12" data-toggle="modal" data-target="#myModal" href="production-start-update-forms.php" data-remote="production-start-update-forms.php?id='.$id.'&pID='.$pRow['prodHistID'].' #updateproduction" style="text-align:center;"><span class="glyphicon glyphicon-edit"></span> Update </button>';
                                                    echo '<button type="button" class="fcbtn btn btn-outline btn-success btn-1f col-md-12" onclick="redirectJob('.$pRow['prodHistID'].')" style="text-align:center;"><span class="glyphicon glyphicon-edit"></span> Job Order` </button>';
                                                    //echo '<a class="btn btn-info" style="color:white;" href="redirect-jt.php?id='. $pRow['prodHistID'].'&oID='.$id.'"><span class="ti-receipt"></span>  Job Order</a>';
                                                    $isFirst = 1;
                                                  }
                                                  echo '</div>
                                                  </div>
                                                  </div>
                                                  <div class="progress progress-md" style="margin-top:15px;">
                                                  <h3 class="progress-bar progress-bar-info active progress-bar-striped" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%; font-family:system-ui;" role="progressbar">'.$pRow['prodStatus'].'</h3>
                                                  </div>
                                                  </div>';
                                                }
                                                
                                              }
                                              ?>

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
              </div>
            </div>
          </div>
          <?php
          } //end ng while sa order reqs
          ?>

          <!--PACKAGE BITCHES-->
          <?php
          $isFinish = 0;
          include "dbconnect.php";

                            //$sql = "SELECT * from tblorder_request a, tblproduct b, tblorders c WHERE c.orderID='$id' and a.orderProductID = b.productID and a.orderRequestStatus!='Archived' and a.tblOrdersID = '$id'";
        $sql = "SELECT * FROM tblpackage_orderreq e,tblorders c, tblproduction a, tblorder_request b, tblproduct d, tblpackages f
WHERE  a.productionPackReq = e.por_ID and e.por_prID = d.productID and b.orderRequestStatus!='Archived'
and c.orderID = b.tblOrdersID and b.order_requestID = e.por_orReqID and 
b.orderPackageID = f.packageID and c.orderID = '$id';";
          $res = mysqli_query($conn,$sql);
          while($row = mysqli_fetch_assoc($res)){
            $isFirst = 0;
            $isFinish = 0;

                              $prodRec = str_pad($row['productionID'], 8, '0', STR_PAD_LEFT); //format ng display ID
                              $prodRec = "#" . $prodRec; //format ng display ID
                              echo '
                              <div class="col-md-12">
                              <div class="panel panel-info" style="margin-top: -20px;">
                              <div class="tab-content thumbnail">
                              <div role="tabpanel" class="tab-pane fade active in" id="job">
                              <div class="panel-wrapper collapse in" aria-expanded="true">
                              <div class="panel-body"><div class="row">
                              <div class="col-md-12">
                              <div class="col-md-6">
                              <h2 style="margin-top: -20px; color:black"><b>'. $prodRec .' - '.$row['productName'].'</b></h2>
                              </div>
                              <div class="col-md-6">';

                              echo '<h2 class="pull-right" style="margin-top: -20px;"><a data-toggle="modal" data-target="#myModal" href="production-start-update-forms.php" data-remote="production-start-update-forms.php?id='.$id.'&pID='.$row['productionID'].'&pack=1 #history"><i class="ti-menu-alt pull-right" style="margin-left: 20px; margin-top:5px;"></i></a>Production History</h2>

                              <h2></h2>
                              </div>
                              </div>
                            </div>';?>

                            <div class="row">
                              <div class="col-md-12">
                                <div class="panel panel-info" style="margin-top: -20px;">
                                  <div class="tab-content thumbnail">
                                    <div role="tabpanel" class="tab-pane fade active in" id="job">
                                      <div class="panel-wrapper collapse in" aria-expanded="true">
                                        <div class="panel-body">
                                          <div class="row">
                                            <div class="col-md-12">
                                              <?php
                                              include "dbconnect.php";
                                              $productionID = $row['productionID'];
                                              $pSQL = "SELECT * FROM tblproduction_phase a, tblproduction b, tblorder_request c, tblphases d, tblpackage_orderreq e WHERE b.productionID = a.prodID and a.prodPhase = d.phaseID and b.productionPackReq = e.por_ID and e.por_orReqID = c.order_requestID and b.productionID = '$productionID'";
                                              $prResult = mysqli_query($conn,$pSQL);
                                              $ctr = mysqli_num_rows($prResult);
                                              $isFirst = 0;
                                              $isFirst = 0;
                                              while($pRow = mysqli_fetch_assoc($prResult)){

                                                if($pRow['prodStatus']=="Pending"){
                                                  echo '<div class="col-lg-2 col-md-2 col-sm-6 col-xs-12" style="margin-right:27px;">
                                                  <h4 style="text-align:center;">'.$pRow['phaseName'].'</h4>
                                                  <div class="thumbnail">
                                                  <div class="product-img">
                                                  <img height="115px" width="115px" style="filter:gray; -webkit-filter: grayscale(1); filter: grayscale(1);" src="plugins/production/'.$pRow['phaseIcon'].'" alt="Unavailable">
                                                  <div class="pro-img-overlay">';
                                                  if($isFinish==1){
                                                    echo '<button type="button" class="fcbtn btn btn-outline btn-success btn-1f col-md-12" data-toggle="modal" data-target="#myModal" href="production-start-update-forms.php" data-remote="production-start-update-forms.php?id='.$id.'&pID='.$pRow['prodHistID'].'&phase='.$pRow['prodPhase'].'&orderReq='.$pRow['por_ID'].'&pack=1 #startproduction" style="text-align:center;"><span class="glyphicon glyphicon-edit"></span> Start </button>';
                                                    $isFinish = 0;
                                                  }
                                                  if($isFirst==0){
                                                    echo '<button type="button" class="fcbtn btn btn-outline btn-success btn-1f col-md-12" data-toggle="modal" data-target="#myModal" href="production-start-update-forms.php" data-remote="production-start-update-forms.php?id='.$id.'&pID='.$pRow['prodHistID'].'&phase='.$pRow['prodPhase'].'&orderReq='.$pRow['por_ID'].'&first=yes&pack=1 #startproduction" style="text-align:center;"><span class="glyphicon glyphicon-edit"></span> Start </button>';
                                                    $isFirst = 1;
                                                  }
                                                  echo '</div>
                                                  </div>
                                                  </div>
                                                  <div class="progress progress-md" style="margin-top:15px;">
                                                  <h3 class="progress-bar progress-bar-warning active progress-bar-striped" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%; font-family:system-ui;" role="progressbar">'.$pRow['prodStatus'].'</h3>
                                                  </div>
                                                  </div>';
                                                }

                                                if($pRow['prodStatus']=="Finished"){
                                                  $isFinish = 1;
                                                  $isFirst = 1;
                                                  echo '<div class="col-lg-2 col-md-2 col-sm-6 col-xs-12" style="margin-right:27px;">
                                                  <h4 style="text-align:center;">'.$pRow['phaseName'].'</h4>
                                                  <div class="thumbnail">
                                                  <img height="115px" width="115px" src="plugins/production/'.$pRow['phaseIcon'].'" alt="Unavailable">
                                                  </div>
                                                  <div class="progress progress-md" style="margin-top:15px;">
                                                  <h3 class="progress-bar progress-bar-success active progress-bar-striped" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%; font-family:system-ui;" role="progressbar">'.$pRow['prodStatus'].'</h3>
                                                  </div>
                                                  </div>';

                                                }

                                                if($pRow['prodStatus']=="Ongoing"){
                                                  echo "<input type='hidden' id='oID' value='".$id."'>";
                                                  echo '<div class="col-lg-2 col-md-2 col-sm-6 col-xs-12" style="margin-right:27px;">
                                                  <h4 style="text-align:center;">'.$pRow['phaseName'].'</h4>
                                                  <div class="thumbnail">
                                                  <div class="product-img">
                                                  <img height="115px" width="115px" src="plugins/production/'.$pRow['phaseIcon'].'" alt="Unavailable">
                                                  <div class="pro-img-overlay">';
                                                  if($isFinish==1){
                                                    echo '<button type="button" class="fcbtn btn btn-outline btn-success btn-1f col-md-12" data-toggle="modal" data-target="#myModal" href="production-start-update-forms.php" data-remote="production-start-update-forms.php?id='.$id.'&pID='.$pRow['prodHistID'].'&pack=1 #updateproduction" style="text-align:center;"><span class="glyphicon glyphicon-edit"></span> Update </button>';
                                                    echo '<button type="button" class="fcbtn btn btn-outline btn-success btn-1f col-md-12" onclick="redirectJob('.$pRow['prodHistID'].')" style="text-align:center;"><span class="glyphicon glyphicon-edit"></span> Job Order </button>';
                                                    $isFinish = 0;
                                                  }
                                                  if($isFirst==0){
                                                    echo '<button type="button" class="fcbtn btn btn-outline btn-success btn-1f col-md-12" data-toggle="modal" data-target="#myModal" href="production-start-update-forms.php" data-remote="production-start-update-forms.php?id='.$id.'&pID='.$pRow['prodHistID'].'&pack=1 #updateproduction" style="text-align:center;"><span class="glyphicon glyphicon-edit"></span> Update </button>';
                                                    echo '<button type="button" class="fcbtn btn btn-outline btn-success btn-1f col-md-12" onclick="redirectJob('.$pRow['prodHistID'].')" style="text-align:center;"><span class="glyphicon glyphicon-edit"></span> Job Order </button>';
                                                    $isFirst = 1;
                                                  }
                                                  echo '</div>
                                                  </div>
                                                  </div>
                                                  <div class="progress progress-md" style="margin-top:15px;">
                                                  <h3 class="progress-bar progress-bar-info active progress-bar-striped" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%; font-family:system-ui;" role="progressbar">'.$pRow['prodStatus'].'</h3>
                                                  </div>
                                                  </div>';
                                                }
                                                
                                              }
                                              ?>

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
              </div>
            </div>
          </div>
          <?php
          } //end ng while sa order reqs
          ?>
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