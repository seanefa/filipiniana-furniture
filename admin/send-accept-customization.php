<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include "session-check.php";
include 'dbconnect.php';

// Include and initialize phpmailer class
require 'plugins/bower_components/PHPMailer/src/Exception.php';
require 'plugins/bower_components/PHPMailer/src/PHPMailer.php';
require 'plugins/bower_components/PHPMailer/src/SMTP.php';

$custid = $_GET['custid'];
$price = $_GET['price'];
$ordid = $_GET['orderID'];

$flag = 0;

$sql = "SELECT * FROM tblcompany_info";
$res = mysqli_query($conn,$sql);
$rowcom = mysqli_fetch_assoc($res);
$comemail = $rowcom["comp_email"];
$comname = $rowcom["comp_name"];
$compassword = $rowcom["comp_emailPassword"];

$updateSql = "UPDATE tblcustomize_request SET customStatus = 'Confirmed' WHERE tblcustomerID = $custid";
if(mysqli_query($conn,$updateSql)){
	$flag++;
}
$action = "INSERT INTO `tblorder_actions` (`orOrderID`, `orAction`, `orReason`) VALUES ($ordid, 'Confirmed Customization', 'Accepted');";
if(mysqli_query($conn,$action)){
	$flag++;
}
if($flag>0){
	if(mysqli_query($conn,$action)){
		$selectemail = "SELECT * from tbluser a, tblcustomize_request b, tblcustomer c WHERE b.tblcustomerID = a.userID and a.userCustID = c.customerID and b.tblcustomerID = '$custid'";
		$res = mysqli_query($conn,$selectemail);

		while($row = mysqli_fetch_assoc($res)){
			$name = $row["customerFirstName"] . " " . $row["customerMiddleName"] . " " . $row["customerLastName"];
			$email = $row["customerEmail"];

			$orderNumber = str_pad($row['customizedID'], 6, '0', STR_PAD_LEFT);

			$mail = new PHPMailer();

// Debugger
// $mail->SMTPDebug = 2;

// HTML email starts here
// HTML email starts here
			$subject    = "Your customization request has been accepted";
			$text_message = "Dear " . $row["customerFirstName"] . " " . $row["customerLastName"] . ",";
			$mail->AddEmbeddedImage('plugins/logo/'.$rowcom['comp_logo'].'', 'logoimg');      

			$message  = "<html><body>";

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
			<p style='font-size:18px; font-family:Verdana, Geneva, sans-serif;'>Please be informed that your Request#" .$orderNumber. " has been accepted, please see details below for more information.</p>
			<p style='font-size:15px; font-family:Verdana, Geneva, sans-serif;'>We have received your customization order request. The estimated price for your order is PHP ".$price.". Please pay at least 50% of the said amount within seven(7) days.</p>";

			$message .= '
			<br>
			<p>You can pay this through our linked bank accounts:&nbsp;&nbsp;<a href="https://www.landbank.com/e-banking"><img src="https://www.landbank.com/sites/default/files/weblogo.png" height="30px;" height="30px;"></a>&nbsp;&nbsp;<a href="https://online.bdo.com.ph/sso/login?josso_back_to=https://online.bdo.com.ph/sso/josso_security_check"><img src="https://www.bdo.com.ph/sites/all/themes/BDO/logo.png" height="30px;" height="30px;"></a></p>
			<p></p>';

			$message .= '
			<p style="font-size:15px; font-family:Verdana, Geneva, sans-serif;">If you have a question regarding to your order, please leave us a message.</p>
			</td>
			</tr>';

			$message .= '<tr height="80">
			<td colspan="4" align="center" style="background-color:#f5f5f5; border-top:dashed #DDBF5F 2px; font-size:24px;">
			<div class="row">
			<div class="col-md-3">
			<p style="font-size:15px;">'.$rowcom['comp_name'].'</p>
			</div>
			<div class="col-md-3">
			<p style="font-size:15px;">'.$rowcom['comp_address'].'</p>
			</div>
			<div class="col-md-3">
			<p style="font-size:15px;">Phone:&nbsp;'.$rowcom['comp_num'].'</p>
			</div>
			</div>
			</td>
			</tr>
			</tbody>';
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
			$mail->Timeout = 600;

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
				alert("Customization Request successfully accepted!");
				window.location.href = "dashboard.php";
				</script>';
			}
		}
	}
}
else {
	header( "Location: dashboard.php" );
}
?>