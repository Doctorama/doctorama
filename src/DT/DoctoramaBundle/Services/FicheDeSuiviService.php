<?php
namespace DT\DoctoramaBundle\Services;
//FicheDeSuiviService
use DT\DoctoramaBundle\Entity\FicheDeSuivi;

class FicheDeSuiviService
{

	private $em;
	
	private $repository;
	
	public function __construct($em)
	{
		$this->em = $em;
		$this->repository = $this->em->getRepository('DTDoctoramaBundle:templatefichedesuivi');
	}
	
	public function createTemplateFicheDeSuivi($idType, $titre)
	{
		$ficheDeSuivi = new FicheDeSuivi();
		$ficheDeSuivi->setIdType($idType);
		$ficheDeSuivi->setTitre($titre);
		
		$this->em = $this->getDoctrine()->getManager();
		$this->em->persist($ficheDeSuivi);
		$this->em->flush();
	}


	public function findbyId($id)
	{		
        $these = $this->repository->findById($id);

   		if (!$ficheDeSuivi) {
			return null;
    	}
    }
	
    public function findByIdType($idType)
	{

		$these = $this->repository->findById($idType);

		if (!$ficheDeSuivi) {
			return null;
		}
    	else {
    		$ficheDeSuivi = $this->repository->findByIdType($idType);
    	}

	}

	public function findByTitre($titre)
	{

		$these = $this->repository->findById($titre);
  	    
		if (!$ficheDeSuivi) {
			return null;
		}
    	else {
    		$ficheDeSuivi = $this->repository->findByTitre($titre);
    	}
	}

	public function updateIdType($id, $newIdType)
	{
		
		$ficheDeSuivi = $this->repository->findById($id);

		if (!$ficheDeSuivi) {
			return null;
		}

		$ficheDeSuivi->setIdType($newIdType);
		$em->flush();

		return $this->redirect($this->generateUrl('homepage'));
	}

	public function updateTitle($id, $newTitre)
	{

		$ficheDeSuivi = $this->repository->findById($id);

		if (!$ficheDeSuivi) {
			return null;
		}

		$ficheDeSuivi->setTitre($newTitre);
		$this->em->flush();

		return $this->redirect($this->generateUrl('homepage'));
	}

	public function deleteFicheDeSuivi($id)
	{

		$ficheDeSuivi = $this->repository->findById($id);

		if (!$ficheDeSuivi) {
			return null;
		}
		$this->em->remove($ficheDeSuivi);
		$this->em->flush();
		
		return $ficheDeSuivi;
	}
	
}