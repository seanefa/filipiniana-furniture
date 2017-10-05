<?php
$id = $_GET['id'];
echo '<script type="text/javascript">
        window.open("bill.php?id='.$id.'","_blank")
        </script>';

echo "<script>
      window.location.href='orders.php';
      </script>";

?>