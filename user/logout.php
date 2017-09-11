<?php
session_start();
unset($_SESSION['logged']);
if(session_destroy()) // Destroying All Sessions
{
header("Location: home.php"); // Redirecting To Home Page
}
?>