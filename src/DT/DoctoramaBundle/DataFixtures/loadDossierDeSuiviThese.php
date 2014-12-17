<?php

namespace DT\DoctoramaBundle\DataFixtures;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;

use DT\DoctoramaBundle\Entity\These;
use DT\DoctoramaBundle\Entity\DossierDeSuivi;

class loadDossierDeSuiviThese extends AbstractFixture implements OrderedFixtureInterface{
	public function load(ObjectManager $manager){
		$manager->getConnection()->prepare('set FOREIGN_KEY_CHECKS = 0;')->execute();
		$manager->getConnection()->prepare('truncate table dossierdesuivi')->execute();
		$manager->getConnection()->prepare('set FOREIGN_KEY_CHECKS = 1;')->execute();
		
		$dossierDeSuivi = new DossierDeSuivi;
		$dossierDeSuivi->setCommentaires('Un commentaire');
		
		$dossierDeSuivi2 = new DossierDeSuivi;
		$dossierDeSuivi2->setCommentaires('Un commentaire');
		
		$dossierDeSuivi3 = new DossierDeSuivi;
		$dossierDeSuivi3->setCommentaires('Un commentaire');
		
		$dossierDeSuivi4 = new DossierDeSuivi;
		$dossierDeSuivi4->setCommentaires('Un commentaire');
		
		$manager->persist($dossierDeSuivi);
		$manager->persist($dossierDeSuivi2);
		$manager->persist($dossierDeSuivi3);
		$manager->persist($dossierDeSuivi4);
		$manager->flush();
		
		$dds = $manager->getRepository('DTDoctoramaBundle:These')->findByTitreThese('Une These');
		$dds2 = $manager->getRepository('DTDoctoramaBundle:These')->findByTitreThese('Une These2');
		
		$dossierDeSuivi->setThese($dds[sizeof($dds)-1]);
		$dossierDeSuivi2->setThese($dds2[sizeof($dds2)-1]);
		
		$dds3 = $manager->getRepository('DTDoctoramaBundle:These')->findByTitreThese('Une These3');
		$dds4 = $manager->getRepository('DTDoctoramaBundle:These')->findByTitreThese('Une These4');
		
		$dossierDeSuivi3->setThese($dds3[sizeof($dds3)-1]);
		$dossierDeSuivi4->setThese($dds4[sizeof($dds4)-1]);
		
		$manager->flush();
	}
	//fonction ordre des fixtures
	public function getOrder(){
		return 3;
	}
}