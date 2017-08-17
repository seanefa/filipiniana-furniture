<html>
<form method="post">

<button type="submit" name="send">Send Mail</button>


</form>


</htm>
<?php
if(isset($_POST['send'])){
/*
require_once 'vendor/autoload.php';

// Create the Transport

$transport = (new Swift_SmtpTransport('smtp.gmail.com', 25))
  ->setUsername('')
  ->setPassword('')
;

//

$transport = new Swift_SendmailTransport('/usr/sbin/sendmail -bs');

// Create the Mailer using your created Transport
$mailer = new Swift_Mailer($transport);

// Create a message
$message = (new Swift_Message('Wonderful Subject'))
  ->setFrom(['john@doe.com' => 'John Doe'])
  ->setTo(['hongkaira@gmail.com', 'other@domain.org' => 'A name'])
  ->setBody('Here is the message itself')
  ;

// Send the message
$result = $mailer->send($message);
*/


// the message
$to = "znotsukaima@gmail.com";
$sub = "Php Mail";
$msg = "Test Message From PHP";


$headers =  'MIME-Version: 1.0' . "\r\n"; 
$headers .= 'From: Your name <znotsukaima@gmail.com>' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 

mail($to, $sub, $msg, $headers);

}
?> 