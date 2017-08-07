<?php
	if(isset($_POST['submit'])){
	if(!empty($_POST['check'])) {
	
	//Counting number of checked checkboxes 
	$checked_count = count($_POST['check['.$row['productID'].']']);
	
	echo "You have selected following ".$checked_count." option(s): <br/>";
	
	//Loop to store and display values of individual checked checkbox
		foreach($_POST['checkt'] as $selected) {
				echo "<p>".$selected ."</p>"; 
		}
	echo "<br/><b>Note :</b> <span>Similarily, You Can Also Perform CRUD Operations using These Selected Values.</span>";	
	}
	else{
	echo "<b>Please Select Atleast One Option.</b>";
	}
	}
?>