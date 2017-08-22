<?php
include "userconnect.php";
?>
<!DOCTYPE html>

<html>
	<head>
		<title>Filipiniana Furnitures - Promos</title>
		<?php
		include "plugins.php";
		?>
	</head>
    <body>
		<div class="container">
			<div class="row">
				<!--navbar-->
				<br><br><br>
				<?php
				include "accessheader.php";
				?>
			</div>
		</div>
        <div class="jumbotron-fluid">
            <hr>
            <h1 class="text-center"><b>PROMOS</b></h1>
            <hr>
        </div>
        <div class="container">
            <div class="row">
                <?php
                include "userconnect.php";
                
                $sql="SELECT * from tblpromos where promoStatus='Active'";
                $result=$conn->query($sql);
                if($result->num_rows>0)
                {
                    while($row=$result->fetch_assoc())
                    {
                ?>
                        <div class="col-6 col-sm-4 col-md-3 col-lg-3 col-xl-4">
                            <img class="img-fluid hover-lighten thumbnail" src="/admin/plugins/images/<?php echo "" . $row["promoImage"];?>">
                        </div>
                <?php
                    }
                }
                $conn->close();
                ?>
            </div>
        </div>
    </body>
</html>