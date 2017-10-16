<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start();
include "dbconnect.php";

$custid = $_GET['custid'];
$price = $_GET['price'];
$orderid = $_GET['orderid'];

$selectemail = "SELECT * from tblcustomer WHERE customerID = '$custid'";
$res = mysqli_query($conn,$selectemail);
$row = mysqli_fetch_assoc($res);
$name = $row["customerFirstName"] . " " . $row["customerMiddleName"] . " " . $row["customerLastName"];
$email = $row["customerEmail"];
echo $email;
echo $name;
echo $price;
		// Include and initialize phpmailer class
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

		            // Create an instance of PHPMailer
$mail = new PHPMailer();

		            // Debugger
		            //$mail->SMTPDebug = 2;

		  			// HTML email starts here
$subject    = "Message from Filipiniana Furnitures!";
$text_message    = "Hello" . $row['customerFirstName'] . $row['customerLastName'] . ", <br / ><br / > We have received your customization order request. The estimated price for your order is PHP ".$price.". Please pay at least 50% of the said amount within seven(7) days.";
$mail->AddEmbeddedImage('image/logo.png', 'logoimg');      

$message  = "<html><body>";
$message .= "<table width='100%' bgcolor='#e0e0e0' cellpadding='0' cellspacing='0' border='0'>";
$message .= "<tr><td>";
$message .= "<table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' style='max-width:650px; background-color:#fff; font-family:Verdana, Geneva, sans-serif;'>";
$message .= "<thead>
<tr height='80'>
<th colspan='4' style='background-color:#f5f5f5; border-bottom:dashed #DDBF5F 2px; font-family:Verdana, Geneva, sans-serif; color:#333; font-size:34px;' >
<img src='cid:logoimg' title='Filipiniana Furniture'/></th>
</tr>
</thead>";
$message .= "<tbody>
<tr>
<td colspan='4' style='padding:15px;'>
<p style='font-size:25px; text-align:center;'></p>
<p style='font-size:15px; font-family:Verdana, Geneva, sans-serif;'>" . $text_message . "</p>
</td>
</tr>

<tr height='80'>
<td colspan='4' align='center' style='background-color:#f5f5f5; border-top:dashed #DDBF5F 2px; font-size:24px; '>
<label>
<a href='https://www.facebook.com/BaraquielsFilipinianaFurniture/' target='_blank'><img style='vertical-align:middle' src='https://cdnjs.cloudflare.com/ajax/libs/webicons/2.0.0/webicons/webicon-facebook-m.png' /></a>
<a href='https://twitter.com/' target='_blank'><img style='vertical-align:middle' src='https://cdnjs.cloudflare.com/ajax/libs/webicons/2.0.0/webicons/webicon-twitter-m.png' /></a>
</label>
</td>
</tr>
</tbody>";
$message .= "</table>";
$message .= "</td></tr>";
$message .= "</table>";
$message .= "</body></html>";
					// HTML email ends here

		            // SMTP configuration
$mail->isSMTP();
		$mail->Host = 'smtp.gmail.com';
		$mail->SMTPAuth = true;
		$mail->Username = 'filfurnitures@gmail.com';
		$mail->Password = 'filfurnitures01';
		$mail->SMTPSecure = 'tls';
		$mail->Port = 587;

		$mail->setFrom('filfurnitures@gmail.com', 'Filipiniana Furniture');
		$mail->addReplyTo('filfurnitures@gmail.com', 'Filipiniana Furniture');
		
	 // Add a recipient
		$mail->addAddress($email);

		        // Set email format to HTML
		$mail->isHTML(true);

		        // Email subject
		$mail->Subject = $subject;

	// Email body content
		$mail->Body = $message;

if($mail->send()){
		// echo 'Message has been sent';
		$sql = "UPDATE tblorders SET orderStatus = 'WFP' WHERE customizedID = '$orderid'";
		mysqli_query($conn,$sql);
	$_SESSION['createSuccess'] = 'Success';
	header( 'Location: dashboard.php');
}
else{
		// echo 'Message could not be sent.';
		// echo 'Mailer Error: ' . $mail->ErrorInfo;
		$sql = "UPDATE tblorders SET orderStatus = 'Archived' WHERE customizedID = '$orderid'";
		mysqli_query($conn,$sql);
	$_SESSION['actionFailed'] = 'Failed';
	header( 'Location: dashboard.php');
}
?>