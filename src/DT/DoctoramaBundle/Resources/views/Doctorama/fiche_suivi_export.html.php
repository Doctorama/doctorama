<?php

if(!strcmp($export,"CSV")){
	echo "Fiche de suivi - ".htmlentities(str_replace('"','\"',$_POST['ficheLabel'])).";".htmlentities(str_replace('"','\"',$_GET['nom']))."\n";
	$formContent = $_POST[$_POST['ficheId']];
	$i=0;
	foreach($formContent as $key => $value){
		echo htmlentities(str_replace('"','\"',$key)).";".htmlentities(str_replace('"','\"',$value))."\n";
	}

}elseif(!strcmp($export,"PDF")){
	require_once('/../../../../../../vendor/html2pdf/html2pdf.class.php');
	$content = "<page>
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
		</style>
		
		<table class='logos'>
		<tr>
			<td>LOGO</td>
			<td class='right'>Université de La Rochelle</td>
		</tr>
		<tr>
			<td>
				<h1>Fiche de suivi - ".htmlentities(str_replace('"','\"',$_POST['ficheId']))."</h1>
			</td>
			<td>
				<h1>".htmlentities(str_replace('"','\"',$_GET['nom']))."</h1>
			</td>
		</tr>";
	$formContent = $_POST[$_POST['ficheId']];
	$i=0;
	foreach($formContent as $value){
		if($i==0){
		$content .= "<tr class='data'>
						<td>
							<p>".htmlentities(str_replace('"','\"',$value))." :</p>
						</td>";
			$i=1;
		}
		elseif($i==1){
		$content .= "<td>
							<p>".htmlentities(str_replace('"','\"',$value))."</p>
						</td>
					</tr>";	
			$i=0;
		}
	}
	$content .= "</table></page>";
	 
	$html2pdf = new \HTML2PDF('P','A4','fr');
	$html2pdf->pdf->SetDisplayMode('fullpage');
	$html2pdf->writeHTML($content);
	$html2pdf->Output(htmlentities(str_replace('"','\"',$_GET['nom'])).'_'.htmlentities(str_replace('"','\"',$_POST['ficheLabel'])).'.pdf');
}
?>