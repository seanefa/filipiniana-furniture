<?php
include "userconnect.php";
	

    
    //get matched data from skills table
    $sql = "SELECT * FROM tblproduct WHERE productID";
    $result = mysqli_query($conn,$sql);

    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row['productName'];
    }
    
    //return json data
    echo json_encode($data);
?>