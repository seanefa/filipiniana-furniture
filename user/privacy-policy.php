<?php
include "userconnect.php";
$sql = "SELECT * FROM tblcompany_info";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="image/favicon.ico" rel="icon" />
<title>Privacy Policy - <?php echo $row['comp_name']?></title>
<meta name="description" content="Furniture shop">
<?php include"css.php";?>
</head>
<body>
<div class="wrapper-wide">
<?php include"header.php";?>
  <div id="container">
    <div class="container">
      <!-- Breadcrumb Start-->
      <ul class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i></a></li>
        <li><a href="privacy-policy.php">Privacy Policy</a></li>
      </ul>
      <!-- Breadcrumb End-->
      <div class="row">
        <!--Middle Part Start-->
        <div id="content" class="col-sm-12">
          <h1 class="title">Privacy Policy</h1>
          <div class="row">
            <div class="col-sm-12">
				<h4 style="font-weight:bold;">What information do we collect?</h4>
              <p >We collect information from you when you register on our site of fill out a form.<br><br>
				When ordering or registering on our site, as appropriate, youmay be asked to enter your: name or e-mail address. You may, however, visit our site anonymously.</p>
				<h4 style="font-weight:bold;">What do we use your information for?</h4>
              <p >Any of the information we collect from you may be used in one or more of the following ways:</p>
				<ul>
					<li><b>To personalize your experience</b> (your information helps us to be better respond to your individual needs).</li>
					<li><b>To improve our website</b> (we continually strive to improve our website offerings based on the information and feedback we receive from you).</li>
					<li><b>To improve customer service</b> (your information helps us to more effectively respond to your customer service requests and support needs).</li>
					<li><b>To process transactions</b> <br>
						Your information, whether public or private, will not be sold, exchanged, transferred, or given to any other company for any reason whatsoever, without your consent, other than for the express purpose of delivering the purchased product or service requested by the customer.</li>
					<li><b>To send periodic emails</b> <br> 
						The email address you provide for order processing, may be used to send you information and updates pertaining to your order, in addition to receiving occasional company news, updates, related products or service information etc.<br>Note: if at anytime you would like to unsubscribe from receiving future emails, we include unsubscribe instructions at the bottom of each email.</li>
					<li><b>To administer a promotion, survey, or other site feature.</b></li>
				</ul>
				<h4 style="font-weight:bold;">How do we protect your information?</h4>
				<p>We implement a variety of security measures to maintain the safety of your personal information when you access your personal information.</p>
				<h4 style="font-weight:bold;">Do we use cookies?</h4>
				<p>We do not use cookies.</p>
				<h4 style="font-weight:bold;">Online Privacy Policy</h4>
				<p>This online privacy policy applies only to information collected through our website and not to information collected offline.</p>
				<h4 style="font-weight:bold;">Your Consent</h4>
				<p>By using our site, you consent to our privacy policy.</p>
				<h4 style="font-weight:bold;">Changes to our Privacy Policy</h4>
				<p>If we decide to change our privacy policy, we will send you an e-mail those changes to your provided e-mail address.</p>
				<h4 style="font-weight:bold;">Contacting Us</h4>
				<?php 
				include "userconnect.php";
				$companyinfo = "SELECT * from tblcompany_info";
				if($datapool=$conn->query($companyinfo))
				{
					while($row=$datapool->fetch_assoc())
					{
				?>
				<p>if there are any questions regarding this policy you may contact us using the information below</p>
					<ul>
						<li><b><?php echo "" . $row["comp_address"];?></b></li>
						<li><b><?php echo "" . $row["comp_email"];?></b></li>
						<li><b><?php echo "" . $row["comp_num"];?></b></li>
					</ul>
				<?php
					}
				}
				$conn->close();
				?>
            </div>
          </div>
        </div>
        <!--Middle Part End -->
      </div>
    </div>
  </div>
<?php include"footer.php";?>
</div>
<?php include"scripts.php";?>
</body>
</html>