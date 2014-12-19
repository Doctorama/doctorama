<?php
namespace DT\DoctoramaBundle\Services;
//TheseService
use DT\DoctoramaBundle\Entity\These;

class TheseService
{
	$repository = $this->getDoctrine()->getRepository('DT/DoctoramaBundle/Entity:These');
	$em = $this->getDoctrine()->getManager();
    
/**
	* Set These
	*
	* @param $titreThese, $sujetThese, $specialite, $laboratoire, axeThematique, axeSpecifique, $financement, $dateDebut, $dateDeSoutenance, $mention
	*
	*
	* @return These
	**/
	public function createThese($titreThese, $sujetThese, $specialite, $laboratoire, axeThematique, axeSpecifique, $financement, $dateDebut, $dateDeSoutenance, $mention)
	{
		$these = new These();
		$these->setTitreThese($titreThese);
		$these->setSujetThese($sujetThese);
		$these->setSpecialite($specialite);
		$these->setlaboratoire($laboratoire);
		$these->setaxeThematique($axeThematique);
		$these->setaxeSpecifique($axeSpecifique);
		$these->setFinancement($financement);
		$these->setdateDebut($dateDebut);
		$these->setdateDeSoutenance($dateDeSoutenance);
		$these->setMention($mention);

		$em = $this->getDoctrine()->getManager();
		$em->persist($these);
		$em->flush();

	}
	/**
	* get TheseById
	*
	* @param TheseById $id
	* @return These
	**/
	public function findbyId($id)
	{
   		
        $these = $repository->findById($id);

   		if (!$these) {
        throw $this->createNotFoundException(
            'Aucun element trouvé pour : '.$id
        );
    	}
    	return $these;
    }
	/**
	* get TheseByTitre
	*
	* @param TheseByTitre $titre
	* @return These
	**/
    public function findByTitle($titreThese)
	{
		$these = $repository->find($titreThese);

  	    if (!$these) {
        throw $this->createNotFoundException(
            'Aucun element trouvé pour : '.$titreThese );
    	}
    	else {

    		return $these;
    	}
		
	}

/**
	* get TheseBySubject
	*
	* @param TheseBySubject $sujetThese
	* @return These
	**/
    public function findBySubject($sujetThese)
	{

		$these = $repository->find($sujetThese);

  	      if (!$these) {
        throw $this->createNotFoundException(
            'Aucun element trouvé pour : '.$sujetThese );
    	}
    	else {
    		return $these;
    	}
		
		
	}
/**
	* get TheseBySpeciality
	*
	* @param TheseBySpeciality $specialite
	* @return These
	**/
	 public function findBySpeciality($specialite)
	{

		$these = $repository->find($specialite);

  	      if (!$these) {
        throw $this->createNotFoundException(
            'Aucun element trouvé pour : '.$specialite );
    	}
    	else {
    		
    		return $these;
    	}
		
	}
/**
	* get TheseByLabo
	*
	* @param TheseByLabo $labo
	* @return These
	**/
	 public function findByLabo($laboratoire)
	{

		$these = $repository->find($laboratoire);

  	      if (!$these) {
        throw $this->createNotFoundException(
            'Aucun element trouvé pour : '.$laboratoire );
    	}
    	else {
    		
    		return $these;
    	}
		
	}
/**
	* get TheseByAxeThematique
	*
	* @param TheseByAxeThematique $axeThematique
	* @return These
	**/
	public function findByAxeThematique($axeThematique)
	{

		$these = $repository->find($axeThematique);

  	      if (!$these) {
        throw $this->createNotFoundException(
            'Aucun element trouvé pour : '.$axeThematique );
    	}
    	else {
    		
    		return $these;
    	}
		
	}

/**
	* get TheseByAxeSpecifique
	*
	* @param TheseByAxeSpecifique $axeSpecifique
	* @return These
	**/
	public function findByaxeSpecifique($axeSpecifique)
	{

		$these = $repository->find($axeSpecifique);

  	      if (!$these) {
        throw $this->createNotFoundException(
            'Aucun element trouvé pour : '.$axeSpecifique );
    	}
    	else {
    		
    		return $these;
    	}
		
	}

/**
	* get TheseByFinancement
	*
	* @param TheseByFinancement $financement
	* @return These
	**/
	public function findByFinancement($financement)
	{

		$these = $repository->find($financement);

  	      if (!$these) {
        throw $this->createNotFoundException(
            'Aucun element trouvé pour : '.$financement );
    	}
    	else {
    		
    		return $these;
    	}
		
	}
/**
	* get TheseByDateDebut
	*
	* @param TheseByDateDebut $dateDebut
	* @return These
	**/
	public function findByDateDebut($dateDebut)
		{

		$these = $repository->find($dateDebut);

  	      if (!$these) {
        throw $this->createNotFoundException(
            'Aucun element trouvé pour : '.$dateDebut );
    	}
    	else {
    		
    		return $these;
    	}
		
	}
/**
	* get TheseByDateDeSoutenance
	*
	* @param TheseByDateDeSoutenance $dateDeSoutenance
	* @return These
	**/
	public function findByDateDeSoutenance($dateDeSoutenance)
		{

		$these = $repository->find($dateDeSoutenance);

  	      if (!$these) {
        throw $this->createNotFoundException(
            'Aucun element trouvé pour : '.$dateDeSoutenance );
    	}
    	else {
    		
    		return $these;
    	}
		
	}
/**
	* get TheseByMention
	*
	* @param TheseByMention $mention
	* @return These
	**/
	public function findByMention($mention)
		{

		$these = $repository->find($mention);

  	      if (!$these) {
        throw $this->createNotFoundException(
            'Aucun element trouvé pour : '.$mention );
    	}
    	else {
    		
    		return $these;
    	}
		
	}
/**
	* Set TitreThese
	*
	* @param These $id, $newTitreThese
	*
	* @return These
	**/
	public function updateTitreThese($id, $newTitreThese)
	{
    
    $these = $em->getRepository('DT/DoctoramaBundle/Entity:These')->findById($id);

    if (!$these) {
        throw $this->createNotFoundException(
            'Aucun produit trouvé pour cet id : '.$id
        );
    }
    $these->setTitreThese($newTitreThese);
    $em->flush();

    return $this->redirect($this->generateUrl('homepage'));
	}
/**
	* Set SujetThese
	*
	* @param These $id, $newSujetThese
	*
	* @return These
	**/
	public function updateSujetThese($id, $newSujetThese)
	{
    
    $these = $em->getRepository('DT/DoctoramaBundle/Entity:These')->findById($id);

    if (!$these) {
        throw $this->createNotFoundException(
            'Aucun produit trouvé pour cet id : '.$id
        );
    }

    $these->setSujetThese($newSujetThese);
    $em->flush();

    return $this->redirect($this->generateUrl('homepage'));
	}
/**
	* Set SpecialiteThese
	*
	* @param These $id, $newSpecialite
	*
	* @return These
	**/
	public function updateSpecialite($id, $newSpecialite)
	{
   
    $these = $em->getRepository('DT/DoctoramaBundle/Entity:These')->findById($id);

    if (!$these) {
        throw $this->createNotFoundException(
            'Aucun produit trouvé pour cet id : '.$id
        );
    }

    $these->setSpecialite($newSpecialite);
    $em->flush();

    return $this->redirect($this->generateUrl('homepage'));
	}
/**
	* Set LaboratoireThese
	*
	* @param These $id, $newlaboratoire
	*
	* @return These
	**/
	public function updateLaboratoire($id, $newlaboratoire)
	{
   
    $these = $em->getRepository('DT/DoctoramaBundle/Entity:These')->findById($id);

    if (!$these) {
        throw $this->createNotFoundException(
            'Aucun produit trouvé pour cet id : '.$id
        );
    }

    $these->setlaboratoire($newlaboratoire);
    $em->flush();

    return $this->redirect($this->generateUrl('homepage'));
	}
/**
	* Set FinancementThese
	*
	* @param These $id, $newFinancement
	*
	* @return These
	**/
	public function updateFinancement($id, $newFinancement)
	{
  
    $these = $em->getRepository('DT/DoctoramaBundle/Entity:These')->findById($id);

    if (!$these) {
        throw $this->createNotFoundException(
            'Aucun produit trouvé pour cet id : '.$id
        );
    }

    $these->setFinancement($newFinancement);
    $em->flush();

    return $this->redirect($this->generateUrl('homepage'));
	}
/**
	* Set DateDebutThese
	*
	* @param These $id, $newDateDebut
	*
	* @return These
	**/
	public function updateDateDebut($id, $newDateDebut)
	{
   
    $these = $em->getRepository('DT/DoctoramaBundle/Entity:These')->findById($id);

    if (!$these) {
        throw $this->createNotFoundException(
            'Aucun produit trouvé pour cet id : '.$id
        );
    }

    $these->setdateDebut($newdateDebut);
    $em->flush();

    return $this->redirect($this->generateUrl('homepage'));
	}
/**
	* Set DateDeSoutenanceThese
	*
	* @param These $id, $newdateDeSoutenance
	*
	* @return These
	**/
	public function updateDateDeSoutenance($id, $newdateDeSoutenance)
	{
 
	$these = $em->getRepository('DT/DoctoramaBundle/Entity:These')->findById($id);

    if (!$These) {
        throw $this->createNotFoundException(
            'Aucun produit trouvé pour cet id : '.$id
        );
    }

    $these->setdateDeSoutenance($newdateDeSoutenance);
    $em->flush();

    return $this->redirect($this->generateUrl('homepage'));
	}
/**
	* Set MentionThese
	*
	* @param These $id, $newMention
	*
	* @return These
	**/
	public function updateMention($id, $newMention)
	{
 
    $these = $em->getRepository('DT/DoctoramaBundle/Entity:These')->findById($id);

    if (!$these) {
        throw $this->createNotFoundException(
            'Aucun produit trouvé pour cet id : '.$id
        );
    }

    $these->setMention($newMention);
    $em->flush();

    return $this->redirect($this->generateUrl('homepage'));
	}

	
/**
	* Set These
	*
	* @param These $id
	*
	* @return True
	**/
	
	public function deleteThese($id)
	{
 
    $these = $em->getRepository('DT/DoctoramaBundle/Entity:These')->findById($id);

    if (!$these) {
        throw $this->createNotFoundException(
            'Aucun produit trouvé pour cet id : '.$id
        );
    }
    $em->remove($these);
	$em->flush();

	return $these;
	}


}