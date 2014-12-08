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
		//ou
		/*
		foreach($personnes as $personne)
		{
			$reunion->addPersonne($personne);
		}
		*/
		
		$em = $this->getDoctrine()->getManager();
		$em->persist($product);
		$em->flush();
	}
}