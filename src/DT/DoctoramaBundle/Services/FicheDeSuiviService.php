<?php

//FicheDeSuiviService
require_once __DIR__ . '/../Entity/FicheDeSuivi.php';

class FicheDeSuiviService
{
	$repository = $this->getDoctrine()->getRepository('DT/DoctoramaBundle/Entity:FicheDeSuivi');
	$em = $this->getDoctrine()->getManager();
    

	public function createFicheDeSuivi($idType, $titre)
	{
		$ficheDeSuivi = new FicheDeSuivi();
		$ficheDeSuivi->setIdType($idType);
		$ficheDeSuivi->setTitre($titre);
		
		//$reunion->setPersonnes($personnes);
		//ou
		/*
		foreach($personnes as $personne)
		{
			$reunion->addPersonne($personne);
		}
		*/
		
		$em = $this->getDoctrine()->getManager();
		$em->persist($ficheDeSuivi);
		$em->flush();
	}


	public function findbyId($id)
	{
   		
        $these = $repository->find($id);

   		if (!$ficheDeSuivi) {
        throw $this->createNotFoundException(
            'Aucun produit trouvé pour cet id : '.$id
        );
    	}
    }
	
    public function findByIdType($idType)
	{

		$these = $repository->find($idType);

		if (!$ficheDeSuivi) {
        throw $this->createNotFoundException(
            'Aucun element trouvé pour : '.$idType );
    	}
    	else {
    		$ficheDeSuivi = $repository->findByIdType($idType);
    	}

	}

	public function findByTitre($titre)
	{

		$these = $repository->find($titre);
  	    
		if (!$ficheDeSuivi) {
        throw $this->createNotFoundException(
            'Aucun element trouvé pour : '.$titre );
    	}
    	else {
    		$ficheDeSuivi = $repository->findByTitre($titre);
    	}
	}

	public function updateIdType($id, $newIdType)
	{
    
    $ficheDeSuivi = $em->getRepository('DT/DoctoramaBundle/Entity:FicheDeSuivi')->find($id);

    if (!$ficheDeSuivi) {
        throw $this->createNotFoundException(
            'Aucun produit trouvé pour cet id : '.$id
        );
    }

    $ficheDeSuivi->setIdType($newIdType);
    $em->flush();

    return $this->redirect($this->generateUrl('homepage'));
	}

	public function updateTitle($id, $newTitre)
	{

     $ficheDeSuivi = $em->getRepository('DT/DoctoramaBundle/Entity:FicheDeSuivi')->find($id);

    if (!$ficheDeSuivi) {
        throw $this->createNotFoundException(
            'Aucun produit trouvé pour cet id : '.$id
        );
    }

    $ficheDeSuivi->setTitre($newTitre);
    $em->flush();

    return $this->redirect($this->generateUrl('homepage'));
	}

	public function deleteFicheDeSuivi($id)
	{

    $ficheDeSuivi = $em->getRepository('DT/DoctoramaBundle/Entity:FicheDeSuivi')->find($id);

    if (!$ficheDeSuivi) {
        throw $this->createNotFoundException(
            'Aucun produit trouvé pour cet id : '.$id
        );
    }
    $em->remove($ficheDeSuivi);
	$em->flush();
	
	return $ficheDeSuivi;
	}
	
}