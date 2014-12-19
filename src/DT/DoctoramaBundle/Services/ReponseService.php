<?php
namespace DT\DoctoramaBundle\Services;
//ReponseService
use DT\DoctoramaBundle\Entity\Reponse;

class ReponseService
{
	$repository = $this->getDoctrine()->getRepository('DT/DoctoramaBundle/Entity:Reponse');
	$em = $this->getDoctrine()->getManager();
    
/**
	* Set Reponse
	*
	* @param $reponse, $Reponse
	*
	* @return Reponse
	**/
	public function createReponse($reponse, $Reponse)
	{
		$reponse = new Reponse();
		$reponse->setDate($date);
		
		$reponse->setReponse($Reponse);
		$em = $this->getDoctrine()->getManager();
		$em->persist($reponse);
		$em->flush();
	}
/**
	* get ReponseById
	*
	* @param ReponseById $id
	* @return Reponse
	**/
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
	/**
	* get ReponseByReponse
	*
	* @param ReponseByReponse $reponse
	* @return Reponse
	**/
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
/**
	* Set Reponse
	*
	* @param Reponse $id, $newReponse
	*
	* @return Reponse
	**/
	public function updateReponse($id, $newReponse)
	{
    $reponse = $em->getRepository('DT/DoctoramaBundle/Entity:Reponse')->find($id);

    if (!$reponse) {
        throw $this->createNotFoundException(
            'Aucun produit trouvé pour cet id : '.$id
        );
    }

    $reponse->setReponse($newReponse);
    $em->flush();

    return $this->redirect($this->generateUrl('homepage'));
	}
/**
	* Set Reponse
	*
	* @param Reponse $id
	*
	* @return True
	**/
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