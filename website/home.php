<!DOCTYPE html>
<html>
  <head>
    <title>Home - Filipiniana Furnitures</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
		<!--css-->
    <link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="components/css/header.css">
		<link rel="stylesheet" href="components/css/home.css">
		<!--js-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>
		<script src="js/bootstrap.min.js"></script>
    <?php
    include "websiteconnect.php";
    $sql="SELECT comp_logo from tblcompany_info";
    $result=$conn->query($sql);
    if($result->num_rows>0){
      if($row=$result->fetch_assoc()){
    ?>
    <link rel="icon" src="/admin/plugins/images/<?php echo "" . $row["comp_logo"];?>">
    <?php
      }
    }
    $conn->close();
    ?>
  </head>
  <body>
    <div class="container-fluid">
      <div class="row">
        <?php
        include "header.php";
        ?>
      </div>
    </div>
		<div class="">
			
		</div>
    <div class="container">
      <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img src="/user/pics/banner.png">
          </div>
          <div class="item">
            <img src="/user/pics/DININGROOMBANNER.png">
          </div>
          <div class="item">
            <img src="/user/pics/LIVINGROOMBANNER.png">
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <hr>
      	<h1 class="text-center"><b>PRODUCTS</b></h1>
      <hr>
      <div class="row">
        <?php
        include "websiteconnect.php";
        $sql="SELECT * from tblproduct where prodStat='Pre-Order' or prodStat='On-Hand' limit 8;";
        $result=$conn->query($sql);
        if($result->num_rows>0){
          while($row=$result->fetch_assoc()){
        ?>
        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
					<div class="collection">
						<div class="object">
							<div class="object-header">
								<h3 class="text-center"><?php echo "" . $row["productName"];?></h3>
							</div>
							<div class="onject-content">
								<img class="img-responsive" src="/admin/plugins.images/<?php echo "" . $row["prodMainPic"];?>"><br>
								<h3 class="text-center text-danger">Php&nbsp;<?php echo "" . number_format($row["productPrice"]);?></h3>
							</div>
						</div>
					</div>
        </div>
        <?php
          }
        }
        $conn->close();
        ?>
      </div>
			<br>
			<div class="text-center">
       	<a class="text-center" href="">see all products</a>
			</div>
    </div>
    <div class="container">
      <div class="row">
        <hr>
        <h1 class="text-center"><b>GOOD NEWS</b></h1>
        <hr>
				<div class="row">
					<?php
					include "websiteconnect.php";
					$sql="SELECT * from tblpromos";
					$result=$conn->query($sql);
					if($result->num_rows>0){
						while($row=$result->fetch_assoc()){
					?>
					<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-2 lighten">
						<img class="img-responsive" src="/admin/plugins/images/<?php echo "" . $row["promoImage"];?>">
					</div>
					<?php
						}
					}
					$conn->close();
					?>
				</div>
      </div>
			<br>
			<div class="text-center">
				<a>see all promos</a>
			</div>
    </div>
		<br>
		<?php
		include "footer.php";
		?>
  </body>
</html>
