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
				<br><br>
				<nav class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 navbar navbar-toggleable-md fixed-top navbar-inverse bg-inverse">
				 	<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				  </button>
					<?php
					include "userconnect.php";
					$sql="SELECT * from tblcompany_info";
					$result=$conn->query($sql);
					if($result->num_rows>0)
					{
						while($row=$result->fetch_assoc())
						{
					?>
						<a class="navbar-brand" href="access.php"><?php echo "" . $row['comp_name'];?></a>
					<?php
						}
					}
					$conn->close();
					?>
				  	<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="navbar-nav mr-auto">
					  		<li class="nav-items">
								<a class="nav-link" href="access.php"><i class="fa fa-user-circle-o"></i>&nbsp;ACCOUNT <span class="sr-only">(current)</span></a>
					  		</li>
					  		<li class="nav-item">
								<a class="nav-link" href="accessproducts.php"><i class="fa fa-bed"></i>&nbsp;PRODUCTS</a>
					  		</li>
					  		<li class="nav-item active">
								<a class="nav-link" href="accesspromos.php"><i class="fa fa-gift"></i>&nbsp;PROMOS</a>
					  		</li>
					  		<li class="nav-item">
								<a class="nav-link" href="accesscustom.php"><i class="fa fa-hand-pointer-o"></i>&nbsp;CUSTOMIZE</a>
					  		</li>
					  		<li class="nav-item">
								<a class="nav-link" href="accessproduction.php"><i class="fa fa-cog fa-spin"></i>&nbsp;PRODUCTION</a>
					  		</li>
						</ul>
						<!-- Right Side Of Navbar -->
		       			<ul class="nav navbar-nav navbar-right">
							<li clas="nav-item">
								<a class="btn btn-outline-danger" href="userlogout.php" title="Log out"><i class="fa fa-sign-out"></i></a>
							</li>
		       			</ul>
				  	</div>
				</nav>
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
                
                $sql="SELECT * from tblpromos";
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