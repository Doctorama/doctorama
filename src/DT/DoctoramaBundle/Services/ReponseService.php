<?php
namespace DT\DoctoramaBundle\Services;
//ReponseService
use DT\DoctoramaBundle\Entity\Reponse;

/**
 * Services associes a l'entite Reponse
 */
class ReponseService
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
		$this->repository = $this->em->getRepository('DTDoctoramaBundle:Reponse');
	}
    
	/**
	* Create Reponse
	*
	* @param string $reponse
	*
	* @return Reponse
	**/
	public function createReponse($reponse)
	{
		$rep = new Reponse();
		$rep->setDate($date);
		
		$rep->setReponse($reponse);
		$em = $this->getDoctrine()->getManager();
		$em->persist($rep);
		$em->flush();
	}
	
	/**
	* get ReponseById
	*
	* @param \integer $id
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
	* @param \integer $reponse
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
	* @param \integer $id
	* @param Reponse $newReponse
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
	* Delete Reponse
	*
	* @param \integer $id
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