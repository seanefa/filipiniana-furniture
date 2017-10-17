<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="image/favicon.ico" rel="icon" />
<title>Delivery Information - Filipiniana Furniture Shop</title>
<meta name="description" content="Furniture shop">
<?php include"css.php";?>
</head>
<body>
<div class="wrapper-wide">
<?php include"header.php";?>
  <div id="container">
    <div class="container">
      <!-- Breadcrumb Start-->
      <ul class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i></a></li>
        <li><a href="delivery-information.php">Delivery Information</a></li>
      </ul>
      <!-- Breadcrumb End-->
      <div class="row">
        <!--Middle Part Start-->
        <div id="content" class="col-sm-12">
          <h1 class="title">Delivery Rates</h1>
          <div class="row">
            <div class="col-sm-12">
				<table class="table table-bordered table-hover">
					<tr>
						<th>Branch</th>
						<th>Location</th>
						<th>Rate</th>
					</tr>
				<?php
				include "userconnect.php";
				
				$sql = "SELECT * from tbldelivery_rates a join tblbranches b where a.delBranchID = b.branchID AND a.delRateStatus = 'Listed' order by branchLocation";
				if($datapool=$conn->query($sql)){
					while($row=$datapool->fetch_assoc()){
				?>
					<tr>
						<td><?php echo "" . $row["branchLocation"];?></td>
						<td><?php echo "" . $row["delLocation"];?></td>
						<td><?php echo "Php " . $row["delRate"];?></td>
					</tr>
				<?php
					}
				}
				$conn->close();
				?>
				</table>
            </div>
          </div>
        </div>
        <!--Middle Part End -->
      </div>
    </div>
  </div>
<?php include"footer.php";?>
</div>
<?php include"scripts.php";?>
</body>
</html>