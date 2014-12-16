<?php
namespace DT\DoctoramaBundle\Services;
//TheseService
use DT\DoctoramaBundle\Entity\These;

class TheseService
{
	$repository = $this->getDoctrine()->getRepository('DT/DoctoramaBundle/Entity:These');
	$em = $this->getDoctrine()->getManager();
    

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
		
		
		//$reunion->setPersonnes($personnes);
		//ou
		/*
		foreach($personnes as $personne)
		{
			$reunion->addPersonne($personne);
		}
		*/
		

		$em = $this->getDoctrine()->getManager();
		$em->persist($these);
		$em->flush();


		

	}
	public function findbyId($id)
	{
   		
        $these = $repository->find($id);

   		if (!$these) {
        throw $this->createNotFoundException(
            'Aucun element trouvé pour : '.$id
        );
    	}
    	return $these;
    }
	
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

	public function findByaxeThematique($axeThematique)
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

	public function findBydateDebut($dateDebut)
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

	public function findBydateDeSoutenance($dateDeSoutenance)
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

	public function updateTitreThese($id, $newTitreThese)
	{
    
    $these = $em->getRepository('DT/DoctoramaBundle/Entity:These')->find($id);

    if (!$these) {
        throw $this->createNotFoundException(
            'Aucun produit trouvé pour cet id : '.$id
        );
    }

    $these->setTitreThese($newTitreThese);
    $em->flush();

    return $this->redirect($this->generateUrl('homepage'));
	}

	public function updateSujetThese($id, $newSujetThese)
	{
    
    $these = $em->getRepository('DT/DoctoramaBundle/Entity:These')->find($id);

    if (!$these) {
        throw $this->createNotFoundException(
            'Aucun produit trouvé pour cet id : '.$id
        );
    }

    $these->setSujetThese($newSujetThese);
    $em->flush();

    return $this->redirect($this->generateUrl('homepage'));
	}

	public function updateSpecialite($id, $newSpecialite)
	{
   
    $these = $em->getRepository('DT/DoctoramaBundle/Entity:These')->find($id);

    if (!$these) {
        throw $this->createNotFoundException(
            'Aucun produit trouvé pour cet id : '.$id
        );
    }

    $these->setSpecialite($newSpecialite);
    $em->flush();

    return $this->redirect($this->generateUrl('homepage'));
	}

	public function updateLaboratoire($id, $newlaboratoire)
	{
   
    $these = $em->getRepository('DT/DoctoramaBundle/Entity:These')->find($id);

    if (!$these) {
        throw $this->createNotFoundException(
            'Aucun produit trouvé pour cet id : '.$id
        );
    }

    $these->setlaboratoire($newlaboratoire);
    $em->flush();

    return $this->redirect($this->generateUrl('homepage'));
	}

	public function updateFinancement($id, $newFinancement)
	{
  
    $these = $em->getRepository('DT/DoctoramaBundle/Entity:These')->find($id);

    if (!$these) {
        throw $this->createNotFoundException(
            'Aucun produit trouvé pour cet id : '.$id
        );
    }

    $these->setFinancement($newFinancement);
    $em->flush();

    return $this->redirect($this->generateUrl('homepage'));
	}

	public function updatedateDebut($id, $newdateDebut)
	{
   
    $these = $em->getRepository('DT/DoctoramaBundle/Entity:These')->find($id);

    if (!$these) {
        throw $this->createNotFoundException(
            'Aucun produit trouvé pour cet id : '.$id
        );
    }

    $these->setdateDebut($newdateDebut);
    $em->flush();

    return $this->redirect($this->generateUrl('homepage'));
	}

	public function updatedateDeSoutenance($id, $newdateDeSoutenance)
	{
 
	$these = $em->getRepository('DT/DoctoramaBundle/Entity:These')->find($id);

    if (!$These) {
        throw $this->createNotFoundException(
            'Aucun produit trouvé pour cet id : '.$id
        );
    }

    $these->setdateDeSoutenance($newdateDeSoutenance);
    $em->flush();

    return $this->redirect($this->generateUrl('homepage'));
	}

	public function updateMention($id, $newMention)
	{
 
    $these = $em->getRepository('DT/DoctoramaBundle/Entity:These')->find($id);

    if (!$these) {
        throw $this->createNotFoundException(
            'Aucun produit trouvé pour cet id : '.$id
        );
    }

    $these->setMention($newMention);
    $em->flush();

    return $this->redirect($this->generateUrl('homepage'));
	}

	

	
	public function deleteThese($id)
	{
 
    $these = $em->getRepository('DT/DoctoramaBundle/Entity:These')->find($id);

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