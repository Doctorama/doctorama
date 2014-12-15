<?php
namespace DT\DoctoramaBundle\Tests;
// src/Acme/StoreBundle/Tests/Entity/ProductRepositoryFunctionalTest.php
use DT\DoctoramaBundle\Services\DoctorantService;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use DT\DoctoramaBundle\Entity\Doctorant;

class DoctorantServiceTest extends WebTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

	// Permet de récupérer l'entitymanager de doctrine
    public function setUp()
    {
        static::$kernel = static::createKernel();
        static::$kernel->boot();
        $this->em = static::$kernel->getContainer()->get('doctrine.orm.entity_manager');
    }
	/*
	public function testcreateDoctorant()
    {
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Doctorant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		
		
		$ds = new DoctorantService($this->em);
        $ds->createDoctorant("toto", "titi", "Monsieur", "toto", "1 rue des roses", "toto@adresse.com", new \DateTime('2000-01-01'), "FR", "La Rochelle", "France", "17", "123456", 0, '2010-09-03', 'test', 'ICONE', 'ULR', 'M1', 'L3I', 'C. Demko', 'ULR', '17', 'France', 'ICONE', '2014-06-20');

		$en = $this->em->getRepository('DTDoctoramaBundle:Doctorant')->findByNom('toto');
        $this->assertEquals(1, sizeof($en));
		
		$en = $this->em->getRepository('DTDoctoramaBundle:Doctorant')->findByNomUsage('titi');
        $this->assertEquals(1, sizeof($en));
		
		$en = $this->em->getRepository('DTDoctoramaBundle:Doctorant')->findByCivilite('Monsieur');
        $this->assertEquals(1, sizeof($en));
		
		$en = $this->em->getRepository('DTDoctoramaBundle:Doctorant')->findByPrenom('toto');
        $this->assertEquals(1, sizeof($en));
		
		$en = $this->em->getRepository('DTDoctoramaBundle:Doctorant')->findByAdresse('1 rue des roses');
        $this->assertEquals(1, sizeof($en));
		
		$en = $this->em->getRepository('DTDoctoramaBundle:Doctorant')->findByMail('toto@adresse.com');
        $this->assertEquals(1, sizeof($en));
		
		$en = $this->em->getRepository('DTDoctoramaBundle:Doctorant')->findByDateDeNaissance(new \DateTime('2000-01-01'));
        $this->assertEquals(1, sizeof($en));
		
		$en = $this->em->getRepository('DTDoctoramaBundle:Doctorant')->findByNationalite('FR');
        $this->assertEquals(1, sizeof($en));
		
		$en = $this->em->getRepository('DTDoctoramaBundle:Doctorant')->findByVilleDeNaissance('La Rochelle');
        $this->assertEquals(1, sizeof($en));
		
		$en = $this->em->getRepository('DTDoctoramaBundle:Doctorant')->findByPaysDeNaissance('France');
        $this->assertEquals(1, sizeof($en));
		
		$en = $this->em->getRepository('DTDoctoramaBundle:Doctorant')->findByDepDeNaissance('17');
        $this->assertEquals(1, sizeof($en));
		
		$en = $this->em->getRepository('DTDoctoramaBundle:Doctorant')->findByNumEtudiant('123456');
        $this->assertEquals(1, sizeof($en));
		
		$en = $this->em->getRepository('DTDoctoramaBundle:Doctorant')->findByBourseEtExoneration(0);
        $this->assertEquals(1, sizeof($en));
		
		$en = $this->em->getRepository('DTDoctoramaBundle:Doctorant')->findByDateInscr1eThese('2010-09-03');
        $this->assertEquals(1, sizeof($en));
		
		$en = $this->em->getRepository('DTDoctoramaBundle:Doctorant')->findByDcace('test');
        $this->assertEquals(1, sizeof($en));
		
		$en = $this->em->getRepository('DTDoctoramaBundle:Doctorant')->findByNomFormationMaster('ICONE');
        $this->assertEquals(1, sizeof($en));
		
		$en = $this->em->getRepository('DTDoctoramaBundle:Doctorant')->findByUniversiteMaster('ULR');
        $this->assertEquals(1, sizeof($en));
		
		$en = $this->em->getRepository('DTDoctoramaBundle:Doctorant')->findBySujetMaster('M1');
        $this->assertEquals(1, sizeof($en));
		
		$en = $this->em->getRepository('DTDoctoramaBundle:Doctorant')->findByLaboratoireAcceuilMaster('L3I');
        $this->assertEquals(1, sizeof($en));
		
		$en = $this->em->getRepository('DTDoctoramaBundle:Doctorant')->findByEncadrantsMaster('C. Demko');
        $this->assertEquals(1, sizeof($en));
		
		$en = $this->em->getRepository('DTDoctoramaBundle:Doctorant')->findByEtabDernierDiplome('ULR');
        $this->assertEquals(1, sizeof($en));
		
		$en = $this->em->getRepository('DTDoctoramaBundle:Doctorant')->findByDepDernierDiplome('17');
        $this->assertEquals(1, sizeof($en));
		
		$en = $this->em->getRepository('DTDoctoramaBundle:Doctorant')->findByPaysDernierDiplome('France');
        $this->assertEquals(1, sizeof($en));
		
		$en = $this->em->getRepository('DTDoctoramaBundle:Doctorant')->findByLibelleDernierDiplome('ICONE');
        $this->assertEquals(1, sizeof($en));
		
		$en = $this->em->getRepository('DTDoctoramaBundle:Doctorant')->findByAnneeDernierDiplome('2014-06-20');
        $this->assertEquals(1, sizeof($en));
	}
	
	public function testfindDoctorantByNom()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Doctorant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new DoctorantService($this->em);
		
		$doctorant = new Doctorant;
		
		$doctorant->setNom('Demko');
		$doctorant->setPrenom('Christophe');
		$doctorant->setNomUsage('Demko');
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
		
		$en = $es->findDoctorantByNom('Demko');
		$this->assertEquals(1, sizeof($en));
	}
	
	public function testfindDoctorantByNomUsage()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Doctorant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new DoctorantService($this->em);
		
		$doctorant = new Doctorant;
		
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
		
		$en = $es->findDoctorantByNomUsage('Demko2');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	public function testfindDoctorantByCivilite()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Doctorant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new DoctorantService($this->em);
		
		$doctorant = new Doctorant;
		
		$doctorant->setNom('Demko');
		$doctorant->setPrenom('Christophe');
		$doctorant->setNomUsage('Demko');
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
		
		$en = $es->findDoctorantByCivilite('Monsieur');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	public function testfindDoctorantByPrenom()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Doctorant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new DoctorantService($this->em);
		
		$doctorant = new Doctorant;
		
		$doctorant->setNom('Demko');
		$doctorant->setPrenom('Christophe');
		$doctorant->setNomUsage('Demko');
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
		
		$en = $es->findDoctorantByPrenom('Christophe');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	public function testfindDoctorantByMail()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Doctorant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new DoctorantService($this->em);
		
		$doctorant = new Doctorant;
		
		$doctorant->setNom('Demko');
		$doctorant->setPrenom('Christophe');
		$doctorant->setNomUsage('Demko');
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
		
		$en = $es->findDoctorantByMail('Demko@adresse.com');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	public function testfindDoctorantByDateDeNaissance()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Doctorant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new DoctorantService($this->em);
		
		$doctorant = new Doctorant;
		
		$doctorant->setNom('Demko');
		$doctorant->setPrenom('Christophe');
		$doctorant->setNomUsage('Demko');
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
		
		$en = $es->findDoctorantByDateDeNaissance(new \DateTime('2000-01-01'));
		$this->assertEquals(1, sizeof($en));
		
	}
	
	public function testfindDoctorantByNationalite()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Doctorant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new DoctorantService($this->em);
		
		$doctorant = new Doctorant;
		
		$doctorant->setNom('Demko');
		$doctorant->setPrenom('Christophe');
		$doctorant->setNomUsage('Demko');
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
		
		$en = $es->findDoctorantByNationalite('FR');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	public function testfindDoctorantByVilleDeNaissance()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Doctorant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new DoctorantService($this->em);
		
		$doctorant = new Doctorant;
		
		$doctorant->setNom('Demko');
		$doctorant->setPrenom('Christophe');
		$doctorant->setNomUsage('Demko');
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
		
		$en = $es->findDoctorantByVilleDeNaissance('La Rochelle');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	public function testfindDoctorantByPaysDeNaissance()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Doctorant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new DoctorantService($this->em);
		
		$doctorant = new Doctorant;
		
		$doctorant->setNom('Demko');
		$doctorant->setPrenom('Christophe');
		$doctorant->setNomUsage('Demko');
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
		
		$en = $es->findDoctorantByPaysDeNaissance('France');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	public function testfindDoctorantByDepDeNaissance()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Doctorant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new DoctorantService($this->em);
		
		$doctorant = new Doctorant;
		
		$doctorant->setNom('Demko');
		$doctorant->setPrenom('Christophe');
		$doctorant->setNomUsage('Demko');
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
		
		$en = $es->findDoctorantByDepDeNaissance('17');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	public function testfindDoctorantByNumEtudiant()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Doctorant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new DoctorantService($this->em);
		
		$doctorant = new Doctorant;
		
		$doctorant->setNom('Demko');
		$doctorant->setPrenom('Christophe');
		$doctorant->setNomUsage('Demko');
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
		
		$en = $es->findDoctorantByNumEtudiant('123456');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	public function testfindDoctorantByBourseEtExoneration()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Doctorant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new DoctorantService($this->em);
		
		$doctorant = new Doctorant;
		
		$doctorant->setNom('Demko');
		$doctorant->setPrenom('Christophe');
		$doctorant->setNomUsage('Demko');
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
		
		$en = $es->findDoctorantByBourseEtExoneration('0');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	public function testfindDoctorantByDateInscr1eThese()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Doctorant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new DoctorantService($this->em);
		
		$doctorant = new Doctorant;
		
		$doctorant->setNom('Demko');
		$doctorant->setPrenom('Christophe');
		$doctorant->setNomUsage('Demko');
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
		
		$en = $es->findDoctorantByDateInscr1eThese('2010-09-03');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	public function testfindDoctorantByDcace()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Doctorant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new DoctorantService($this->em);
		
		$doctorant = new Doctorant;
		
		$doctorant->setNom('Demko');
		$doctorant->setPrenom('Christophe');
		$doctorant->setNomUsage('Demko');
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
		
		$en = $es->findDoctorantByDcace('rr');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	public function testfindDoctorantByNomFormationMaster()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Doctorant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new DoctorantService($this->em);
		
		$doctorant = new Doctorant;
		
		$doctorant->setNom('Demko');
		$doctorant->setPrenom('Christophe');
		$doctorant->setNomUsage('Demko');
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
		
		$en = $es->findDoctorantByNomFormationMaster('ICONE');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	public function testfindDoctorantByUniversiteMaster()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Doctorant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new DoctorantService($this->em);
		
		$doctorant = new Doctorant;
		
		$doctorant->setNom('Demko');
		$doctorant->setPrenom('Christophe');
		$doctorant->setNomUsage('Demko');
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
		
		$en = $es->findDoctorantByUniversiteMaster('ULR');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	public function testfindDoctorantBySujetMaster()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Doctorant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new DoctorantService($this->em);
		
		$doctorant = new Doctorant;
		
		$doctorant->setNom('Demko');
		$doctorant->setPrenom('Christophe');
		$doctorant->setNomUsage('Demko');
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
		
		$en = $es->findDoctorantBySujetMaster('M1');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	public function testfindDoctorantByLaboratoireAcceuilMaster()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Doctorant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new DoctorantService($this->em);
		
		$doctorant = new Doctorant;
		
		$doctorant->setNom('Demko');
		$doctorant->setPrenom('Christophe');
		$doctorant->setNomUsage('Demko');
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
		
		$en = $es->findDoctorantByLaboratoireAcceuilMaster('L3I');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	public function testfindDoctorantByEncadrantsMaster()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Doctorant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new DoctorantService($this->em);
		
		$doctorant = new Doctorant;
		
		$doctorant->setNom('Demko');
		$doctorant->setPrenom('Christophe');
		$doctorant->setNomUsage('Demko');
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
		
		$en = $es->findDoctorantByEncadrantsMaster('C. Demko');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	public function testfindDoctorantByEtabDernierDiplome()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Doctorant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new DoctorantService($this->em);
		
		$doctorant = new Doctorant;
		
		$doctorant->setNom('Demko');
		$doctorant->setPrenom('Christophe');
		$doctorant->setNomUsage('Demko');
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
		
		$en = $es->findDoctorantByEtabDernierDiplome('ULR');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	public function testfindDoctorantByPaysDernierDiplome()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Doctorant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new DoctorantService($this->em);
		
		$doctorant = new Doctorant;
		
		$doctorant->setNom('Demko');
		$doctorant->setPrenom('Christophe');
		$doctorant->setNomUsage('Demko');
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
		
		$en = $es->findDoctorantByPaysDernierDiplome('France');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	public function testfindDoctorantByLibelleDernierDiplome()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Doctorant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new DoctorantService($this->em);
		
		$doctorant = new Doctorant;
		
		$doctorant->setNom('Demko');
		$doctorant->setPrenom('Christophe');
		$doctorant->setNomUsage('Demko');
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
		
		$en = $es->findDoctorantByLibelleDernierDiplome('ICONE');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	public function testfindDoctorantByAnneeDernierDiplome()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Doctorant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new DoctorantService($this->em);
		
		$doctorant = new Doctorant;
		
		$doctorant->setNom('Demko');
		$doctorant->setPrenom('Christophe');
		$doctorant->setNomUsage('Demko');
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
		
		$en = $es->findDoctorantByAnneeDernierDiplome('2014-06-20');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	public function testfindDoctorantByDepDernierDiplome()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Doctorant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new DoctorantService($this->em);
		
		$doctorant = new Doctorant;
		
		$doctorant->setNom('Demko');
		$doctorant->setPrenom('Christophe');
		$doctorant->setNomUsage('Demko');
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
		
		$en = $es->findDoctorantByDepDernierDiplome('17');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	public function testfindAll()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Doctorant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new DoctorantService($this->em);
		
		$doctorant = new Doctorant;
		
		$doctorant->setNom('Demko');
		$doctorant->setPrenom('Christophe');
		$doctorant->setNomUsage('Demko');
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
		
		$doctorant = new Doctorant;
		
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
		
		$en = $es->findAll();
		$this->assertEquals(2, sizeof($en));
		
	}
	
	public function testupdateNom()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Doctorant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new DoctorantService($this->em);
		
		$doctorant = new Doctorant;
		
		$doctorant->setNom('Demko');
		$doctorant->setPrenom('Christophe');
		$doctorant->setNomUsage('Demko');
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
		
		$doctorant = new Doctorant;
		
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
		
		$en = $es->updateNom(2, "Demko123");
		$req = $this->em->getRepository("DTDoctoramaBundle:Doctorant")->findOneById(2);
		$this->assertEquals("Demko123", $req->getNom());	
	}
	
	public function testupdateNomUsage()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Doctorant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new DoctorantService($this->em);
		
		$doctorant = new Doctorant;
		
		$doctorant->setNom('Demko');
		$doctorant->setPrenom('Christophe');
		$doctorant->setNomUsage('Demko');
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
		
		$doctorant = new Doctorant;
		
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
		
		$en = $es->updateNomUsage(2, "Demko123");
		$req = $this->em->getRepository("DTDoctoramaBundle:Doctorant")->findOneById(2);
		$this->assertEquals("Demko123", $req->getNomUsage());	
	}
	
	public function testupdateCivilite()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Doctorant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new DoctorantService($this->em);
		
		$doctorant = new Doctorant;
		
		$doctorant->setNom('Demko');
		$doctorant->setPrenom('Christophe');
		$doctorant->setNomUsage('Demko');
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
		
		$doctorant = new Doctorant;
		
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
		
		$en = $es->updateCivilite(2, "test123");
		$req = $this->em->getRepository("DTDoctoramaBundle:Doctorant")->findOneById(2);
		$this->assertEquals("test123", $req->getCivilite());	
	}
	
	public function testupdatePrenom()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Doctorant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new DoctorantService($this->em);
		
		$doctorant = new Doctorant;
		
		$doctorant->setNom('Demko');
		$doctorant->setPrenom('Christophe');
		$doctorant->setNomUsage('Demko');
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
		
		$doctorant = new Doctorant;
		
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
		
		$en = $es->updatePrenom(2, "test123");
		$req = $this->em->getRepository("DTDoctoramaBundle:Doctorant")->findOneById(2);
		$this->assertEquals("test123", $req->getPrenom());	
	}
	
	public function testupdateAdresse()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Doctorant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new DoctorantService($this->em);
		
		$doctorant = new Doctorant;
		
		$doctorant->setNom('Demko');
		$doctorant->setPrenom('Christophe');
		$doctorant->setNomUsage('Demko');
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
		
		$doctorant = new Doctorant;
		
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
		
		$en = $es->updateAdresse(2, "test123");
		$req = $this->em->getRepository("DTDoctoramaBundle:Doctorant")->findOneById(2);
		$this->assertEquals("test123", $req->getAdresse());	
	}
	
	public function testupdateMail()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Doctorant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new DoctorantService($this->em);
		
		$doctorant = new Doctorant;
		
		$doctorant->setNom('Demko');
		$doctorant->setPrenom('Christophe');
		$doctorant->setNomUsage('Demko');
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
		
		$doctorant = new Doctorant;
		
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
		
		$en = $es->updateMail(2, "test123");
		$req = $this->em->getRepository("DTDoctoramaBundle:Doctorant")->findOneById(2);
		$this->assertEquals("test123", $req->getMail());	
	}
	
	public function testupdateDateDeNaissance()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Doctorant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new DoctorantService($this->em);
		
		$doctorant = new Doctorant;
		
		$doctorant->setNom('Demko');
		$doctorant->setPrenom('Christophe');
		$doctorant->setNomUsage('Demko');
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
		
		$doctorant = new Doctorant;
		
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
		
		$en = $es->updateDateDeNaissance(2, new \DateTime('2000-01-02'));
		$req = $this->em->getRepository("DTDoctoramaBundle:Doctorant")->findOneById(2);
		$this->assertEquals(new \DateTime('2000-01-02'), $req->getDateDeNaissance());	
	}
	
	public function testupdateNationalite()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Doctorant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new DoctorantService($this->em);
		
		$doctorant = new Doctorant;
		
		$doctorant->setNom('Demko');
		$doctorant->setPrenom('Christophe');
		$doctorant->setNomUsage('Demko');
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
		
		$doctorant = new Doctorant;
		
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
		
		$en = $es->updateNationalite(2, "test123");
		$req = $this->em->getRepository("DTDoctoramaBundle:Doctorant")->findOneById(2);
		$this->assertEquals("test123", $req->getNationalite());	
	}
	
	public function testupdateVilleDeNaissance()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Doctorant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new DoctorantService($this->em);
		
		$doctorant = new Doctorant;
		
		$doctorant->setNom('Demko');
		$doctorant->setPrenom('Christophe');
		$doctorant->setNomUsage('Demko');
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
		
		$doctorant = new Doctorant;
		
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
		
		$en = $es->updateVilleDeNaissance(2, "test123");
		$req = $this->em->getRepository("DTDoctoramaBundle:Doctorant")->findOneById(2);
		$this->assertEquals("test123", $req->getVilleDeNaissance());	
	}
	
	public function testupdatePaysDeNaissance()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Doctorant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new DoctorantService($this->em);
		
		$doctorant = new Doctorant;
		
		$doctorant->setNom('Demko');
		$doctorant->setPrenom('Christophe');
		$doctorant->setNomUsage('Demko');
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
		
		$doctorant = new Doctorant;
		
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
		
		$en = $es->updatePaysDeNaissance(2, "test123");
		$req = $this->em->getRepository("DTDoctoramaBundle:Doctorant")->findOneById(2);
		$this->assertEquals("test123", $req->getPaysDeNaissance());	
	}
	
	public function testupdateDepDeNaissance()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Doctorant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new DoctorantService($this->em);
		
		$doctorant = new Doctorant;
		
		$doctorant->setNom('Demko');
		$doctorant->setPrenom('Christophe');
		$doctorant->setNomUsage('Demko');
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
		
		$doctorant = new Doctorant;
		
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
		
		$en = $es->updateDepDeNaissance(2, "test123");
		$req = $this->em->getRepository("DTDoctoramaBundle:Doctorant")->findOneById(2);
		$this->assertEquals("test123", $req->getDepDeNaissance());	
	}
	
	public function testupdateNumEtudiant()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Doctorant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new DoctorantService($this->em);
		
		$doctorant = new Doctorant;
		
		$doctorant->setNom('Demko');
		$doctorant->setPrenom('Christophe');
		$doctorant->setNomUsage('Demko');
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
		
		$doctorant = new Doctorant;
		
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
		
		$en = $es->updateNumEtudiant(2, "test123");
		$req = $this->em->getRepository("DTDoctoramaBundle:Doctorant")->findOneById(2);
		$this->assertEquals("test123", $req->getNumEtudiant());	
	}
	
	public function testupdateBourseEtExoneration()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Doctorant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new DoctorantService($this->em);
		
		$doctorant = new Doctorant;
		
		$doctorant->setNom('Demko');
		$doctorant->setPrenom('Christophe');
		$doctorant->setNomUsage('Demko');
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
		
		$doctorant = new Doctorant;
		
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
		
		$en = $es->updateBourseEtExoneration(2, "test123");
		$req = $this->em->getRepository("DTDoctoramaBundle:Doctorant")->findOneById(2);
		$this->assertEquals("test123", $req->getBourseEtExoneration());	
	}
	
	public function testupdateDateInscr1eThese()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Doctorant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new DoctorantService($this->em);
		
		$doctorant = new Doctorant;
		
		$doctorant->setNom('Demko');
		$doctorant->setPrenom('Christophe');
		$doctorant->setNomUsage('Demko');
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
		
		$doctorant = new Doctorant;
		
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
		
		$en = $es->updateDateInscr1eThese(2, "test123");
		$req = $this->em->getRepository("DTDoctoramaBundle:Doctorant")->findOneById(2);
		$this->assertEquals("test123", $req->getDateInscr1eThese());	
	}
	
	public function testupdateDcace()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Doctorant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new DoctorantService($this->em);
		
		$doctorant = new Doctorant;
		
		$doctorant->setNom('Demko');
		$doctorant->setPrenom('Christophe');
		$doctorant->setNomUsage('Demko');
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
		
		$doctorant = new Doctorant;
		
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
		
		$en = $es->updateDcace(2, "test123");
		$req = $this->em->getRepository("DTDoctoramaBundle:Doctorant")->findOneById(2);
		$this->assertEquals("test123", $req->getDcace());	
	}
	
	public function testupdateNomFormationMaster()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Doctorant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new DoctorantService($this->em);
		
		$doctorant = new Doctorant;
		
		$doctorant->setNom('Demko');
		$doctorant->setPrenom('Christophe');
		$doctorant->setNomUsage('Demko');
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
		
		$doctorant = new Doctorant;
		
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
		
		$en = $es->updateNomFormationMaster(2, "test123");
		$req = $this->em->getRepository("DTDoctoramaBundle:Doctorant")->findOneById(2);
		$this->assertEquals("test123", $req->getNomFormationMaster());	
	}
	
	public function testupdateUniversiteMaster()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Doctorant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new DoctorantService($this->em);
		
		$doctorant = new Doctorant;
		
		$doctorant->setNom('Demko');
		$doctorant->setPrenom('Christophe');
		$doctorant->setNomUsage('Demko');
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
		
		$doctorant = new Doctorant;
		
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
		
		$en = $es->updateUniversiteMaster(2, "test123");
		$req = $this->em->getRepository("DTDoctoramaBundle:Doctorant")->findOneById(2);
		$this->assertEquals("test123", $req->getUniversiteMaster());	
	}
	
	public function testupdateSujetMaster()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Doctorant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new DoctorantService($this->em);
		
		$doctorant = new Doctorant;
		
		$doctorant->setNom('Demko');
		$doctorant->setPrenom('Christophe');
		$doctorant->setNomUsage('Demko');
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
		
		$doctorant = new Doctorant;
		
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
		
		$en = $es->updateSujetMaster(2, "test123");
		$req = $this->em->getRepository("DTDoctoramaBundle:Doctorant")->findOneById(2);
		$this->assertEquals("test123", $req->getSujetMaster());	
	}
	
	public function testupdateLaboratoireAccueilMaster()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Doctorant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new DoctorantService($this->em);
		
		$doctorant = new Doctorant;
		
		$doctorant->setNom('Demko');
		$doctorant->setPrenom('Christophe');
		$doctorant->setNomUsage('Demko');
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
		
		$doctorant = new Doctorant;
		
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
		
		$en = $es->updateLaboratoireAccueilMaster(2, "test123");
		$req = $this->em->getRepository("DTDoctoramaBundle:Doctorant")->findOneById(2);
		$this->assertEquals("test123", $req->getLaboratoireAcceuilMaster());	
	}
	
	public function testupdateEncadrantsMaster()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Doctorant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new DoctorantService($this->em);
		
		$doctorant = new Doctorant;
		
		$doctorant->setNom('Demko');
		$doctorant->setPrenom('Christophe');
		$doctorant->setNomUsage('Demko');
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
		
		$doctorant = new Doctorant;
		
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
		
		$en = $es->updateEncadrantsMaster(2, "test123");
		$req = $this->em->getRepository("DTDoctoramaBundle:Doctorant")->findOneById(2);
		$this->assertEquals("test123", $req->getEncadrantsMaster());	
	}
	
	public function testupdateEtabDernierDiplome()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Doctorant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new DoctorantService($this->em);
		
		$doctorant = new Doctorant;
		
		$doctorant->setNom('Demko');
		$doctorant->setPrenom('Christophe');
		$doctorant->setNomUsage('Demko');
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
		
		$doctorant = new Doctorant;
		
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
		
		$en = $es->updateEtabDernierDiplome(2, "test123");
		$req = $this->em->getRepository("DTDoctoramaBundle:Doctorant")->findOneById(2);
		$this->assertEquals("test123", $req->getEtabDernierDiplome());	
	}
	
	public function testupdateDepDernierDiplome()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Doctorant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new DoctorantService($this->em);
		
		$doctorant = new Doctorant;
		
		$doctorant->setNom('Demko');
		$doctorant->setPrenom('Christophe');
		$doctorant->setNomUsage('Demko');
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
		
		$doctorant = new Doctorant;
		
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
		
		$en = $es->updateDepDernierDiplome(2, "test123");
		$req = $this->em->getRepository("DTDoctoramaBundle:Doctorant")->findOneById(2);
		$this->assertEquals("test123", $req->getDepDernierDiplome());	
	}
	
	public function testupdatePaysDernierDiplome()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Doctorant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new DoctorantService($this->em);
		
		$doctorant = new Doctorant;
		
		$doctorant->setNom('Demko');
		$doctorant->setPrenom('Christophe');
		$doctorant->setNomUsage('Demko');
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
		
		$doctorant = new Doctorant;
		
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
		
		$en = $es->updatePaysDernierDiplome(2, "test123");
		$req = $this->em->getRepository("DTDoctoramaBundle:Doctorant")->findOneById(2);
		$this->assertEquals("test123", $req->getPaysDernierDiplome());	
	}
	
	public function testupdateLibelleDernierDiplome()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Doctorant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new DoctorantService($this->em);
		
		$doctorant = new Doctorant;
		
		$doctorant->setNom('Demko');
		$doctorant->setPrenom('Christophe');
		$doctorant->setNomUsage('Demko');
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
		
		$doctorant = new Doctorant;
		
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
		
		$en = $es->updateLibelleDernierDiplome(2, "test123");
		$req = $this->em->getRepository("DTDoctoramaBundle:Doctorant")->findOneById(2);
		$this->assertEquals("test123", $req->getLibelleDernierDiplome());	
	}
	
	public function testupdateAnneeDernierDiplome()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Doctorant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new DoctorantService($this->em);
		
		$doctorant = new Doctorant;
		
		$doctorant->setNom('Demko');
		$doctorant->setPrenom('Christophe');
		$doctorant->setNomUsage('Demko');
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
		
		$doctorant = new Doctorant;
		
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
		
		$en = $es->updateAnneeDernierDiplome(2, "test123");
		$req = $this->em->getRepository("DTDoctoramaBundle:Doctorant")->findOneById(2);
		$this->assertEquals("test123", $req->getAnneeDernierDiplome());	
	}
	
	public function testdelete()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Doctorant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new DoctorantService($this->em);
		
		$doctorant = new Doctorant;
		
		$doctorant->setNom('Demko');
		$doctorant->setPrenom('Christophe');
		$doctorant->setNomUsage('Demko');
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
		
		$doctorant = new Doctorant;
		
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
		
		$en = $es->delete(1);
		
		$en = $this->em->getRepository('DTDoctoramaBundle:Doctorant')->findById(1);
		$this->assertEquals(0, sizeof($en));	
		
		$en = $this->em->getRepository('DTDoctoramaBundle:Doctorant')->findById(2);
		$this->assertEquals(1, sizeof($en));
	}
	*/
}
?>