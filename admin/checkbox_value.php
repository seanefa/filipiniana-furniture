<?php
include 'dbconnect.php';

	if(isset($_POST['check'])){
	if(!empty($_POST['check'])) {
	
	//Counting number of checked checkboxes 
	$checked_count = count($_POST['check']);
	
	echo "You have selected following ".$checked_count." option(s): <br/>";
	
	//Loop to store and display values of individual checked checkbox
		foreach($_POST['check'] as $selected) {
				$sql = "SELECT * FROM tblproduct WHERE productID='$selected'";
			    $result = mysqli_query($conn, $sql);
			    while ($row = mysqli_fetch_assoc($result))
			    {
			        echo ('<td>'.$row['productName'].'</td>
			          <td>'.$row['productPrice'].'</td>
			          ');?>
			          <td>
			            <button type="button" class="btn btn-danger" data-toggle="modal" href="packages-forms.php" data-remote="packages-forms.php?id=<?php echo $row['packageID']?> #delete" data-target="#myModal">Remove</button>
			          </td>
			          <?php echo ('</tr>');
			      }
		}
	}
	else{
	echo "<b>Please Select Atleast One Option.</b>";
	}
	}
?>