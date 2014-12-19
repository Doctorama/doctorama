<?php
namespace DT\DoctoramaBundle\Services;
//DossierDeSuiviService
use DT\DoctoramaBundle\Entity\DossierDeSuivi;

class DossierDeSuiviService
{
	/**
	* @var \Doctrine\ORM\EntityManager
	*/
	private $em;
	
	/**
	* @var Repository
	*/
	private $repository;
	
	/**
	* Constructor
	* @param EntityManager $em
	*/
	public function __construct($em)
	{
		$this->em = $em;
		$this->repository = $this->em->getRepository('DTDoctoramaBundle:DossierDeSuivi');
	}
	
	/**
	* Set DossierDeSuivi
	*
	* @param Doctorant $Doctorant
	* @param TemplateFicheSuivi $Template
	* @param string $commentaires
	*
	* @return DossierDeSuivi
	**/
	public function createDossierDeSuivi($Doctorant, $Template, $commentaires)
	{
		$dossierDeSuivi = new DossierDeSuivi();
			
		$dossierDeSuivi->setCommentaires($commentaires);
		
		$this->em->persist($dossierDeSuivi);
		$this->em->flush();
	}
	
	/**
	* get DossierDeSuiviById
	*
	* @param \integer $id
	* @return DossierDeSuivi
	**/
	public function findbyId($id)
	{
   		$these = $this->repository->findOneById($id);

   		if (!$dossierDeSuivi) {
			return null;
    	}
    }
	
	/**
	* get DossierDeSuiviByCommentaires
	*
	* @param string $commentaires
	* @return DossierDeSuivi
	**/
    public function findByCommentaires($commentaires)
	{

		$dossierDeSuivi = $this->repository->findByCommentaires($commentaires);

		if (!$dossierDeSuivi) {
			return null;
    	}

	}
	
	/**
	* Set DossierDeSuivi
	*
	* @param \integer $id
	* @param string $commentaires
	*
	* @return DossierDeSuivi
	**/
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
	
	/**
	* Delete DossierDeSuivi
	*
	* @param \integer $id
	*
	* @return True
	**/
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