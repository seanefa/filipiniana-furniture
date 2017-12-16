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
   //  var  typeOfRel = $("#typeOfRel").val();
   //  alert(typeOfRel);
   //  if(typeOfRel=='N/A'){
   //    $("#pick").prop('checked',true);
   //  }
   //  else{
   //   $("#del").prop('checked',true);
   // }
 });

  $(document).ready(function(){//change ng order
    $('#order').change(function(){
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
  });


  $(document).ajaxStop(function(){


  $(".chBox").on('change',function(){
    if($(this).prop("checked")){
      var relType = $("input[name='check']:checked").val();
      if(relType=='Delivery'){
        if(($("#delAdd").val())==""){
          $('#saveBtn').prop('disabled',true);
        }
        else{
          $('#saveBtn').prop('disabled',false);
        }
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

  $(document).ready(function(){ //change ng for
    $("input[name='relType']").on('change',function(){
      var val = $("input[name='relType']:checked").val();
      if(val=="Pick-up"){
        var valueType = 1;
        var orderID = $("#order").val();
        $.ajax({
          type: 'post',
          url: 'del-changed-for.php',
          data: {
            id: valueType, oID : orderID,
          },
          success: function (response) {
            $( '#delInfo' ).html(response);
          }
        });
      }
      else{
        var valueType = 2;
        var orderID = $("#order").val();
        $.ajax({
          type: 'post',
          url: 'del-changed-for.php',
          data: {
            id: valueType, oID : orderID,
          },
          success: function (response) {
            $( '#delInfo' ).html(response);
          }
        });
      }
    });
  });
});

$(document).ready(function(){
  $("#order").select2();
});

</script>

<title>New Release</title>
<link rel="icon" type="image/x-icon" sizes="16x16" href="plugins/logo/favicon.ico">
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
                  <a aria-controls="proorders" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"></i></span><span class="hidden-xs"><i class="ti-check-box"></i> New Release</span></a>
                </li>
              </ul>
            </h3>
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane fade active in">
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <form action="save-new-delivery.php" method="post">
                    <div class="panel-body">
                      <div class="row" style="margin-top: -30px;">
                        <div class="col-md-6">
                          <div class="form-group">
                            <h2 style="font-family: inherit; font-weight: bolder;">Search an Order:</h2>
                            <select class="form-control" tabindex="1" name="order" id="order" style="text-align:right">
                              <option value=""></option>
                              <?php
                              include "dbconnect.php";
                             // $sql = "SELECT * FROM tblcustomer a, tblorders b WHERE a.customerID = b.custOrderID and b.orderID NOT IN(SELECT orderID FROM tblorders a, tblorder_request b, tbldelivery_details c WHERE c.del_orderReqID = b.order_requestID and b.tblOrdersID = a.orderID) ORDER BY orderID;";
                              $sql = "SELECT * FROM tblcustomer a, tblorders b WHERE a.customerID = b.custOrderID and b.orderStatus !='Finished' and b.orderStatus != 'Cancelled' and b.orderStatus!='Archived' and b.orderStatus!='Pending' and b.orderStatus!='WFA' and b.orderStatus!='WFP' ORDER BY orderID;";
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
                          <div class="panel-body blue-gradient">
                            <h2 style="text-align:center; font-family: inherit; font-weight: bolder;">RELEASE INFORMATION</h2>
                            <hr>
                            <div class="row">
                              <div id="delInfo"></div>
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