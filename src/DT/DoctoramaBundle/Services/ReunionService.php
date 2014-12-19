<?php
namespace DT\DoctoramaBundle\Services;
//ReunionService
use DT\DoctoramaBundle\Entity\Reunion;

class ReunionService
{
	private $em;
	
	private $repository;
	
	public function __construct($em)
	{
		$this->em = $em;
		$this->repository = $this->em->getRepository('DTDoctoramaBundle:Reunion');
	}
	/**
	* Set Reunion
	*
	* @param $lieu, $date
	*
	* @return Reunion
	**/
	public function createReunion($lieu, $date)
	{
		$reunion = new Reunion();
		$reunion->setLieu($lieu);
		$reunion->setDate($date);

		$this->em->persist($reunion);
		$this->em->flush();

		return $reunion;
	}
	/**
	* Set Personnes
	*
	* @param $id, $personne
	*
	* @return Personnes
	**/
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
	/**
	* Set Personne
	*
	* @param Personne $id, $idpersonne
	*
	* @return True
	**/
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
	/**
	* get PersonnesById
	*
	* @param PersonnesById $id
	* @return Personnes
	**/
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
	/**
	* get DateById
	*
	* @param DateById $id
	* @return Date
	**/
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
	/**
	* Set Date
	*
	* @param Date $id, $date
	*
	* @return Date
	**/
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
	/**
	* get LieuById
	*
	* @param LieuById $id
	* @return Lieu
	**/
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
	/**
	* Set Lieu
	*
	* @param Lieu $id, $lieu
	*
	* @return Lieu
	**/
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
	/**
	* get ReunionByPersonne
	*
	* @param ReunionByPersonne $idpers
	* @return ReunionByPersonne
	**/
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