    <style>
    .affix {
        top: 0;
        width: 100%;
    }

    .affix + .container-fluid {
        padding-top: 70px;
    }
    </style>
    <div class="container-fluid bg-wood">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-6 col-md-4 col-lg-2 col-xl-2">
            <?php
            include "websiteconnect.php";
            $sql="SELECT * from tblcompany_info";
            $result=$conn->query($sql);
            if($result->num_rows>0){
              while($row=$result->fetch_assoc()){
            ?>
              <img class="img-responsive col-xs-12" href="home.php" src="/admin/plugins/images/<?php echo "" . $row["comp_logo"];?>">
          </div>
          <div class="col-xs-12 col-sm-6 col-md-8 col-lg-6 col-xl-3">

          </div>
          <?php
            }
          }
          $conn->close();
          ?>
          <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 text-right">
            <br>
            <form class="form-inline">
              <input type="text" class="form-control">
              <button type="submit" class="btn btn-info"><small>Search</small></button>
            </form>
            <br>
            <button class="form-control btn btn-warning"><span class="fa fa-shopping-cart"></span>&nbsp;<b>Cart</b>&nbsp;<span class="badge"></span></button>
          </div>
        </div>
      </div>
    </div>
    <nav class="navbar navbar-inverse" data-spy="affix" data-offset-top="135" style="z-index: 1;">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
            <?php
            include "websiteconnect.php";
            $sql = "SELECT * from tblcompany_info";
            $result= $conn->query($sql);
            if($result->num_rows>0){
              while($row=$result->fetch_assoc()){
                ?>
                <a class="navbar-brand" href="#"><?php echo "" . $row["comp_name"];?></a>
                <?php
              }
            }
            $conn->close();
            ?>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav">
            <li><a href="#"><span class="glyphicon glyphicon-home"></span>&nbsp;<b>Home</b></a></li>
            <li><a href="#"><span class="fa fa-bed"></span>&nbsp;<b>Products</b></a></li>
            <li><a href="#"><span class="glyphicon glyphicon-gift"></span>&nbsp;<b>Promos</b></a></li>
            <li><a href="#"><span class="glyphicon glyphicon-user"></span>&nbsp;<b>Account</b></a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a data-toggle="modal" href="#signupModal"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
            <li><a data-toggle="modal" href="#loginModal"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
          </ul>
        </div>
      </div>
    </nav>
<!--signup-->
<div id="signupModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><span class="fa fa-user-plus"></span>&nbsp;Sign up</h4>
      </div>
      <div class="modal-body">
				<h6 class="text-center">Note: All fields are <b class="text-danger">required</b></h6>
				<h3 class="text-center">Personal Information</h3>
				<br>
				<form method="post" action="add_user.php">
					<form class="form-group">
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
								<input class="form-control" type="text" placeholder="First Name" name="fname" required>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
								<input class="form-control" type="text" placeholder="Middle Name" name="mname" required>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
								<input class="form-control" type="text" placeholder="Last Name" name="lname" required>
							</div>
						</div>
					</form>
					<br>
					<textarea class="form-control" name="address" placeholder="Address" required></textarea>
					<br>
					<form class="form-group">
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
								<input type="number" class="form-control" name="number" placeholder="Contact Number" required>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
								<input type="email" class="form-control" name="email" placeholder="Email" required>
							</div>
						</div>
					</form>
					<hr>
					<h3 class="text-center">Account Information</h3>
					<br>
					<form class="form-group">
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
								<input type="text" placeholder="Username" name="uname" class="form-control" required>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
								<input type="password" placeholder="Password" name="upass" class="form-control" required>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
								<input type="password" placeholder="Confirm Password" name="cpass" class="form-control" required>
							</div>
						</div>
					</form>
					<br>
					<div class="text-center">
						<div class="btn-group">
							<button type="submit" class="btn btn-primary">Sign up</button>
							<button type="reset" class="btn btn-warning">Clear</button>
							<button type="submit" data-dismiss="modal" class="btn btn-danger">Close</button>
						</div>
					</div>
				</form>
      </div>
  	</div>
	</div>
</div>
<!--login-->
<div class="modal fade" id="loginModal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><span class="fa fa-sign-in"></span>&nbsp;Log In</h4>
			</div>
			<div class="modal-body">
				<h6 class="text-center">Note: All fields are <b class="text-danger">required</b></h6>
				<form action="login_validate.php" action="post">
					<form class="form-group">
						<input type="text" class="form-control" placeholder="Username" name="username" required><br>
						<input type="password" class="form-control" placeholder="Password" name="password">
					</form>
					<br>
					<div class="text-center">
						<div class="btn-group">
							<button type="submit" class="btn btn-primary">Log In</button>
							<button type="reset" class="btn btn-warning">Clear</button>
							<button data-dismiss="modal" class="btn btn-danger">Close</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>