<?php

namespace DT\DoctoramaBundle\DataFixtures;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use DT\DoctoramaBundle\Entity\Doctorant;
use DT\DoctoramaBundle\Entity\These;

class loadDoctorantThese implements FixtureInterface{
	public function load(ObjectManager $manager){
		/********************* Declaration Doctorant *************************/
		$doctorant = new Doctorant;
		
		$doctorant->setNom('Dupond');
		$doctorant->setPrenom('toto');
		$doctorant->setNomUsage('Dupond');
		$doctorant->setCivilite('Monsieur');
		$doctorant->setAdresse('1 rue des roses');
		$doctorant->setMail('dupond@adresse.com');
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
		
		/********************* Declaration These *************************/
		$these = new These;
		
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
		
		/********************* Association Doctorant These *************************/
		
		
		$manager->persist($doctorant);
		$manager->persist($these);
		
		$manager->flush();
		
		$th = $manager->getRepository('DTDoctoramaBundle:These')->findByTitreThese('Une These');
		$doctorant->setThese($th[0]);
		
		$manager->flush();
		
	}
}