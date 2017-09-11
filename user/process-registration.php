<?php
/* Registration process, inserts user info into the database 
   and sends account confirmation email message
 */

// Set session variables to be used on profile.php page
$_SESSION['userEmail'] = $_POST['email'];
$_SESSION['customerFirstName'] = $_POST['firstname'];
$_SESSION['customerMiddleName'] = $_POST['middlename'];
$_SESSION['customerLastName'] = $_POST['lastname'];

// Escape all $_POST variables to protect against SQL injections
$customerFirstName = $mysqli->escape_string($_POST['firstname']);
$customerMiddleName = $mysqli->escape_string($_POST['middlename']);
$customerLastName = $mysqli->escape_string($_POST['lastname']);
$userEmail = $mysqli->escape_string($_POST['email']);
$userpassword = $mysqli->escape_string(password_hash($_POST['password'], PASSWORD_BCRYPT));
//$hash = $mysqli->escape_string( md5( rand(0,1000) ) );
      
// Check if user with that email already exists
$result = $mysqli->query("SELECT * FROM tbluser WHERE userEmail='$userEmail'") or die($mysqli->error());

// We know user email exists if the rows returned are more than 0
if ( $result->num_rows > 0 ) {
    
    $_SESSION['message'] = 'User with this email already exists!';
    header("location: register.php");
    
}
else { // Email doesn't already exist in a database, proceed...

    // active is 0 by DEFAULT (no need to include it here)
    $sql = "INSERT INTO tbluser (customerFirstName, customerLastName, email, password) " 
            . "VALUES ('$customerFirstName','$customerLastName','$userEmail','$userPassword')";

    // Add user to the database
    if ( $mysqli->query($sql) ){

        $_SESSION['active'] = 0; //0 until user activates their account with verify.php
        $_SESSION['logged_in'] = true; // So we know the user has logged in
        $_SESSION['message'] =
                
   /*              "Confirmation link has been sent to $email, please verify
                 your account by clicking on the link in the message!";

        // Send registration confirmation link (verify.php)
        $to      = $email;
        $subject = 'Account Verification';
        $message_body = '
        Hello '.$customerFirstName.',

        Thank you for signing up!

        Please click this link to activate your account:

        http://localhost/login-system/verify.php?email='.$email.'&hash='.$hash;  

        mail( $to, $subject, $message_body );
*/
        header("location: profile.php"); 

    }

    else {
        $_SESSION['message'] = 'Registration failed!';
        header("location: register.php");
    }
}