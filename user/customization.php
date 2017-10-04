<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link href="image/favicon.ico" rel="icon" />
  <link rel="stylesheet" href="css/myStyle.css">
  <title>Customization - Filipiniana Furniture Shop</title>
  <meta name="description" content="Furniture shop">
  <script type="text/javascript" src="js/myScript.js"></script>
  <script type="text/javascript" src="js/dropzone.js"></script>
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
        <li><a href="customization.php">Customization</a></li>
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

            <fieldset>
              <div class="form-group">
              <legend>Customization&nbsp;<i><small class="text-danger" id="_lblAccountMsg"></small></i></legend>
              <form enctype="multipart/form-data" action="send-customized-product.php" autocomplete="off" class="btn btn-primary dropzone">
                  
          </form>
          <form  id="my-awesome-dropzone"></form>
        </div>
              <div class="form-group required">
        <label for="input-block" class="col-sm-3 control-label">Add Blueprint</label>
        <div class="col-sm-8">
        </div>
        </div>
        <div class="form-group required">
        <label for="input-block" class="col-sm-3 control-label">Description</label>
        <div class="col-sm-8">
          <textarea class="form-control" name="description"></textarea>
        </div>
        </div>
            </fieldset>
              <div style="text-align: center;">
                <a href="account.php" class="btn btn-info">CANCEL</a>
                <input type="submit" class="btn btn-success" value="SAVE" name="register" id="">
              </div>
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