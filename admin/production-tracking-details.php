<?php
$activePage = basename($_SERVER['PHP_SELF'],".php");
include "menu.php";
include 'dbconnect.php';
$id = 0;
if(isset($_GET['id'])){
  $id = $_GET['id']; 
}
?>
<!DOCTYPE html>  
<html lang="en">
<head>
  <title>Production Details</title>
  <link rel="icon" type="image/x-icon" sizes="16x16" href="plugins/images/favicon.ico">
  <script>
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
                <form action="add-customer.php" method = "post">
                  <div class="row">
                    <div class="descriptions">
                      <div class="form-body">
                        <h2>Customer Information</h2>
                        <?php
                        $sql = "SELECT * FROM tblcustomer a, tblorders b WHERE a.customerID = b.custOrderID and b.orderID = '$id'";
                        $result = mysqli_query($conn,$sql);
                        $row = mysqli_fetch_assoc($result);
                        ?>
                        <div class="row">
                          <div class="col-md-12">
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
                        <br>

                        <div class="row">
                         <div class="col-md-12">
                          <div class="descriptions">
                            <h2>Order Information</h2>
                            <?php
                            $isFinish = 0;
                            include "dbconnect.php";
                            $sql = "SELECT * from tblorder_request a, tblproduct b, tblorders c WHERE c.orderID='$id' and a.orderProductID = b.productID and a.orderRequestStatus!='Archived' and a.tblOrdersID = '$id'";
                            $res = mysqli_query($conn,$sql);
                            while($row = mysqli_fetch_assoc($res)){

                              echo '
                              <div class="col-md-12">
                              <div class="panel panel-info" style="margin-top: -20px;">
                              <div class="tab-content thumbnail">
                              <div role="tabpanel" class="tab-pane fade active in" id="job">
                              <div class="panel-wrapper collapse in" aria-expanded="true">
                              <div class="panel-body"><div class="row">
                              <div class="col-md-12">
                              <div class="col-md-6">
                              <h2 style="margin-top: -20px;">'.$row['productName'].'</h2>
                              </div>
                              <div class="col-md-6">';

                              echo '<h2 class="pull-right" style="margin-top: -20px;"><a data-toggle="modal" data-target="#myModal" href="production-start-update-forms.php" data-remote="production-start-update-forms.php?id='.$id.'&pID='.$row['order_requestID'].' #history"><i class="ti-menu-alt pull-right" style="margin-left: 20px; margin-top:5px;"></i></a>Production History</h2>

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
                                              $ordReqID = $row['order_requestID'];
                                              $pSQL = "SELECT * FROM tblproduction_phase a, tblproduction b, tblorder_request c, tblphases d WHERE b.productionID = a.prodID and a.prodPhase = d.phaseID and b.productionOrderReq = c.order_requestID and c.order_requestID = '$ordReqID';";
                                              $prResult = mysqli_query($conn,$pSQL);
                                              $ctr = mysqli_num_rows($prResult);
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
                                                    echo '<button type="button" class="fcbtn btn btn-outline btn-success btn-1f col-md-12" data-toggle="modal" data-target="#myModal" href="production-start-update-forms.php" data-remote="production-start-update-forms.php?id='.$id.'&pID='.$pRow['prodHistID'].' #startproduction" style="text-align:center;"><span class="glyphicon glyphicon-edit"></span> Start </button>';
                                                    $isFinish = 0;
                                                  }
                                                  if($isFirst==0){
                                                    echo '<button type="button" class="fcbtn btn btn-outline btn-success btn-1f col-md-12" data-toggle="modal" data-target="#myModal" href="production-start-update-forms.php" data-remote="production-start-update-forms.php?id='.$id.'&pID='.$pRow['prodHistID'].' #startproduction" style="text-align:center;"><span class="glyphicon glyphicon-edit"></span> First </button>';
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
                                                  echo '<div class="col-lg-2 col-md-2 col-sm-6 col-xs-12" style="margin-right:27px;">
                                                  <h4 style="text-align:center;">'.$pRow['phaseName'].'</h4>
                                                  <div class="thumbnail">
                                                  <div class="product-img">
                                                  <img height="115px" width="115px" src="plugins/production/'.$pRow['phaseIcon'].'" alt="Unavailable">
                                                  <div class="pro-img-overlay">';
                                                  if($isFinish==1){
                                                    echo '<button type="button" class="fcbtn btn btn-outline btn-success btn-1f col-md-12" data-toggle="modal" data-target="#myModal" href="production-start-update-forms.php" data-remote="production-start-update-forms.php?id='.$id.'&pID='.$pRow['prodHistID'].' #updateproduction" style="text-align:center;"><span class="glyphicon glyphicon-edit"></span> Update </button>';
                                                    $isFinish = 0;
                                                  }
                                                  if($isFirst==0){
                                                    echo '<button type="button" class="fcbtn btn btn-outline btn-success btn-1f col-md-12" data-toggle="modal" data-target="#myModal" href="production-start-update-forms.php" data-remote="production-start-update-forms.php?id='.$id.'&pID='.$pRow['prodHistID'].' #updateproduction" style="text-align:center;"><span class="glyphicon glyphicon-edit"></span> Update </button>';
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