<?php

namespace DT\DoctoramaBundle\DataFixtures;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use DT\DoctoramaBundle\Entity\Doctorant;

class loadDoctorant implements FixtureInterface{

	public function load(ObjectManager $manager){
		/*$doctorant = new Doctorant;
		
		$doctorant->setNom('toto');
		$doctorant->setPrenom('titi');
		$doctorant->setNomUsage('toto');
		$doctorant->setCivilite('Monsieur');
		$doctorant->setAdresse('1 rue des roses');
		$doctorant->setMail('toto@adresse.com');
		$doctorant->setDateDeNaissance(new \DateTime('2000-01-01'));
		$doctorant->setNationalite('FR');
		$doctorant->setVilleDeNaissance('La Rochelle');
		$doctorant->setPaysDeNaissance('France');
		$doctorant->setDepDeNaissance('17');
		
		$doctorant->setDepDernierDiplome('17');
		
		$doctorant->setNumEtudiant('15526398958');
		$doctorant->setBourseEtExoneration(0);
		$doctorant->setDateInscr1eThese('2010-09-03');
		$doctorant->setDCACE('');
		$doctorant->setNomFormationMaster('ICONE');
		$doctorant->setUniversiteMaster('ULR');
		$doctorant->setSujetMaster('M1');
		$doctorant->setLaboratoireAcceuilMaster('L3I');
		$doctorant->setEncadrantsMaster('C. Demko');
		$doctorant->setEtabDernierDiplome('ULR');
		$doctorant->setPaysDernierDiplome('France');
		$doctorant->setLibelleDernierDiplome('ICONE');
		$doctorant->setAnneeDernierDiplome('2014-06-20');
		
		
		$manager->persist($doctorant);
			
		$manager->flush();*/
		
	}
	
}