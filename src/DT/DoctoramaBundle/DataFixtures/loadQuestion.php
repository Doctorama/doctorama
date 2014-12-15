<?php

namespace DT\DoctoramaBundle\DataFixtures;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;


use DT\DoctoramaBundle\Entity\Question;
use DT\DoctoramaBundle\Entity\TemplateFicheSuivi;

class loadQuestion extends AbstractFixture implements OrderedFixtureInterface{

	public function load(ObjectManager $manager){
		$question = new Question;
		$question->setQuestion('Quel est la couleur du cheval blanc d\'henry 4 ?');
		
		$manager->persist($question);
			
		$manager->flush();
		
		$tfs = $manager->getRepository('DTDoctoramaBundle:TemplateFicheSuivi')->findByTitre('Un Template');
		$template = $tfs[sizeof($tfs)-1];
		$template->addQuestions($question);
		
		$manager->persist($template);
		
		$manager->flush();
	}
	//fonction ordre des fixtures
	public function getOrder(){
		return 5;
	}

}