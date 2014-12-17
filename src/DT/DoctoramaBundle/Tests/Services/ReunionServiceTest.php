<?php
namespace DT\DoctoramaBundle\Tests;

use DT\DoctoramaBundle\Services\ReunionService;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use DT\DoctoramaBundle\Entity\Reunion;
use DT\DoctoramaBundle\Entity\Encadrant;

class ReunionServiceTest extends WebTestCase
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

	private function viderTable()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Reunion")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Encadrant")->execute();
		$this->em->getConnection()->prepare("TRUNCATE TABLE encadrant_reunion")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
	}
	
	private function creer1Encadrant()
	{
		$encadrant = new Encadrant();
		
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
		
		return $encadrant;
	}

	/*public function testcreateReunion()
	{
		$this->viderTable();
		
		$rs = new ReunionService($this->em);
		$reu = $rs->createReunion("135", new \DateTime('2000-01-01'));
		
		$req = $this->em->getRepository('DTDoctoramaBundle:Reunion')->findByLieu('135');
        $this->assertEquals(1, sizeof($req));
		
		$req = $this->em->getRepository('DTDoctoramaBundle:Reunion')->findByDate(new \DateTime('2000-01-01'));
        $this->assertEquals(1, sizeof($req));
		
		$enc = $this->creer1Encadrant();
		$enc->addReunion($reu);
		
		$enc = $this->creer1Encadrant();
		$enc->addReunion($reu);
		
		$encdansreu = array();
		$enclist = $this->em->getRepository('DTDoctoramaBundle:Encadrant')->findAll();
		foreach($enclist as $e)
		{
			foreach($e->getReunion() as $r)
			{
				if($r == $reu)
				{
					array_push($encdansreu, $e);
				}
			}
		}
		
		$this->assertEquals(2, sizeof($encdansreu));
	}
	
	public function testaddPersonne()
	{
		$this->viderTable();
		
		$rs = new ReunionService($this->em);
		$reu = $rs->createReunion("135", new \DateTime('2000-01-01'));
		
		$enc1 = $this->creer1Encadrant();
		$enc2 = $this->creer1Encadrant();
		
		$rs->addPersonne(1, $enc1);
		$rs->addPersonne(1, $enc2);
		
		$tab = $reu->getPersonnes();
		$this->assertEquals(2, count($tab));
	}
	
	public function testgetPersonnes()
	{
		$this->viderTable();
		
		$rs = new ReunionService($this->em);
		$reu = $rs->createReunion("135", new \DateTime('2000-01-01'));
		
		$enc1 = $this->creer1Encadrant();
		$enc2 = $this->creer1Encadrant();
		
		$reu->addPersonne($enc1);
		$reu->addPersonne($enc2);
		
		$tab = $rs->getPersonnes(1);
		$this->assertEquals(2, count($tab));
	}
	
	public function testdeletePersonne()
	{
		$this->viderTable();
		
		$rs = new ReunionService($this->em);
		$reu = $rs->createReunion("135", new \DateTime('2000-01-01'));
		
		$enc1 = $this->creer1Encadrant();
		$enc2 = $this->creer1Encadrant();
		
		$reu->addPersonne($enc1);
		$reu->addPersonne($enc2);
		
		$reurep = $rs->deletePersonne(1, 2);
		$tabpers = $reurep->getPersonnes();
		$this->assertEquals(1, count($tabpers));
	}
	
	public function testsetDate()
	{
		$this->viderTable();
		$rs = new ReunionService($this->em);
		$reu = $rs->createReunion("135", new \DateTime('2000-01-01'));
		
		$rs->setDate(1, new \DateTime('2000-05-01'));
		
		$this->assertEquals(new \DateTime('2000-05-01'), $reu->getDate());
	}
	
	public function testgetDate()
	{
		$this->viderTable();
		$rs = new ReunionService($this->em);
		$reu = $rs->createReunion("135", new \DateTime('2000-01-01'));
				
		$this->assertEquals(new \DateTime('2000-01-01'), $rs->getDate(1));
	}
	
	public function testgetLieu()
	{
		$this->viderTable();
		$rs = new ReunionService($this->em);
		$reu = $rs->createReunion("135", new \DateTime('2000-01-01'));
				
		$this->assertEquals("135", $rs->getLieu(1));
	}
	
	public function testsetLieu()
	{
		$this->viderTable();
		$rs = new ReunionService($this->em);
		$reu = $rs->createReunion("135", new \DateTime('2000-01-01'));
		
		$rs->setLieu(1, "015");
		
		$this->assertEquals("015", $reu->getLieu());
	}
	
	public function testfindReunionByPersonne()
	{
		$this->viderTable();
		$rs = new ReunionService($this->em);
		$reu = $rs->createReunion("135", new \DateTime('2000-01-01'));
		$reu = $rs->createReunion("136", new \DateTime('2000-01-01'));
		
		$enc1 = $this->creer1Encadrant();
		$enc2 = $this->creer1Encadrant();
		$enc3 = $this->creer1Encadrant();
		$enc4 = $this->creer1Encadrant();
		
		$rs->addPersonne(1, $enc1);
		$rs->addPersonne(1, $enc2);
		$rs->addPersonne(2, $enc2);
		$rs->addPersonne(1, $enc3);
		$rs->addPersonne(1, $enc4);
		
		$rs->findReunionByPersonne(2);
	}*/
}