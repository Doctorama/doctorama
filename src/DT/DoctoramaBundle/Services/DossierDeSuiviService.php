<?php

//DossierDeSuiviService
require_once __DIR__ . '/../Entity/DossierDeSuivi.php';

class DossierDeSuiviService
{
	$repository = $this->getDoctrine()->getRepository('DT/DoctoramaBundle/Entity:DossierDeSuivi');
	$em = $this->getDoctrine()->getManager();


	public function createDossierDeSuivi($coms)
	{
		$dossierDeSuivi = new DossierDeSuivi();
		$dossierDeSuivi->setComs($coms);
		
		//$reunion->setPersonnes($personnes);
		//ou
		/*
		foreach($personnes as $personne)
		{
			$reunion->addPersonne($personne);
		}
		*/
		
		$em = $this->getDoctrine()->getManager();
		$em->persist($dossierDeSuivi);
		$em->flush();
	}

	public function findbyId($id)
	{
   		$these = $repository->find($id);

   		if (!$dossierDeSuivi) {
        throw $this->createNotFoundException(
            'Aucun produit trouvé pour cet id : '.$id
        );
    	}
    }
	
    public function findByComs($coms)
	{

		$these = $repository->find($id);

		$dossierDeSuivi = $repository->findByComs($coms);

		if (!$dossierDeSuivi) {
        throw $this->createNotFoundException(
            'Aucun element trouvé pour :'.$coms
        );

    	}

	}

	public function updateComs($id, $ncoms)
	{

    $dossierDeSuivi = $em->getRepository('DT/DoctoramaBundle/Entity:dossierDeSuivi')->find($id);


    if (!$dossierDeSuivi) {
        throw $this->createNotFoundException(
            'Aucun produit trouvé pour cet id : '.$id
        );
    }

    $dossierDeSuivi->setComs($ncoms);
    $em->flush();

    return $this->redirect($this->generateUrl('homepage'));
	}

	public function deleteDossierDeSuivi($id)
    {
    $dossierDeSuivi = $em->getRepository('DT/DoctoramaBundle/Entity:DossierDeSuivi')->find($id);


    if (!$dossierDeSuivi) {
        throw $this->createNotFoundException(
            'Aucun produit trouvé pour cet id : '.$id
        );
    }
    $em->remove($dossierDeSuivi);
    $em->flush();

    return $dossierDeSuivi;
    }


}