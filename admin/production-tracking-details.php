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
                            include "dbconnect.php";
                            $sql = "SELECT * from tblorder_request a, tblproduct b WHERE a.orderProductID = b.productID and a.orderRequestStatus!='Archived' and a.tblOrdersID = '$id'";
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
                              <h2 class="pull-right" style="margin-top: -20px;"><a data-toggle="modal" data-target="#myModal" href="production-forms.php" data-remote="production-forms.php #history"><i class="ti-list pull-right" style="margin-left: 20px;"></i></a> STATUS </h2>

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
                                              
                                              ?>
                                              <div class="col-md-2" style="margin-right:27px;">
                                                <div class="panel panel-info" style="margin-top: -20px;">
                                                  <div class="tab-content thumbnail">
                                                    <div role="tabpanel" class="tab-pane fade active in" id="job">
                                                      <div class="panel-wrapper collapse in" aria-expanded="true">
                                                        <div class="panel-body">
                                                          <img height="115px" src="plugins/production/brush.png" alt="Unavailable">
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                  <h4 style="text-align:center;">STATUS</h4>
                                                  <div class="row">
                                                    <div class="col-md-2" style="margin-left:14px;">
                                                      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal" href="production-start-update-forms.php" data-remote="production-start-update-forms.php #updateproduction" style="text-align:center;"><span class="glyphicon glyphicon-edit"></span> Update</button>
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