<?php
include "userconnect.php";
$sql = "SELECT * FROM tblcompany_info";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="image/favicon.ico" rel="icon" />
<title>Contact Us - <?php echo $row['comp_name']?></title>
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
        <li><a href="contact-us.php">Contact Us</a></li>
      </ul>
      <!-- Breadcrumb End-->
      <div class="row">
        <!--Middle Part Start-->
        <div id="content" class="col-sm-12">
          <h1 class="title">Contact Us</h1>
          <div class="row">
            <?php
    include "userconnect.php";
    $sql="SELECT * from tblcompany_info";
    $result=$conn->query($sql);
    if($result->num_rows>0)
    {
      while($row=$result->fetch_assoc())
      {
    ?>

          <div class="col-md-3">
            <img alt="" src="image/logo-small.png" style="display:block;margin:auto;">
          </div>
          <div class="col-md-3">
            <p><i class="fa fa-map-pin"></i>&nbsp;&nbsp;Address : <?php echo "" . $row['comp_address'];?></p>
          </div>
          <div class="col-md-3">
            <p><i class="fa fa-phone"></i>&nbsp;&nbsp;Phone : <?php echo "" . $row['comp_num'];?></p>
          </div>
          <div class="col-md-3">
            <p><i class="fa fa-envelope"></i>&nbsp;&nbsp;E-mail : <?php echo "" . $row['comp_email'];?></p>
          </div>
<?php
    }
  }
  $conn->close();
?>
          </div>
          <br>
          <form class="form-horizontal">
            <fieldset>
              <h3 class="subtitle">Send us an Email</h3>
              <div class="form-group required">
                <label class="col-md-2 col-sm-3 control-label" for="input-name">Your Name</label>
                <div class="col-md-10 col-sm-9">
                  <input type="text" name="name" value="" id="input-name" class="form-control" />
                </div>
              </div>
              <div class="form-group required">
                <label class="col-md-2 col-sm-3 control-label" for="input-email">E-Mail Address</label>
                <div class="col-md-10 col-sm-9">
                  <input type="text" name="email" value="" id="input-email" class="form-control" />
                </div>
              </div>
              <div class="form-group required">
                <label class="col-md-2 col-sm-3 control-label" for="input-enquiry">Inquiry</label>
                <div class="col-md-10 col-sm-9">
                  <textarea name="enquiry" rows="10" id="input-enquiry" class="form-control"></textarea>
                </div>
              </div>
            </fieldset>
            <div class="buttons">
              <div class="pull-right">
                <input class="btn btn-primary" type="submit" value="Submit" />
              </div>
            </div>
          </form>
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