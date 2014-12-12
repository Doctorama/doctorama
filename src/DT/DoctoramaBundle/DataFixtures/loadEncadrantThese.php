<?php

namespace DT\DoctoramaBundle\DataFixtures;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use DT\DoctoramaBundle\Entity\These;
use DT\DoctoramaBundle\Entity\Encadrant;
use DT\SecurityBundle\Entity\Compte;

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
		
		$encadrant2 = new Encadrant;
		
		$encadrant2->setNom('Revel');
		$encadrant2->setPrenom('Arnaud');
		$encadrant2->setNomUsage('Revel');
		$encadrant2->setCivilite('Monsieur');
		$encadrant2->setAdresse('1 rue des roses');
		$encadrant2->setMail('revel@adresse.com');
		$encadrant2->setDateDeNaissance(new \DateTime('2000-01-01'));
		$encadrant2->setNationalite('FR');
		$encadrant2->setVilleDeNaissance('La Rochelle');
		$encadrant2->setPaysDeNaissance('France');
		$encadrant2->setDepDeNaissance('17');
		
		$compte = new Compte;
		$compte->setUsername('CDemko');
		$compte->setPlainPassword('1234');
		$compte->setEnabled(true);
		$compte->setEmail('demko@adresse.com');
		$compte->setEncadrant($encadrant);
		
		$compte2 = new Compte;
		$compte2->setUsername('ARevel');
		$compte2->setPlainPassword('4567');
		$compte2->setEnabled(true);
		$compte2->setEmail('revel@adresse.com');
		$compte2->setEncadrant($encadrant2);
		
		$manager->persist($encadrant);
		$manager->persist($encadrant2);
		$manager->persist($compte);
		$manager->persist($compte2);
		$manager->flush();
		
		$en = $manager->getRepository('DTDoctoramaBundle:These')->findByTitreThese('Une These');
		$en2 = $manager->getRepository('DTDoctoramaBundle:These')->findByTitreThese('Une These2');
		$these = $en[sizeof($en)-1];
		$these2 = $en2[sizeof($en2)-1];
		$these->addEncadrant($encadrant);
		$these2->addEncadrant($encadrant2);
		
		$manager->flush();
		
	}
}