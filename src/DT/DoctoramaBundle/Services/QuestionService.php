<?php
namespace DT\DoctoramaBundle\Services;
//QuestionService
use DT\DoctoramaBundle\Entity\Question;

class QuestionService
{
	$repository = $this->getDoctrine()->getRepository('DT/DoctoramaBundle/Entity:Question');
	$em = $this->getDoctrine()->getManager();
    
/**
	* Set Question
	*
	* @param $question, $fiche
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

	}
/**
	* get QuestionById
	*
	* @param QuestionById $id
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
	* @param QuestionByQuestion $question
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
	* @param Question $id, $newQuestion
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
	* Set Question
	*
	* @param Question $id
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