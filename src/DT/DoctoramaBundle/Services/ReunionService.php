<?php
namespace DT\DoctoramaBundle\Services;
//ReunionService
use DT\DoctoramaBundle\Entity\Reunion;

class ReunionService
{
	private $em;
	
	private $repository;
	
	/* --------Constructeur, permet de récupèrer l'entitymanager et les tous les attributs de la table reunion-------- */
	public function __construct($em)
	{
		$this->em = $em;
		$this->repository = $this->em->getRepository('DTDoctoramaBundle:Reunion');
	}
	
	/* -------- Fonction permettant de créer une réunion en précisant la date et le lieu de celle-ci--------*/	
	public function createReunion($lieu, $date)
	{
		$reunion = new Reunion();
		$reunion->setLieu($lieu);
		$reunion->setDate($date);

		$this->em->persist($reunion);
		$this->em->flush();

		return $reunion;
	}
	
	/*-------- Fonction permettant de créer une personne en précisant son id et une personne (tous les attributs de l'entité personne)--------*/
	public function addPersonne($id, $personne)
	{
		$rep = $this->repository->findOneById($id);
		if(!$rep)
		{
			return null;
		}
		else
		{
			$rep->addPersonne($personne);
			return $rep;
		}
	}
	/*-------- Fonction permettant de supprimer une personne--------*/
	public function deletePersonne($id, $idpersonne)
	{
		$rep = $this->repository->findOneById($id);
		if(!$rep)
		{
			return null;
		}
		else
		{
			$tab = $rep->getPersonnes();
			foreach($tab as $pers)
			{
				if($pers->getId() == $idpersonne)
				{
					$rep->deletePersonne($pers);
				}
			}
			return $rep;
		}
	}
	
	/*-------- Récupèrer une personne en fonction de son Id-------- */
	
	public function getPersonnes($id)
	{
		$rep = $this->repository->findOneById($id);
		if(!$rep)
		{
			return null;
		}
		else
		{
			return $rep->getPersonnes();
		}
	}
	/*-------- Renvoie la date de réunion en précisant son Id--------*/
	public function getDate($id)
	{
		$rep = $this->repository->findOneById($id);
		if(!$rep)
		{
			return null;
		}
		else
		{
			return $rep->getDate();
		}
	}
	
	/*-------- Permet de modifier une réunion, on lui renseigne une nouvelle date et un nouvel Id --------*/
	public function setDate($id, $date)
	{
		$rep = $this->repository->findOneById($id);
		if(!$rep)
		{
			return null;
		}
		else
		{
			return $rep->setDate($date);
		}
	}
	
	/*-------- Renvoie le lieu de la réunion en renseignant son Id--------*/
	public function getLieu($id)
	{
		$rep = $this->repository->findOneById($id);
		if(!$rep)
		{
			return null;
		}
		else
		{
			return $rep->getLieu();
		}
	}
	
	/*-------- Modifier le lieu d'une réunion, on lui renseigne un nouveau lieu et un nouvel Id--------*/
	public function setLieu($id, $lieu)
	{
		$rep = $this->repository->findOneById($id);
		if(!$rep)
		{
			return null;
		}
		else
		{
			return $rep->setLieu($lieu);
		}
	}
	
	/*-------- Retourne toutes les réunions en renseignant son Id--------*/
	public function findReunionByPersonne($idpers)
	{
		$rep = $this->repository->findAll();
		if(!$rep)
		{
			return null;
		}
		else
		{
			$tabpers = array();
			foreach($rep as $reu)
			{
				$tab = $reu->getPersonnes();
				foreach($tab as $pers)
				{
					if($pers->getId() == $idpers)
					{
						array_push($tabpers, array('personne' => $pers, 'reunion' => $reu));
					}
				}
			}
			return $tabpers;
		}
	}
}