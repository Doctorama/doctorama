<?php

//QuestionService
require_once __DIR__ . '/../Entity/Question.php';

class QuestionService
{
	$repository = $this->getDoctrine()->getRepository('DT/DoctoramaBundle/Entity:Question');
	$em = $this->getDoctrine()->getManager();
    

	public function createQuestion($question, $fiche)
	{
		$question = new Question();
		$question->setQuestion($question);
		
		$question->setFiche($fiche);
		//ou
		/*
		foreach($personnes as $personne)
		{
			$reunion->addPersonne($personne);
		}
		*/
		
		$em = $this->getDoctrine()->getManager();
		$em->persist($Question);
		$em->flush();

	}

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