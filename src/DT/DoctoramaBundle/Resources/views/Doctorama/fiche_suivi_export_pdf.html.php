<?php
require_once('/../../../../../../vendor/html2pdf/html2pdf.class.php');

$content = "";
$content .= "";

$content .= "<page>";
$content .= "
	<style>
		table{
			width:100%;
			border-collapse: collapse;
		}
		.logos td{
			width:50%;
		}
		.content{
			
		}
		td.right{
			text-align:right;
		}
		table tr.data td{
			padding-bottom:15px;
			border-bottom: 1px solid black;
		}
	</style>";
$content .= "<table class='logos'>
	<tr>
		<td>LOGO</td>
		<td class='right'>Université de La Rochelle</td>
	</tr>";
$content .= "<tr><td><h1>Fiche de suivi - ".htmlentities(str_replace('"','\"',$_POST['form']))."</h1></td><td><h1>".htmlentities(str_replace('"','\"',$_GET['nom']))."</h1></td></tr>";
$formContent = $_POST[htmlentities(str_replace('"','\"',$_POST['form']))];
foreach($formContent as $key => $value){
	$content .= "<tr class='data'>
					<td>
						<p>".htmlentities(str_replace('"','\"',$key))." : </p>
					</td>
					<td>
						<p>".htmlentities(str_replace('"','\"',$value))."</p>
					</td>
				</tr>";		
}
$content .= "</table>";
$content .= "</page>";
 
$html2pdf = new \HTML2PDF('P','A4','fr');
$html2pdf->pdf->SetDisplayMode('fullpage');
$html2pdf->writeHTML($content);
$html2pdf->Output('test.pdf');
?>