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
                include "dbconnect.php";
                $sql = "SELECT * FROM tblproduction a inner join tblorder_request b on b.order_requestID = a.productionOrderReq inner join tblorders c on c.orderID = b.tblOrdersID inner join tblproduct d on d.productID = b.orderProductID";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result))
                {
                  if($row['prodRecordStatus']=="Active"){
                  if($row['orderType']=="Pre-Order"){
                    $name = $row['productName'];
                    echo(' 
                    <ul class="nav customtab2 nav-tabs" role="tablist">
                      <li role="presentation" class="active">
                        <a aria-controls="proorders" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs">Order ID:  '.$row['orderID'] .' </span></a>
                      </li>
                    </ul>
                      '); 
                    }
                  }
                }         
              ?>
            </h3>
              <!-- brochure -->
      <div class="panel-body">
        <div class="orderconfirm">
                     <form action="add-customer.php" method = "post">
                    <div class="row">
                      <div class="descriptions">
                        <div class="form-body">
                          <h2>Customer Information:</h2>
                            <div class="row">

                              <?php
                              $sql = "SELECT * FROM tblcustomer;";
                              $result = mysqli_query($conn, $sql);
                              while ($row = mysqli_fetch_assoc($result))
                              {
                                if($row['customerStatus'] != "Archived"){
                                  echo('
                                   <input type="hidden" id="lstName'.$row['customerID'].'" value="'.$row['customerLastName'].'">
                                   <input type="hidden" id="firstName'.$row['customerID'].'" value="'.$row['customerFirstName'].'">
                                   <input type="hidden" id="midName'.$row['customerID'].'" value="'.$row['customerMiddleName'].'">
                                   <input type="hidden" id="address'.$row['customerID'].'" value="'.$row['customerAddress'].'">
                                   <input type="hidden" id="contact'.$row['customerID'].'" value="'.$row['customerContactNum'].'">
                                   <input type="hidden" id="email'.$row['customerID'].'" value="'.$row['customerEmail'].'">
                                  ');
                                }
                              }
                              ?>

                              <script type="text/javascript">
                                $(document).ready(function(){
                                  $('#thisBtnSucks').removeAttr('href');




                                  $('#savedCustomer').change(function(){
                                    var id = $(this).val();
                                    if(id == 0){
                                      id=+1;
                                    }
                                    if($('#savedCustomer option:selected').text()!=""){
                                      $('#isBool').attr('value','changed');
                                    $('#submitBtn').attr('type',"button");
                                    $('#submitBtn').attr('onclick',"location.href='next1.php';");
                                    $('#customerIds').attr('value',id);

                                    $('#ln').attr('value',$('#lstName'+id+'').val());
                                    $('#ln').html($('#lstName'+id+'').val());
                                    $('#ln').attr('readonly',true);
                                    $('#fn').attr('value',$('#firstName'+id+'').val());
                                    $('#fn').attr('readonly',true);
                                    $('#mn').attr('value',$('#midName'+id+'').val());
                                    $('#mn').attr('readonly',true);
                                    $('#custadd').attr('value',$('#address'+id+'').val());
                                    $('#custadd').attr('readonly',true);
                                    $('#custcont').attr('value',$('#contact'+id+'').val());
                                    $('#custcont').attr('readonly',true);
                                    $('#custemail').attr('value',$('#email'+id+'').val());
                                    $('#custemail').attr('readonly',true);
                                    }
                                    else if($('#savedCustomer option:selected').text() == ""){
                                      $('#customerIds').attr('value',id+1);
                                      $('#submitBtn').attr('type',"submit");
                                      $('#isBool').attr('value','not change');
                                    $('#submitBtn').attr('onclick',"");
                                      $('#ln').attr('value',"");
                                    $('#ln').attr('readonly',false);
                                    $('#fn').attr('value',"");
                                    $('#fn').attr('readonly',false);
                                    $('#mn').attr('value',"");
                                    $('#mn').attr('readonly',false);
                                    $('#custadd').attr('value',"");
                                    $('#custadd').attr('readonly',false);
                                    $('#custcont').attr('value',"");
                                    $('#custcont').attr('readonly',false);
                                    $('#custemail').attr('value',"");
                                    $('#custemail').attr('readonly',false);
                                    }
                                  });
                                });
                              </script>

                            <div class="col-md-4">
                            </div>
                            <div class="col-md-4">
                            </div>
                          </div>
                    <br>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <input type="hidden" name="customerIds" id="customerIds">
                        <label class="control-label">Last Name:</label><span id="x" style="color:red"> *</span>
                        <input type="text" id="ln" class="form-control" name="lastn" value="" required/>
                      </div>
                    </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label">First Name:</label><span id="x" style="color:red"> *</span>
                          <input type="text" id="fn" class="form-control" name="firstn" required/> 
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label">Middle Name:</label>
                          <input type="text" id="mn" class="form-control" name="midn"/> 
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                      <div class="form-group">
                        <label class="control-label">Address</label><span id="x" style="color:red"> *</span>
                        <input type="text" id="custadd" class="form-control" name="custoadd" required/>
                      </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label">Contact number</label><span id="x" style="color:red"> *</span>
                          <input type="number" id="custcont" class="form-control" name="custocont" required/>
                        </div>
                      </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label">Email</label><span id="x" style="color:red"> *</span>
                            <input type="email" id="custemail" class="form-control" name="custoemail" required/> 
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

              <div class="row">
                <div class="descriptions">
                <h2>Payment Information:</h2>
                  <div class="col-md-12">
                    <div class="row">
                        <div class="table-responsive">
                          <table class="table display nowrap" id="tblProducts">
                            <thead>
                              <tr>
                                <th style="text-align: left;"></th>
                                <th style="text-align: left;"></th>
                                <th style="text-align: left;"></th>
                                <th style="text-align: left;"></th>                         
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
                              </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                  </div>
                </div>
              </div>  

               <div class="row">
                <div class="descriptions">
                <h2>Order Information:</h2>
                  <div class="col-md-12">
                    <div class="panel panel-info" style="margin-top: -20px;">
                <div class="tab-content thumbnail">
              <!-- CATEGORY -->
              <div role="tabpanel" class="tab-pane fade active in" id="job">
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="col-md-6">
                          <h2 style="margin-top: -20px;">FURNITURE NAME</h2>
                        </div>
                        <div class="col-md-6">
                          <h2 class="pull-right" style="margin-top: -20px;"><a data-toggle="modal" data-target="#myModal" href="production-forms.php" data-remote="production-forms.php #history"><i class="ti-list pull-right" style="margin-left: 20px;"></i></a> STATUS </h2>

                          <h2></h2>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-12">
                     <div class="panel panel-info" style="margin-top: -20px;">
                      <div class="tab-content thumbnail">
                    <!-- CATEGORY -->
                    <div role="tabpanel" class="tab-pane fade active in" id="job">
                      <div class="panel-wrapper collapse in" aria-expanded="true">
                        <div class="panel-body">
                            <div class="row">
                              <div class="col-md-12">
                                <div class="col-md-2" style="margin-right:27px;">
                                  <div class="panel panel-info" style="margin-top: -20px;">
                                    <div class="tab-content thumbnail">
                                  <!-- CATEGORY -->
                                  <div role="tabpanel" class="tab-pane fade active in" id="job">
                                    <div class="panel-wrapper collapse in" aria-expanded="true">
                                      <div class="panel-body">

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
                                 <div class="col-md-2" style="margin-right:27px;">
                                  <div class="panel panel-info" style="margin-top: -20px;">
                                    <div class="tab-content thumbnail">
                                  <!-- CATEGORY -->
                                  <div role="tabpanel" class="tab-pane fade active in" id="job">
                                    <div class="panel-wrapper collapse in" aria-expanded="true">
                                      <div class="panel-body">

                                         </div>

                                         </div>
                                      </div>
                                      </div>
                                      <h4 style="text-align:center;">STATUS</h4>
                                      <div class="row">
                                      <div class="col-md-2" style="margin-left:22px;">
                                      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal" href="production-start-update-forms.php" data-remote="production-start-update-forms.php #startproduction"><span class="glyphicon glyphicon-edit"></span> Start</button>
                                    </div>
                                  </div>
                                    </div>
                                </div>
                                 <div class="col-md-2" style="margin-right:27px;">
                                  <div class="panel panel-info" style="margin-top: -20px;">
                                    <div class="tab-content thumbnail">
                                  <!-- CATEGORY -->
                                  <div role="tabpanel" class="tab-pane fade active in" id="job">
                                    <div class="panel-wrapper collapse in" aria-expanded="true">
                                      <div class="panel-body">

                                         </div>

                                         </div>
                                      </div>
                                      </div>
                                      <h4 style="text-align:center;">STATUS</h4>
                                      <div class="row">
                                      <div class="col-md-2" style="margin-left:22px;">
                                      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal" href="production-start-update-forms.php" data-remote="production-start-update-forms.php #startproduction" ><span class="glyphicon glyphicon-edit"></span> Start</button>
                                    </div>
                                  </div>
                                    </div>
                                </div>
                                 <div class="col-md-2" style="margin-right:27px;">
                                  <div class="panel panel-info" style="margin-top: -20px;">
                                    <div class="tab-content thumbnail">
                                  <!-- CATEGORY -->
                                  <div role="tabpanel" class="tab-pane fade active in" id="job">
                                    <div class="panel-wrapper collapse in" aria-expanded="true">
                                      <div class="panel-body">

                                         </div>

                                         </div>
                                      </div>
                                      </div>
                                      <h4 style="text-align:center;">STATUS</h4>
                                      <div class="row">
                                      <div class="col-md-2" style="margin-left:22px;">
                                      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal" href="production-start-update-forms.php" data-remote="production-start-update-forms.php #startproduction"><span class="glyphicon glyphicon-edit"></span> Start</button>
                                    </div>
                                  </div>
                                    </div>
                                </div>
                                <div class="col-md-2" style="margin-right:27px;">
                                  <div class="panel panel-info" style="margin-top: -20px;">
                                    <div class="tab-content thumbnail">
                                  <!-- CATEGORY -->
                                  <div role="tabpanel" class="tab-pane fade active in" id="job">
                                    <div class="panel-wrapper collapse in" aria-expanded="true">
                                      <div class="panel-body">

                                         </div>

                                         </div>
                                      </div>
                                      </div>
                                      <h4 style="text-align:center;">STATUS</h4>
                                      <div class="row">
                                      <div class="col-md-2" style="margin-left:22px;">
                                      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal" href="production-start-update-forms.php" data-remote="production-start-update-forms.php #startproduction"><span class="glyphicon glyphicon-edit"></span> Start</button>
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