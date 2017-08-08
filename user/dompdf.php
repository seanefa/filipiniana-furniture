<?php

set_include_path(get_include_path() . PATH_SEPARATOR . "/path/to/dompdf-master");

require_once "dompdf/autoload.inc.php";

use Dompdf\Dompdf;

$html = file_get_contents("report.php");
$dompdf = new DOMPDF();
$lala = "ututut";
$html =  "
<h2><b style='color:red;'>OFFICIAL RECEIPT</b><span class='pull-right'></h2>
<hr>
<div class='row'>
	<div class='col-md-12>
		<div class='pull-left'>
		<h3> &nbsp;<b class='text-danger'>".$lala."Filipiniana Furniture</b></h3>
		<p class='text-muted m-l-5'>
		Aguinaldo Highway, <br>
		Talaba II, <br>
		Bacoor Cavite</p>
		</div>
	</div>
	<div class='pull-center'>
		<table style='border:1px solid black;'>
			<thead>
				<th>Qty</th>
				<th>Unit</th>
				<th>Furniture Description</th>
				<th>Unit Price</th>
				<th>Amount</th>
			</thead>
			<br><br>
			<tbody>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
";
$dompdf->load_html($html);
$dompdf->render();

$dompdf->stream("dompdf_out.pdf", array("Attachment" => 0));

exit(0);

$dompdf->stream("receipt.pdf");

?>