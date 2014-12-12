<?php

namespace DT\DoctoramaBundle\DataFixtures;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use DT\DoctoramaBundle\Entity\Doctorant;
use DT\DoctoramaBundle\Entity\These;
use DT\SecurityBundle\Entity\Compte;

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

		$doctorant2 = new Doctorant;
		
		$doctorant2->setNom('Durand');
		$doctorant2->setPrenom('titi');
		$doctorant2->setNomUsage('Durand');
		$doctorant2->setCivilite('Monsieur');
		$doctorant2->setAdresse('1 rue des roses');
		$doctorant2->setMail('Durand@adresse.com');
		$doctorant2->setDateDeNaissance(new \DateTime('2000-01-01'));
		$doctorant2->setNationalite('FR');
		$doctorant2->setVilleDeNaissance('La Rochelle');
		$doctorant2->setPaysDeNaissance('France');
		$doctorant2->setDepDeNaissance('17');
		
		$doctorant2->setDepDernierDiplome('17');
		
		$doctorant2->setNumEtudiant('15526398958');
		$doctorant2->setBourseEtExoneration(0);
		$doctorant2->setDateInscr1eThese('2010-09-03');
		$doctorant2->setDCACE('');
		$doctorant2->setNomFormationMaster('ICONE');
		$doctorant2->setUniversiteMaster('ULR');
		$doctorant2->setSujetMaster('M1');
		$doctorant2->setLaboratoireAcceuilMaster('L3I');
		$doctorant2->setEncadrantsMaster('A. Revel');
		$doctorant2->setEtabDernierDiplome('ULR');
		$doctorant2->setPaysDernierDiplome('France');
		$doctorant2->setLibelleDernierDiplome('ICONE');
		$doctorant2->setAnneeDernierDiplome('2014-06-20');

		$compte = new Compte;
		$compte->setUsername('TDupond');
		$compte->setPlainPassword('1234');
		$compte->setEnabled(true);
		$compte->setEmail('dupond@adresse.com');
		$compte->setDoctorant($doctorant);
		
		$compte2 = new Compte;
		$compte2->setUsername('TDurand');
		$compte2->setPlainPassword('4567');
		$compte2->setEnabled(true);
		$compte2->setEmail('durand@adresse.com');
		$compte2->setDoctorant($doctorant2);
		
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
		
		$these2 = new These;
		
		$these2->setTitreThese('Une These2');
		$these2->setSujetThese('un Sujet');
		$these2->setSpecialite('Informatique');
		$these2->setLaboratoire('L3I');
		$these2->setAxeThematique('info');
		$these2->setAxeScientifique('aaa');
		$these2->setFinancement('Une societe');
		$these2->setDateDebut(new \DateTime('2014-01-01'));
		$these2->setDateDESoutenance(new \DateTime('2017-01-01'));
		$these2->setMention('Bien');
		
		/********************* Association Doctorant These *************************/
		
		
		$manager->persist($doctorant);
		$manager->persist($these);
		$manager->persist($doctorant2);
		$manager->persist($these2);
		$manager->persist($compte);
		$manager->persist($compte2);
		
		$manager->flush();
		
		$th = $manager->getRepository('DTDoctoramaBundle:These')->findByTitreThese('Une These');
		$doctorant->setThese($th[sizeof($th)-1]);
		$th2 = $manager->getRepository('DTDoctoramaBundle:These')->findByTitreThese('Une These2');
		$doctorant2->setThese($th2[sizeof($th2)-1]);
		
		$manager->flush();
		
	}
}