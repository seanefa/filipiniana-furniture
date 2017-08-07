<?php
include 'dbconnect.php';

$conn = mysqli_connect($servername, $username, $password, $dbname);

  // Check connection
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}


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
			echo '<script type="text/javascript">';
			echo 'alert("RECORD SUCCESFULLY SAVED!")';
			header( "Location: packages.php" );
			echo '</script>';

		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}

		mysqli_close($conn);
	}
	?>