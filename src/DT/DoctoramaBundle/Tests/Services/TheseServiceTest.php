<?php
namespace DT\DoctoramaBundle\Tests;

use DT\DoctoramaBundle\Services\TheseService;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use DT\DoctoramaBundle\Entity\These;
use DT\DoctoramaBundle\Entity\Encadrant;
use DT\DoctoramaBundle\Entity\Doctorant;
use DT\DoctoramaBundle\Entity\DossierDeSuivi;

/**
 * Tests associes a l'entite These
 */
class TheseServiceTest extends WebTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

	/**
	*	Permet de récupérer l'entitymanager de doctrine
	*/
    public function setUp()
    {
        static::$kernel = static::createKernel();
        static::$kernel->boot();
        $this->em = static::$kernel->getContainer()->get('doctrine.orm.entity_manager');
    }

	/**
	*	Permet de vider les tables utilisees lors des tests
	*/
	private function viderTable()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE encadrant_these")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE these")->execute();
		$this->em->getConnection()->prepare("TRUNCATE TABLE these_dossierdesuivi")->execute();
		$this->em->getConnection()->prepare("TRUNCATE TABLE encadrant")->execute();
		$this->em->getConnection()->prepare("TRUNCATE TABLE doctorant")->execute();
		$this->em->getConnection()->prepare("TRUNCATE TABLE dossierdesuivi")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
	}
	
	/**
	*	Permet de créer un encadrant
	*	@return Encadrant
	*/	
	public function create1Encadrant()
	{
		$encadrant = new Encadrant();
		
		$encadrant->setNom('Demko');
		$encadrant->setPrenom('Christophe');
		$encadrant->setNomUsage('Demko2');
		$encadrant->setCivilite('Monsieur');
		$encadrant->setAdresse('1 rue des roses');
		$encadrant->setMail('Demko@adresse.com');
		$encadrant->setDateDeNaissance(new \DateTime('2000-01-01'));
		$encadrant->setNationalite('FR');
		$encadrant->setVilleDeNaissance('La Rochelle');
		$encadrant->setPaysDeNaissance('France');
		$encadrant->setDepDeNaissance('17');
		
		$this->em->persist($encadrant);
		$this->em->flush();
		
		return $encadrant;
	}
	
	/**
	*	Permet de créer un dossier de suivi vide
	*	@return DossierDeSuivi
	*/
	public function create1DossierDeSuivi()
	{
		$dossierDeSuivi = new DossierDeSuivi;
		$dossierDeSuivi->setCommentaires('Un commentaire');
		
		$this->em->persist($dossierDeSuivi);
		$this->em->flush();
		
		return $dossierDeSuivi;
	}
	
	/**
	*	Permet de créer un doctorant
	*	@return Doctorant
	*/
	private function creer1Doctorant()
	{
		$doctorant = new Doctorant();
		
		$doctorant->setNom('Demko');
		$doctorant->setPrenom('Christophe');
		$doctorant->setNomUsage('Demko2');
		$doctorant->setCivilite('Monsieur');
		$doctorant->setAdresse('1 rue des roses');
		$doctorant->setMail('Demko@adresse.com');
		$doctorant->setDateDeNaissance(new \DateTime('2000-01-01'));
		$doctorant->setNationalite('FR');
		$doctorant->setVilleDeNaissance('La Rochelle');
		$doctorant->setPaysDeNaissance('France');
		$doctorant->setDepDeNaissance('17');
		$doctorant->setNumEtudiant('123456');
		$doctorant->setBourseEtExoneration('0');
		$doctorant->setDateInscr1eThese('2010-09-03');
		$doctorant->setDcace('rr');
		$doctorant->setNomFormationMaster('ICONE');
		$doctorant->setUniversiteMaster('ULR');
		$doctorant->setSujetMaster('M1');
		$doctorant->setLaboratoireAcceuilMaster('L3I');
		$doctorant->setEncadrantsMaster('C. Demko');
		$doctorant->setEtabDernierDiplome('ULR');
		$doctorant->setDepDernierDiplome('17');
		$doctorant->setPaysDernierDiplome('France');
		$doctorant->setLibelleDernierDiplome('ICONE');
		$doctorant->setAnneeDernierDiplome('2014-06-20');
		
		$this->em->persist($doctorant);
		$this->em->flush();
		
		return $doctorant;
	}
	
	/**
	*	Permet de créer une these
	*	@return These
	*/
	public function create1These()
	{
		$these = new These;
		
		$these->setTitreThese('Une These');
		$these->setSujetThese('un Sujet');
		$these->setSpecialite('Informatique');
		$these->setLaboratoire('L3I');
		$these->setAxeThematique('info');
		$these->setAxeScientifique('aaa');
		$these->setFinancement('Une societe');
		$these->setDateDebut(new \DateTime('2014-01-01'));
		$these->setDateDeSoutenance(new \DateTime('2017-01-01'));
		$these->setMention('Bien');
		
		$this->em->persist($these);			
		$this->em->flush();
		
		return $these;
	}
	
	/**
	*	Test de la création d'une these	
	*/
	public function testcreateThese()
	{
		$this->viderTable();
		$TS = new TheseService($this->em);
		$these = $TS->createThese('Une These', 'un Sujet', 'Informatique', 'L3I', 'info', 'aaa', 'Une societe', new \DateTime('2014-01-01'), new \DateTime('2017-01-01'), 'Bien');
		$enc1 = $this->create1Encadrant();
		$enc2 = $this->create1Encadrant();
		$dds = $this->create1DossierDeSuivi();
		$doc = $this->creer1Doctorant();
		
		$these->setDoctorant($doc);
		$these->addEncadrant($enc1);
		$these->addEncadrant($enc2);
		$these->setDossierDeSuivi($dds);
		$this->em->flush();
		
		$en = $this->em->getRepository('DTDoctoramaBundle:These')->findByTitreThese('Une These');
        $this->assertEquals(1, sizeof($en));
		
		$en = $this->em->getRepository('DTDoctoramaBundle:These')->findBySujetThese('un Sujet');
        $this->assertEquals(1, sizeof($en));
		
		$en = $this->em->getRepository('DTDoctoramaBundle:These')->findBySpecialite('Informatique');
        $this->assertEquals(1, sizeof($en));
		
		$en = $this->em->getRepository('DTDoctoramaBundle:These')->findByLaboratoire('L3I');
        $this->assertEquals(1, sizeof($en));
		
		$en = $this->em->getRepository('DTDoctoramaBundle:These')->findByAxeThematique('info');
        $this->assertEquals(1, sizeof($en));
		
		$en = $this->em->getRepository('DTDoctoramaBundle:These')->findByAxeScientifique('aaa');
        $this->assertEquals(1, sizeof($en));
		
		$en = $this->em->getRepository('DTDoctoramaBundle:These')->findByFinancement('Une societe');
        $this->assertEquals(1, sizeof($en));
		
		$en = $this->em->getRepository('DTDoctoramaBundle:These')->findByDateDebut(new \DateTime('2014-01-01'));
        $this->assertEquals(1, sizeof($en));
		
		$en = $this->em->getRepository('DTDoctoramaBundle:These')->findByDateDeSoutenance(new \DateTime('2017-01-01'));
        $this->assertEquals(1, sizeof($en));
		
		$en = $this->em->getRepository('DTDoctoramaBundle:These')->findByMention('Bien');
        $this->assertEquals(1, sizeof($en));		
		
		$en = $this->em->getRepository('DTDoctoramaBundle:These')->findByDoctorant($doc);
		$this->assertEquals(1, sizeof($en));
		
		$en = $this->em->getRepository('DTDoctoramaBundle:These')->findByDossierDeSuivi($dds);
		$this->assertEquals(1, sizeof($en));
		
	}
	
	/**
	*	Test de la recherche de theses par son id
	*/
	public function testfindById()
	{
		$this->viderTable();
		$this->create1These();
		$TS = new TheseService($this->em);
		
		$req = $TS->findById(1);
		$this->assertEquals(1, sizeof($req));
	}
	
	/**
	*	Test de la recherche de theses par son titre
	*/
	public function testfindTitreThese()
	{
		$this->viderTable();
		$this->create1These();
		$TS = new TheseService($this->em);
		
		$req = $TS->findByTitreThese('Une These');
		$this->assertEquals(1, sizeof($req));
	}
	
	/**
	*	Test de la recherche de theses par son sujet
	*/
	public function testfindBySujetThese()
	{
		$this->viderTable();
		$this->create1These();
		$TS = new TheseService($this->em);
		
		$req = $TS->findBySujetThese('un Sujet');
		$this->assertEquals(1, sizeof($req));
	}
	
	/**
	*	Test de la recherche de theses par sa specialite
	*/
	public function testfindBySpecialite()
	{
		$this->viderTable();
		$this->create1These();
		$TS = new TheseService($this->em);
		
		$req = $TS->findBySpecialite('Informatique');
		$this->assertEquals(1, sizeof($req));
	}
	
	/**
	*	Test de la recherche de theses par son laboratoire
	*/
	public function testfindByLaboratoire()
	{
		$this->viderTable();
		$this->create1These();
		$TS = new TheseService($this->em);
		
		$req = $TS->findByLaboratoire('L3I');
		$this->assertEquals(1, sizeof($req));
	}
	
	/**
	*	Test de la recherche de theses par son axe thematique
	*/
	public function testfindByAxeThematique()
	{
		$this->viderTable();
		$this->create1These();
		$TS = new TheseService($this->em);
		
		$req = $TS->findByAxeThematique('info');
		$this->assertEquals(1, sizeof($req));
	}
	
	/**
	*	Test de la recherche de theses par son axe scientifique
	*/
	public function testfindAxeScientifique()
	{
		$this->viderTable();
		$this->create1These();
		$TS = new TheseService($this->em);
		
		$req = $TS->findByAxeScientifique('aaa');
		$this->assertEquals(1, sizeof($req));
	}
	
	/**
	*	Test de la recherche de theses par son financement
	*/
	public function testfindByFinancement()
	{
		$this->viderTable();
		$this->create1These();
		$TS = new TheseService($this->em);
		
		$req = $TS->findByFinancement('Une societe');
		$this->assertEquals(1, sizeof($req));
	}
	
	/**
	*	Test de la recherche de theses par sa date de debut
	*/
	public function testfindByDateDebut()
	{
		$this->viderTable();
		$this->create1These();
		$TS = new TheseService($this->em);
		
		$req = $TS->findByDateDebut(new \DateTime('2014-01-01'));
		$this->assertEquals(1, sizeof($req));
	}
	
	/**
	*	Test de la recherche de theses par sa date de soutenance
	*/
	public function testfindByDateDeSoutenance()
	{
		$this->viderTable();
		$this->create1These();
		$TS = new TheseService($this->em);
		
		$req = $TS->findByDateDeSoutenance(new \DateTime('2017-01-01'));
		$this->assertEquals(1, sizeof($req));
	}
	
	/**
	*	Test de la recherche de theses par sa mention
	*/
	public function testfindByMention()
	{
		$this->viderTable();
		$this->create1These();
		$TS = new TheseService($this->em);
		
		$req = $TS->findByMention('Bien');
		$this->assertEquals(1, sizeof($req));
	}
	
	/**
	*	Test de la mise a jour du titre d'une these
	*/
	public function testupdateTitreThese()
	{
		$this->viderTable();
		$this->create1These();
		$TS = new TheseService($this->em);
		
		$req = $TS->updateTitreThese(1, 'test');
		
		$these = $this->em->getRepository('DTDoctoramaBundle:These')->findOneById(1);
		$this->assertEquals('test', $these->getTitreThese());
		
	}
	
	/**
	*	Test de la mise a jour du sujet d'une these
	*/
	public function testupdateSujetThese()
	{
		$this->viderTable();
		$this->create1These();
		$TS = new TheseService($this->em);
		
		$req = $TS->updateSujetThese(1, 'test');
		
		$these = $this->em->getRepository('DTDoctoramaBundle:These')->findOneById(1);
		$this->assertEquals('test', $these->getSujetThese());
		
	}
	
	/**
	*	Test de la mise a jour de la specialite d'une these
	*/
	public function testupdateSpecialite()
	{
		$this->viderTable();
		$this->create1These();
		$TS = new TheseService($this->em);
		
		$req = $TS->updateSpecialite(1, 'test');
		
		$these = $this->em->getRepository('DTDoctoramaBundle:These')->findOneById(1);
		$this->assertEquals('test', $these->getSpecialite());
	}
	
	/**
	*	Test de la mise a jour du laboratoire d'une these
	*/
	public function testupdateLaboratoire()
	{
		$this->viderTable();
		$this->create1These();
		$TS = new TheseService($this->em);
		
		$req = $TS->updateLaboratoire(1, 'test');
		
		$these = $this->em->getRepository('DTDoctoramaBundle:These')->findOneById(1);
		$this->assertEquals('test', $these->getLaboratoire());	
	}
	
	/**
	*	Test de la mise a jour du financement d'une these
	*/
	public function testupdateFinancement()
	{
		$this->viderTable();
		$this->create1These();
		$TS = new TheseService($this->em);
		
		$req = $TS->updateFinancement(1, 'test');
		
		$these = $this->em->getRepository('DTDoctoramaBundle:These')->findOneById(1);
		$this->assertEquals('test', $these->getFinancement());	
	}
	
	/**
	*	Test de la mise a jour de la date de debut d'une these
	*/
	public function testupdatedateDebut()
	{
		$this->viderTable();
		$this->create1These();
		$TS = new TheseService($this->em);
		
		$req = $TS->updatedateDebut(1, new \DateTime('2015-01-01'));
		
		$these = $this->em->getRepository('DTDoctoramaBundle:These')->findOneById(1);
		$this->assertEquals(new \DateTime('2015-01-01'), $these->getDateDebut());	
	}
	
	/**
	*	Test de la mise a jour de la date de soutenance d'une these
	*/
	public function testupdateDateDeSoutenance()
	{
		$this->viderTable();
		$this->create1These();
		$TS = new TheseService($this->em);
		
		$req = $TS->updatedateDeSoutenance(1, new \DateTime('2015-01-01'));
		
		$these = $this->em->getRepository('DTDoctoramaBundle:These')->findOneById(1);
		$this->assertEquals(new \DateTime('2015-01-01'), $these->getDateDeSoutenance());	
	}
	
	/**
	*	Test de la mise a jour de la mention d'une these
	*/
	public function testupdateMention()
	{
		$this->viderTable();
		$this->create1These();
		$TS = new TheseService($this->em);
		
		$req = $TS->updateMention(1, 'test');
		
		$these = $this->em->getRepository('DTDoctoramaBundle:These')->findOneById(1);
		$this->assertEquals('test', $these->getMention());	
	}
	
	/**
	*	Test de la suppression d'une these
	*/
	public function testdeleteThese()
	{
		$this->viderTable();
		$this->create1These();
		$TS = new TheseService($this->em);
		
		$req = $TS->deleteThese(1);
		
		$these = $this->em->getRepository('DTDoctoramaBundle:These')->findAll();
		$this->assertEquals(0, count($these));	
	}
	
	/*public function testfindByDoctorant()
	{
		$this->viderTable();
		$th = $this->create1These();
		$enc = $this->create1Encadrant();
		$th->addEncadrant($enc);
		$TS = new TheseService($this->em);
		
		
		$req = $TS->findByDoctorant(1);
		
		$these = $this->em->getRepository('DTDoctoramaBundle:These')->findOneById(1);
		$this->assertEquals($enc, $these->getEncadrants());	
	}*/
}