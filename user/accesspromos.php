<?php
include "userconnect.php";
?>
<!DOCTYPE html>

<html>
	<head>
		<title>Filipiniana Furnitures - Production</title>
		<!--meta tags-->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="x-ua-compatible" content="ie-edge">
		<!--bootstrap 4-->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
		<!--custom css-->
		<link rel="stylesheet" href="custom.css">
		<!--scripts-->
		<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
		<!--google icons-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<!--font awesome icons-->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<!--my css-->
		<link rel="stylesheet" href="myStyle.css">
		<!--javascript-->
		<script src="myScript.js"></script>
	</head>
    <body>
		<div class="container">
			<div class="row">
				<!--navbar-->
				<br><br><br>
				<?php
				include "accessheader.php";
				?>
			</div>
		</div>
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
    </body>
</html>