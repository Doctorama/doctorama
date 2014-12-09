<?php

//ResponseService
require_once __DIR__ . '/../Entity/Reponse.php';

class ReponseService
{
	$repository = $this->getDoctrine()->getRepository('DT/DoctoramaBundle/Entity:Reponse');
	$em = $this->getDoctrine()->getManager();
    

	public function createReponse($reponse, $question)
	{
		$reponse = new Reponse();
		$reponse->setDate($date);
		
		$reponse->setQuestion($question);
		//ou
		/*
		foreach($personnes as $personne)
		{
			$reunion->addPersonne($personne);
		}
		*/
		
		$em = $this->getDoctrine()->getManager();
		$em->persist($reponse);
		$em->flush();
	}

	public function findbyId($id)
	{
   		
        $these = $repository->find($id);

   		if (!$reponse) {
        throw $this->createNotFoundException(
            'Aucun element trouvé pour : '.$id
        );
    	}
    	return $reponse;
    }
	
    public function findByreponse($reponse)
	{

		$these = $repository->find($reponse);

		if (!$reponse) {
        throw $this->createNotFoundException(
            'Aucun element trouvé pour :'.$reponse );
    	}
    	else {
    		returne $reponse;
    	}

	}

	public function updateReponse($id, $newReponse)
	{
    $reponse = $em->getRepository('DT/DoctoramaBundle/Entity:Reponse')->find($id);

    if (!$reponse) {
        throw $this->createNotFoundException(
            'Aucun produit trouvé pour cet id : '.$id
        );
    }

    $reponse->setQuestion($newReponse);
    $em->flush();

    return $this->redirect($this->generateUrl('homepage'));
	}

	public function deleteReponse($id)
	{
     $reponse = $em->getRepository('DT/DoctoramaBundle/Entity:Reponse')->find($id);

    if (!$reponse) {
        throw $this->createNotFoundException(
            'Aucun produit trouvé pour cet id : '.$id
        );
    }
    $em->remove($reponse);
	$em->flush();

	return $reponse;
	}



}