<?php

namespace DT\DoctoramaBundle\DataFixtures;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use DT\DoctoramaBundle\Entity\These;
use DT\DoctoramaBundle\Entity\Encadrant;

class loadEncadrantThese implements FixtureInterface{
	public function load(ObjectManager $manager){
		/********************* Declaration Encadrant *************************/
		$encadrant = new Encadrant;
		
		$encadrant->setNom('Demko');
		$encadrant->setPrenom('Christophe');
		$encadrant->setNomUsage('Demko');
		$encadrant->setCivilite('Monsieur');
		$encadrant->setAdresse('1 rue des roses');
		$encadrant->setMail('Demko@adresse.com');
		$encadrant->setDateDeNaissance(new \DateTime('2000-01-01'));
		$encadrant->setNationalite('FR');
		$encadrant->setVilleDeNaissance('La Rochelle');
		$encadrant->setPaysDeNaissance('France');
		$encadrant->setDepDeNaissance('17');
		//$encadrant->setDepDernierDiplome('17');
		
		$manager->persist($encadrant);
		$manager->flush();
		
		$en = $manager->getRepository('DTDoctoramaBundle:These')->findByTitreThese('Une These');
		
		$encadrant->addThese($en[0]);
		
		$manager->flush();
		
	}
}