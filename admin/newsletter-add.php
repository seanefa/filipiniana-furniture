<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start();
include "dbconnect.php";

$insertnews = "INSERT into tblnewsletter(newsletterDate, newsletterAuthor, newsletterContent) values('$date', '$user', '$content')";

if(mysqli_query($conn,$insertnews)){
	$selectemail = "SELECT * from tblcustomer WHERE customerNewsletter = 1";
	$res = mysqli_query($conn,$selectemail);
	while($row = mysqli_fetch_assoc($res)){
		$name = $row["customerFirstName"] . " " . $row["customerMiddleName"] . " " . $row["customerLastName"];
		$emails = $row["customerEmail"];
		// Include and initialize phpmailer class
		require 'PHPMailer/src/Exception.php';
		require 'PHPMailer/src/PHPMailer.php';
		require 'PHPMailer/src/SMTP.php';

		            // Create an instance of PHPMailer
		$mail = new PHPMailer();

		            // Debugger
		            //$mail->SMTPDebug = 2;

		  			// HTML email starts here
		$subject    = "Announcement from Filipiniana Furnitures!";
		$text_message    = "Hello" . $row['customerFirstName'] . $row['customerLastName'] . ", <br /><br /> $content";
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
		<p style='font-size:25px; text-align:center;'>Thank you for registering on our site!</p>
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
		$mail->addAddress($em);

		        // Set email format to HTML
		$mail->isHTML(true);

		        // Email subject
		$mail->Subject = $subject;

	// Email body content
		$mail->Body = $message;
		$_SESSION['updateSuccess'] = 'Success';
		header( 'Location: ' . $_SERVER['HTTP_REFERER']);
	}
}

else{
	$_SESSION['actionFailed'] = 'Failed';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
}
?>