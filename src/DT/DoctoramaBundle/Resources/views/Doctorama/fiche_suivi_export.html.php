<?php

if(!strcmp($_POST['export'],"CSV")){
	echo "Fiche de suivi - ".htmlentities(str_replace('"','\"',$_POST['form'])).";".htmlentities(str_replace('"','\"',$_GET['nom']))."\n";
	$formContent = $_POST[htmlentities(str_replace('"','\"',$_POST['form']))];
	$i=0;
	foreach($formContent as $key => $value){
		echo htmlentities(str_replace('"','\"',$key)).";".htmlentities(str_replace('"','\"',$value))."\n";
	}

}elseif(!strcmp($_POST['export'],"PDF")){
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
				<h1>Fiche de suivi - ".htmlentities(str_replace('"','\"',$_POST['form']))."</h1>
			</td>
			<td>
				<h1>".htmlentities(str_replace('"','\"',$_GET['nom']))."</h1>
			</td>
		</tr>";
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
	$content .= "</table></page>";
	 
	$html2pdf = new \HTML2PDF('P','A4','fr');
	$html2pdf->pdf->SetDisplayMode('fullpage');
	$html2pdf->writeHTML($content);
	$html2pdf->Output(htmlentities(str_replace('"','\"',$_GET['nom'])).'_'.htmlentities(str_replace('"','\"',$_POST['form'])).'.pdf');
}
?>