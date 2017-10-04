<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link href="image/favicon.ico" rel="icon" />
	<link rel="stylesheet" href="css/myStyle.css">
	<title>Proof of Payment - Filipiniana Furniture Shop</title>
	<meta name="description" content="Furniture shop">
	<script type="text/javascript" src="js/myScript.js"></script>
	<?php include"css.php";?>
</head>
<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    if (isset($_POST['register'])) { //user registering
        
        require 'process-registration.php';
    }
}
?>
<body style="background: #ffffff;">
	<?php 
	include "header.php";
	if(!isset($_SESSION["userID"]))
	{
		echo "<script>
		window.location.href='login.php';
		alert('You have no access here. You must logged in first.');
		</script>";
	}
	?>
	<div id="container">
		<div class="container">
			<ul class="breadcrumb">
				<li><a href="home.php"><i class="fa fa-home"></i></a></li>
        		<li><a href="proof-of-payment-form.php">Proof of Payment</a></li>
			</ul>
			<br>
			<div class="row">
				<?php include "accountmenu.php"; ?>
				<!--Middle Part Start-->
				<div class="col-sm-9" id="content">
					<div class="row">
						<div class="col-sm-12">
							<div class="well">
									<?php include "userconnect.php";
			$sql="SELECT * from tbluser a join tblcustomer b WHERE a.userCustID = b.customerID and  a.userID = " . $_SESSION["userID"] . "";
			$result = $conn->query($sql);
			if($result->num_rows>0){
				while($row=$result->fetch_assoc()){
			?>
			          <form enctype="multipart/form-data" action="send-proof.php" autocomplete="off" class="form-horizontal" method="post">
            <fieldset>
              <legend>Proof of Payment Form&nbsp;<i><small class="text-danger" id="_lblAccountMsg"></small></i></legend>
              <p class="text-success" style="text-align: center;">You can refer to your receipt.</p>
              <div class="form-group required">
                <label for="input-firstname" class="col-sm-2 control-label">Order #</label>
                <div class="col-sm-10 col-md-10 col-lg-10 col-xl-10">
					<select class="form-control" name="orderid">
						<option disabled>Choose Order</option>
					<?php
					include "userconnect.php";
					$orders = "SELECT * from tblorders";
					$result = $conn->query($orders);
					if($result->num_rows>0){
						while($row=$result->fetch_assoc()){
							?>
						<option><?php echo "" . $row["orderID"];?></option>
						<?php
						}
					}
					$conn->close();
					?>
					</select>
<!--                  <input type="text" class="form-control" id="input-firstname" placeholder="" value="" name="branchcode" required>-->
                </div>
              </div>
              <div class="form-group required">
                <label for="input-firstname" class="col-sm-2 control-label">Swift Code</label>
                <div class="col-sm-10 col-md-10 col-lg-10 col-xl-10">
                  <input type="text" class="form-control" id="input-firstname" placeholder="" value="" name="branchcode" required>
                </div>
              </div>
              <div class="form-group required">
                <label for="input-email" class="col-sm-2 control-label">Amount Paid</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="input-email" placeholder="" name="amountpaid" required>
                </div>
              </div>
              <div class="form-group required">
                <label for="input-telephone" class="col-sm-2 control-label">Date Paid</label>
                <div class="col-sm-10">
                  <input type="date" class="form-control" id="input-telephone" value="" name="datepaid" required>
                </div>
              </div>
              <div class="form-group required">
                <label for="input-block" class="col-sm-2 control-label">Photo</label>
                <div class="col-sm-10">
                  <input type="file" name="receiptphoto" class="" required/>
                </div>
              </div>
            </fieldset>
              <div style="text-align: center;">
              	<a href="account.php" class="btn btn-info">CANCEL</a>
                <input type="submit" class="btn btn-primary" value="SAVE" name="register" id="">
              </div>
			</form>
			<?php
				}
			}
			?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--Middle Part End -->
			</div>
		</div>
		<?php include"footer.php";?>
	</div>
	<!--img src="pics/userpictures/<?php echo "" . $row["customerDP"];?>" style="height:150px; width:150px;" alt="Product" class="img-responsive profilepic"/-->
	<?php include "scripts.php";?>
</body>
</html>