<?php
include "session-check.php";
include 'dbconnect.php';

if(isset($_POST['check'])){
	if(!empty($_POST['check'])) {
		
                        //Counting number of checked checkboxes 
		$checked_count = count($_POST['check']);
		
                        //Loop to store and display values of individual checked checkbox
		foreach($_POST['check'] as $selected) {
			$sql = "SELECT * FROM tblproduct WHERE productID='$selected'";
			$result = mysqli_query($conn, $sql);
			while ($row = mysqli_fetch_assoc($result))
			{
				echo ('<td>'.$row['productName'].'</td>
					<td>'.$row['productPrice'].'</td>
					');?>
					<td><button type="button" class="btn btn-danger" data-toggle="modal" href="packages-form.php" data-remote="packages-form.php?id=<?php echo $row['productID']?> #delete" data-target="#myModal">Deactivate</button>
					</td>
					<?php echo ('</tr>');
				}
			}
		}
		else{
			echo "<b>Please Select Atleast One Option.</b>";
		}
	}
	if($sql){
		if (mysqli_query($conn, $sql)) {
			echo $iPname;
    		$_SESSION['createSuccess'] = 'Success';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
} 
 else {
    $_SESSION['actionFailed'] = 'Failed';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
  }

		mysqli_close($conn);
	}
	?>