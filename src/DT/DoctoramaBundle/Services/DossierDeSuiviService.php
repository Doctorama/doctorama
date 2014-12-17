<?php
namespace DT\DoctoramaBundle\Services;
//DossierDeSuiviService
use DT\DoctoramaBundle\Entity\DossierDeSuivi;

class DossierDeSuiviService
{
	private $em;
	
	private $repository;
	
	public function __construct($em)
	{
		$this->em = $em;
		$this->repository = $this->em->getRepository('DTDoctoramaBundle:DossierDeSuivi');
	}

	public function createDossierDeSuivi($idFiche, $idTemplate, $commentaires)
	{
		$dossierDeSuivi = new DossierDeSuivi();
			
		$dossierDeSuivi->setCommentaires($commentaires);
		
		$this->em->persist($dossierDeSuivi);
		$this->em->flush();
	}

	public function findbyId($id)
	{
   		$these = $this->repository->findOneById($id);

   		if (!$dossierDeSuivi) {
			return null;
    	}
    }
	
    public function findByCommentaires($commentaires)
	{

		$dossierDeSuivi = $this->repository->findByCommentaires($commentaires);

		if (!$dossierDeSuivi) {
			return null;
    	}

	}

	public function updateCommentaires($id, $commentaires)
	{

		$dossierDeSuivi = $this->repository->findOneById($id);


		if (!$dossierDeSuivi) {
			return null;
    	}

		$dossierDeSuivi->setCommentaires($commentaires);
		$this->em->flush();

		return $this->redirect($this->generateUrl('homepage'));
	}

	public function deleteDossierDeSuivi($id)
    {
		$dossierDeSuivi = $this->repository->findOneById($id);


		if (!$dossierDeSuivi) {
			return null;
    	}
		
		$em->remove($dossierDeSuivi);
		$em->flush();

		return $dossierDeSuivi;
    }


}