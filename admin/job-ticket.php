<?php
$id = $_GET['id'];
$or = str_pad($id, 6, '0', STR_PAD_LEFT);
$orID = "JT". $or;

set_include_path(get_include_path() . PATH_SEPARATOR . "/path/to/dompdf");
require_once "dompdf/autoload.inc.php";
use Dompdf\Dompdf;
ob_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title><?php echo $orID?></title>
  <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<?php 
$id = $_GET['id'];
include "dbconnect.php";
$sql = "SELECT * FROM tblcompany_info";
$res = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($res);
?>
<body>
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div style="text-align: center;">
        <img height="55px" src="plugins/images/<?php echo $row['comp_logo'];?>"/>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div style="text-align: center;">
        <p style='font-family:inherit; font-size:28px;'><?php echo $row['comp_name'];?></p>
        <h5><?php echo $row['comp_address'];?></h5>
        <h5>Phone: <?php echo $row['comp_num'];?></h5>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div style="text-align: center;">
        <p style="text-align: center; font-family: inherit; font-weight: bolder; font-size: 20px;">- J O B T I C K E T -</p>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-6">
      <?php
      include "dbconnect.php";
      $sql = "SELECT * FROM tblproduction_phase a, tblproduction b, tblorder_request c, tblphases d, tblorders e WHERE b.productionID = a.prodID and a.prodPhase = d.phaseID and b.productionOrderReq = c.order_requestID and a.prodHistID = '$id' and c.tblOrdersID = e.orderID";
      $res = mysqli_query($conn,$sql);
      $rrow = mysqli_fetch_assoc($res);
      $orderID = $rrow['orderID'];
      $order_requestID = $rrow['order_requestID'];
      $phaseName = $rrow['phaseName'];
      $handler = $rrow['prodEmp'];

      $date = date_create($rrow['prodDateStart']);
      $dateStart = date_format($date,"F d, Y");

      $edate = date_create($rrow['prodEstDate']);
      $estDate = date_format($edate,"F d, Y");


      //$sql1 = "SELECT * FROM tblproduct a, tblorder_request b, tblfabric c, tblframework d WHERE a.productID = b.orderProductID and b.order_requestID = '$order_requestID' and ";
      $sql1 = "SELECT * FROM tblproduct a, tblfabrics b, tblframeworks c, tblfurn_type d, tblfurn_category e, tblorder_request f, tblfurn_design g WHERE a.prodDesign = g.designID and a.prodFabricID = b.fabricID and a.prodFrameworkID = c.frameworkID and a.prodTypeID = d.typeID and a. prodCatID = e.categoryID and a.productID = f.orderProductID and f.order_requestID = '$order_requestID'";
      $sql1res = mysqli_query($conn,$sql1);
      $prow = mysqli_fetch_assoc($sql1res);

      $sql2 = "SELECT * FROM tblcustomer a, tblorders b WHERE a.customerID = b.custOrderID and b.orderID = '$orderID'";
      $sql2 = mysqli_query($conn,$sql2);
      $custRow = mysqli_fetch_assoc($sql2);

      $or = str_pad($orderID, 6, '0', STR_PAD_LEFT);
      $orID = "OR". $or;

      $date  = date("F d, Y");
      ?>
      <p style="text-align: center; font-family: inherit; font-weight: bolder; font-size: 20px;">Date:&nbsp;<b>
        <?php echo "" . $date;
        ?>
      </b></p>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12">
      <div class="col-xs-6">
        <h2>
        <?php echo $orID;?> - 
        <?php echo $custRow['customerFirstName'].' '.$custRow['customerMiddleName'].'  '.$custRow['customerLastName'];?>
      </h2>
      </div>
    </div>
  </div>
    <div class="row">
    <div class="col-xs-12">
      <span style="text-align: center; font-family: inherit; font-weight: 400; font-size: 15px;">PRODUCTION INFORMATION</span>
      <br>
      <div class="table-responsive">
        <table class="table color-bordered-table muted-bordered-table">
          <tr>
            <td>Date Start</td>
            <td><?php echo $dateStart?></td>
          </tr>
          <tr>
            <td>Handler</td>
            <td>
            <?php 
              $sql = "SELECT * FROM tblemployee WHERE empID = '$handler'";
              $res = mysqli_query($conn,$sql);
              $row = mysqli_fetch_assoc($res);
              echo $row['empFirstName'].' '.$row['empMidName'].' '.$row['empLastName'];
              ?>
          </td>
          </tr>
          <tr>
            <td>Estimated Date Finish</td>
            <td><?php echo $estDate;?></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12">
     <span style="text-align: center; font-family: inherit; font-weight: 400; font-size: 15px;">FURNITURE INFORMATION</span>
     <br>
     <div class="table-responsive">
      <table class="table color-bordered-table muted-bordered-table">
        <tr>
          <td>Name</td>
          <td><?php echo $prow['productName']?></td>
        </tr>
        <tr>
          <td>Category</td>
          <td> <?php echo $prow['categoryName'];?> </td>
        </tr>
        <tr>
          <td>Type</td>
          <td><?php echo $prow['typeName'];?> </td>
          <tr>
            <td>Design</td>
            <td><?php echo $prow['designName'];?></td>
          </tr>
          <tr>
            <td>Fabric</td>
            <td><?php echo $prow['fabricName'];?></td>
          </tr>
          <tr>
            <td>Framework</td>
            <td><?php echo $prow['frameworkName'];?></td>
          </tr>
          <tr>
            <td>Dimension Specification</td>
            <td><?php echo $prow['prodSizeSpecs'];?></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
  <br>
  <div class="row">
    <div class="col-xs-12">
      <span style="text-align: center; font-family: inherit; font-weight: 400; font-size: 15px;">MATERIALS ISSUED : <mark><?php echo $phaseName?></mark></span>
      <br>
      <div class="table-responsive">
        <table class="table color-bordered-table muted-bordered-table">
          <thead>
            <tr>
              <th>Type</th>
              <th>Material</th>
              <th style="text-align:right;">Quantity</th>
            </tr>
          </thead>
          <tbody>
            <?php
            include "dbconnect.php";
            $tQuan = 0;
            $tPrice = 0;
            $sql1 = "SELECT * FROM tblprodphase_materials a, tblmat_var b, tblmat_type c, tblmaterials d WHERE a.pph_matDescID = b.mat_varID and b.materialID = d.materialID and d.materialType = c.matTypeID and a.pphID = '$id'";
            $res = mysqli_query($conn,$sql1);
            while($row = mysqli_fetch_assoc($res)){
              echo "<tr>
                    <td>".$row['matTypeName']."</td>
                    <td>".$row['mat_varDescription']."/ ".$row['materialName']."</td>
                    <td style='text-align:right;'>".$row['pph_matQuan']."</td>
                    </tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div> 
  </div><p><?php 
        session_start();
        include "dbconnect.php"; 
        $datepr = date("Y-m-d");
        $sql5 = "SELECT * FROM tblemployee a inner join tbluser b where a.empID = b.userEmpID and userID='" . $_SESSION["userID"] . "'";
          $result5 = mysqli_query($conn, $sql5);
          while ($row5 = mysqli_fetch_assoc($result5))
          { 
            if($row5['userStatus']=="Active" && $row5['userType']=="admin")
      {
              echo('Printed By: '.$row5['empFirstName'].' '.$row5['empMidName'].' '.$row5['empLastName'].'     ['.$datepr.']');
            }
          }  ?></p>
  <br>
  <br>
</body>
<script src="bootstrap/dist/js/bootstrap.min.js"></script> 
</html>
<?php
$html = ob_get_clean();
$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream($orID, array("Attachment" => 0));
?>