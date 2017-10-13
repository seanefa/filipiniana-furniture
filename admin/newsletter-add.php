<?php
session_start();
include "dbconnect.php";

$id = $_SESSION["userID"];
$date = $_POST["news_date"];
$content = $_POST["news_content"];

$insertnews = "INSERT into tblnewsletter(newsletterDate, newsletterAuthor, newsletterContent) values('$date', '$id', '$content')";

if($conn->query($insertnews) === true){
	header("Location: dashboard.php");
}
else{
	echo "error" . $conn->error . "<br>palagyan naman to ng toaster TY.";
}
?>