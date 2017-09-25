<?php
$activePage = basename($_SERVER['PHP_SELF'],".php");
include "menu.php";
//session_start();

if(isset($_GET['id'])){
  $jsID = $_GET['id']; 
}
/*else{
echo "<script>
window.location.href='delivery-tracking.php';
alert('You have no access here');
</script>";
}*/
//$_SESSION['varname'] = 3;
include 'dbconnect.php';
?>
<!DOCTYPE html>  
<html lang="en">
<head>
  <script>
  $(document).ready(function(){ //ON LOAD
    var value = $("#order").val();
    $.ajax({
      type: 'post',
      url: 're-order-info.php',
      data: {
        id: value,
      },
      success: function (response) {
        $( '#ordersTbl' ).html(response);
      }
    });
    $.ajax({
      type: 'post',
      url: 're-order-out.php',
      data: {
        id: value,
      },
      success: function (response) {
        $( '#orderReqs' ).html(response);
      }
    });
  });

  $(document).ready(function(){//change ng order
    $('#order').change(function(){
      var value = $("#order").val();
      $.ajax({
        type: 'post',
        url: 're-order-info.php',
        data: {
          id: value,
        },
        success: function (response) {
          $( '#ordersTbl' ).html(response);
        }
      });
      $.ajax({
        type: 'post',
        url: 're-order-out.php',
        data: {
          id: value,
        },
        success: function (response) {
          $( '#orderReqs' ).html(response);
        }
      });
    });
  });


  $(document).ajaxStop(function(){

  });

  $(document).ready(function(){
    $("#order").select2();
  });

  </script>

  <title>New Release</title>
  <link rel="icon" type="image/x-icon" sizes="16x16" href="plugins/images/favicon.ico">
</head>

<body class ="fix-header fix-sidebar">
  <div id="page-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
          <div class="panel panel-info">
            <h3>
              <ul class="nav customtab2 nav-tabs" role="tablist">
                <li role="presentation" class="active">
                  <a aria-controls="proorders" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs">New Return</span></a>
                </li>
              </ul>
            </h3>
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane fade active in">
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <form action="save-new-return.php" method="post">
                    <div class="panel-body">
                      <div class="row" style="margin-top: -30px;">
                        <div class="col-md-6">
                          <!-- <div class="row">
                            <div class="form-group">
                              <label class="control-label" style="text-align: left;">Sort by:</label>
                              <select class="form-control" data-placeholder="Choose a Fabric" tabindex="1" name="sort" id="sort" style="text-align:right">
                                <option value="order">Order ID</option>
                                <option value="name">Customer Name</option>
                                <option value="name">Customer Name</option>
                              </select>
                            </div>
                          </div> -->
                          <div class="form-group">
                            <h2 class="control-label" style="text-align: left;">Select an Order:</h2>
                            <select class="form-control" data-placeholder="Choose a Fabric" tabindex="1" name="order" id="order" style="text-align:right">
                              <?php
                              include "dbconnect.php";
                              $sql = "SELECT * FROM tblcustomer a, tblorders b WHERE a.customerID = b.custOrderID and b.orderStatus ='Finished' ORDER BY orderID;";
                              $result = mysqli_query($conn,$sql);
                              while ($row = mysqli_fetch_assoc($result))
                              {
                                if($row['orderStatus']!='Archived'){
                                  $orderID = str_pad($row['orderID'], 6, '0', STR_PAD_LEFT);
                                  $orderID = "OR" . $orderID;
                                  echo('<option value='.$row['orderID'].' >'.$orderID.'  -  '.$row['customerLastName'].' '.$row['customerFirstName'].' '.$row['customerMiddleName'].'</option>');
                                }
                              }
                              ?>
                            </select>
                          </div>

                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <div id="ordersTbl">
                                </div>
                              </div>
                            </div>
                          </div>



                        </div>


                        <div class="col-md-6" > 
                          <div class="panel-body blue-gradient">
                            <h2 style="text-align:center">RETURN INFORMATION</h2>
                            <hr>
                            <div class="row">
                              <div class="col-md-12">
                                <div class="form-group">
                                  <h5 class="control-label" style="text-align: left;">Order Inclusions:</h5>
                                  <select class="form-control" data-placeholder="Choose a Fabric" tabindex="1" name="orderReqs" id="orderReqs">
                                  </select>
                                </div>
                              </div>
                            </div>
                            <?php
                            $date = new DateTime();
                            $date = date_format($date, "Y-m-d");
                            ?>
                            <div class="row">
                              <div class="col-md-12">
                                <div class="form-group">
                                  <h5 class="control-label" style="text-align: left;">Date Returned</h5>
                                  <input type="date" id="reDate" class="form-control" name="reDate" value="<?php echo $date?>"/>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-12">
                                <div class="form-group">
                                  <h5 class="control-label" style="text-align: left;">Reason</h5>
                                  <textarea name="reasons" class="form-control" rows="4"></textarea>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-12">
                                <div class="form-group">
                                  <h4><b>   Assessment  </b>
                                    <label class="radio-inline"><input type="radio" id="replace" name="assessment" value="Replace"/>  Replace</label>
                                    <label class="radio-inline"><input type="radio" id="repair" name="assessment" value="Repair"/>   Repair</label></h4>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <h5 class="control-label" style="text-align: left;">Estimated Release Date:</h5>
                                    <input type="date" id="estDate" class="form-control" name="estDate" value="<?php echo $date?>"/>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <h5 class="control-label" style="text-align: left;">Remarks</h5>
                                    <textarea name="remarks" class="form-control" rows="4"></textarea>
                                  </div>
                                </div>
                              </div>
                                <!-- <div class="row">
                                  <div id="orderReqs"></div>
                                </div> -->
                                <div class="row" style="margin:10px">
                                  <button data-wizard="finish" type="submit" class="btn btn-success waves-effect pull-right" id="saveBtn"><i class="fa fa-check"></i> Save</button>
                                </div>
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
          </body> 

          <script type="text/javascript">
          (function(){
            $('#accordion').wizard({
              step: '[data-toggle="collapse"]',
              buttonsAppendTo: '.panel-collapse',
              templates: {
                buttons: function(){
                  var options = this.options;
                  return '<div class="panel-footer"><ul class="pager">' +
                  '<button data-wizard="finish" type="submit" class="btn btn-success waves-effect pull-right" id="addFab"><i class="fa fa-check"></i> Save</button>' +
                  '</div>';
                }
              },
              onFinish: function(){
                window.location.href = 'receipt.php?id='+id;
              }
            });
          })();
          </script>
          </html>