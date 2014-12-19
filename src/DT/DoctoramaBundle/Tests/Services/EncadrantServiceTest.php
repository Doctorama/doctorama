<?php
namespace DT\DoctoramaBundle\Tests;

use DT\DoctoramaBundle\Services\EncadrantService;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use DT\DoctoramaBundle\Entity\Encadrant;

/**
 * Tests associes a l'entite Encadrant
 */
class EncadrantServiceTest extends WebTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

	/**
	*	Permet de r�cup�rer l'entitymanager de doctrine
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
		$this->em->getConnection()->prepare("TRUNCATE TABLE Encadrant")->execute();
		$this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
	}
	
	/**
	*	Permet de cr�er un encadrant
	*	@return Encadrant
	*/
	private function creer1Encadrant()
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
	*	Test de la cr�ation d'un encadrant
	*/
    public function testcreateEncadrant()
    {
		$this->viderTable();
		
		
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
	
	/**
	*	Test de la recherche d'encadrant par son id
	*/
	public function testfindEncadrantById()
	{
		$this->viderTable();	
		$this->creer1Encadrant();
		$es = new EncadrantService($this->em);
		
		$en = $es->findEncadrantById(1);
		$this->assertEquals(1, sizeof($en));
		
	}
	
	/**
	*	Test de la recherche d'encadrant par son nom
	*/
	public function testfindEncadrantByNom()
	{
		$this->viderTable();	
		$this->creer1Encadrant();
		$es = new EncadrantService($this->em);
		
		$en = $es->findEncadrantByNom('Demko');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	/**
	*	Test de la recherche d'encadrant par son noom d'usage
	*/
	public function testfindEncadrantByNomUsage()
	{
		$this->viderTable();	
		$this->creer1Encadrant();
		$es = new EncadrantService($this->em);
		
		$en = $es->findEncadrantByNomUsage('Demko2');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	/**
	*	Test de la recherche d'encadrant par sa civilite
	*/
	public function testfindEncadrantByCivilite()
	{
		$this->viderTable();	
		$this->creer1Encadrant();
		$es = new EncadrantService($this->em);
		
		$en = $es->findEncadrantByCivilite('Monsieur');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	/**
	*	Test de la recherche d'encadrant par son prenom
	*/
	public function testfindEncadrantByPrenom()
	{
		$this->viderTable();	
		$this->creer1Encadrant();
		$es = new EncadrantService($this->em);
		
		$en = $es->findEncadrantByPrenom('Christophe');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	/**
	*	Test de la recherche d'encadrant par son adresse
	*/
	public function testfindEncadrantByAdresse()
	{
		$this->viderTable();	
		$this->creer1Encadrant();
		$es = new EncadrantService($this->em);
		
		$en = $es->findEncadrantByAdresse('1 rue des roses');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	/**
	*	Test de la recherche d'encadrant par son mail
	*/
	public function testfindEncadrantByMail()
	{
		$this->viderTable();	
		$this->creer1Encadrant();
		$es = new EncadrantService($this->em);
		
		$en = $es->findEncadrantByMail('Demko@adresse.com');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	/**
	*	Test de la recherche d'encadrant par sa date de naissance
	*/
	public function testfindEncadrantByDateDeNaissance()
	{
		$this->viderTable();	
		$this->creer1Encadrant();
		$es = new EncadrantService($this->em);
		
		$en = $es->findEncadrantByDateDeNaissance(new \DateTime('2000-01-01'));
		$this->assertEquals(1, sizeof($en));
		
	}
	
	/**
	*	Test de la recherche d'encadrant par sa nationalite
	*/
	public function testfindEncadrantByNationalite()
	{
		$this->viderTable();	
		$this->creer1Encadrant();
		$es = new EncadrantService($this->em);
		
		$en = $es->findEncadrantByNationalite('FR');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	/**
	*	Test de la recherche d'encadrant par son id
	*/
	public function testfindEncadrantByVilleDeNaissance()
	{
		$this->viderTable();	
		$this->creer1Encadrant();
		$es = new EncadrantService($this->em);
		
		$en = $es->findEncadrantByVilleDeNaissance('La Rochelle');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	/**
	*	Test de la recherche d'encadrant par son paysdenaissance
	*/
	public function testfindEncadrantByPaysDeNaissance()
	{
		$this->viderTable();	
		$this->creer1Encadrant();
		$es = new EncadrantService($this->em);
		
		$en = $es->findEncadrantByPaysDeNaissance('France');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	/**
	*	Test de la recherche d'encadrant par son departement de naissance
	*/
	public function testfindEncadrantByDepDeNaissance()
	{
		$this->viderTable();	
		$this->creer1Encadrant();
		$es = new EncadrantService($this->em);
		
		$en = $es->findEncadrantByDepDeNaissance('17');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	/**
	*	Test de la recherche d'encadrant par son nom et prenom
	*/
	public function testfindEncadrantByNomEtPrenom()
	{
		$this->viderTable();	
		$this->creer1Encadrant();
		$es = new EncadrantService($this->em);
		
		$en = $es->findEncadrantByNomEtPrenom('Christophe', 'Demko');
		$this->assertEquals(1, sizeof($en));
		
	}
	
	/**
	*	Test de la recherche de tous les encadrants
	*/
	public function testfindAll()
	{
		$this->viderTable();	
		$this->creer1Encadrant();
		$this->creer1Encadrant();
		$es = new EncadrantService($this->em);
		
		$en = $es->findAll();
		$this->assertEquals(2, sizeof($en));
		
	}
	
	/**
	*	Test de la mise a jour du nom d'un encadrant
	*/
	public function testupdateNom()
	{
		$this->viderTable();	
		$this->creer1Encadrant();
		$this->creer1Encadrant();
		$es = new EncadrantService($this->em);
		
		$en = $es->updateNom(2, 'Revel');
		$req = $this->em->getRepository("DTDoctoramaBundle:Encadrant")->findOneById(2);

		$this->assertEquals('Revel', $req->getNom());
		
	}
	
	/**
	*	Test de la mise a jour du nom d'usage d'un encadrant
	*/
	public function testupdateNomUsage()
	{
		$this->viderTable();	
		$this->creer1Encadrant();
		$this->creer1Encadrant();
		$es = new EncadrantService($this->em);
		
		$en = $es->updateNomUsage(2, 'Revel');
		$req = $this->em->getRepository("DTDoctoramaBundle:Encadrant")->findOneById(2);

		$this->assertEquals('Revel', $req->getNomUsage());
		
	}
	
	/**
	*	Test de la mise a jour du prenom d'un encadrant
	*/
	public function testupdatePrenom()
	{
		$this->viderTable();	
		$this->creer1Encadrant();
		$this->creer1Encadrant();
		$es = new EncadrantService($this->em);
		
		$en = $es->updatePrenom(2, 'Revel');
		$req = $this->em->getRepository("DTDoctoramaBundle:Encadrant")->findOneById(2);

		$this->assertEquals('Revel', $req->getPrenom());
		
	}
	
	/**
	*	Test de la mise a jour de l'adresse d'un encadrant
	*/
	public function testupdateAdresse()
	{
		$this->viderTable();	
		$this->creer1Encadrant();
		$this->creer1Encadrant();
		$es = new EncadrantService($this->em);
		
		$en = $es->updateAdresse(2, '2 rue au pied');
		$req = $this->em->getRepository("DTDoctoramaBundle:Encadrant")->findOneById(2);

		$this->assertEquals('2 rue au pied', $req->getAdresse());
		
	}
	
	/**
	*	Test de la mise a jour du mail d'un encadrant
	*/
	public function testupdateMail()
	{
		$this->viderTable();	
		$this->creer1Encadrant();
		$this->creer1Encadrant();
		$es = new EncadrantService($this->em);
		
		$en = $es->updateMail(2, 'Revel@ad.fr');
		$req = $this->em->getRepository("DTDoctoramaBundle:Encadrant")->findOneById(2);

		$this->assertEquals('Revel@ad.fr', $req->getMail());
		
	}
	
	/**
	*	Test de la mise a jour de la date de naissance d'un encadrant
	*/
	public function testupdateDateDeNaissance()
	{
		$this->viderTable();	
		$this->creer1Encadrant();
		$this->creer1Encadrant();
		$es = new EncadrantService($this->em);
		
		$en = $es->updateDateDeNaissance(2, new \DateTime('2015-01-01'));
		$req = $this->em->getRepository("DTDoctoramaBundle:Encadrant")->findOneById(2);

		$this->assertEquals(new \DateTime('2015-01-01'), $req->getDateDeNaissance());
		
	}
	
	/**
	*	Test de la mise a jour de la nationalite d'un encadrant
	*/
	public function testupdateNationalite()
	{
		$this->viderTable();	
		$this->creer1Encadrant();
		$this->creer1Encadrant();
		$es = new EncadrantService($this->em);
		
		$en = $es->updateNationalite(2, "EN");
		$req = $this->em->getRepository("DTDoctoramaBundle:Encadrant")->findOneById(2);

		$this->assertEquals("EN", $req->getNationalite());
		
	}
	
	/**
	*	Test de la mise a jour de la ville de naissance d'un encadrant
	*/
	public function testupdateVilleDeNaissance()
	{
		$this->viderTable();	
		$this->creer1Encadrant();
		$this->creer1Encadrant();
		$es = new EncadrantService($this->em);
		
		$en = $es->updateVilleDeNaissance(2, "Niort");
		$req = $this->em->getRepository("DTDoctoramaBundle:Encadrant")->findOneById(2);

		$this->assertEquals("Niort", $req->getVilleDeNaissance());
		
	}
	
	/**
	*	Test de la mise a jour du pays de naissance d'un encadrant
	*/
	public function testupdatePaysDeNaissance()
	{
		$this->viderTable();	
		$this->creer1Encadrant();
		$this->creer1Encadrant();
		$es = new EncadrantService($this->em);
		
		$en = $es->updatePaysDeNaissance(2, "Belgique");
		$req = $this->em->getRepository("DTDoctoramaBundle:Encadrant")->findOneById(2);

		$this->assertEquals("Belgique", $req->getPaysDeNaissance());
		
	}
	
	/**
	*	Test de la mise a jour du departement de naissance d'un encadrant
	*/
	public function testupdateDepDeNaissance()
	{
		$this->viderTable();	
		$this->creer1Encadrant();
		$this->creer1Encadrant();
		$es = new EncadrantService($this->em);
		
		$en = $es->updateDepDeNaissance(2, "79000");
		$req = $this->em->getRepository("DTDoctoramaBundle:Encadrant")->findOneById(2);

		$this->assertEquals("79000", $req->getDepDeNaissance());
		
	}
	
	/**
	*	Test de la suppression d'un encadrant
	*/
	public function testdelete()
	{
		$this->viderTable();	
		$this->creer1Encadrant();
		$this->creer1Encadrant();
		$es = new EncadrantService($this->em);
		
		$en = $es->delete(2);
		
		$en = $this->em->getRepository('DTDoctoramaBundle:Encadrant')->findAll();
		$this->assertEquals(1, sizeof($en));
	}
	
}


?>