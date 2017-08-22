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

  $(document).ready(function(){
    var value = $("#order").val();
    $.ajax({
      type: 'post',
      url: 'del-orders-out.php',
      data: {
        id: value,
      },
      success: function (response) {
        $( '#ordersTbl' ).html(response);
      }
    });
    $.ajax({
      type: 'post',
      url: 'del-info-out.php',
      data: {
        id: value,
      },
      success: function (response) {
        $( '#delInfo' ).html(response);
      }
    });
  });

  $(document).ready(function(){
    $('#order').change(function() {
      var value = $("#order").val();
      $.ajax({
        type: 'post',
        url: 'del-orders-out.php',
        data: {
          id: value,
        },
        success: function (response) {
          $( '#ordersTbl' ).html(response);
        }
      });
    });
  });

  $(document).ready(function(){
    $('#order').change(function() {
      var value = $("#order").val();
      $.ajax({
        type: 'post',
        url: 'del-info-out.php',
        data: {
          id: value,
        },
        success: function (response) {
          $( '#delInfo' ).html(response);
        }
      });
    });
  });

  $(document).ajaxStop(function(){

    $(".chBox").on('change',function(){
      if($(this).prop("checked")){
        if(($("#delAdd").val())==""){
          $('#saveBtn').prop('disabled',true);
        }
        else{
          $('#saveBtn').prop('disabled',false);
        }
      }
      else{
        $('#saveBtn').prop('disabled',true);
      }
    });

    $('#location').change(function(){
      var value = $("#location").val();
      $("#delRate").val(value);
    });


    $("#delAdd").on('keyup',function(){
      var add = $("#delAdd").val();
      if(add==""){
        $('#saveBtn').prop('disabled',true);
      }
      else{
        var chbox = $("input[name='check']:checked").val();
        if(chbox==""){
          $('#saveBtn').prop('disabled',true);

        }
        else{
          $('#saveBtn').prop('disabled',false);
        }
      }
    });
  });
  </script>
  <title>New Delivery</title>
  <link rel="icon" type="image/x-icon" sizes="16x16" href="plugins/images/favicon.ico">
</head>
<body class ="fix-header fix-sidebar">
  <div id="page-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12">
          <h4 class="box-title">
            <h3>
              <ul class="nav customtab2 nav-tabs" role="tablist">
                <li role="presentation" class="active">
                  <a aria-controls="proorders" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs">New Delivery</span></a>
                </li>
              </ul>
            </h3>
          </h4>
          <div class="orderconfirm">
            <div class="panel panel-default">
              <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                <form action="save-new-delivery.php" method="post">
                  <div class="panel-body">
                    <div class="row">
                      <div class="descriptions">
                        <div class="col-md-12">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <h1 class="control-label">Currently Showing</h1>
                                <select class="form-control" data-placeholder="Choose a Fabric" tabindex="1" name="order" id="order" style="text-align:right">
                                  <?php
                                  include "dbconnect.php";
                                  $sql = "SELECT * FROM tblcustomer a, tblorders b WHERE a.customerID = b.custOrderID and b.orderID NOT IN(SELECT orderID FROM tblorders a, tblorder_request b, tbldelivery_details c WHERE c.del_orderReqID = b.order_requestID and b.tblOrdersID = a.orderID) ORDER BY orderID;";
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

                              <div class="col-md-12">
                                <div class="table-responsive">
                                  <h3 style="text-align:center">Select Orders to Deliver</h3>
                                  <h1 style="text-align:center"><label class="form-control" style="border:0px;">Orders</label></h1>
                                  <table class="table product-overview" id="ordersTbl">
                                    <thead>
                                      <th style="text-align:left">Furniture Name</th>
                                      <th style="text-align:left">Furniture Description</th>
                                      <th style="text-align:right;">Quantity</th>
                                    </thead>
                                  </table>
                                </div>
                              </div>

                            </div>


                            <div class="col-md-6" > 
                              <div class="panel-body" style="background-color:#8dcfe7">
                                <h2 style="border:0px;text-align:center">Delivery Information</h2>
                                <hr>
                                <div id="delInfo">

                                </div>
                                <?php
                                $date = new DateTime();
                                $date = date_format($date, "Y-m-d");
                                ?>
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label class="control-label">Delivery Date</label><span id="x" style="color:red"> *</span>
                                    <input type="date" id="delDate" class="form-control" name="delDate" value="<?php echo $date?>"/> 
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <label class="control-label">Delivery Man</label><span id="x" style="color:red"> *</span>
                                      <select class="form-control" data-placeholder="Select Delivery Man" tabindex="1" name="emp">
                                        <?php
                                        include "dbconnect.php";
                                        $sql = "SELECT * FROM tblemployee ORDER BY empFirstName";
                                        $result = mysqli_query($conn, $sql);
                                        while ($row = mysqli_fetch_assoc($result))
                                        {
                                          if($row['empStatus']=='Active'){
                                            echo('<option value='.$row['empID'].'>'.$row['empFirstName'].' '.$row['empMidName'].' '.$row['empLastName'].'</option>');
                                          }
                                        }
                                        ?>
                                      </select>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <label class="control-label">Remarks</label>
                                      <textarea name="remarks" class="form-control"></textarea>
                                      <br>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row" style="margin:10px">
                            <button data-wizard="finish" type="submit" class="btn btn-success waves-effect pull-right" id="saveBtn" disabled><i class="fa fa-check"></i> Save</button>
                          </div>
                        </form>
                      </div>
                    </div>  
                  </div>
                </div>
              </div>
            </div>
          </div>
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