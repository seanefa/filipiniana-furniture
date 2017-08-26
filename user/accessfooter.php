<head>
	<link rel="stylesheet" href="css/footer.css">
</head>
<footer class="bg-wood2">
	<?php
		include "userconnect.php";
		$sql="SELECT * from tblcompany_info";
		$result=$conn->query($sql);
		if($result->num_rows>0)
		{
			while($row=$result->fetch_assoc())
			{
		?>
			  <div class="container">
				<div class="row">
				  <div class="col-md-3 col-sm-6 footer-col">
					<h6 class="heading7">ABOUT</h6>
					<p><i class="fa fa-map-pin"></i><?php echo "" . $row['comp_address'];?></p>
					<p><i class="fa fa-phone"></i> Phone : <?php echo "" . $row['comp_num'];?></p>
					<p><i class="fa fa-envelope"></i> E-mail : <?php echo "" . $row['comp_email'];?></p>
					<p class="text-justify"><i class="fa fa-book"></i> <?php echo "" . $row['comp_about'];?></p>
				  </div>
				  <div class="col-md-2 col-sm-6 footer-col">
					<h6 class="heading7">GENERAL LINKS</h6>
					<ul class="footer-ul">
					  <li><a href="access.php"> Profile</a></li>
					  <li><a href="accessproducts.php"> Products</a></li>
					  <li><a href="#"> User Manual</a></li>
					</ul>
				  </div>
				  <div class="col-md-3 col-sm-6 footer-col">
					<h6 class="heading7">CUSTOMER CARE</h6>
					<ul class="footer-ul">
					  <li><a href=""><span class="fa fa-question-circle"></span> How to Order a Furniture</a></li>
					  <li><a href=""><span class="fa fa-question-circle"></span> How to pick the perfect furniture</a></li>
					  <li><a href=""><span class="fa fa-question-circle"></span> Terms and Conditions</a></li>
					</ul>
					<div class="post">
					  <!--p>facebook crack the movie advertisment code:what it means for you <span>August 3,2015</span></p>
					  <p>facebook crack the movie advertisment code:what it means for you <span>August 3,2015</span></p>
					  <p>facebook crack the movie advertisment code:what it means for you <span>August 3,2015</span></p-->
					</div>
				  </div>
				  <div class="col-md-2 col-sm-6 footer-col">
					  <h6 class="heading7">FURNITURE</h6>
					  <ul class="footer-ul">
						  <li><a href=""><span class="fa fa-caret-right"></span>&nbsp;Living Room Furnitures</a></li>
						  <li><a href=""><span class="fa fa-caret-right"></span>&nbsp;Dining Room Furnitures</a></li>
						  <li><a href=""><span class="fa fa-caret-right"></span>&nbsp;Bedroom Furnitures</a></li>
						  <li><a href=""><span class="fa fa-caret-right"></span>&nbsp;Outdoor Furnitures</a></li>
						  <li><a href=""><span class="fa fa-caret-right"></span>&nbsp;Office Furnitures</a></li>
					  </ul>
				  </div>
				  <div class="col-md-2 col-sm-6 footer-col">
					<h6 class="heading7">Social Media</h6>
					<ul class="footer-social">
					  <li class="socialicons"><a href="https://www.facebook.com/BaraquielsFilipinianaFurniture/" target="_blank"><i class="fa fa-facebook social-icon facebook" aria-hidden="true"></i></a></li>
					  <li class="socialicons"><a href="http://www.twitter.com/filipiniana_furniture" target="_blank"><i class="fa fa-twitter social-icon twitter" aria-hidden="true"></i></a></li>
					  <li class="socialicons"><a href="http://www.google.com/filipinianafurniture" target="_blank"><i class="fa fa-google-plus social-icon google" aria-hidden="true"></i></a></li>
					</ul>
				  </div>
				</div>
			  </div>
  		<?php
			}
		}
		$conn->close();
	?>
</footer>
