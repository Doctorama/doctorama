<?php

//src/DT/DoctoramaBundle/DataFixtures/loadQuestionReponse

namespace DT\DoctoramaBundle\DataFixtures;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use DT\DoctoramaBundle\Entity\Reponse;
use DT\DoctoramaBundle\Entity\Question;

class loadQuestionReponse implements FixtureInterface{

	// dans l'argument de la méthode load , l'objet $manager est l'entityManager
	public function load(ObjectManager $manager){
		

		// On récupère la question grace à l' $id
    	$question = $manager->getRepository('DTDoctoramaBundle:Question')->find(1);

    	// Création des deux réponses
		$reponse = new Reponse;

		// La résponse sera "4"
		$reponse->setReponse('4');

		// Elle sera associé à la question avec l'id= 1 
		$reponse->setQuestion($question);

		$manager->persist($reponse);			
		$manager->flush();
		
	}
	
}