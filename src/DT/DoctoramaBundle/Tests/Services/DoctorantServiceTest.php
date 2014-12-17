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
	
	private function viderTable()
	{
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();	
		$this->em->getConnection()->prepare("TRUNCATE TABLE Doctorant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
	}
	
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
	
	/*public function testcreateDoctorant()
    {
		$this->viderTable();
		
		
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
		$this->viderTable();		
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->findDoctorantByNom('Demko');
		$this->assertEquals(1, sizeof($en));
	}
	
	public function testfindDoctorantByNomUsage()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->findDoctorantByNomUsage('Demko2');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	public function testfindDoctorantByCivilite()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->findDoctorantByCivilite('Monsieur');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	public function testfindDoctorantByPrenom()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->findDoctorantByPrenom('Christophe');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	public function testfindDoctorantByMail()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->findDoctorantByMail('Demko@adresse.com');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	public function testfindDoctorantByDateDeNaissance()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->findDoctorantByDateDeNaissance(new \DateTime('2000-01-01'));
		$this->assertEquals(1, sizeof($en));
		
	}
	
	public function testfindDoctorantByNationalite()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->findDoctorantByNationalite('FR');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	public function testfindDoctorantByVilleDeNaissance()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->findDoctorantByVilleDeNaissance('La Rochelle');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	public function testfindDoctorantByPaysDeNaissance()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->findDoctorantByPaysDeNaissance('France');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	public function testfindDoctorantByDepDeNaissance()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->findDoctorantByDepDeNaissance('17');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	public function testfindDoctorantByNumEtudiant()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->findDoctorantByNumEtudiant('123456');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	public function testfindDoctorantByBourseEtExoneration()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->findDoctorantByBourseEtExoneration('0');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	public function testfindDoctorantByDateInscr1eThese()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->findDoctorantByDateInscr1eThese('2010-09-03');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	public function testfindDoctorantByDcace()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->findDoctorantByDcace('rr');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	public function testfindDoctorantByNomFormationMaster()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->findDoctorantByNomFormationMaster('ICONE');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	public function testfindDoctorantByUniversiteMaster()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->findDoctorantByUniversiteMaster('ULR');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	public function testfindDoctorantBySujetMaster()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->findDoctorantBySujetMaster('M1');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	public function testfindDoctorantByLaboratoireAcceuilMaster()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->findDoctorantByLaboratoireAcceuilMaster('L3I');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	public function testfindDoctorantByEncadrantsMaster()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->findDoctorantByEncadrantsMaster('C. Demko');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	public function testfindDoctorantByEtabDernierDiplome()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->findDoctorantByEtabDernierDiplome('ULR');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	public function testfindDoctorantByPaysDernierDiplome()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->findDoctorantByPaysDernierDiplome('France');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	public function testfindDoctorantByLibelleDernierDiplome()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->findDoctorantByLibelleDernierDiplome('ICONE');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	public function testfindDoctorantByAnneeDernierDiplome()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->findDoctorantByAnneeDernierDiplome('2014-06-20');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	public function testfindDoctorantByDepDernierDiplome()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->findDoctorantByDepDernierDiplome('17');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	public function testfindAll()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->findAll();
		$this->assertEquals(2, sizeof($en));
		
	}
	
	public function testupdateNom()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->updateNom(2, "Demko123");
		$req = $this->em->getRepository("DTDoctoramaBundle:Doctorant")->findOneById(2);
		$this->assertEquals("Demko123", $req->getNom());	
	}
	
	public function testupdateNomUsage()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->updateNomUsage(2, "Demko123");
		$req = $this->em->getRepository("DTDoctoramaBundle:Doctorant")->findOneById(2);
		$this->assertEquals("Demko123", $req->getNomUsage());	
	}
	
	public function testupdateCivilite()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->updateCivilite(2, "test123");
		$req = $this->em->getRepository("DTDoctoramaBundle:Doctorant")->findOneById(2);
		$this->assertEquals("test123", $req->getCivilite());	
	}
	
	public function testupdatePrenom()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->updatePrenom(2, "test123");
		$req = $this->em->getRepository("DTDoctoramaBundle:Doctorant")->findOneById(2);
		$this->assertEquals("test123", $req->getPrenom());	
	}
	
	public function testupdateAdresse()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->updateAdresse(2, "test123");
		$req = $this->em->getRepository("DTDoctoramaBundle:Doctorant")->findOneById(2);
		$this->assertEquals("test123", $req->getAdresse());	
	}
	
	public function testupdateMail()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->updateMail(2, "test123");
		$req = $this->em->getRepository("DTDoctoramaBundle:Doctorant")->findOneById(2);
		$this->assertEquals("test123", $req->getMail());	
	}
	
	public function testupdateDateDeNaissance()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->updateDateDeNaissance(2, new \DateTime('2000-01-02'));
		$req = $this->em->getRepository("DTDoctoramaBundle:Doctorant")->findOneById(2);
		$this->assertEquals(new \DateTime('2000-01-02'), $req->getDateDeNaissance());	
	}
	
	public function testupdateNationalite()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->updateNationalite(2, "test123");
		$req = $this->em->getRepository("DTDoctoramaBundle:Doctorant")->findOneById(2);
		$this->assertEquals("test123", $req->getNationalite());	
	}
	
	public function testupdateVilleDeNaissance()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->updateVilleDeNaissance(2, "test123");
		$req = $this->em->getRepository("DTDoctoramaBundle:Doctorant")->findOneById(2);
		$this->assertEquals("test123", $req->getVilleDeNaissance());	
	}
	
	public function testupdatePaysDeNaissance()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->updatePaysDeNaissance(2, "test123");
		$req = $this->em->getRepository("DTDoctoramaBundle:Doctorant")->findOneById(2);
		$this->assertEquals("test123", $req->getPaysDeNaissance());	
	}
	
	public function testupdateDepDeNaissance()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->updateDepDeNaissance(2, "test123");
		$req = $this->em->getRepository("DTDoctoramaBundle:Doctorant")->findOneById(2);
		$this->assertEquals("test123", $req->getDepDeNaissance());	
	}
	
	public function testupdateNumEtudiant()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->updateNumEtudiant(2, "test123");
		$req = $this->em->getRepository("DTDoctoramaBundle:Doctorant")->findOneById(2);
		$this->assertEquals("test123", $req->getNumEtudiant());	
	}
	
	public function testupdateBourseEtExoneration()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->updateBourseEtExoneration(2, "test123");
		$req = $this->em->getRepository("DTDoctoramaBundle:Doctorant")->findOneById(2);
		$this->assertEquals("test123", $req->getBourseEtExoneration());	
	}
	
	public function testupdateDateInscr1eThese()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->updateDateInscr1eThese(2, "test123");
		$req = $this->em->getRepository("DTDoctoramaBundle:Doctorant")->findOneById(2);
		$this->assertEquals("test123", $req->getDateInscr1eThese());	
	}
	
	public function testupdateDcace()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->updateDcace(2, "test123");
		$req = $this->em->getRepository("DTDoctoramaBundle:Doctorant")->findOneById(2);
		$this->assertEquals("test123", $req->getDcace());	
	}
	
	public function testupdateNomFormationMaster()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->updateNomFormationMaster(2, "test123");
		$req = $this->em->getRepository("DTDoctoramaBundle:Doctorant")->findOneById(2);
		$this->assertEquals("test123", $req->getNomFormationMaster());	
	}
	
	public function testupdateUniversiteMaster()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->updateUniversiteMaster(2, "test123");
		$req = $this->em->getRepository("DTDoctoramaBundle:Doctorant")->findOneById(2);
		$this->assertEquals("test123", $req->getUniversiteMaster());	
	}
	
	public function testupdateSujetMaster()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->updateSujetMaster(2, "test123");
		$req = $this->em->getRepository("DTDoctoramaBundle:Doctorant")->findOneById(2);
		$this->assertEquals("test123", $req->getSujetMaster());	
	}
	
	public function testupdateLaboratoireAccueilMaster()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->updateLaboratoireAccueilMaster(2, "test123");
		$req = $this->em->getRepository("DTDoctoramaBundle:Doctorant")->findOneById(2);
		$this->assertEquals("test123", $req->getLaboratoireAcceuilMaster());	
	}
	
	public function testupdateEncadrantsMaster()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->updateEncadrantsMaster(2, "test123");
		$req = $this->em->getRepository("DTDoctoramaBundle:Doctorant")->findOneById(2);
		$this->assertEquals("test123", $req->getEncadrantsMaster());	
	}
	
	public function testupdateEtabDernierDiplome()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->updateEtabDernierDiplome(2, "test123");
		$req = $this->em->getRepository("DTDoctoramaBundle:Doctorant")->findOneById(2);
		$this->assertEquals("test123", $req->getEtabDernierDiplome());	
	}
	
	public function testupdateDepDernierDiplome()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->updateDepDernierDiplome(2, "test123");
		$req = $this->em->getRepository("DTDoctoramaBundle:Doctorant")->findOneById(2);
		$this->assertEquals("test123", $req->getDepDernierDiplome());	
	}
	
	public function testupdatePaysDernierDiplome()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->updatePaysDernierDiplome(2, "test123");
		$req = $this->em->getRepository("DTDoctoramaBundle:Doctorant")->findOneById(2);
		$this->assertEquals("test123", $req->getPaysDernierDiplome());	
	}
	
	public function testupdateLibelleDernierDiplome()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->updateLibelleDernierDiplome(2, "test123");
		$req = $this->em->getRepository("DTDoctoramaBundle:Doctorant")->findOneById(2);
		$this->assertEquals("test123", $req->getLibelleDernierDiplome());	
	}
	
	public function testupdateAnneeDernierDiplome()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->updateAnneeDernierDiplome(2, "test123");
		$req = $this->em->getRepository("DTDoctoramaBundle:Doctorant")->findOneById(2);
		$this->assertEquals("test123", $req->getAnneeDernierDiplome());	
	}
	
	public function testdelete()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->delete(1);
		
		$en = $this->em->getRepository('DTDoctoramaBundle:Doctorant')->findById(1);
		$this->assertEquals(0, sizeof($en));	
		
		$en = $this->em->getRepository('DTDoctoramaBundle:Doctorant')->findById(2);
		$this->assertEquals(1, sizeof($en));
	}*/
	
}
?>