<?php

require_once('html2pdf/html2pdf.class.php');

$questions = array("Question 1"=>"question1","Question 2"=>"question2","Question 3"=>"question3");

$content = "";

ob_start();

$content .= "<page>";

$content .= "<h1>Fiche de suivi - ".htmlentities(str_replace('"','\"',$_GET['name']))."</h1>";
$content .= "<table>";
$formContent = $_POST[htmlentities(str_replace('"','\"',$_POST['form']))];
foreach($formContent as $key => $value){
	$content .= "<tr><td>".htmlentities(str_replace('"','\"',$key))."</td><td>".htmlentities(str_replace('"','\"',$value))."</td></tr>";		
}
$content .= "</table>";
$content .= "</page>";

$html2pdf = new HTML2PDF('P','A4','fr');
$html2pdf->WriteHTML($content);
$html2pdf->Output('fiche_suivi.pdf');