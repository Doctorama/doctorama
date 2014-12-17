<?php
namespace DT\DoctoramaBundle\Services;
//TheseService
use DT\DoctoramaBundle\Entity\These;

class TheseService
{
	private $em;
	
	private $repository;
	
	public function __construct($em)
	{
		$this->em = $em;
		$this->repository = $this->em->getRepository('DTDoctoramaBundle:These');
	}
    

	public function createThese($titreThese, $sujetThese, $specialite, $laboratoire, $axeThematique, $axeScientifique, $financement, $dateDebut, $dateDeSoutenance, $mention)
	{
		$these = new These();
		$these->setTitreThese($titreThese);
		$these->setSujetThese($sujetThese);
		$these->setSpecialite($specialite);
		$these->setLaboratoire($laboratoire);
		$these->setAxeThematique($axeThematique);
		$these->setAxeScientifique($axeScientifique);
		$these->setFinancement($financement);
		$these->setDateDebut($dateDebut);
		$these->setDateDeSoutenance($dateDeSoutenance);
		$these->setMention($mention);

		$this->em->persist($these);
		$this->em->flush();
		
		return $these;
	}
	
	public function findById($id)
	{		
        $these = $this->repository->findOneById($id);

   		if (!$these) {
			return null;
    	}
    	return $these;
    }
	
    public function findByTitreThese($titreThese)
	{
		$these = $this->repository->findByTitreThese($titreThese);

  	    if (!$these) {
			return null;
    	}
    	else {
    		return $these;
    	}		
	}


    public function findBySujetThese($sujetThese)
	{
		$these = $this->repository->findBySujetThese($sujetThese);

  	    if (!$these) {
			return null;
    	}
    	else {
    		return $these;
    	}		
	}

	public function findBySpecialite($specialite)
	{
		$these = $this->repository->findBySpecialite($specialite);

  	    if (!$these) {
			return null;
    	}
    	else {   		
    		return $these;
    	}
		
	}

	public function findByLaboratoire($laboratoire)
	{
		$these = $this->repository->findByLaboratoire($laboratoire);

  	    if (!$these) {
			return null;
    	}
    	else {		
    		return $these;
    	}
	}

	public function findByAxeThematique($axeThematique)
	{
		$these = $this->repository->findByAxeThematique($axeThematique);

  	    if (!$these) {
			return null;
    	}
    	else {    		
    		return $these;
    	}		
	}


	public function findByAxeScientifique($axeScientifique)
	{

		$these = $this->repository->findByAxeScientifique($axeScientifique);
  	    if (!$these) {
			return null;
    	}
    	else {  		
    		return $these;
    	}		
	}


	public function findByFinancement($financement)
	{
		$these = $this->repository->findByFinancement($financement);

  	    if (!$these) {
			return null;
    	}
    	else {   		
    		return $these;
    	}		
	}

	public function findByDateDebut($dateDebut)
	{
		$these = $this->repository->findByDateDebut($dateDebut);

  	    if (!$these) {
			return null;
    	}
    	else {    		
    		return $these;
    	}		
	}

	public function findByDateDeSoutenance($dateDeSoutenance)
	{

		$these = $this->repository->findByDateDeSoutenance($dateDeSoutenance);

  	    if (!$these) {
			return null;
    	}
    	else {  		
    		return $these;
    	}		
	}

	public function findByMention($mention)
	{
		$these = $this->repository->findByMention($mention);

  	    if (!$these) {
			return null;
    	}
    	else {    		
    		return $these;
    	}		
	}

	public function updateTitreThese($id, $newTitreThese)
	{   
		$these = $this->repository->findOneById($id);

		if (!$these) {
			return null;
		}

		$these->setTitreThese($newTitreThese);
		$this->em->flush();

		return $these;
	}

	public function updateSujetThese($id, $newSujetThese)
	{   
		$these = $this->repository->findOneById($id);

		if (!$these) {
			return null;
		}
		$these->setSujetThese($newSujetThese);
		$this->em->flush();

		return $these;
	}

	public function updateSpecialite($id, $newSpecialite)
	{  
		$these = $this->repository->findOneById($id);
		
		if (!$these) {
			return null;
		}
		$these->setSpecialite($newSpecialite);
		$this->em->flush();

		return $these;
	}

	public function updateLaboratoire($id, $newlaboratoire)
	{
		$these = $this->repository->findOneById($id);

		if (!$these) {
			return null;
		}

		$these->setlaboratoire($newlaboratoire);
		$this->emem->flush();

		return $these;
	}

	public function updateFinancement($id, $newFinancement)
	{
		$these = $this->repository->findOneById($id);

		if (!$these) {
			return null;
		}

		$these->setFinancement($newFinancement);
		$this->em->flush();

		return $these;
	}

	public function updatedateDebut($id, $newdateDebut)
	{
		$these = $this->repository->findOneById($id);

		if (!$these) {
			return null;
		}

		$these->setdateDebut($newdateDebut);
		$this->em->flush();

		return $these;
	}

	public function updatedateDeSoutenance($id, $newdateDeSoutenance)
	{
		$these = $this->repository->findOneById($id);

		if (!$these) {
			return null;
		}

		$these->setdateDeSoutenance($newdateDeSoutenance);
		$this->em->flush();

		return $these;
	}

	public function updateMention($id, $newMention)
	{
		$these = $this->repository->findOneById($id);

		if (!$these) {
			return null;
		}

		$these->setMention($newMention);
		$this->em->flush();

		return $these;
	}
	
	public function deleteThese($id)
	{
		$these = $this->repository->findOneById($id);

		if (!$these) {
			return null;
		}
		$this->em->remove($these);
		$this->em->flush();

		return $these;
	}

	public function findByDoctorant($doctorant)
	{
		$these = $this->repository->findByDoctorant($doctorant);
		
		if (!$these) {
			return null;
		}
		return $these;
	}
	
	public function updateDoctorant($id, $doctorant)
	{
		$these = $this->repository->findOneById($id);

		if (!$these) {
			return null;
		}

		$these->setDoctorant($newFinancement);
		$this->em->flush();

		return $these;
	}
	
	public function findEncadrantsByIdThese($idThese)
	{
		$these = $this->repository->findOneById($id);

		if (!$these) {
			return null;
		}
		
		return $these->getEncadrants();
	}
}