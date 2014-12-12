<?php

namespace DT\DoctoramaBundle\DataFixtures;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use DT\DoctoramaBundle\Entity\These;
use DT\DoctoramaBundle\Entity\DossierDeSuivi;

class loadDossierDeSuiviThese implements FixtureInterface{
	public function load(ObjectManager $manager){
		$dossierDeSuivi = new DossierDeSuivi;
		$dossierDeSuivi->setCommentaires('Un commentaire');
		
		$dossierDeSuivi2 = new DossierDeSuivi;
		$dossierDeSuivi2->setCommentaires('Un commentaire');
		
		$manager->persist($dossierDeSuivi);
		$manager->persist($dossierDeSuivi2);
		$manager->flush();
		
		$dds = $manager->getRepository('DTDoctoramaBundle:These')->findByTitreThese('Une These');
		$dds2 = $manager->getRepository('DTDoctoramaBundle:These')->findByTitreThese('Une These2');
		
		$dossierDeSuivi->setThese($dds[sizeof($dds)-1]);
		$dossierDeSuivi2->setThese($dds2[sizeof($dds2)-1]);
		
		$manager->flush();
	}
}