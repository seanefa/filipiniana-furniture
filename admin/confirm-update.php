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
?>
<!DOCTYPE html>  
<html lang="en">
<head>
  <title>Update Order</title>
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
                  <a aria-controls="proorders" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs">Update Order</span></a>
                </li>
              </ul>
            </h3>
          </h4>
          <div class="orderconfirm">
            <div class="panel-group wiz-aco" id="accordion" role="tablist" aria-multiselectable="true">
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                  <h4 class="panel-title">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                      <h3>Order Additions</h3>
                    </a>
                  </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                  <form action="save-order-update.php" method = "post">
                    <input type="hidden" name="updateOrder" id="updateOrder" value="<?php echo $_POST['updateOrder']?>">
                    <div class="panel-body">
                      <div class="row">
                        <div class="descriptions">
                          <div class="col-md-12">
                            <div class="table-responsive" style="clear: both;">
                              <table class="table table-bordered display nowrap" id="tblPackages">
                                <thead>
                                  <tr>
                                    <h4>
                                      <th>Furniture Name</th>
                                      <th>Furniture Description</th>
                                      <th style="text-align: right;">Unit Price</th>
                                      <th style="text-align: right;">Quantity</th>
                                      <th style="text-align: right;">Total Price</th></h4>
                                      <!--<th style="text-align: center;">Customizations</th>-->
                                    </h4>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php 
                                  $removed = $_POST['removed'];
                                  $priceremoved = $_POST['priceremoved'];
                                  $quantremoved = $_POST['quantremoved'];
                                  $selected = $_POST['cart'];
                                  $selectedQuant = $_POST['quant'];
                                  $selectedPrice = $_POST['price'];
                                  $tempPrice = 0;
                                  $tempQuant = 0;

                                  $totPrice = $_POST['totalPrice'];
                                  $totQuant = $_POST['totalQuant'];

                                  $ctr = 0;
                                  $pCtr = 0;
                                  $quantarray = array();
                                  $pricearray = array();
                                  $removearray = array();
                                  $priceremovearray = array();
                                  $quantremovearray = array();

                                  foreach ($removed as $removedItem) {
                                    array_push($removearray, $removedItem);
                                  }
                                  foreach ($priceremoved as $priceremovedItem) {
                                    array_push($priceremovearray, $priceremovedItem);
                                  }
                                  foreach ($quantremoved as $quantremovedItem) {
                                    array_push($quantremovearray, $quantremovedItem);
                                  }

                                  foreach ($selectedQuant as $itemQuant) {
                                    if(!in_array($itemQuant, $quantremovearray)){
                                      $tempQuant =+ $itemQuant;
                                      array_push($quantarray,$itemQuant);
                                    }
                                    else{
                                    }
                                  } 
                                  foreach ($selectedPrice as $itemPrice) {
                                    if(!in_array($itemPrice, $priceremovearray)){
                                      $tempPrice =+ $itemPrice;
                                      array_push($pricearray,$itemPrice);
                                    }
                                    else{
                                    }
                                  }
                                  foreach ($selected as $items) {
                                    if(!in_array($items, $removearray)){
                                      $sql = "SELECT * FROM tblproduct where productID = '$items';";
                                      $result = mysqli_query($conn, $sql);
                                      if($result){
                                        while ($row = mysqli_fetch_assoc($result)) {
                                          $ctr++; 
                                          $pCtr++;                            
                                          echo ('
                                            <tr>
                                            <td><input id="cart'.$ctr.'" name="cart[]" value="'.$items.'" type="hidden"/>'.$row['productName'].'</td>
                                            <td>'.$row['productDescription'].'</td>
                                            <td style="text-align: right;">&#8369; '.number_format($row['productPrice'],2).'</td>
                                            <td style="text-align: right;">'.$quantarray[$ctr-1].'<input id="quant'.$ctr.'" name="quant[]" value="'.$quantarray[$ctr-1].'" type="hidden"/></td>
                                            <td id="price'.$ctr.'" style="text-align: right;">&#8369; '.number_format($pricearray[$pCtr-1],2).'<input id="price'.$ctr.'" name="prices[]" value="'.$pricearray[$pCtr-1].'" type="hidden"/></td></tr>');?>
                                          <?php    
                                        }
                                      }
                                    }
                                  }
                                  ?>
                                  <tfoot>
                                    <td colspan="3" style="text-align:right;"><b> GRAND TOTAL</b></td>
                                    <td style="text-align: right;"><?php echo ('<input id="totalQuant" name="totalQuant" value ="'.$totQuant.'" type="hidden"/>'.$totQuant.''); ?></td>
                                    <td style="text-align: right;">&#8369; <?php echo number_format($totPrice,2); ?></td>
                                    <input type="hidden" name="totalPrice" id="totalPrice" value="<?php echo $totPrice; ?>">
                                  </tfoot>
                                </tbody>

                                <script type="text/javascript">
                                var tempPrice = parseInt($('#totalPrice').html());
                                var tempTQuant = parseInt($('#totalQuant').val());
                                var realPrice = 0;
                                var totalPrice =0;
                                var price = 0;
                                var quant = 0;
                                var flag = 0;
                                function sendData(ctr){
                                  realPrice = parseInt($('#prices'+ctr).val())/ parseInt($('#quant'+ctr).val()) ;
                                  price = parseInt($('#prices'+ctr).val());
                                }

                                function passValue(ctr){

                                  quant = parseInt($('#quant'+ctr).val());
                                  var temRice = quant * price;
                                  alert(temRice);
                                  $('#price'+ctr).html(0);
                                  $('#price'+ctr).html(String(quant * realPrice));

                                  if(flag == 0 ){
                                    totalPrice = tempPrice - price;
                                    var e = totalPrice +(quant * realPrice);
                                    alert(e);
                                    $('#totalPrice').html(0);
                                    $('#totalPrice').html(String(e));
                                    flag = 1;
                                  }
                                  else if(flag == 1){
                                    var tPrice = parseInt($('#totalPrice').html());
                                    alert(quant * parseInt($('#prices'+ctr).val()));
                                    $('#totalPrice').html(0);
                                    $('#totalPrice').html(tPrice+(quant * parseInt($('#prices').val())));
                                  }
                                }
                                </script>

                              </table>
                            </form>
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