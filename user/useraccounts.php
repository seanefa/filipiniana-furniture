<html>
	<head>
		<title>Accounts - Filipiniana Furnitures</title>
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
		<link rel="stylesheet" href="css/custom.css">
		<link rel="stylesheet" href="css/header.css">
		<link rel="stylesheet" href="css/footer.css">
		<link rel="stylesheet" href="css/hover.css">
	</head>
	<body>
		<!--navbar-->
		<?php
		include "header.php";
		?>
		<div class="container-fluid">
			<br>
			<h1 class="text-center"><b>ACCOUNTS</b></h1>
			<br>
		</div>
		<div class="container">
			<div class="row justify-content-between">
				<div class="col-12 col-sm-12 col-md-6 col-lg-5 col-xl-5 bg-wood">
					<br>
					<h3 class="text-center"><span class="fa fa-sign-in"></span>&nbsp;Log In</h3>
					<br>
					<form class="form-group text-center" method="post" action="uservalidate.php">
						<input class="form-control" name="username" type="text" placeholder="Username or Email" required><br>
						<input class="form-control" name="password" type="password" placeholder="Password" required><br>
						<button type="submit" class="btn btn-web" onclick="newuser.php"><span class="fa fa-check"></span></button>
						<button type="reset" class="btn btn-web" onclick="newuser.php"><span class="fa fa-times"></span></button>
					</form>
					<br>
				</div>
				<div class="col-12 col-sm-12 col-md-6 col-lg-5 col-xl-5 bg-wood">
					<br>
					<h3 class="text-center"><span class="fa fa-user-plus"></span>&nbsp;Sign Up</h3>
					<br>
				</div>
			</div>
		</div>
		<br>
		<!--footer-->
		<?php
		include "footer.php";
		?>
	</body>
</html>