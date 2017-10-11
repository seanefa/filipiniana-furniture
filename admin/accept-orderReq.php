
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include "session-check.php";
include 'dbconnect.php';

$id = $_POST['id'];
$xid = str_pad($id, 6, '0', STR_PAD_LEFT);
$remarks = $_POST['orderremarks'];
$date = $_POST['pidate'];

$or = str_pad($id, 6, '0', STR_PAD_LEFT);
$orID = "OR". $or;
$sql = "SELECT * FROM tblcompany_info";
$res = mysqli_query($conn,$sql);
$rowcom = mysqli_fetch_assoc($res);
$orderID = "SELECT * FROM tblorders a, tblinvoicedetails b, tblpayment_details c WHERE b.invoiceID = c.invID and a.orderID = '$id'";
$orRes = mysqli_query($conn,$orderID);
$orRoq = mysqli_fetch_assoc($orRes);
$orderID = $orRoq['orderID'];

$sqlcust = "SELECT * FROM tblcustomer a, tblorders b WHERE a.customerID = b.custOrderID and b.orderID = '$orderID'";
      $res = mysqli_query($conn,$sqlcust);
      $custRow = mysqli_fetch_assoc($res);
      $em = $custRow['customerEmail'];

      $or = str_pad($id, 6, '0', STR_PAD_LEFT); 
        echo $or;
        $orID = "OR". $or;



            $tQuan = 0;
            $tPrice = 0;

            $sqlrq = "SELECT * FROM tblorder_request a, tblorders b, tblpackages c WHERE c.packageID = a.orderPackageID and b.orderID = a.tblOrdersID and b.orderID = '$orderID'";
            $resrq = mysqli_query($conn,$sqlrq);



            $sql2 = "SELECT * FROM tblorder_request a, tblorders b, tblproduct c WHERE c.productID = a.orderProductID and b.orderID = a.tblOrdersID and b.orderID = '$orderID'";
            $res2 = mysqli_query($conn,$sql2);

            $down = 0;
          $bal = 0;
          $sql3 = "SELECT * FROM tblinvoicedetails a, tblpayment_details b, tblorders c WHERE c.orderID = a.invorderID and a.invoiceID = b.invID and c.orderID = '$orderID'";
          $res3 = mysqli_query($conn,$sql3);
          $tpay = 0;


            $sql4 = "SELECT * FROM tblpayment_details a, tblmodeofpayment b WHERE b.modeofpaymentID = a.mopID and a.payment_detailsID = '$id'";
            $res4 = mysqli_query($conn,$sql4);

            $datepr = date("Y-m-d");
        $sql5 = "SELECT * FROM tblemployee a inner join tbluser b where a.empID = b.userEmpID and userID=1";
          $result5 = mysqli_query($conn, $sql5);
$updateSql = "UPDATE tblorders SET orderStatus = 'Pending', orderRemarks =  '$remarks',dateOfRelease = '$date' WHERE orderID = $id";
if(mysqli_query($conn,$updateSql)){

	// Include and initialize phpmailer class
	            require 'PHPMailer/src/Exception.php';
	            require 'PHPMailer/src/PHPMailer.php';
	            require 'PHPMailer/src/SMTP.php';

	            // Create an instance of PHPMailer
	            $mail = new PHPMailer();

	            // Debugger
	            //$mail->SMTPDebug = 2;

	  			// HTML email starts here
	            $subject    = "Greetings from Filipiniana Furniture!";
	      		$text_message    = "Hello Mariano Lozano III, <br /><br /> Thank you for Ordering: <br /><br>";
	      		$mail->AddEmbeddedImage('plugins/images/'.$rowcom['comp_logo'].'', 'logoimg');      
	  
				$message  = "<html><body>";
				 
$message .= '
<head>
  <title>'. $orID .'</title>
  <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div style="text-align: center;">
        <img height="55px" src="cid:logoimg"/>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div style="text-align: center;">
        <p style="font-family:inherit; font-size:28px;">'.$rowcom['comp_name'].'</p>
        <h5>'.$rowcom['comp_address'].'</h5>
        <h5>Phone:'.$rowcom['comp_num'].'</h5>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div style="text-align: center;">
        <p style="text-align: center; font-family: inherit; font-weight: bolder; font-size: 20px;">- B I L L -</p>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-6">
      ';

      $message .= '
      <p style="text-align: center; font-family: inherit; font-weight: bolder; font-size: 20px;">Date:&nbsp;<b>
       '.$date.'
      </b></p>
      
    </div>
    <div class="col-xs-6">
      <span style="text-align: center; font-family: inherit; font-weight: bolder; font-size: 20px;">OR #'.$xid.' 
        ';
        
        $message .='
      </span>
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-xs-12">
       <span style="text-align: center; font-family: inherit; font-weight: 400; font-size: 15px;">CUSTOMER INFORMATION</span>
       <br>
       <div class="table-responsive">
        <table class="table color-bordered-table muted-bordered-table">
          <tr>
            <td>Name:</td>
            <td>'. $custRow['customerFirstName'].' '.$custRow['customerMiddleName'].'  '.$custRow['customerLastName'].'</td>
          </tr>
          <tr>
            <td>Address:</td>
            <td>'. $custRow['customerAddress'].'</td>
          </tr>
          <tr>
            <td>Contact Number:</td>
            <td>'. $custRow['customerContactNum'].'</td>
          </tr>
          <tr>
            <td>Email Address:</td>
            <td>'. $custRow['customerEmail'].'</td>
          </tr>
        </table>
      </div>
    </div>
  </div>
  ';
  $message .= '
  <br>
  <div class="row">
    <div class="col-xs-12">
      <span style="text-align: center; font-family: inherit; font-weight: 400; font-size: 15px;">PARTICULARS</span>
      <br>
      <div class="table-responsive">
        <table style="border: 1px solid black; padding: 15px;">
          <thead>
            <tr>
              <th>Furniture Name</th>
              <th>Furniture Description</th>
              <th style="text-align:right;">Unit Price</th>
              <th style="text-align:right;">Quantity</th>
              <th style="text-align:right;">Total Price</th>
            </tr>
          </thead>
          <tbody>';
            while($row = mysqli_fetch_assoc($resrq)){
              $orReqID = $row['order_requestID'];
              $message .= '<tr>
              <td>'.$row['packageDescription'].'</td>
              <td>PACKAGE</td>
              <td style="text-align:right;">Php  '.number_format($row['packagePrice'],2).'</td>
              <td style="text-align:center">'.$row['orderQuantity'].'</td>';
              $tPrice = $row['orderQuantity'] * $row['packagePrice'];
              $tPrice =  number_format($tPrice,2);
              $message .= '<td style="text-align:right;">Php  '.$tPrice.'</td></tr>';
              $tPrice = $row['orderPrice'];
              $orReqID = $row['order_requestID'];
              $sql3 = "SELECT * FROM tblpackage_orderreq a, tblproduct b WHERE a.por_prID = b.productID and a.por_orReqID = '$orReqID'";
              $res3 = mysqli_query($conn,$sql3);
              while($row3 = mysqli_fetch_assoc($res3)){
                $message .= '<tr>
              <td style="text-align:right;"> - '.$row3['productName'].'</td>
              <td>'.$row3['productDescription'].'</td>
              <td style="text-align:right;"></td>';
              $tQuan = $tQuan + $row['orderQuantity'] * 1;
              $message .= '<td style="text-align:right">'.$row['orderQuantity'] * 1 .'</td>
              <td style="text-align:right;"></td></tr>';

              }
            }
            while($row = mysqli_fetch_assoc($res2)){
              $message .= '<tr>
              <td>'.$row['productName'].'</td>
              <td>'.$row['productDescription'].'</td>
              <td style="text-align:right;">Php  '.number_format($row['productPrice'],2).'</td>
              <td style="text-align:right;">'.$row['orderQuantity'].'</td>';
              $tPrice = $row['orderQuantity'] * $row['productPrice'];
              $tPrice =  number_format($tPrice,2);
              $message .= '<td style="text-align:right;">Php  '.$tPrice.'</td></tr>';
              $tPrice = $row['orderPrice'];
              $tQuan = $tQuan + $row['orderQuantity'];
            }
            
            $message .='
            <tr style="text-align:right;">
              <td></td>
              <td colspan="2" style="text-align:right;"><b>GRAND TOTAL:</b></td>
              <td id="totalQ">'.$tQuan.'</td>
              <td id="totalPrice">'. "Php  ". number_format($tPrice,2).'</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div> 
  </div>
  <br>

  <div class="row">
    <div class="col-xs-12">
      <span style="text-align: center; font-family: inherit; font-weight: 400; font-size: 15px;">PAYMENT INFORMATION</span>
      <br>
      <div class="table-responsive">
        <table class="table color-bordered-table muted-bordered-table">
          
';
          
          
           $message .= '
           <tr>
            <td>Value Added Tax:</td>
            <td>Php '. number_format($tPrice*.12,2).'</td>
          </tr>
          <tr>
            <td>Amount:</td>
            <td>Php '. number_format($tPrice,2).'</td>
          </tr>
          
        </table>
      </div>
    </div>
  </div>
  <br>
  ';
  $message .= '
  
  <div class="row">
    <div class="col-md-12">
      <p>"You can pay this through our linked bank accounts."<br><a href="https://www.landbank.com/e-banking">BPI</a>       <a href="https://online.bdo.com.ph/sso/login?josso_back_to=https://online.bdo.com.ph/sso/josso_security_check">LandBank</a></p>
      <p>';

        
          while ($row5 = mysqli_fetch_assoc($result5))
          { 
            if($row5['userStatus']=="Active" && $row5['userType']=="admin")
			{
              $message .= ('Printed By: '.$row5['empFirstName'].' '.$row5['empMidName'].' '.$row5['empLastName'].'     ['.$datepr.']');
            }
          } 

    $message .='</p>
    </div>
  </div> 
';
 

				$message .= "</body></html>";
				// HTML email ends here

	            // SMTP configuration
		        $mail->isSMTP();
		        $mail->Host = 'smtp.gmail.com';
		        $mail->SMTPAuth = true;
		        $mail->Username = 'filfurnitures@gmail.com';
		        $mail->Password = 'filfurnitures01';
		        $mail->SMTPSecure = 'tls';
		        $mail->Port = 587;

		        $mail->setFrom('filfurnitures@gmail.com', 'Filipiniana Furniture');
		        $mail->addReplyTo('filfurnitures@gmail.com', 'Filipiniana Furniture');

		        // Add a recipient
		        $mail->addAddress('znotsukaima@gmail.com');

		        // Set email format to HTML
		        $mail->isHTML(true);

		        // Email subject
		        $mail->Subject = $subject;

		        // Email body content
		        $mail->Body = $message;

		        // Send email
		        if(!$mail->send()){
		            echo 'Message could not be sent.';
		            echo 'Mailer Error: ' . $mail->ErrorInfo;
		        }
		        else{
		            echo 'Message has been sent';
		        }



	echo '<script type="text/javascript">';
	header( "Location: orders.php" );
	echo 'alert("SUCCESSFULLY ACCEPT ORDER!")';
	echo '</script>';
}
?>