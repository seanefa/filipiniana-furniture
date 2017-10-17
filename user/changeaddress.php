<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link href="image/favicon.ico" rel="icon" />
  <link rel="stylesheet" href="css/myStyle.css">
  <title>Change Personal Information - Filipiniana Furniture Shop</title>
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
        <li><a href="addressbook.php">Address Book</a></li>
        <li><a href="changeaddress.php">Change Address</a></li>
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
          <form enctype="multipart/form-data" action="updateaddress.php" autocomplete="off" class="form-horizontal" method="post">
            <fieldset id="account">
              <legend>Change Address</legend>
              <div class="form-group required">
                <label for="input-block" class="col-sm-2 control-label">Complete Address</label>
                <div class="col-sm-9">
                  <div id="locationField">
      <input class="form-control" name="address" id="autocomplete" placeholder="Enter your address"
            type="text"></input>
    </div>
    <br>
    <br>
    
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