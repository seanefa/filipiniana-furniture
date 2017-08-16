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
              ?>

              <ul class="nav customtab2 nav-tabs" role="tablist">
                <li role="presentation" class="active">
                  <a aria-controls="proorders" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs"><?php echo $orderID?></span></a>
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

                        <div class="row">
                          <div class="descriptions">
                            <h2>Order Information:</h2>
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
                              <div class="col-md-6">
                              <h2 class="pull-right" style="margin-top: -20px;"><a data-toggle="modal" data-target="#myModal" href="production-forms.php" data-remote="production-forms.php #history"><i class="ti-list pull-right" style="margin-left: 20px;"></i></a>Production History</h2>

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
                                                    echo '<div class="col-md-2" style="margin-right:27px;">
                                                <div class="panel panel-info" style="margin-top: -20px;">
                                                  <h4 style="text-align:center;">'.$pRow['phaseName'].'</h4>
                                                  <div class="tab-content thumbnail">
                                                    <div role="tabpanel" class="tab-pane fade active in" id="job">
                                                      <div class="panel-wrapper collapse in" aria-expanded="true">
                                                        <div class="panel-body">
                                                          <img height="115px" style="filter:gray; -webkit-filter: grayscale(1); filter: grayscale(1);" src="plugins/production/'.$pRow['phaseIcon'].'" alt="Unavailable">
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                  <h4 style="text-align:center; background-color:orange; color:white">'.$pRow['prodStatus'].'</h4>
                                                  <div class="row">
                                                    <div class="col-md-2" style="margin-left:14px;">';
                                                    if($isFinish==1){
                                                      echo '<button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal" href="production-start-update-forms.php" data-remote="production-start-update-forms.php?id='.$id.'&pID='.$pRow['prodHistID'].' #startproduction" style="text-align:center;"><span class="glyphicon glyphicon-edit"></span> Start </button>';
                                                      }
                                                      if($isFirst==0){
                                                      echo '<button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal" href="production-start-update-forms.php" data-remote="production-start-update-forms.php?id='.$id.'&pID='.$pRow['prodHistID'].' #startproduction" style="text-align:center;"><span class="glyphicon glyphicon-edit"></span> Start </button>';
                                                      $isFirst = 1;
                                                      }
                                                    echo '</div>
                                                  </div>
                                                </div>
                                              </div>';
                                              $isFinish = 0;
                                                }

                                                if($pRow['prodStatus']=="Finished"){
                                                  $isFinish = 1;
                                                  echo '<div class="col-md-2" style="margin-right:27px;">
                                                <div class="panel panel-info" style="margin-top: -20px;">
                                                  <h4 style="text-align:center;">'.$pRow['phaseName'].'</h4>
                                                  <div class="tab-content thumbnail">
                                                    <div role="tabpanel" class="tab-pane fade active in" id="job">
                                                      <div class="panel-wrapper collapse in" aria-expanded="true">
                                                        <div class="panel-body">
                                                          <img height="115px" src="plugins/production/'.$pRow['phaseIcon'].'" alt="Unavailable">
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div><h4 style="text-align:center; background-color:green; color:white">'.$pRow['prodStatus'].'</h4>
                                                  <div class="row">
                                                    <div class="col-md-2" style="margin-left:14px;">
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>';
                                                }

                                                if($pRow['prodStatus']=="Ongoing"){
                                                  echo '<div class="col-md-2" style="margin-right:27px;">
                                                <div class="panel panel-info" style="margin-top: -20px;">
                                                  <h4 style="text-align:center;">'.$pRow['phaseName'].'</h4>
                                                  <div class="tab-content thumbnail">
                                                    <div role="tabpanel" class="tab-pane fade active in" id="job">
                                                      <div class="panel-wrapper collapse in" aria-expanded="true">
                                                        <div class="panel-body">
                                                          <img height="115px" src="plugins/production/'.$pRow['phaseIcon'].'" alt="Unavailable">
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                  <h4 style="text-align:center; background-color:green; color:white">'.$pRow['prodStatus'].'</h4>
                                                  <div class="row">
                                                    <div class="col-md-2" style="margin-left:14px;">';
                                                    if($isFinish==1){
                                                      echo '<button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal" href="production-start-update-forms.php" data-remote="production-start-update-forms.php?id='.$id.'&pID='.$pRow['prodHistID'].' #startproduction" style="text-align:center;"><span class="glyphicon glyphicon-edit"></span> Update </button>';
                                                    }
                                                    echo '</div>
                                                  </div>
                                                </div>
                                              </div>';
                                              $isFirst = 1;
                                              $isFinish = 0;
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
  <div class="modal-dialog">
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