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
	
	public function createReunion($lieu, $date)
	{
		$reunion = new Reunion();
		$reunion->setLieu($lieu);
		$reunion->setDate($date);

		$this->em->persist($reunion);
		$this->em->flush();

		return $reunion;
	}
	
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
	
	public function deletePersonne($id, $personne)
	{
		$rep = $this->repository->findOneById($id);
		if(!$rep)
		{
			return null;
		}
		else
		{
			$rep->deletePersonne($personne);
			return $rep;
		}
	}
	
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
	
	public function setlistePersonne($id, $personnes)
	{
		$rep = $this->repository->findOneById($id);
		if(!$rep)
		{
			return null;
		}
		else
		{
			return $rep->setPersonnes($personnes);
		}
	}
	
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
}