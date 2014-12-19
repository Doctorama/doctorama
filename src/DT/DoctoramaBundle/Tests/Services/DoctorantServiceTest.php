<?php
namespace DT\DoctoramaBundle\Tests;
// src/Acme/StoreBundle/Tests/Entity/ProductRepositoryFunctionalTest.php
use DT\DoctoramaBundle\Services\DoctorantService;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use DT\DoctoramaBundle\Entity\Doctorant;

/**
 * Tests associes a l'entite Doctorant
 */
class DoctorantServiceTest extends WebTestCase
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
		$this->em->getConnection()->prepare("TRUNCATE TABLE Doctorant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
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
	*	Test de la création d'un doctorant
	*/
	public function testcreateDoctorant()
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
	
	/**
	*	Test de la recherche de doctorant par son nom
	*/
	public function testfindDoctorantByNom()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->findDoctorantByNom('Demko');
		$this->assertEquals(1, sizeof($en));
	}
	
	/**
	*	Test de la recherche de doctorant par son nom d'usage
	*/
	public function testfindDoctorantByNomUsage()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->findDoctorantByNomUsage('Demko2');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	/**
	*	Test de la recherche de doctorant par sa civilite
	*/
	public function testfindDoctorantByCivilite()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->findDoctorantByCivilite('Monsieur');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	/**
	*	Test de la recherche de doctorant par son prenom
	*/
	public function testfindDoctorantByPrenom()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->findDoctorantByPrenom('Christophe');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	/**
	*	Test de la recherche de doctorant par son mail
	*/
	public function testfindDoctorantByMail()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->findDoctorantByMail('Demko@adresse.com');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	/**
	*	Test de la recherche de doctorant par sa date de naissance
	*/
	public function testfindDoctorantByDateDeNaissance()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->findDoctorantByDateDeNaissance(new \DateTime('2000-01-01'));
		$this->assertEquals(1, sizeof($en));
		
	}
	
	/**
	*	Test de la recherche de doctorant par sa nationalite
	*/
	public function testfindDoctorantByNationalite()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->findDoctorantByNationalite('FR');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	/**
	*	Test de la recherche de doctorant par sa ville de naissance
	*/
	public function testfindDoctorantByVilleDeNaissance()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->findDoctorantByVilleDeNaissance('La Rochelle');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	/**
	*	Test de la recherche de doctorant par son pays de naissance
	*/
	public function testfindDoctorantByPaysDeNaissance()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->findDoctorantByPaysDeNaissance('France');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	/**
	*	Test de la recherche de doctorant par son departement de naissance
	*/
	public function testfindDoctorantByDepDeNaissance()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->findDoctorantByDepDeNaissance('17');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	/**
	*	Test de la recherche de doctorant par son numero d'etudiant
	*/
	public function testfindDoctorantByNumEtudiant()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->findDoctorantByNumEtudiant('123456');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	/**
	*	Test de la recherche de doctorant par sa bourse
	*/
	public function testfindDoctorantByBourseEtExoneration()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->findDoctorantByBourseEtExoneration('0');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	/**
	*	Test de la recherche de doctorant par sa 1ere date d'inscription a une these
	*/
	public function testfindDoctorantByDateInscr1eThese()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->findDoctorantByDateInscr1eThese('2010-09-03');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	/**
	*	Test de la recherche de doctorant par son DCACE
	*/
	public function testfindDoctorantByDcace()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->findDoctorantByDcace('rr');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	/**
	*	Test de la recherche de doctorant par le nom de sa formation en master
	*/
	public function testfindDoctorantByNomFormationMaster()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->findDoctorantByNomFormationMaster('ICONE');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	/**
	*	Test de la recherche de doctorant par le nom de son universite en master
	*/
	public function testfindDoctorantByUniversiteMaster()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->findDoctorantByUniversiteMaster('ULR');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	/**
	*	Test de la recherche de doctorant par son sujet en master
	*/
	public function testfindDoctorantBySujetMaster()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->findDoctorantBySujetMaster('M1');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	/**
	*	Test de la recherche de doctorant par son laboratoire d'acceuil en master
	*/
	public function testfindDoctorantByLaboratoireAcceuilMaster()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->findDoctorantByLaboratoireAcceuilMaster('L3I');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	/**
	*	Test de la recherche de doctorant par son encadrant en master
	*/
	public function testfindDoctorantByEncadrantsMaster()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->findDoctorantByEncadrantsMaster('C. Demko');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	/**
	*	Test de la recherche de doctorant par son etablissement de dernier diplome
	*/
	public function testfindDoctorantByEtabDernierDiplome()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->findDoctorantByEtabDernierDiplome('ULR');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	/**
	*	Test de la recherche de doctorant par son pays de dernier diplome
	*/
	public function testfindDoctorantByPaysDernierDiplome()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->findDoctorantByPaysDernierDiplome('France');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	/**
	*	Test de la recherche de doctorant par son libelle de dernier diplome
	*/
	public function testfindDoctorantByLibelleDernierDiplome()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->findDoctorantByLibelleDernierDiplome('ICONE');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	/**
	*	Test de la recherche de doctorant par son annee de dernier diplome
	*/
	public function testfindDoctorantByAnneeDernierDiplome()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->findDoctorantByAnneeDernierDiplome('2014-06-20');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	/**
	*	Test de la recherche de doctorant par son departement de dernier diplome
	*/
	public function testfindDoctorantByDepDernierDiplome()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->findDoctorantByDepDernierDiplome('17');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	/**
	*	Test de la recherche de tous les doctorants
	*/
	public function testfindAll()
	{
		$this->viderTable();		
		$this->creer1Doctorant();
		$this->creer1Doctorant();
		$es = new DoctorantService($this->em);
		
		$en = $es->findAll();
		$this->assertEquals(2, sizeof($en));
		
	}
	
	/**
	*	Test de la mise a jour du nom d'un doctorant
	*/
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
	
	/**
	*	Test de la mise a jour du nom d'usage d'un doctorant
	*/
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
	
	/**
	*	Test de la mise a jour de la civilite d'un doctorant
	*/
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
	
	/**
	*	Test de la mise a jour du prenom d'un doctorant
	*/
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
	
	/**
	*	Test de la mise a jour de l'adresse d'un doctorant
	*/
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
	
	/**
	*	Test de la mise a jour du mail d'un doctorant
	*/
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
	
	/**
	*	Test de la mise a jour de la date de naissance d'un doctorant
	*/
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
	
	/**
	*	Test de la mise a jour de la nationalite d'un doctorant
	*/
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
	
	/**
	*	Test de la mise a jour de la ville de naissance d'un doctorant
	*/
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
	
	/**
	*	Test de la mise a jour du pays de naissance d'un doctorant
	*/
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
	
	/**
	*	Test de la mise a jour du departement de naissanced'un doctorant
	*/
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
	
	/**
	*	Test de la mise a jour du numero etudiant d'un doctorant
	*/
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
	
	/**
	*	Test de la mise a jour de la bourse d'un doctorant
	*/
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
	
	/**
	*	Test de la mise a jour de la date de 1ere inscription en these d'un doctorant
	*/
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
	
	/**
	*	Test de la mise a jour du DCACE d'un doctorant
	*/
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
	
	/**
	*	Test de la mise a jour du nom de la formation en master d'un doctorant
	*/
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
	
	/**
	*	Test de la mise a jour du nom de l'universite en master d'un doctorant
	*/
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
	
	/**
	*	Test de la mise a jour du sujet en master d'un doctorant
	*/
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
	
	/**
	*	Test de la mise a jour du laboratoire d'acceuil en master d'un doctorant
	*/
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
	
	/**
	*	Test de la mise a jour de l'encadrant en master d'un doctorant
	*/
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
	
	/**
	*	Test de la mise a jour de l'etablissement du dernier diplome d'un doctorant
	*/
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
	
	/**
	*	Test de la mise a jour du departement du dernier diplome d'un doctorant
	*/
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
	
	/**
	*	Test de la mise a jour du pays du dernier diplome d'un doctorant
	*/
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
	
	/**
	*	Test de la mise a jour du libelle du dernier diplome d'un doctorant
	*/
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
	
	/**
	*	Test de la mise a jour de l'annee d'obtention du dernier diplome d'un doctorant
	*/
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
	
	/**
	*	Test de la suppression d'un doctorant
	*/
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
	}
	
}
?>