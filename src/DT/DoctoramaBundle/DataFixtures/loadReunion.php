<?php

namespace DT\DoctoramaBundle\DataFixtures;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;

use DT\DoctoramaBundle\Entity\Reunion;
use DT\DoctoramaBundle\Entity\Doctorant;
use DT\DoctoramaBundle\Entity\Encadrant;

class loadReunion extends AbstractFixture implements OrderedFixtureInterface{
	public function load(ObjectManager $manager){
		$reunion = new Reunion;
		$reunion->setLieu('Pascal 128');
		$reunion->setDate(new \DateTime('2014-12-16'));
		
		$manager->persist($reunion);
		$manager->flush();
		
		$doc = $manager->getRepository('DTDoctoramaBundle:Doctorant')->findById(1);
		$doctorant = $doc[0];
		$doctorant->addReunion($reunion);
		$enc = $manager->getRepository('DTDoctoramaBundle:Encadrant')->findById(1);
		$encadrant = $enc[0];
		$encadrant->addReunion($reunion);
		
		$manager->persist($doctorant);
		$manager->persist($encadrant);
		$manager->flush();
	}
	//fonction ordre des fixtures
	public function getOrder(){
		return 5;
	}
}