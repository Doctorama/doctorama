<?php
namespace DT\DoctoramaBundle\Services;
//QuestionService
use DT\DoctoramaBundle\Entity\Question;

/**
 * Services associes a l'entite Question
 */
class QuestionService
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
		$this->repository = $this->em->getRepository('DTDoctoramaBundle:Question');
	}
    
	/**
	* Set Question
	*
	* @param string $question
	* @param $fiche
	*
	* @return Question
	**/
	public function createQuestion($question, $fiche)
	{
		$question = new Question();
		$question->setQuestion($question);
		$question->setFiche($fiche);
		
		$em = $this->getDoctrine()->getManager();
		$em->persist($Question);
		$em->flush();
		
		return $question;
	}
	
	/**
	* get QuestionById
	*
	* @param \integer $id
	* @return Question
	**/
	public function findbyId($id)
	{
   		
        $these = $repository->find($id);

   		if (!$question) {
        throw $this->createNotFoundException(
            'Aucun element trouvé pour cet id : '.$id
        );
    	}
    	else 
    	{
    		return $question;
    	}
    }
	
	/**
	* get QuestionByQuestion
	*
	* @param string $question
	* @return Question
	**/
    public function findByQuestion($question)
	{

		$these = $repository->find($question);

		if (!$question) {
        throw $this->createNotFoundException(
            'Aucun element trouvé pour : '.$question );
    	}
    	else {
    		return $question;
    	}

	}
	
	/**
	* Set Question
	*
	* @param \integer $id
	* @param string $newQuestion
	*
	* @return Question
	**/
	public function updateQuestion($id, $newQuestion)
	{
   
		$question = $em->getRepository('DT/DoctoramaBundle/Entity:Question')->find($id);

		if (!$question) {
			throw $this->createNotFoundException(
				'Aucun produit trouvé pour cet id : '.$id
			);
		}

		$question->setQuestion($newQuestion);
		$em->flush();

		return $this->redirect($this->generateUrl('homepage'));
	}
	
	/**
	* Delete Question
	*
	* @param \integer $id
	*
	* @return True
	**/
	public function deleteQuestion($id)
	{
   
		$question = $em->getRepository('DT/DoctoramaBundle/Entity:Question')->find($id);

		if (!$Question) {
			throw $this->createNotFoundException(
				'Aucun produit trouvé pour cet id : '.$id
			);
		}
		$em->remove($question);
		$em->flush();

		return $question;
	}
	
}