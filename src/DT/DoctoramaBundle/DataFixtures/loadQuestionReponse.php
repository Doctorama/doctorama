<?php

//src/DT/DoctoramaBundle/DataFixtures/loadQuestionReponse

namespace DT\DoctoramaBundle\DataFixtures;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;

use DT\DoctoramaBundle\Entity\Reponse;
use DT\DoctoramaBundle\Entity\Question;

class loadQuestionReponse extends AbstractFixture implements OrderedFixtureInterface{

	// dans l'argument de la méthode load , l'objet $manager est l'entityManager
	public function load(ObjectManager $manager){
		

		// On récupère la question grace à l' $id
    	$question = $manager->getRepository('DTDoctoramaBundle:Question')->find(1);

    	// Création des deux réponses
		$reponse = new Reponse;
		$reponse1 = new Reponse;

		// La résponse sera "4"
		$reponse->setReponse('4');
		// Non la réponse c'est blanc !
		$reponse1->setReponse("Non c'est blanc !");

		// Elle sera associé à la question avec l'id= 1 
		$reponse->setQuestion($question);
		$reponse1->setQuestion($question);

		$manager->persist($reponse);			
		$manager->persist($reponse1);	
		$manager->flush();
		
	}
	//fonction ordre des fixtures
	public function getOrder(){
		return 6;
	}
	
}