<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="image/favicon.ico" rel="icon" />
<title>404 - Filipiniana Furniture Shop</title>
<meta name="description" content="Furniture shop">
<?php include "css.php";
 
?>
</head>
<body>

<div class="wrapper-wide">
<?php 
 include "header.php";
  include "userconnect.php";

  $id =  $_GET["id"];

  echo $id;

  $sql="UPDATE tbluser SET confirmedUser= 1 where userCustID = ".$id ."";
  $result = mysqli_query($conn,$sql);



  


;?>
  <div id="container">
    <div class="container">
      <div class="row">
        <!--Middle Part Start-->
        <div id="content" class="col-sm-12">
          <p class="text-center lead">Your Account Has been Activated!<br>
            Enjoy Shopping! </p>
          <div class="buttons text-center"> <a class="btn btn-primary btn-lg" href="login.php">Continue</a> </div>
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