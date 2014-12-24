<?php
//Export CSV
if(!strcmp($export,"CSV")){
	echo "Fiche de suivi - ".htmlentities(str_replace('"','\"',$_POST['ficheLabel'])).";".htmlentities(str_replace('"','\"',$_GET['nom']))."\n";
	$formContent = $_POST[$_POST['ficheId']];
	$i=0;
	// Parcours des données et ajout d'un caractère de séparation ";"
	foreach($formContent as $key => $value){
		if($i==0){
			echo htmlentities(str_replace('"','\"',$value)).";";
			$i=1;
		}
		elseif($i==1){
			echo htmlentities(str_replace('"','\"',$value))."\n";
		}
	}
}
// Export PDF
elseif(!strcmp($export,"PDF")){
//Import librairie
	require_once('/../../../../../../vendor/html2pdf/html2pdf.class.php');
//Formatage de la page
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
			<td>Doctorama</td>
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
//Parcours des données et ajout dans un tableau
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
// Création du documetnt PDF
	$html2pdf = new \HTML2PDF('P','A4','fr');
	$html2pdf->pdf->SetDisplayMode('fullpage');
// Ajout du contenu
	$html2pdf->writeHTML($content);
// Envoi
	$html2pdf->Output(htmlentities(str_replace('"','\"',$_GET['nom'])).'_'.htmlentities(str_replace('"','\"',$_POST['ficheLabel'])).'.pdf');
}
?>