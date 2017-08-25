<!DOCTYPE html>
<html>
	<head>
		<title>Promos - Filipiniana Furnitures</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="x-ua-compatible" content="ie-edge">
		<link rel="icon" href="pics/filfurniturelogo.png">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js">
		<script src="myScript.js"></script>
		<link  rel="stylesheet" href="css/custom.css">
		<link rel="stylesheet" href="css/header.css">
		<link rel="stylesheet" href="css/custom.css">
		<link rel="stylesheet" href="css/footer.css">
	</head>
    <body>
			<!--navbar-->
			<?php
			include "header.php";
			?>
      <div class="jumbotron-fluid">
          <hr>
          <h1 class="text-center"><b>PROMOS</b></h1>
          <hr>
      </div>
      <div class="container">
          <div class="row">
              <?php
              include "userconnect.php";
              
              $sql="SELECT * from tblpromos where promoStatus='Active'";
              $result=$conn->query($sql);
              if($result->num_rows>0)
              {
                  while($row=$result->fetch_assoc())
                  {
              ?>
                      <div class="col-6 col-sm-4 col-md-3 col-lg-3 col-xl-4">
                          <img class="img-fluid hover-lighten thumbnail" src="/admin/plugins/images/<?php echo "" . $row["promoImage"];?>">
                      </div>
              <?php
                  }
              }
              $conn->close();
              ?>
            </div>
      </div>
			<?php
			include "footer.php";
			?>
    </body>
</html>