<?php

namespace DT\DoctoramaBundle\DataFixtures;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;

use DT\DoctoramaBundle\Entity\DirecteurDeLaboratoire;
use DT\SecurityBundle\Entity\Compte;

class loadDirecteurDeLaboratoire extends AbstractFixture implements OrderedFixtureInterface{
	public function load(ObjectManager $manager){
		$directeurLabo = new DirecteurDeLaboratoire;
		
		$directeurLabo->setNom('Toto');
		$directeurLabo->setPrenom('Titi');
		$directeurLabo->setNomUsage('Toto');
		$directeurLabo->setCivilite('Monsieur');
		$directeurLabo->setAdresse('1 rue des roses');
		$directeurLabo->setMail('toto@adresse.com');
		$directeurLabo->setDateDeNaissance(new \DateTime('2000-01-01'));
		$directeurLabo->setNationalite('FR');
		$directeurLabo->setVilleDeNaissance('La Rochelle');
		$directeurLabo->setPaysDeNaissance('France');
		$directeurLabo->setDepDeNaissance('17');
		
		$compte = new Compte;
		$compte->setUsername('TToto');
		$compte->setPlainPassword('1234');
		$compte->setEnabled(true);
		$compte->setEmail('ttoto@adresse.com');
		$compte->setDirecteur($directeurLabo);
		
		$manager->persist($directeurLabo);
		$manager->persist($compte);
		$manager->flush();
	}
	//fonction ordre des fixtures
	public function getOrder(){
		return 1;
	}
}