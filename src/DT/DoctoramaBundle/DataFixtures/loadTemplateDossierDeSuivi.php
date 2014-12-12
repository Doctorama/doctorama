<?php

namespace DT\DoctoramaBundle\DataFixtures;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use DT\DoctoramaBundle\Entity\TemplateFicheSuivi;
use DT\DoctoramaBundle\Entity\DossierDeSuivi;

class loadTemplateDossierDeSuivi implements FixtureInterface{
	public function load(ObjectManager $manager){
		$template = new TemplateFicheSuivi;
		$template->setTitre('Un template');
		
		$template2 = new TemplateFicheSuivi;
		$template2->setTitre('Un template');
		
		$manager->persist($template);
		$manager->persist($template2);
		$manager->flush();
		
		$t = $manager->getRepository('DTDoctoramaBundle:DossierDeSuivi')->findById(1);
		$t2 = $manager->getRepository('DTDoctoramaBundle:DossierDeSuivi')->findById(2);
		
		$template->setDossierDeSuivi($t[0]);
		$template2->setDossierDeSuivi($t2[0]);
		
		$manager->flush();
	}
}