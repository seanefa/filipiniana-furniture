 <?php
 $id = $_POST['id'];
 $isFinish = 0;
 include "userconnect.php";
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

                              echo '<h2 class="pull-right" style="margin-top: -20px;"><button data-toggle="modal" data-target="#myModal" href="production-start-update-forms.php" data-remote="production-start-update-forms.php?id='.$id.'&pID='.$row['productionID'].' #history"><i class="ti-menu-alt pull-right" style="margin-left: 20px; margin-top:5px;"></i>Production History</h2></button>
                              </div>
                              </div>
                            </div>';

                           echo' <div class="row">
                              <div class="col-md-12">
                                <div class="panel panel-info" style="margin-top: -20px;">
                                  <div class="tab-content thumbnail">
                                    <div role="tabpanel" class="tab-pane fade active in" id="job">
                                      <div class="panel-wrapper collapse in" aria-expanded="true">
                                        <div class="panel-body">
                                          <div class="row">
                                            <div class="col-md-12">';
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
                                                  <div class="pro-img-overlay">
                                                  </div>
                                                  </div>
                                                  <div class="progress progress-md" style="margin-top:15px;">
                                                  <h3 class="progress-bar progress-bar-warning active progress-bar-striped" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%; font-family:system-ui;" role="progressbar">'.$pRow['prodStatus'].'</h3>
                                                  </div>
                                                  </div>';
                                                }

                                                if($pRow['prodStatus']=="Finished"){
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
                                                  <div class="pro-img-overlay"></div>
                                                  </div>
                                                  </div>
                                                  <div class="progress progress-md" style="margin-top:15px;">
                                                  <h3 class="progress-bar progress-bar-info active progress-bar-striped" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%; font-family:system-ui;" role="progressbar">'.$pRow['prodStatus'].'</h3>
                                                  </div>
                                                  </div>';
                                                }
                                              }
echo '
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
          </div>';
          } //end ng while sa order reqs
          $isFinish = 0;
          include "userconnect.php";
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
                            </div>';

                            echo '<div class="row">
                              <div class="col-md-12">
                                <div class="panel panel-info" style="margin-top: -20px;">
                                  <div class="tab-content thumbnail">
                                    <div role="tabpanel" class="tab-pane fade active in" id="job">
                                      <div class="panel-wrapper collapse in" aria-expanded="true">
                                        <div class="panel-body">
                                          <div class="row">
                                            <div class="col-md-12">';
                                              include "userconnect.php";
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
                                                  <div class="pro-img-overlay"></div>
                                                  </div>
                                                  </div>
                                                  <div class="progress progress-md" style="margin-top:15px;">
                                                  <h3 class="progress-bar progress-bar-warning active progress-bar-striped" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%; font-family:system-ui;" role="progressbar">'.$pRow['prodStatus'].'</h3>
                                                  </div>
                                                  </div>';
                                                }

                                                if($pRow['prodStatus']=="Finished"){
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
                                                  <div class="pro-img-overlay"></div>
                                                  </div>
                                                  </div>
                                                  <div class="progress progress-md" style="margin-top:15px;">
                                                  <h3 class="progress-bar progress-bar-info active progress-bar-striped" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%; font-family:system-ui;" role="progressbar">'.$pRow['prodStatus'].'</h3>
                                                  </div>
                                                  </div>';
                                                }
                                                
                                              }

                                            echo '</div>
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
          </div>';
          } //end ng while sa order reqs
        echo '</div>
      </div>
    </div>';
    ?>