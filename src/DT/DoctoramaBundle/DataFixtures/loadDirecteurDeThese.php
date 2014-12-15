<?php

namespace DT\DoctoramaBundle\DataFixtures;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;

use DT\DoctoramaBundle\Entity\These;
use DT\DoctoramaBundle\Entity\Encadrant;
use DT\SecurityBundle\Entity\Compte;

class loadDirecteurDeThese extends AbstractFixture implements OrderedFixtureInterface{
	public function load(ObjectManager $manager){
		$directeur = new Encadrant;
		$directeur->setNom('Toto');
		$directeur->setPrenom('Jean');
		$directeur->setNomUsage('Toto');
		$directeur->setCivilite('Monsieur');
		$directeur->setAdresse('1 rue des roses');
		$directeur->setMail('toto@adresse.com');
		$directeur->setDateDeNaissance(new \DateTime('2000-01-01'));
		$directeur->setNationalite('FR');
		$directeur->setVilleDeNaissance('La Rochelle');
		$directeur->setPaysDeNaissance('France');
		$directeur->setDepDeNaissance('17');
		
		$compte = new Compte;
		$compte->setUsername('JToto');
		$compte->setPlainPassword('5678');
		$compte->setEnabled(true);
		$compte->setEmail('toto@adresse.com');
		$compte->setEncadrant($directeur);
		
		$manager->persist($directeur);
		$manager->persist($compte);
		$manager->flush();
		
		$dir = $manager->getRepository('DTDoctoramaBundle:These')->findByTitreThese('Une These');
		$these = $dir[sizeof($dir)-1];
		$these->addDirecteursDeThese($directeur);
        $manager->persist($these);
    
		$manager->flush();
	}
	public function getOrder(){
		return 3;
	}
}