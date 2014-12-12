<?php

namespace DT\DoctoramaBundle\DataFixtures;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;


use Doctrine\Common\Persistence\ObjectManager;

use DT\DoctoramaBundle\Entity\These;

class loadThese extends AbstractFixture implements OrderedFixtureInterface{

	public function load(ObjectManager $manager){
		/*$these = new These;
		
		$these->setTitreThese('Une These');
		$these->setSujetThese('un Sujet');
		$these->setSpecialite('Informatique');
		$these->setLaboratoire('L3I');
		$these->setAxeThematique('info');
		$these->setAxeScientifique('aaa');
		$these->setFinancement('Une societe');
		$these->setDateDebut(new \DateTime('2014-01-01'));
		$these->setDateDESoutenance(new \DateTime('2017-01-01'));
		$these->setMention('Bien');
		
		$manager->persist($these);
			
		$manager->flush();*/
	
	}	

	//focntion ordre des fixtures
	public function getOrder(){
		return 1;
	}
}