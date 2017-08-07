<?php
include "titleHeader.php";
include "menu.php";
session_start();
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
  <!-- Preloader -->
  <div id="page-wrapper">
    <div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
          <div class="panel panel-info">
            <!-- nav start -->
            <h3>
              <ul class="nav customtab2 nav-tabs" role="tablist">
                <li role="presentation" class>
                  <a aria-controls="order-management.php" role="tab" aria-expanded="false" href="order-management.php"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs"></span><i  class="ti-shopping-cart"></i> Order Management</a>
                </li>
                <li role="presentation" class="active">
                  <a aria-controls="order-request.php" role="tab" aria-expanded="false" href="order-request.php"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs"></span><i  class="ti-shopping-cart"></i> <?php echo $titlePage?></a>
                </li>
                <li role="presentation" class>
                  <a aria-controls="customization-request.php" role="tab" aria-expanded="false" href="customization-request.php"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs"></span><i  class="ti-shopping-cart"></i> Customization Request</a>
                </li>
              </ul>
            </h3>
            <!-- nav end -->
            <div class="row">
              <div class="col-md-12">
                
            <div class="tab-content">
              <!-- brochure -->
              <div role="tabpanel" class="tab-pane fade active in" id="allprod">
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">
                        <div class="table-responsive">
                        <table class="table color-bordered-table muted-bordered-table dataTable display nowrap" id="tblCategories">
                            <thead>
                                <tr>
                                    <th style="text-align: center;">Order ID</th>
                                    <th style="text-align: center;">Customer Name</th>
                                    <th style="text-align: center;">Request Date</th>
                                    <th style="text-align: center;">Total Quantity</th>
                                    <th style="text-align: center;">Total Price</th>
                                    <th style="text-align: center;">Actions</th>
                                </tr>
                            </thead>
                            <tbody style="text-align:center;">
                                <?php
                      include "dbconnect.php";
                     
                                // Create connection
                      $conn = mysqli_connect($servername, $username, $password, $dbname);
                                // Check connection
                      if (!$conn) {
                        die("Connection failed: " . mysqli_connect_error());
                      }

                      $sql = "SELECT * FROM tblorder_request order by order_requestID desc;";
                      $result = mysqli_query($conn, $sql);
                      if($result){
                        while ($row = mysqli_fetch_assoc($result))
                        {

                          $count_prod = pCount($row['order_requestID']);
                          $get_date = getDate($row['order_requestID']);
                           echo ('
                            <tr>
                                   <td>'.$row['order_requestID'].'</td>
                                    <td>'.$get_name.'</td>
                                    <td>'.$get_date.'</td>
                                    <td>'.$count_prod.'</td>
                                    <td>&#8369; 33,000</td>
                                    <td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal2"><i class="glyphicon glyphicon-eye-open"></i> View</button> <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal3"><i class="glyphicon glyphicon-ok"></i> Accept</button></td>
                                </tr>
                            ');
                            }     
                            }
                             function pCount($id){
                                  include "dbconnect.php";
                                  $cnt = 0;
                                  $sql = "SELECT COUNT(*) AS NO FROM tblorder_request WHERE order_requestID='$id'";
                                  $result = mysqli_query($conn,$sql);
                                  while($row = mysqli_fetch_assoc($result)){
                                    $cnt = $row['NO'];
                                  }
                                  return $cnt;
                                }
                                function getDate($id){
                                  include "dbconnect.php";
                                 
                                  $sql = "SELECT 'dateOfRecieved' FROM tblorders WHERE orderID='$id'";
                                  $result = mysqli_query($conn,$sql);
                                  $row = mysqli_fetch_assoc($result)
                                  return $row;
                                }
                                function getName($id){
                                  include "dbconnect.php";
                                 
                                  $sql = "SELECT * FROM tblcustomer WHERE customerID='$id'";
                                  $result = mysqli_query($conn,$sql);
                                  $row = mysqli_fetch_assoc($result)
                                  $name = $row['customerLastName'].','.$row['customerFirstName'].'  '.$row['customerMiddleName'];
                                  return $name;
                                }               
                            ?> 
                            </tbody>
                      </table>
                    </div> <!-- table class res -->
                    </div> <!-- panel body -->
                </div> <!-- panel wrapper -->
              </div> <!-- tab panel -->
          </div> <!-- tab -->
          </div> <!-- col inside -->
            </div> <!-- row inside panel -->
          </div> <!-- panel info -->

     <!-- col sub2 --> 
       <!-- row sub2 -->
      
      </div> <!-- col1 -->
    </div> <!-- row -->
        <div id="myModal1" class="modal fade" role="dialog " aria-hidden="true" style="display: none;" tabindex="-1">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 class="modal-title">Message</h3>
          </div>
            <!-- Modal content -->
            <div class="modal-content">
            <div class="modal-body">
              <h2 style="text-align:center;"> Successfully added to cart!<br>
              </h2>
              <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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