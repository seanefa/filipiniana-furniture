<?php
include "userconnect.php";
session_start();
if(!isset($_SESSION['userID']))
{
	header("Location: error.html");
}
?>
<!DOCTYPE html>

<html>
	<head>
		<?php
		include "plugins.php";
		?>
		<title>Promos - Filipiniana Furnitures</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="x-ua-compatible" content="ie-edge">
		<link rel="icon" href="pics/filfurniturelogo.png">
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
		<script src="js/myScript.js"></script>
		<link  rel="stylesheet" href="css/custom.css">
		<link rel="stylesheet" href="css/header.css">
		<link rel="stylesheet" href="css/custom.css">
		<link rel="stylesheet" href="css/footer.css">
		<link rel="stylesheet" href="css/hover.css">
	</head>
  <body>
				<?php
				include "accessheader.php";
				?>
        <div class="jumbotron-fluid">
            <hr>
            <h1 class="text-center"><b>PROMOS</b></h1>
            <hr>
        </div>
        <div class="container">
            <div class="row justify-content-center">
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
												<div class="hovereffect">
                          <img class="img-fluid" src="/admin/plugins/promos/<?php echo "" . $row["promoImage"];?>">
													<div class="overlay">
														<h2><?php echo "" . $row["promoName"];?></h2>
														<a class="info" data-toggle="#viewmodal" href=""><span class="fa fa-eye"></span>&nbsp; View</a>
														<a class="info" href=""><span class="fa fa-eye"></span>&nbsp; Avail</a>
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
        </div>
		<?php
		include "accessfooter.php";
		?>
    </body>
</html>