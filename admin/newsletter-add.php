<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include and initialize phpmailer class
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

include "session-check.php";
include 'dbconnect.php';

$sql = "SELECT * FROM tblcompany_info";
$res = mysqli_query($conn,$sql);
$rowcom = mysqli_fetch_assoc($res);
$comemail = $rowcom["comp_email"];
$comname = $rowcom["comp_name"];
$compassword = $rowcom["comp_emailPassword"];

$user = $_SESSION["userID"];
$date = date("Y-m-d");
$content = $_POST["news_content"];
$insertnews = "INSERT into tblnewsletter(newsletterDate, newsletterAuthor, newsletterContent,newsletterStatus) values('$date', '$user', '$content','Pending')";
if(mysqli_query($conn,$insertnews)){
	$selectemail = "SELECT * from tblcustomer a, tbluser b WHERE b.userCustID = a.customerID and b.confirmedUser = 1 and a.customerNewsletter = 1";
	$res = mysqli_query($conn,$selectemail);
	while($row = mysqli_fetch_assoc($res)){
		$name = $row["customerFirstName"] . " " . $row["customerMiddleName"] . " " . $row["customerLastName"];
		$email = $row["customerEmail"];
// Create an instance of PHPMailer
		$mail = new PHPMailer();

// Debugger
// $mail->SMTPDebug = 2;

// HTML email starts here
		$subject    = "Announcement from $comname!";
		$text_message = "Dear " . $row["customerFirstName"] . " " . $row["customerLastName"] . ",";

		$mail->AddEmbeddedImage('plugins/images/'.$rowcom['comp_logo'].'', 'logoimg');    

		$message  = "<html><body>";
		$message .= "<table width='100%' bgcolor='#e0e0e0' cellpadding='0' cellspacing='0' border='0'>";
		$message .= "<tr><td>";
		$message .= "<table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' style='max-width:650px; background-color:#fff; font-family:Verdana, Geneva, sans-serif;'>";
		$message .= "<thead>
		<tr height='80'>
		<th colspan='4' style='background-color:#f5f5f5; border-bottom:dashed #DDBF5F 2px; font-family:Verdana, Geneva, sans-serif; color:#333; font-size:34px;' >
		<img src='cid:logoimg' title='$comname'/></th>
		</tr>
		</thead>";
		$message .= "<tbody>
		<tr>
		<td colspan='4' style='padding:15px;'>
		<p style='font-size:16px; font-family:Verdana, Geneva, sans-serif;'>" . $text_message . "</p>
		<p style='font-size:18px; text-align:center;'> Newsletter from $comname!</p>
		<p style='font-size:17px; font-family:Verdana, Geneva, sans-serif;'>$content</p>
		<p style='font-size:12px; font-family:Verdana, Geneva, sans-serif;'>Note: If you wish to unsubscribe to our newsletter, please change its settings in your account.</p>
		</td>
		</tr>

		<tr height='80'>
		<td colspan='4' align='center' style='background-color:#f5f5f5; border-top:dashed #DDBF5F 2px; font-size:24px;''>
		<div class='row'>
		<div class='col-md-3'>
		<p style='font-size:15px;'>".$rowcom['comp_name']."</p>
		</div>
		<div class='col-md-3'>
		<p style='font-size:15px;'>".$rowcom['comp_address']."</p>
		</div>
		<div class='col-md-3'>
		<p style='font-size:15px;'>Phone:&nbsp;".$rowcom['comp_num']."</p>
		</div>
		</div>
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
	    $mail->Username = $comemail;
	    $mail->Password = $compassword;
		$mail->SMTPSecure = 'tls';
		$mail->Port = 587;
		$mail->Timeout = 1200;

		$mail->SMTPOptions = array(
			'ssl' => array(
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true
			)
		);

		$mail->setFrom($comemail, $comname);
		$mail->addReplyTo($comemail, $comname);

// Add a recipient
		$mail->addAddress($email);

// Set email format to HTML
		$mail->isHTML(true);

// Email subject
		$mail->Subject = $subject;

// Email body content
		$mail->Body = $message;
// Send email
		if(!$mail->send()){
//echo 'Message could not be sent.';
//echo 'Mailer Error: ' . $mail->ErrorInfo;
			echo '<script>
				alert("Oops, something went wrong!");
				window.location.href = "dashboard.php";
				</script>';
		}
		else{
			echo '<script>
				alert("Newsletter successfully sent!");
				window.location.href = "dashboard.php";
				</script>';
		}
	}
}
else {
	header( "Location: dashboard.php" );
}
?>