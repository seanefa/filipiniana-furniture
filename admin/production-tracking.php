<?php
include "titleHeader.php";
include "menu.php";
//session_start();
/*if(isset($GET['id'])){
   $jsID = $_GET['id']; 
 }
 $jsID=$_GET['id'];
 $_SESSION['varname'] = $jsID;*/
 include 'dbconnect.php';
 $conn = mysqli_connect($servername, $username, $password, $dbname);
          // Check connection
 if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>
<!DOCTYPE html>  
<html lang="en">
<head>
</head>
<body class ="fix-header fix-sidebar">
  <div id="page-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
          <div class="panel panel-info">
            <h3>
              <ul class="nav customtab2 nav-tabs" role="tablist">
                <button id="tempbtn" class="btn btn-lg btn-info pull-right" data-toggle="modal" data-target="#myModal" href="production-forms.php" data-remote="production-forms.php #new" aria-expanded="false" style="margin-right: 20px;"><span class="btn-label"><i class="ti-plus"></i></span>New</button>
                <li role="presentation" class="active">
                  <a role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs"></span><i class="fa fa-check-square-o"></i>&nbsp;<?php echo $titlePage?></a>
                </li>
              </ul>
            </h3>

            <div class="tab-content">
              <!-- CATEGORY -->
              <div role="tabpanel" class="tab-pane fade active in" id="type">
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">
                    <form id="myForm" method="post">
                      <div class="col-md-12">
                        
                        <div class="tab-content">
                          <!-- brochure -->
                          <div role="tabpanel" class="tab-pane fade active in" id="allprod">
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                              <div class="panel-body">
                                  <div class="row" style="margin: 0 auto; margin-top: -120px;">
                                  <div style="margin: 0 auto;">
                                      <input type="text" id="my-input-field" class="form-control navbar-form navbar-right" placeholder="&#128269; Search..." size="30" style="margin-top: 35px; margin-bottom: 35px;">
                                  </div>
                                  </div>

                                  <div class="row" id="allprod">
                                  <div id="thisIsCart">
                                  </div>

                                  <div class="row formScroll" id = "tblProd">
                                    <?php
                                      include "dbconnect.php";
                                      //$sql = "SELECT * FROM tblproduction a inner join tblorder_request b on b.order_requestID = a.productionOrderReq inner join tblorders c on c.orderID = b.tblOrdersID inner join tblproduct d on d.productID = b.orderProductID";
                                      $sql = "SELECT * FROM tblorders WHERE orderStatus!='Ready for release' AND orderStatus!='Archived' AND orderStatus!='Rejected' AND orderStatus!='finished' order by orderID;";
                                      $result = mysqli_query($conn, $sql);
                                      while ($row = mysqli_fetch_assoc($result))
                                      {
                                        if($row['orderType']=="Pre-Order"){
                                          $orderID = "OR" . str_pad($row['orderID'], 6, '0', STR_PAD_LEFT);
                                          $production = production($row['orderID']);
                                          echo(' 
                                          <form method="get" id="">
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                              <div class="thumbnail instafilta-target">
                                              <h4 style="text-align:center; font-weight: bolder; font-family: inherit">'.$orderID .'</h4>
                                              <hr>
                                                <div class="product-img">
                                                <img height="115px" src="plugins/images/furnitureicon.png" alt="Unavailable">');
                                            if($row['orderStatus']=='Pending'){
                                              echo ('<div class="pro-img-overlay">
                                                    <a class="btn btn-primary" href="production-start.php?id='.$row['orderID'].'" style="font-family:inherit; margin-top:25px; color:white;">Start Production</a><input type="hidden" id="idBtn" value="'.$row['orderID'].'"/> 
                                                  </div>
                                                </div>');
                                            }
                                            else{
                                                  echo ('<div class="pro-img-overlay">
                                                    <a class="btn btn-primary" href="production-tracking-details.php?id='.$row['orderID'].'" style="font-family:inherit; margin-top:25px; color:white;">View Details</a><input type="hidden" id="idBtn" value="'.$row['orderID'].'"/>  
                                                  </div>
                                                </div>');
                                                }
                                                if($row['orderStatus']=="Ongoing"){
                                                  echo '<div class="progress progress-lg" style="margin-top:15px;">
                                                          <h3 class="progress-bar progress-bar-info active progress-bar-striped" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%; font-family:system-ui;" role="progressbar">'.$row['orderStatus'].'<br>'.$production.'</h3>
                                                        </div>';
                                                }
                                                if($row['orderStatus']=="Cancelled"){
                                                  echo '<div class="progress progress-lg" style="margin-top:15px;">
                                                          <h3 class="progress-bar progress-bar-danger active progress-bar-striped" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%; font-family:system-ui;" role="progressbar">'.$row['orderStatus'].'<br>'.$production.'</h3>
                                                        </div>';
                                                }
                                                if($row['orderStatus']=="Pending"){
                                                  echo '<div class="progress progress-lg" style="margin-top:15px;">
                                                          <h3 class="progress-bar progress-bar-warning active progress-bar-striped" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%; font-family:system-ui;" role="progressbar">'.$row['orderStatus'].'<br>'.$production.'</h3>
                                                        </div>';
                                                }
                                                echo ('                                                 
                                                </div>
                                              </div>
                                            </form>
                                            '); 
                                        }
                                      }   
                                      function production($id){
                                        include "dbconnect.php";
                                        $rowCount = 0;
                                        $sql = "SELECT * from tblorder_request WHERE orderRequestStatus!='Archived' and tblOrdersID = '$id'";
                                        $res = mysqli_query($conn,$sql);
                                        $rowCount = mysqli_num_rows($res);

                                        $finProduction = 0;
                                        $sql = "SELECT * FROM tblproduction a, tblorder_request b WHERE a.productionOrderReq = b.order_requestID and b.tblOrdersID = '$id';";
                                        $res = mysqli_query($conn,$sql);
                                        while($row = mysqli_fetch_assoc($res)){
                                          if($row['productionStatus']=='Finished'){
                                            $finProduction++;
                                          }
                                        }
                                        $output = $finProduction . " finished out of " . $rowCount;
                                        return($output);
                                      }      
                                    ?> 
                                  </div>
                                  </div>

                              </div> <!-- panel body -->
                            </div> <!-- panel wrapper -->
                          </div> <!-- tab panel -->
                        </div> <!-- tab-content -->
                      </div> <!-- col inside -->
                    </form>
                  </div>
                </div>
              </div>
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
            <!-- Modal content -->
            <div class="modal-content clearable-content">
            <div class="modal-body">

            </div>
            </div>
          </div>
          </div>
        </div>

        <script>
          $(document).ready(function () {
            $('#my-input-field').instaFilta();
          });
        </script>

        <script type="text/javascript">
            $('#DetailsButton').click(function(e) {
                e.preventDefault(); e.stopPropagation();
                window.location.href = $(e.currentTarget).data().href;
            });
        </script>

        <script>
          $(document).on('hidden.bs.modal', function (e) {
            var target = $(e.target);
            target.removeData('bs.modal')
            .find(".clearable-content").html('');
          });
          </script>

          <script>
            $(document).ready(function () {
              $('.formScroll').slimScroll({
                height: '832px',
                size: '8px',
                wheelStep: 3,
                railVisible: true
              });
            });
          </script>
      </div>
    </div>
    </body> 
</html>