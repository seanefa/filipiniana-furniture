<?php 
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="image/favicon.ico" rel="icon" />
<title>Profile - Filipiniana Furniture Shop</title>
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
<body>
<div class="wrapper-wide">
<?php include"header.php";?>
  <div id="container">
    <div class="container">
      <!-- Breadcrumb Start-->
      <ul class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i></a></li>
        <li><a href="login.php">Account</a></li>
        <li><a href="register.php">Register</a></li>
      </ul>
      <!-- Breadcrumb End-->
      <div class="row">
        <!--Middle Part Start-->
        <div class="col-sm-12" id="content">
          <h1 class="title">Update Information</h1>
			<?php include "userconnect.php";
			$sql="SELECT * from tblcustomer as customer join tbluser as user where user.userCustID = customer.customerID and customer.customerID = 1";
			$result = $conn->query($sql);
			if($result->num_rows>0){
				while($row=$result->fetch_assoc()){
			?>
          <form action="updateinformation.php" autocomplete="off" class="form-horizontal" method="post">
            <fieldset id="account">
              <legend>Your Personal Details</legend>
              <!--div style="display: none;" class="form-group required">
                <label class="col-sm-2 control-label">Customer Group</label>
                <div class="col-sm-10">
                  <div class="radio">
                    <label>
                      <input type="radio" checked="checked" value="1" name="customer_group_id">
                      Default</label>
                  </div>
                </div>
              </div-->
              <div class="form-group required">
                <label for="input-firstname" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                  <input type="text" class="form-control" id="input-firstname" placeholder="First Name" value="<?php echo "" . $row["customerFirstName"];?>" name="fname" required>
                </div>
                <div class="col-sm-3">
                  <input type="text" class="form-control" id="input-middlename" placeholder="Middle Name" value="<?php echo "" . $row["customerMiddleName"];?>" name="mname">
                </div>
                <div class="col-sm-3">
                  <input type="text" class="form-control" id="input-lastname" placeholder="Last Name" value="<?php echo "" . $row["customerLastName"];?>" name="lname" required>
                </div>
              </div>
              <div class="form-group required">
                <label for="input-email" class="col-sm-2 control-label">E-Mail</label>
                <div class="col-sm-10">
                  <input type="email" class="form-control" id="input-email" placeholder="E-Mail" value="<?php echo "" . $row["customerEmail"];?>" name="email" required>
                </div>
              </div>
              <div class="form-group required">
                <label for="input-telephone" class="col-sm-2 control-label">Contact</label>
                <div class="col-sm-10">
                  <input type="tel" class="form-control" id="input-telephone" placeholder="Contact" value="<?php echo "" . $row["customerContactNum"];?>" name="number" required>
                </div>
              </div>
              <div class="form-group required">
                <label for="input-block" class="col-sm-2 control-label">Address</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="input-address" placeholder="e.g. #1255 Saint Francis St., Brgy. Parang, Marikina City" value="<?php echo "" . $row["customerAddress"];?>" name="address" required>
                </div>
              </div>
            </fieldset>
            <fieldset>
              <legend>Your Account&nbsp;<i><small class="text-danger" id="_lblAccountMsg"></small></i></legend>
              <div class="form-group required">
                <label for="input-password" class="col-sm-2 control-label">Username</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="input-username" placeholder="Username" value="<?php echo "" . $row["userName"];?>" name="uname" required>
                </div>
              </div>
              <div class="form-group required">
                <label for="input-password" class="col-sm-2 control-label">Old Password</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" id="input-password-old" placeholder="Old Password" value="" name="opass">
                </div>
              </div>
              <div class="form-group required">
                <label for="input-password" class="col-sm-2 control-label">Password</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" id="input-password" placeholder="Password" value="" name="upass">
                </div>
              </div>
              <div class="form-group required">
                <label for="input-confirm" class="col-sm-2 control-label">Confirm Password</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" id="input-confirm" placeholder="Confirm Password" value="" name="cpass">
                </div>
              </div>
            </fieldset>
            <div class="buttons">
              <div class="pull-right">
                <input type="submit" class="btn btn-primary" value="Update" name="register" id="">
              </div>
            </div>
          </form>
			<?php
				}
			}
			?>
        </div>
        <!--Middle Part End -->
        <!--Right Part Start -->
        <!--aside id="column-right" class="col-sm-3 hidden-xs">
          <h3 class="subtitle">Account</h3>
          <div class="list-group">
            <ul class="list-item">
              <li><a href="login.php">Login</a></li>
              <li><a href="register.php">Register</a></li>
              <li><a href="#">Forgotten Password</a></li>
              <li><a href="#">My Account</a></li>
              <li><a href="#">Address Books</a></li>
              <li><a href="wishlist.php">Wish List</a></li>
              <li><a href="#">Order History</a></li>
              <li><a href="#">Downloads</a></li>
              <li><a href="#">Reward Points</a></li>
              <li><a href="#">Returns</a></li>
              <li><a href="#">Transactions</a></li>
              <li><a href="#">Newsletter</a></li>
              <li><a href="#">Recurring payments</a></li>
            </ul>
          </div>
        </aside-->
        <!--Right Part End -->
      </div>
    </div>
  </div>
<?php include"footer.php";?>
</div>
<?php include"scripts.php";?>
</body>
</html>