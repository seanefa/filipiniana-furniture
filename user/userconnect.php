<?php

	$conn= new mysqli("localhost","root","","filfurnituredb");

	if($conn->connect_error)
	{
		die("Connection Failed: " . $conn->connect_error);
	}
?>
