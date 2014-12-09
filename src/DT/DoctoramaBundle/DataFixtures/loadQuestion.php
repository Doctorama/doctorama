<?php

namespace DT\DoctoramaBundle\DataFixtures;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use DT\DoctoramaBundle\Entity\Question;

class loadQuestion implements FixtureInterface{

	public function load(ObjectManager $manager){
		$question = new Question;
		$question->setQuestion('Quel est la couleur du cheval blanc d\'henry 4 ?');
		
		$manager->persist($question);
			
		$manager->flush();
	}

}