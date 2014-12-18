<?php

namespace DT\DoctoramaBundle\DataFixtures;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;

use DT\DoctoramaBundle\Entity\TemplateFicheSuivi;
use DT\DoctoramaBundle\Entity\DossierDeSuivi;
use DT\DoctoramaBundle\Entity\Fiche;

class loadFiche extends AbstractFixture implements OrderedFixtureInterface{
	public function load(ObjectManager $manager){
		$fiche = new Fiche;
		$fiche->setTitre('Un titre');
		
		$fiche2 = new Fiche;
		$fiche2->setTitre('Un titre2');
		
		$fiche3 = new Fiche;
		$fiche3->setTitre('Un titre3');
		
		$fiche4 = new Fiche;
		$fiche4->setTitre('Un titre4');
		
		$fiche5 = new Fiche;
		$fiche5->setTitre('Un titre5');
		
		$manager->persist($fiche);
		$manager->persist($fiche2);
		$manager->persist($fiche3);
		$manager->persist($fiche4);
		$manager->persist($fiche5);
		
		$d = $manager->getRepository('DTDoctoramaBundle:DossierDeSuivi')->findById(1);
		$d2 = $manager->getRepository('DTDoctoramaBundle:DossierDeSuivi')->findById(2);
		$d3 = $manager->getRepository('DTDoctoramaBundle:DossierDeSuivi')->findById(3);
		$d4 = $manager->getRepository('DTDoctoramaBundle:DossierDeSuivi')->findById(4);
		
		$t = $manager->getRepository('DTDoctoramaBundle:TemplateFicheSuivi')->findById(1);
		$t2 = $manager->getRepository('DTDoctoramaBundle:TemplateFicheSuivi')->findById(2);
		$t3 = $manager->getRepository('DTDoctoramaBundle:TemplateFicheSuivi')->findById(3);
		$t4 = $manager->getRepository('DTDoctoramaBundle:TemplateFicheSuivi')->findById(4);
		$t5 = $manager->getRepository('DTDoctoramaBundle:TemplateFicheSuivi')->findById(5);
		
		$fiche->setDossierDeSuivi($d[0]);
		$fiche2->setDossierDeSuivi($d2[0]);
		$fiche3->setDossierDeSuivi($d3[0]);
		$fiche4->setDossierDeSuivi($d3[0]);
		$fiche5->setDossierDeSuivi($d4[0]);
		
		$fiche->setTemplatesFicheSuivi($t[0]);
		$fiche2->setTemplatesFicheSuivi($t2[0]);
		$fiche3->setTemplatesFicheSuivi($t3[0]);
		$fiche4->setTemplatesFicheSuivi($t3[0]);
		$fiche5->setTemplatesFicheSuivi($t4[0]);
		$fiche5->setTemplatesFicheSuivi($t5[0]);
		
		$manager->flush();
	}
	public function getOrder(){
		return 5;
	}
}