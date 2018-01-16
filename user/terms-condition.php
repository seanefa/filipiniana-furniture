<?php
include "userconnect.php";
$sql = "SELECT * FROM tblcompany_info";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="image/favicon.ico" rel="icon" />
<title>Terms & Condition - <?php echo $row['comp_name']?></title>
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
        <li><a href="terms-condition.php">Terms & Condition</a></li>
      </ul>
      <!-- Breadcrumb End-->
      <div class="row">
        <!--Middle Part Start-->
        <div id="content" class="col-sm-12">
          <h1 class="title">Terms & Condition</h1>
          <div class="row">
            <div class="col-sm-12">
				<h4>Business Policies</h4>
              	<ul>
					<li>The customer must pay at least 50% of the total price of the furniture ordered for the production of furniture to begin.</li>
					<li>On-hand furniture must be fully paid upon acquisition.</li>
					<li>Furniture must be claimed, paid or delivered on or before the end of the contract.</li>
					<li>A customer must pay a cancellation fee if he/she cancels his order that is already undergoing production. Cancellation fee varies.</li>
					<li>If ordered furniture is not claimed and fully paid within 1 month (30 days) and 1 week after the contract’s expiration the management has the right to resell the furniture.</li>
					<li>The price of a customized furniture will be decided by the management</li>
					<li>The furniture will be replaced or repaired if found broken upon delivery.</li>
					<li>Six months warranty is given to all furniture.</li>
				</ul>
				<h4>Business Requirements</h4>
				<ul>
					<li>The production of furniture will begin once the customer paid a down payment of at least 50% of the total amount of the ordered furniture.</li>
					<li>A minimum storage fee of PHP 500 pesos will be added to the total balance if furniture is not claimed or is fully paid on or before the day the contract will end.</li>
					<li>A detailed description and specification is needed for customized furniture.</li>
					<li>Damage on furniture caused by natural disaster and by improper use or maintenance is not covered on the warranty.</li>
					<li>Official receipt must be presented to acquire warranty.</li>
					<li>A minimum fee of PHP 500 is needed to cancel an order that is already undergoing production.</li>
				</ul>
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