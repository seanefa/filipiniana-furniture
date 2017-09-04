<?php
session_start();
if(!isset($_SESSION["userID"]))
{
  header("Location: login.php");
}
$userid = $_SESSION["userID"];
$_SESSION['passId'] = $userid;
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="image/favicon.ico" rel="icon" />
<title>Customized Solutions - Filipiniana Furniture Shop</title>
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
        <li><a href="login.php">Customized Solutions</a></li>
      </ul>
      <!-- Breadcrumb End-->
      <div class="row">
        <!--Middle Part Start-->
        <div id="content" class="col-sm-12">
          <h1 class="title">Customized Solutions</h1>
          <div class="row">
            <form action="add-customization.php" method="post">
        <div class="row">
          <div class="col-12 col-sm-12 col-md-4 col-lg-3 col-xl-3">

            <div id="productDesc" style="display: none">
            <div class="card">
              <div class="card-header text-center">
                <h1 class="card-title">Design Information</h1>
                <h4>Size specification</h4>
                <input type="number" name="cust_height" class="form-control" placeholder="Height" required>
                <input type="number" name="cust_width" class="form-control" placeholder="Width" required>
                <input type="number" name="cust_length" class="form-control" placeholder="Length" required>
                <br>
                <h4>Fabric</h4>

                <select name="cust_fabric" class="form-control" data-placeholder="Choose a Fabric" id="chooseFabric">
                        <option value="0" selected disabled>Choose a Fabric</option>
                        <?php
                        include "dbconnect.php";
            // Create connection
                        $conn = mysqli_connect($servername, $username, $password, $dbname);
            // Check connection
                        if (!$conn) {
                          die("Connection failed: " . mysqli_connect_error());
                        }
                        $sql = "SELECT * FROM tblfabrics order by fabricName;";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result))
                        {
                          if($row['fabricStatus']=='Listed'){
                            echo('<option value='.$row['fabricID'].'>'.$row['fabricName'].'</option>
                              
                              ');
                          }
                        }
                        ?>
                      </select>
                      <?php
                        include "dbconnect.php";
            // Create connection
                        $conn = mysqli_connect($servername, $username, $password, $dbname);
            // Check connection
                        if (!$conn) {
                          die("Connection failed: " . mysqli_connect_error());
                        }
                        $sql = "SELECT * FROM tblfabrics order by fabricName;";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result))
                        {
                          if($row['fabricStatus']=='Listed'){
                            echo('<input value="'.$row['fabricPic'].'" id="'.$row['fabricID'].'" type="hidden">
                              
                              ');
                          }
                        }
                        ?>
                            <br>
                            <br>
                            <img src='' id="tempImage" style="width: 100px;height: 100px;">
                            <br>
                            <br>
                <h4>Remarks</h4>
                <textarea name="cust_remarks" class="form-control" rows="4" cols="10"></textarea>
                
              </div>
              <div class="card-block"></div>
            </div>
          </div>
          </div>

          <div id="changeSize" class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <!-- col-12 col-sm-12 col-md-8 col-lg-9 col-xl-9 !-->
            <div class="card">
              <div class="card-block text-center">
                <img class="img-fluid table-responsive">
                  <div class="literCanvas"></div>
                  <div id="thisCanvas" style="display: none">
                  <canvas id="canvas" height="550" width="700" style="border:1px solid #000000; background-color: gray"></canvas>
                  </div>
                  <img name="cust_image" src='' style="display: none;" height="550" width="700" id="savedImage">
                  <input type="hidden" name="cust_img_data" id="cust_img_data" value=""/>
                  
                    
                  
              </div>
              <div class="card-footer text-center">
                <div class="card-footer text-center" id="anotherDesign" style="display: none">
                <img src='' id="tempImage">
                  <button type="button" class='btn btn-primary' id="newDesign">New Design</button>
                  <button type="submit" class='btn btn-success' id="submitThis">Submit Design</button>

                </div>
                <button type="button" class='btn btn-primary' id="saveDesign">Save Design</button>

                <button type="button" class='btn btn-primary' id="chooseExist">Choose existing framework</button>
              </div>
            </div>
          </div>
        </div>
        </form>
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