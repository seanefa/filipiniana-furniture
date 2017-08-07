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
                <li role="presentation" class>
                  <a aria-controls="order-request.php" role="tab" aria-expanded="false" href="order-request.php"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs"></span><i  class="ti-shopping-cart"></i> Order Request</a>
                </li>
                <li role="presentation" class="active">
                  <a aria-controls="customization-request.php" role="tab" aria-expanded="false" href="customization-request.php"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs"></span><i  class="ti-shopping-cart"></i> <?php echo $titlePage?></a>
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
                                <tr>
                                   <td>2</td>
                                    <td>Dela Cruz, Celia</td>
                                    <td>03-08-2017</td>
                                    <td>3</td>
                                    <td>&#8369; 33,000</td>
                                    <td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal2"><i class="glyphicon glyphicon-eye-open"></i> View</button> <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal3"><i class="glyphicon glyphicon-ok"></i> Accept</button></td>
                                </tr>
                                <tr>
                                   <td>5</td>
                                    <td>Garcia, Amanda</td>
                                    <td>03-10-2017</td>
                                    <td>1</td>
                                    <td>&#8369; 25,000</td>
                                    <td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal4"><i class="glyphicon glyphicon-eye-open"></i> View</button> <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal5"><i class="glyphicon glyphicon-ok"></i> Accept</button></td>
                                </tr>
                            </tbody>
                      </table>
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