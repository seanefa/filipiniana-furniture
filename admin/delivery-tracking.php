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
              <button id="tempbtn" class="btn btn-lg btn-info pull-right" data-toggle="modal" data-target="#myModal" href="del-form.php" data-remote="del-form.php?oID #view" aria-expanded="false" style="margin-right: 20px;">View Delivery History</button>
                <li role="presentation" class="active">
                  <a role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs"></span><i class="fa fa-check-square"></i>&nbsp;<?php echo $titlePage?></a>
                </li>
              </ul>
            </h3>
            <div class="tab-content">
              <!-- CATEGORY -->
              <div role="tabpanel" class="tab-pane fade active in" id="modeofpayment">
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">
                    <div class="row">
                      <div class="table-responsive">
                        <table class="table color-bordered-table muted-bordered-table dataTable display nowrap" id="tblCategories">
                          <thead>
                            <tr>
                              <th>Order ID</th>
                              <th>Customer Name</th>
                              <th>Furniture Name</th>
                              <th>Date Release</th>
                              <th>Status</th>
                              <th class="removeSort">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            
                              <?php
                              include "dbconnect.php";
                              $sql = "SELECT * FROM tbldelivery a inner join tblorder_request b on b.order_requestID = a.deliveryOrdReq inner join tblorders c on c.orderID = b.tblOrdersID inner join tblproduct d on d.productID = b.orderProductID  inner join tblcustomer e on e.customerID = c.custOrderID";
                              $result = mysqli_query($conn, $sql);
                              while ($row = mysqli_fetch_assoc($result))
                              {
                                if($row['deliveryRecStatus']=="Active"){
                                  echo('<td>'. $row['orderID'] .'</td>
                                    <td>'.$row['customerLastName'].', '.$row['customerFirstName'].'</td>
                                    <td>'.$row['productName'].'</td>
                                    <td>'.$row['dateOfRelease'].'</td>
                                    <td>'.$row['deliveryStatus'].'</td>
                                    ');?>
                                    <td>
                                      <!-- VIEW -->
                                      <button type="button" class="btn btn-success" data-toggle="modal" href="del-form.php" data-remote="del-form.php?oID=<?php echo $row['order_requestID']?>&amd;smth=<?php echo $row['productID'] ?>&amp;id=<?php echo $row['deliveryID']?> #update" data-target="#myModal">Update</button>
                                    </td>
                                    <?php echo ('</tr>');
                                  }
                                }
                              ?>
                            
                            <script type="text/javascript">
                              function confirmDelete(id) {
                               window.location.href="delete-modeofpayment.php?id="+id+"";
                             }
                             function edit(id){
                              window.location.href="update-modeofpayment.php?id="+id+"";
                            }
                          </script>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- New Framework Mo
            <!-- /.modal -->
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
          $(document).on('hidden.bs.modal', function (e) {
            var target = $(e.target);
            target.removeData('bs.modal')
            .find(".clearable-content").html('');
          });
          </script>
      </div>
    </div>
    </body> 
</html>