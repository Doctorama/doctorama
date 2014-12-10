<?php

//ReunionService
require_once __DIR__ . '/../Entity/Reunion.php';

class ReunionService
{
	public function createReunion($lieu, $date, $personnes)
	{
		$reunion = new Reunion();
		$reunion->setLieu($lieu);
		$reunion->setDate($date);
		$reunion->setPersonnes($personnes);

		$em = $this->getDoctrine()->getManager();
		$em->persist($product);
		$em->flush();
	}
}


//Importation fichier CSV service
class CSV_service
{
	public function ImportData($file)
	{
		$ligne = 1; //compteur de ligne
		$fic = fopen($file, "a+");
		while($tab=fgetcsv($fic,1024,';'))
		{
			$champs = count($tab); //nombre de champ dans la ligne en question	
			if ($ligne>1) //affichage de chaque champ de la ligne en question
			{
				for($i=0; $i<$champs; $i ++)
				{
					echo $tab[$i] . "<br />";
				}
			}
			$ligne ++;
		}
		
		/*
		$reunion = new Reunion();
		$reunion->setLieu($lieu);
		$reunion->setDate($date);
		
		$reunion->setPersonnes($personnes);

		$em = $this->getDoctrine()->getManager();
		$em->persist($product);
		$em->flush();
		*/
	}
}