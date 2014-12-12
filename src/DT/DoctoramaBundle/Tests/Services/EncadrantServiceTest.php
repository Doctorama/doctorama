<?php
namespace DT\DoctoramaBundle\Tests;
// src/Acme/StoreBundle/Tests/Entity/ProductRepositoryFunctionalTest.php
use DT\DoctoramaBundle\Services\EncadrantService;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use DT\DoctoramaBundle\Entity\Encadrant;

class ProductRepositoryFunctionalTest extends WebTestCase
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

	// Test création encadrant
    public function testcreateEncadrant()
    {
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Encadrant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		
		
		$es = new EncadrantService($this->em);
        $es->createEncadrant("test1", "test2", "test3", "test4", "test5", "test6", new \DateTime('2000-01-01'), "test7", "test8", "test9", "test10");

		$en = $this->em->getRepository('DTDoctoramaBundle:Encadrant')->findByNom('test1');
        $this->assertEquals(1, sizeof($en));
		
		$en = $this->em->getRepository('DTDoctoramaBundle:Encadrant')->findByPrenom('test4');
        $this->assertEquals(1, sizeof($en));
		
		$en = $this->em->getRepository('DTDoctoramaBundle:Encadrant')->findByNomUsage('test2');
        $this->assertEquals(1, sizeof($en));
		
		$en = $this->em->getRepository('DTDoctoramaBundle:Encadrant')->findByCivilite('test3');
        $this->assertEquals(1, sizeof($en));
		
		$en = $this->em->getRepository('DTDoctoramaBundle:Encadrant')->findByAdresse('test5');
        $this->assertEquals(1, sizeof($en));
		
		$en = $this->em->getRepository('DTDoctoramaBundle:Encadrant')->findByMail('test6');
        $this->assertEquals(1, sizeof($en));
		
		$en = $this->em->getRepository('DTDoctoramaBundle:Encadrant')->findByDateDeNaissance(new \DateTime('2000-01-01'));
        $this->assertEquals(1, sizeof($en));
		
		$en = $this->em->getRepository('DTDoctoramaBundle:Encadrant')->findByNationalite('test7');
        $this->assertEquals(1, sizeof($en));
		
		$en = $this->em->getRepository('DTDoctoramaBundle:Encadrant')->findByVilleDeNaissance('test8');
        $this->assertEquals(1, sizeof($en));
		
		$en = $this->em->getRepository('DTDoctoramaBundle:Encadrant')->findByPaysDeNaissance('test9');
        $this->assertEquals(1, sizeof($en));
		
		$en = $this->em->getRepository('DTDoctoramaBundle:Encadrant')->findByDepDeNaissance('test10');
        $this->assertEquals(1, sizeof($en));
    }
	
	// Test "retrouver un encadrant par son id"
	public function testfindEncadrantById()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Encadrant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new EncadrantService($this->em);
		
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
		
		$this->em->persist($encadrant);
		$this->em->flush();
		
		$en = $es->findEncadrantById(1);
		$this->assertEquals(1, sizeof($en));
		
	}
	
	// Test "retrouver un encadrant par son id"
	public function testfindEncadrantByNom()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Encadrant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new EncadrantService($this->em);
		
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
		
		$this->em->persist($encadrant);
		$this->em->flush();
		
		$en = $es->findEncadrantByNom('Demko');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	// Test "retrouver un encadrant par son nom d'usage"
	public function testfindEncadrantByNomUsage()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Encadrant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new EncadrantService($this->em);
		
		$encadrant = new Encadrant;
		
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
		
		$en = $es->findEncadrantByNomUsage('Demko2');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	// Test "retrouver un encadrant par sa civilité"
	public function testfindEncadrantByCivilite()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Encadrant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new EncadrantService($this->em);
		
		$encadrant = new Encadrant;
		
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
		
		$en = $es->findEncadrantByCivilite('Monsieur');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	// Test "retrouver un encadrant par sa Prenom"
	public function testfindEncadrantByPrenom()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Encadrant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new EncadrantService($this->em);
		
		$encadrant = new Encadrant;
		
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
		
		$en = $es->findEncadrantByPrenom('Christophe');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	// Test "retrouver un encadrant par sa Adresse"
	public function testfindEncadrantByAdresse()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Encadrant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new EncadrantService($this->em);
		
		$encadrant = new Encadrant;
		
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
		
		$en = $es->findEncadrantByAdresse('1 rue des roses');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	// Test "retrouver un encadrant par son adresse"
	public function testfindEncadrantByMail()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Encadrant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new EncadrantService($this->em);
		
		$encadrant = new Encadrant;
		
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
		
		$en = $es->findEncadrantByMail('Demko@adresse.com');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	// Test "retrouver un encadrant par sa date de naissance"
	public function testfindEncadrantByDateDeNaissance()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Encadrant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new EncadrantService($this->em);
		
		$encadrant = new Encadrant;
		
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
		
		$en = $es->findEncadrantByDateDeNaissance(new \DateTime('2000-01-01'));
		$this->assertEquals(1, sizeof($en));
		
	}
	
	// Test "retrouver un encadrant par sa Nationalite"
	public function testfindEncadrantByNationalite()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Encadrant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new EncadrantService($this->em);
		
		$encadrant = new Encadrant;
		
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
		
		$en = $es->findEncadrantByNationalite('FR');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	// Test "retrouver un encadrant par sa ville de naissance"
	public function testfindEncadrantByVilleDeNaissance()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Encadrant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new EncadrantService($this->em);
		
		$encadrant = new Encadrant;
		
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
		
		$en = $es->findEncadrantByVilleDeNaissance('La Rochelle');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	// Test "retrouver un encadrant par son pays de naissance"
	public function testfindEncadrantByPaysDeNaissance()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Encadrant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new EncadrantService($this->em);
		
		$encadrant = new Encadrant;
		
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
		
		$en = $es->findEncadrantByPaysDeNaissance('France');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	// Test "retrouver un encadrant par son département de naissance"
	public function testfindEncadrantByDepDeNaissance()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Encadrant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new EncadrantService($this->em);
		
		$encadrant = new Encadrant;
		
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
		
		$en = $es->findEncadrantByDepDeNaissance('17');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	// Test "retrouver un encadrant par son nom et prenom"
	public function testfindEncadrantByNomEtPrenom()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Encadrant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new EncadrantService($this->em);
		
		$encadrant = new Encadrant;
		
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
		
		$en = $es->findEncadrantByNomEtPrenom('Christophe', 'Demko');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	// Test "retrouver tous les encadrants"
	public function testfindAll()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Encadrant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new EncadrantService($this->em);
		
		$encadrant = new Encadrant;
		
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
		
		$encadrant = new Encadrant;
		
		$encadrant->setNom('Demko');
		$encadrant->setPrenom('Christophe');
		$encadrant->setNomUsage('Demko1');
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
		
		$en = $es->findAll();
		$this->assertEquals(2, sizeof($en));
		
	}
	
	// Test "mise à jour du nom d'un encadrant"
	public function testupdateNomEncadrant()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Encadrant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new EncadrantService($this->em);
		
		$encadrant = new Encadrant;
		
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
		
		$encadrant = new Encadrant;
		
		$encadrant->setNom('Demko');
		$encadrant->setPrenom('Christophe');
		$encadrant->setNomUsage('Demko1');
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
		
		$en = $es->updateNomEncadrant(2, 'Revel');
		$req = $this->em->getRepository("DTDoctoramaBundle:Encadrant")->findOneById(2);

		$this->assertEquals('Revel', $req->getNom());
		
	}
	
	// Test "mise à jour du nom d'usage d'un encadrant"
	public function testupdateNomUsageEncadrant()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Encadrant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new EncadrantService($this->em);
		
		$encadrant = new Encadrant;
		
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
		
		$encadrant = new Encadrant;
		
		$encadrant->setNom('Demko');
		$encadrant->setPrenom('Christophe');
		$encadrant->setNomUsage('Demko1');
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
		
		$en = $es->updateNomUsageEncadrant(2, 'Revel');
		$req = $this->em->getRepository("DTDoctoramaBundle:Encadrant")->findOneById(2);

		$this->assertEquals('Revel', $req->getNomUsage());
		
	}
	
	// Test "mise à jour du prenom d'un encadrant"
	public function testupdatePrenomEncadrant()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Encadrant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new EncadrantService($this->em);
		
		$encadrant = new Encadrant;
		
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
		
		$encadrant = new Encadrant;
		
		$encadrant->setNom('Demko');
		$encadrant->setPrenom('Christophe');
		$encadrant->setNomUsage('Demko1');
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
		
		$en = $es->updatePrenomEncadrant(2, 'Revel');
		$req = $this->em->getRepository("DTDoctoramaBundle:Encadrant")->findOneById(2);

		$this->assertEquals('Revel', $req->getPrenom());
		
	}
	
	// Test "mise à jour de l'adresse d'un encadrant"
	public function testupdateAdresseEncadrant()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Encadrant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new EncadrantService($this->em);
		
		$encadrant = new Encadrant;
		
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
		
		$encadrant = new Encadrant;
		
		$encadrant->setNom('Demko');
		$encadrant->setPrenom('Christophe');
		$encadrant->setNomUsage('Demko1');
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
		
		$en = $es->updateAdresseEncadrant(2, '2 rue au pied');
		$req = $this->em->getRepository("DTDoctoramaBundle:Encadrant")->findOneById(2);

		$this->assertEquals('2 rue au pied', $req->getAdresse());
		
	}
	
	// Test "mise à jour du mail d'un encadrant"
	public function testupdateMailEncadrant()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Encadrant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new EncadrantService($this->em);
		
		$encadrant = new Encadrant;
		
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
		
		$encadrant = new Encadrant;
		
		$encadrant->setNom('Demko');
		$encadrant->setPrenom('Christophe');
		$encadrant->setNomUsage('Demko1');
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
		
		$en = $es->updateMailEncadrant(2, 'Revel@ad.fr');
		$req = $this->em->getRepository("DTDoctoramaBundle:Encadrant")->findOneById(2);

		$this->assertEquals('Revel@ad.fr', $req->getMail());
		
	}
	
	// Test "mise à jour de la date de naissance d'un encadrant"
	public function testupdateDateDeNaissancEncadrant()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Encadrant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new EncadrantService($this->em);
		
		$encadrant = new Encadrant;
		
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
		
		$encadrant = new Encadrant;
		
		$encadrant->setNom('Demko');
		$encadrant->setPrenom('Christophe');
		$encadrant->setNomUsage('Demko1');
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
		
		$en = $es->updateDateDeNaissancEncadrant(2, new \DateTime('2015-01-01'));
		$req = $this->em->getRepository("DTDoctoramaBundle:Encadrant")->findOneById(2);

		$this->assertEquals(new \DateTime('2015-01-01'), $req->getDateDeNaissance());
		
	}
	
	// Test "mise à jour de la nationalite d'un encadrant"
	public function testupdateNationaliteEncadrant()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Encadrant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new EncadrantService($this->em);
		
		$encadrant = new Encadrant;
		
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
		
		$encadrant = new Encadrant;
		
		$encadrant->setNom('Demko');
		$encadrant->setPrenom('Christophe');
		$encadrant->setNomUsage('Demko1');
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
		
		$en = $es->updateNationaliteEncadrant(2, "EN");
		$req = $this->em->getRepository("DTDoctoramaBundle:Encadrant")->findOneById(2);

		$this->assertEquals("EN", $req->getNationalite());
		
	}
	
	// Test "mise à jour de la ville de naissance d'un encadrant"
	public function testupdateVilleDeNaissanceEncadrant()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Encadrant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new EncadrantService($this->em);
		
		$encadrant = new Encadrant;
		
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
		
		$encadrant = new Encadrant;
		
		$encadrant->setNom('Demko');
		$encadrant->setPrenom('Christophe');
		$encadrant->setNomUsage('Demko1');
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
		
		$en = $es->updateVilleDeNaissanceEncadrant(2, "Niort");
		$req = $this->em->getRepository("DTDoctoramaBundle:Encadrant")->findOneById(2);

		$this->assertEquals("Niort", $req->getVilleDeNaissance());
		
	}
	
	// Test "mise à jour du pays de naissance d'un encadrant"
	public function testupdatePaysDeNaissanceEncadrant()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Encadrant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new EncadrantService($this->em);
		
		$encadrant = new Encadrant;
		
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
		
		$encadrant = new Encadrant;
		
		$encadrant->setNom('Demko');
		$encadrant->setPrenom('Christophe');
		$encadrant->setNomUsage('Demko1');
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
		
		$en = $es->updatePaysDeNaissanceEncadrant(2, "Belgique");
		$req = $this->em->getRepository("DTDoctoramaBundle:Encadrant")->findOneById(2);

		$this->assertEquals("Belgique", $req->getPaysDeNaissance());
		
	}
	
	// Test "mise à jour du pays de naissance d'un encadrant"
	public function testupdateDepDeNaissanceEncadrant()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Encadrant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$es = new EncadrantService($this->em);
		
		$encadrant = new Encadrant;
		
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
		
		$encadrant = new Encadrant;
		
		$encadrant->setNom('Demko');
		$encadrant->setPrenom('Christophe');
		$encadrant->setNomUsage('Demko1');
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
		
		$en = $es->updateDepDeNaissanceEncadrant(2, "79000");
		$req = $this->em->getRepository("DTDoctoramaBundle:Encadrant")->findOneById(2);

		$this->assertEquals("79000", $req->getDepDeNaissance());
		
	}
	
}


?>