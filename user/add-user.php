<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include and initialize phpmailer class
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

session_start();
include 'userconnect.php';

$sql = "SELECT * FROM tblcompany_info";
$res = mysqli_query($conn,$sql);
$rowcom = mysqli_fetch_assoc($res);
$comemail = $rowcom["comp_email"];
$comname = $rowcom["comp_name"];

$fn=$_POST['fname'];
$mn=$_POST['mname'];
$ln=$_POST['lname'];
$ar= $_POST['adr'];;

$cn=$_POST['number'];
$em=$_POST['email'];
$newstat=$_POST["newsletter"];
$un=$_POST['uname'];
$pw=$_POST['upass'];
$cf=$_POST['cpass'];
$status="active";
$type="customer";
$datecreated=date("Y/m/d");

$last_id=$conn->insert_id;

$nl=(int)$newstat;

$un= mysqli_real_escape_string($conn, $un);
$pw= mysqli_real_escape_string($conn, $pw);
$fn= mysqli_real_escape_string($conn, $fn);
$mn= mysqli_real_escape_string($conn, $mn);
$ln= mysqli_real_escape_string($conn, $ln);
$ar= mysqli_real_escape_string($conn, $ar);
$cn= mysqli_real_escape_string($conn, $cn);
$em= mysqli_real_escape_string($conn, $em);

$logSQL = "INSERT into tbllogs(category, action, date, description, userID) values('User', 'New', '$datecreated', 'New customer named $fn $mn $ln', '$last_id')";

if($cf==$pw)
{
	$sql2="INSERT into tblcustomer(customerFirstName, customerMiddleName, customerLastName, customerAddress, customerContactNum, customerEmail, customerDP, customerNewsletter, customerStatus) values('$fn', '$mn', '$ln', '$ar', '$cn', '$em', 'defaultdp.jpg', '$newstat', '$status')";
	
	if($sql2)
	{
		if ($conn->query($sql2)==true)
		{
			mysqli_query($conn, $logSQL);
			$last_id=$conn->insert_id;
			$sql="INSERT INTO tbluser(userName, userPassword, userStatus, userType, userCustID, dateCreated) VALUES ('$un', '$pw', '$status', '$type', '$last_id', '$datecreated')";
			if($conn->query($sql)==true)
			{
	            $name = $fn . " " . $mn . " " . $ln;
// Create an instance of PHPMailer
			$mail = new PHPMailer();

	            // Debugger
	            //$mail->SMTPDebug = 2;

	  			// HTML email starts here
	            $subject    = "Greetings from $comname!";
	      		$text_message    = "Hello! $name,";
				$mail->AddEmbeddedImage('../admin/plugins/images/'.$rowcom['comp_logo'].'', 'logoimg');  
	  
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
				        <p style='font-size:15px; font-family:Verdana, Geneva, sans-serif;'>".$text_message."</p>
				        <p style='font-size:25px; text-align:center;'>Thank you for registering on our site!</p>
				        <p style='font-size:15px; font-family:Verdana, Geneva, sans-serif;'>Your account details are as follows: <br /> Username: $un <br /><br>Click this <a href='http://localhost:8000/user/confirm-account.php?id=".$last_id." '>Link</a> to Activate your Account</p>
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
				$mail->Password = 'filfurnitures01';
				$mail->SMTPSecure = 'tls';
				$mail->Port = 587;

				$mail->setFrom($comemail, $comname);
				$mail->addReplyTo($comemail, $comname);

	// Add a recipient
				$mail->addAddress($em);

		        // Set email format to HTML
		        $mail->isHTML(true);

		        // Email subject
		        $mail->Subject = $subject;

		        // Email body content
		        $mail->Body = $message;

		        // Send email
		       /* if(!$mail->send()){
		            echo 'Message could not be sent.';
		            echo 'Mailer Error: ' . $mail->ErrorInfo;
		        }
		        else{
		            echo 'Message has been sent';
		        }

				header("Location: home.php"); */

		        if(!$mail->send()){
		            echo '<script>
					alert("Oops, something went wrong!");
					window.location.href = "register.php";
					</script>';
		        }
		        else{
		            echo '<script>
					alert("Account successfully created!");
					window.location.href = "login.php";
					</script>';
		        }
			}
			else
			{
				 echo '<script>
					alert("Oops, something went wrong!");
					window.location.href = "register.php";
					</script>';
			}
		}
		else
		{
			 echo '<script>
					alert("Oops, something went wrong!");
					window.location.href = "register.php";
					</script>';
		}
	}
}
else
{
	echo "Passwords does not match.";
}
?>
$conn-close();