<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link href="image/favicon.ico" rel="icon" />
  <link rel="stylesheet" href="css/myStyle.css">
  <title>Profile - Filipiniana Furniture Shop</title>
  <meta name="description" content="Furniture shop">
  <script type="text/javascript" src="js/myScript.js"></script>
  <?php include"css.php";?>
</head>
<body style="background: #ffffff;">
  <?php 
  include "header.php";
  if(!isset($_SESSION["userID"]))
  {
    echo "<script>
    window.location.href='login.php';
    alert('You have no access here. You must logged in first.');
    </script>";
  }
  ?>
  <div id="container">
    <div class="container">
      <ul class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-home"></i></a></li>
        <li><a href="production.php">Production</a></li>
      </ul>
      <br>
      <div class="row">
        <?php include "accountmenu.php"; ?>
        <!--Middle Part Start-->
        <div class="col-sm-9" id="content">
          <h2>Production</h2>
          <div class="row">
            <div class="col-sm-12">
              <div class="well">
                <div class="row">
                         <div class="col-md-12">
                          <div class="descriptions">
                            <h2>Order Information</h2>
                            <?php
                            $isFinish = 0;
                            include "userconnect.php";
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
                                              $ordReqID = $row['order_requestID'];
                                              
                                              $pSQL = "SELECT * FROM tblproduction_phase a, tblproduction b, tblorder_request c, tblphases d WHERE b.productionID = a.prodID and a.prodPhase = d.phaseID and b.productionOrderReq = c.order_requestID and c.order_requestID = '$ordReqID';";
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
                      <?php
          } //end ng while sa order reqs
          ?>
                
              </div>
            </div>
          </div>
        </div>
        <!--Middle Part End -->
      </div>
    </div>
  </div>
  <?php include"footer.php";?>
  <!--img src="pics/userpictures/<?php echo "" . $row["customerDP"];?>" style="height:150px; width:150px;" alt="Product" class="img-responsive profilepic"/-->
  <?php include "scripts.php";?>
</body>
</html>