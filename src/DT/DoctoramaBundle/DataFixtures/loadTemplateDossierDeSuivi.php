<?php

namespace DT\DoctoramaBundle\DataFixtures;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;

use DT\DoctoramaBundle\Entity\TemplateFicheSuivi;
use DT\DoctoramaBundle\Entity\DossierDeSuivi;

class loadTemplateDossierDeSuivi extends AbstractFixture implements OrderedFixtureInterface{
	public function load(ObjectManager $manager){
		$template = new TemplateFicheSuivi;
		$template->setTitre('T6');
		$template->setVersion(1);
		
		$template2 = new TemplateFicheSuivi;
		$template2->setTitre('T6');
		$template2->setVersion(2);
		
		$template3 = new TemplateFicheSuivi;
		$template3->setTitre('T12');
		$template3->setVersion(1);
		
		$template4 = new TemplateFicheSuivi;
		$template4->setTitre('T12');
		$template4->setVersion(2);
		
		$template5 = new TemplateFicheSuivi;
		$template5->setTitre('T18');
		$template5->setVersion(1);
		
		
		$manager->persist($template);
		$manager->persist($template2);
		$manager->persist($template3);
		$manager->persist($template4);
		$manager->persist($template5);
		$manager->flush();
		
		/*$t = $manager->getRepository('DTDoctoramaBundle:DossierDeSuivi')->findById(1);
		$t2 = $manager->getRepository('DTDoctoramaBundle:DossierDeSuivi')->findById(2);
		$t3 = $manager->getRepository('DTDoctoramaBundle:DossierDeSuivi')->findById(3);
		$t4 = $manager->getRepository('DTDoctoramaBundle:DossierDeSuivi')->findById(4);
		
		$template->setDossierDeSuivi($t[0]);
		$template2->setDossierDeSuivi($t2[0]);
		$template3->setDossierDeSuivi($t2[0]);
		$template4->setDossierDeSuivi($t3[0]);
		$template5->setDossierDeSuivi($t4[0]);
		
		$manager->flush();*/
	}
	//fonction ordre des fixtures
	public function getOrder(){
		return 4;
	}
}