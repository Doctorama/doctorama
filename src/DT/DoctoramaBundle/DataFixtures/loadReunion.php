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
		$reunion->setLibelle('T6');
		
		$reunion2 = new Reunion;
		$reunion2->setLieu('Pascal 22');
		$reunion2->setDate(new \DateTime('2014-12-18'));
		$reunion2->setLibelle('T6');
		
		$reunion3 = new Reunion;
		$reunion3->setLieu('Pascal 25');
		$reunion3->setDate(new \DateTime('2014-12-19'));
		$reunion3->setLibelle('T6');
		
		$manager->persist($reunion);
		$manager->persist($reunion2);
		$manager->persist($reunion3);
		$manager->flush();
		
		$doc = $manager->getRepository('DTDoctoramaBundle:Doctorant')->findById(1);
		$doctorant = $doc[0];
		$doctorant->addReunion($reunion);
		$enc = $manager->getRepository('DTDoctoramaBundle:Encadrant')->findById(1);
		$encadrant = $enc[0];
		$encadrant->addReunion($reunion);
		
		$enc1 = $manager->getRepository('DTDoctoramaBundle:Encadrant')->findById(2);
		$doc1 = $manager->getRepository('DTDoctoramaBundle:Doctorant')->findById(2);
		$doctorant = $doc1[0];
		$doctorant->addReunion($reunion2);
		$encadrant = $enc1[0];
		$encadrant->addReunion($reunion2);
		$doctorant = $doc1[0];
		$doctorant->addReunion($reunion3);
		$encadrant = $enc1[0];
		$encadrant->addReunion($reunion3);
		
		$manager->persist($doctorant);
		$manager->persist($encadrant);
		$manager->flush();
	}
	//fonction ordre des fixtures
	public function getOrder(){
		return 5;
	}
}