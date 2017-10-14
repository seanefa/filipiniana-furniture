<!--Right Part Start -->
<aside id="column-left" class="col-sm-3 hidden-xs">
	<?php
	include "userconnect.php";
	$sql = "SELECT * from tbluser a join tblcustomer b WHERE a.userCustID = b.customerID and  a.userID = " . $_SESSION["userID"] . "";
	$result = $conn->query($sql);
	if($result->num_rows>0)
	{
		while($row=$result->fetch_assoc())
		{
			?>
			<img class="img-responsive" src="pics/userpictures/<?php echo "" . $row["customerDP"];?>">
			<br>
			<h3 class="subtitle"><?php echo "" . $row["customerFirstName"] . " " . substr($row["customerMiddleName"],0,1)?>.<?php echo "" . " " . $row["customerLastName"];?></h3>
			<?php
		}
	}
	$conn->close();
	?>
	<div class="list-group">
		<ul class="list-item">
			<li><a href="account.php">Account Dashboard</a></li>
			<li><a href="addressbook.php">Address Book</a></li>
			<li><a href="customization.php">Customization</a></li>
			<li><a href="orders.php">Orders</a></li>
			<li><a href="updateinfo.php">Personal Information</a></li>
			<li><a href="production.php">Production Information</a></li>
			<li><a href="proof-of-payment-form.php">Proof of Payment</a></li>
			<li><a href="returns.php">Returns</a></li>
			<li><a href="reviews.php">Reviews</a></li>
		</ul>
	</div>
</aside>
<!--Right Part End -->
