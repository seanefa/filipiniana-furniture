<footer class="bg-web">
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
				  <div class="col-md-3 col-sm-6 footer-col"><img class="mx-auto d-block img-fluid" src="/admin/plugins/images/<?php echo "" .$row['comp_logo'];?>">
					<p style="text-align: center; color: white;"><a class="navbar-brand" href="userhome.php" style="color:white;"><?php echo "" . $row['comp_name'];?></a></p>
					<p class="text-justify"><?php echo "" . $row['comp_about'];?></p>
					<p><i class="fa fa-map-pin"></i> <?php echo "" . $row['comp_address'];?></p>
					<p><i class="fa fa-phone"></i> Phone : <?php echo "" . $row['comp_num'];?></p>
					<p><i class="fa fa-envelope"></i> E-mail : <?php echo "" . $row['comp_email'];?></p>

				  </div>
				  <div class="col-md-3 col-sm-6 footer-col">
					<h6 class="heading7">GENERAL LINKS</h6>
					<ul class="footer-ul">
					  <li><a href="userhome.php"> Home</a></li>
					  <li><a href="userproducts.php"> Products</a></li>
					  <li><a href="#"> User Manual</a></li>
					</ul>
				  </div>
				  <div class="col-md-3 col-sm-6 footer-col">
					<h6 class="heading7">CUSTOMER CARE</h6>
					<ul class="footer-ul">
					  <li><a href=""><span class="fa fa-question-circle"></span> How to Order a Furniture</a></li>
					  <li><a href=""><span class="fa fa-question-circle"></span> How to pick the perfect furniture</a></li>
					  <li><a href=""> </a></li>
					</ul>
					<div class="post">
					  <!--p>facebook crack the movie advertisment code:what it means for you <span>August 3,2015</span></p>
					  <p>facebook crack the movie advertisment code:what it means for you <span>August 3,2015</span></p>
					  <p>facebook crack the movie advertisment code:what it means for you <span>August 3,2015</span></p-->
					</div>
				  </div>
				  <div class="col-md-3 col-sm-6 footer-col">
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
