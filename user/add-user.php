<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start();

$fn=$_POST['fname'];
$mn=$_POST['mname'];
$ln=$_POST['lname'];
$a1 = '';
$a2 = '';
$a3 = '';
$a4 = '';
$a5 = '';
$a6 = '';
if(isset($_POST['street'])){
$a1 = $_POST['street'];
}
if(isset($_POST['route'])){
$a2 = $_POST['route'];
}
if(isset($_POST['localcity'])){
$a3 = $_POST['localcity'];
}
if(isset($_POST['state'])){
$a4 = $_POST['state'];
}
if(isset($_POST['zipcode'])){
$a5 = $_POST['zipcode'];
}
if(isset($_POST['-country'])){
$a6 = $_POST['-country'];
}
$a1= mysqli_real_escape_string($conn, $a1);
$a2= mysqli_real_escape_string($conn, $a2);
$a3= mysqli_real_escape_string($conn, $a3);
$a4= mysqli_real_escape_string($conn, $a4);
$a5= mysqli_real_escape_string($conn, $a5);
$a6= mysqli_real_escape_string($conn, $a6);
$ar= $a1.','.$a2.','.$a3.','.$a4.','.$a5.','.$a6.'';


$cn=$_POST['number'];
$em=$_POST['email'];
$newstat=$_POST["newsletter"];
$un=$_POST['uname'];
$pw=$_POST['upass'];
$cf=$_POST['cpass'];
$status="active";
$type="customer";
$datecreated=date("Y/m/d");
include 'userconnect.php';
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

if($cf==$pw)
{
	$sql2="INSERT into tblcustomer(customerFirstName, customerMiddleName, customerLastName, customerAddress, customerContactNum, customerEmail, customerNewsletter, customerStatus) values('$fn', '$mn', '$ln', '$ar', '$cn', '$em', '$newstat', '$status')";
	
	if($sql2)
	{
		if ($conn->query($sql2)==true)
		{
			$last_id=$conn->insert_id;
			$sql="INSERT INTO tbluser(userName, userPassword, userStatus, userType, userCustID, dateCreated) VALUES ('$un', '$pw', '$status', '$type', '$last_id', '$datecreated')";
			if($conn->query($sql)==true)
			{
			    // Include and initialize phpmailer class
	            require 'PHPMailer/src/Exception.php';
	            require 'PHPMailer/src/PHPMailer.php';
	            require 'PHPMailer/src/SMTP.php';

	            // Create an instance of PHPMailer
	            $mail = new PHPMailer();

	            // Debugger
	            //$mail->SMTPDebug = 2;

	  			// HTML email starts here
	            $subject    = "Greetings from Filipiniana Furniture!";
	      		$text_message    = "Hello $fn $ln, <br /><br /> Your account details are as follows: <br /> Username: $un <br /><br>Click this <a href='http://localhost:8000/user/confirm-account.php?id=".$last_id." '>Link</a> to Activate your Account<br>";
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
				        <p style='font-size:15px; font-family:Verdana, Geneva, sans-serif;'>".$text_message."</p>
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

		        // Send email
		        if(!$mail->send()){
		            echo 'Message could not be sent.';
		            echo 'Mailer Error: ' . $mail->ErrorInfo;
		        }
		        else{
		            echo 'Message has been sent';
		        }

				header("Location: home.php");
			}
			else
			{
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
		}
		else
		{
			echo "Error: " . $sql2 . "<br>" . $conn->error;
		}
	}
}
else
{
	echo "Passwords does not match.";
}
?>
$conn-close();