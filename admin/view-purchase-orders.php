<?php
$activePage = basename($_SERVER['PHP_SELF'],".php");
include "menu.php";
//session_start();
/*
if(isset($_GET['customerId'])){
   $jsID = $_GET['customId']; 
 }*/
 //$_SESSION['varname'] = 3;
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
  <title>Order Management</title>
  <link rel="icon" type="image/x-icon" sizes="16x16" href="plugins/logo/favicon.ico">
</head>
<body class ="fix-header fix-sidebar">
  <!-- Preloader -->
  <div id="page-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
          <div class="panel panel-info">
            <h3>
              <ul class="nav customtab2 nav-tabs" role="tablist">
                <li role="presentation" class="active">
                  <a aria-controls="proorders" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs">View P.O's</span></a>
                </li>
              </ul>
            </h3>
              <!-- brochure -->
      <div class="panel-body">
        <div class="orderconfirm">

              <div class="row">
                <div class="descriptions">
                  <div class="col-md-12">
                    <div class="row">
                        <div class="table-responsive">
                          <table class="table color-bordered-table muted-bordered-table dataTable display nowrap" id="tblProducts">
                            <thead>
                              <tr>
                                <th style="text-align: left;">P.O ID</th>
                                <th style="text-align: left;">Date Created</th>
                                <th style="text-align: left;">Supplier</th>
                                <th style="text-align: left;">Quantity</th> 
                                <th style="text-align: left;">Action</th>                         
                              </thead>
                              <tbody  id="tb_row" style="text-align: left;">
                              <tr>
                                <td>
                                  
                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>
                                  <button type="button" class="btn btn-warning" data-toggle="modal" href="purchase-orders-forms.php" data-remote="purchase-orders-forms.php #viewPO" data-target="#myModal"><span class='glyphicon glyphicon-eye-open'></span> View</button>
                                </td>
                              </tr>
                              </tbody>
                            </table>
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