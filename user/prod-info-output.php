 <?php
 $id = $_POST['id'];
 $isFinish = 0;
 include "userconnect.php";
 $sql = "SELECT * FROM tblorders c, tblproduction a, tblorder_request b, tblproduct d WHERE c.orderID = b.tblOrdersID and b.order_requestID = a.productionOrderReq and c.orderID = '$id' and b.orderRequestStatus!='Archived' and b.orderProductID = d.productID";
 $res = mysqli_query($conn,$sql);
 while($row = mysqli_fetch_assoc($res)){
  $prodRec = str_pad($row['productionID'], 8, '0', STR_PAD_LEFT); 
  $prodRec = "#" . $prodRec;

  echo ('<br><div class="row">
    <div class="col-md-12">
      <div class="col-md-6">
        <h2 style="margin-top: -20px; color:black"><b>'. $prodRec .' - '.$row['productName'].'</b></h2>
      </div>
      <div class="col-md-6">');
        echo ('<h2 class="pull-right" style="margin-top: -20px;"><button data-toggle="modal" data-target="#myModal" href="production-start-update-forms.php" data-remote="production-start-update-forms.php?id='.$id.'&pID='.$row['productionID'].' #history"><i class="ti-menu-alt pull-right" style="margin-left: 20px; margin-top:5px;"></i>Production History</h2></button>
      </div>
    </div>
  </div><br>');
}//first loop
?>