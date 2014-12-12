<?php
namespace DT\DoctoramaBundle\Services;
//EncadrantService
use DT\DoctoramaBundle\Entity\Encadrant;

class EncadrantService
{

	private $em;
	
	private $repository;
	
	public function __construct($em)
	{
		$this->em = $em;
		$this->repository = $this->em->getRepository('DTDoctoramaBundle:Encadrant');
	}
	
	public function createEncadrant($nom, $nomUsage, $civilite, $prenom, $adresse, $mail, $dateDeNaissance, $nationalite, $villeDeNaissance, $paysDeNaissance, $depDeNaissance)
	{
		$encadrant = new Encadrant();
		$encadrant->setNom($nom);
		$encadrant->setNomUsage($nomUsage);
		$encadrant->setCivilite($civilite);
		$encadrant->setPrenom($prenom);
		$encadrant->setAdresse($adresse);
		$encadrant->setMail($mail);
		$encadrant->setDateDeNaissance($dateDeNaissance);
		$encadrant->setNationalite($nationalite);
		$encadrant->setVilleDeNaissance($villeDeNaissance);
		$encadrant->setPaysDeNaissance($paysDeNaissance);
		$encadrant->setDepDeNaissance($depDeNaissance);
		
		
		$this->em->persist($encadrant);
		$this->em->flush();
		return $encadrant;
	}
	
	public function findEncadrantById($id)
	{

		
		$encadrant = $this->repository->findById($id);

		if (!$encadrant) {
			throw $this->createNotFoundException(
				'Aucun encadrant trouvé par : : '.$id
			);
						}
		else
			return $encadrant;
	}
	
	public function findEncadrantByNom($nom)
	{

		$encadrants = $this->repository->findByNom($nom);

		if (!$encadrants) 
		{
			throw $this->createNotFoundException(
			'Aucun encadrant trouvé par : : '.$nom
		);
		}
		else
			return $encadrants;
	}
	
	public function findEncadrantByNomUsage($nomUsage)
	{
		$encadrants = $this->repository->findByNomUsage($nomUsage);

		if (!$encadrants) {
			throw $this->createNotFoundException(
				'Aucun encadrant trouvé par : : '.$nomUsage
			);
						}
		else
			return $encadrants;
	}
		
	public function findEncadrantByCivilite($civilite)
	{

		$encadrants = $this->repository->findByCivilite($civilite);

		if (!$encadrants) {
			throw $this->createNotFoundException(
				'Aucun encadrant trouvé par : : '.$civilite
			);
						}
		else
			return $encadrants;
	}
	
	public function findEncadrantByPrenom($prenom)
	{
		$encadrants = $this->repository->findByPrenom($prenom);

		if (!$encadrants) {
			throw $this->createNotFoundException(
				'Aucun encadrant trouvé par : : '.$prenom
			);
						}
		else
			return $encadrants;
	}
		
	public function findEncadrantByAdresse($adresse)
	{

		$encadrants = $this->repository->findByAdresse($adresse);

		if (!$encadrants) {
			throw $this->createNotFoundException(
				'Aucun encadrant trouvé par : : '.$adresse
			);
						}
		else
			return $encadrants;
	}
	
	public function findEncadrantByMail($mail)
	{

		$encadrant = $this->repository->findByMail($mail);

		if (!$encadrant) {
			throw $this->createNotFoundException(
				'Aucun encadrant trouvé par : : '.$mail
			);
						}
		else
			return $encadrant;
	}
	
	public function findEncadrantByDateDeNaissance($dateDeNaissance)
	{

		$encadrants = $this->repository->findByDateDeNaissance($dateDeNaissance);

		if (!$encadrants) {
			throw $this->createNotFoundException(
				'Aucun encadrant trouvé par : : '.$dateDeNaissance
			);
						}
		else
			return $encadrants;
	}
	
	public function findEncadrantByNationalite($nationalite)
	{

		$encadrants = $this->repository->findByNationalite($nationalite);

		if (!$encadrants) {
			throw $this->createNotFoundException(
				'Aucun encadrant trouvé par : : '.$nationalite
			);
						}
		else
			return $encadrants;
	}
	
	public function findEncadrantByVilleDeNaissance($villeDeNaissance)
	{

		$encadrants = $this->repository->findByVilleDeNaissance($villeDeNaissance);

		if (!$encadrants) {
			throw $this->createNotFoundException(
				'Aucun encadrant trouvé par : : '.$villeDeNaissance
			);
						}
		else
			return $encadrants;
	}
	
	public function findEncadrantByPaysDeNaissance($paysDeNaissance)
	{

		$encadrants = $this->repository->findByPaysDeNaissance($paysDeNaissance);

		if (!$encadrants) {
			throw $this->createNotFoundException(
				'Aucun encadrant trouvé par : : '.$paysDeNaissance
			);
						}
		else
			return $encadrants;
	}
	
	public function findEncadrantByDepDeNaissance($depDeNaissance)
	{

		$encadrants = $this->repository->findByDepDeNaissance($depDeNaissance);

		if (!$encadrants) {
			throw $this->createNotFoundException(
				'Aucun encadrant trouvé par : : '.$depDeNaissance
			);
						}
		else
			return $encadrants;
	}
	
	public function findEncadrantByNomEtPrenom($prenom, $nom)
	{

		$encadrants = $this->em->getConnection()->prepare('SELECT *	FROM Encadrant e WHERE e.prenom = "'.$prenom.'" AND e.nom = "'.$nom.'";')->execute();

		if (!$encadrants) {
			throw $this->createNotFoundException(
				'Aucun encadrant trouvé'
			);
						}
		else
			return $encadrants;
	}
	
	public function findAll()
	{

		$encadrants = $this->repository->findAll();

		if (!$encadrants) {
			throw $this->createNotFoundException(
				'Aucun encadrant trouvé'
			);
						}
		else
			return $encadrants;
	}
	
	
	public function updateNomEncadrant($id,$nouveauNom)
	{
	
		$encadrant = $this->repository->find($id);

		if (!$encadrant) {
			throw $this->createNotFoundException(
				'Aucun encadrant trouvé pour cet id: '.$id
			);
		}

		$encadrant->setNom($nouveauNom);
		$this->em->flush();

		return $encadrant;
	}
	
	public function updateNomUsageEncadrant($id,$nouveauNomUsage)
	{
	
		$encadrant = $this->repository->find($id);

		if (!$encadrant) {
			throw $this->createNotFoundException(
				'Aucun encadrant trouvé pour cet id: '.$id
			);
		}

		$encadrant->setNomUsage($nouveauNomUsage);
		$this->em->flush();

		return $encadrant;
	}
	
	public function updateCiviliteEncadrant($id,$nouveauCivilite)
	{
	
		$encadrant = $this->repository->find($id);

		if (!$encadrant) {
			throw $this->createNotFoundException(
				'Aucun encadrant trouvé pour cet id: '.$id
			);
		}

		$encadrant->setCivilite($nouveauCivilite);
		$this->em->flush();

		return $encadrant;
	}
	
	public function updatePrenomEncadrant($id,$nouveauPrenom)
	{
	
		$encadrant = $this->repository->find($id);

		if (!$encadrant) {
			throw $this->createNotFoundException(
				'Aucun encadrant trouvé pour cet id: '.$id
			);
		}

		$encadrant->setPrenom($nouveauPrenom);
		$this->em->flush();

		return $encadrant;
	}
	
	public function updateAdresseEncadrant($id,$nouveauAdresse)
	{
	
		$encadrant = $this->repository->find($id);

		if (!$encadrant) {
			throw $this->createNotFoundException(
				'Aucun encadrant trouvé pour cet id: '.$id
			);
		}

		$encadrant->setAdresse($nouveauAdresse);
		$this->em->flush();

		return $encadrant;
	}
	
	public function updateMailEncadrant($id,$nouveauMail)
	{
	
		$encadrant = $this->repository->find($id);

		if (!$encadrant) {
			throw $this->createNotFoundException(
				'Aucun encadrant trouvé pour cet id: '.$id
			);
		}

		$encadrant->setMail($nouveauMail);
		$this->em->flush();

		return $encadrant;
	}
	
	public function updateDateDeNaissancEncadrant($id,$nouveauDateDeNaissance)
	{
	
		$encadrant = $this->repository->find($id);

		if (!$encadrant) {
			throw $this->createNotFoundException(
				'Aucun encadrant trouvé pour cet id: '.$id
			);
		}

		$encadrant->setDateDeNaissance($nouveauDateDeNaissance);
		$this->em->flush();

		return $encadrant;
	}
	
	public function updateNationaliteEncadrant($id,$nouveauNationalite)
	{
	
		$encadrant = $this->repository->find($id);

		if (!$encadrant) {
			throw $this->createNotFoundException(
				'Aucun encadrant trouvé pour cet id: '.$id
			);
		}

		$encadrant->setNationalite($nouveauNationalite);
		$this->em->flush();

		return $encadrant;
	}
	
	public function updateVilleDeNaissanceEncadrant($id,$nouveauVilleDeNaissance)
	{
	
		$encadrant = $this->repository->find($id);

		if (!$encadrant) {
			throw $this->createNotFoundException(
				'Aucun encadrant trouvé pour cet id: '.$id
			);
		}

		$encadrant->setVilleDeNaissance($nouveauVilleDeNaissance);
		$this->em->flush();

		return $encadrant;
	}
	
	public function updatePaysDeNaissanceEncadrant($id,$nouveauPaysDeNaissance)
	{
	
		$encadrant = $this->repository->find($id);

		if (!$encadrant) {
			throw $this->createNotFoundException(
				'Aucun encadrant trouvé pour cet id: '.$id
			);
		}

		$encadrant->setPaysDeNaissance($nouveauPaysDeNaissance);
		$this->em->flush();

		return $encadrant;
	}
	
	public function updateDepDeNaissanceEncadrant($id,$nouveauDepDeNaissance)
	{
	
		$encadrant = $this->repository->find($id);

		if (!$encadrant) {
			throw $this->createNotFoundException(
				'Aucun encadrant trouvé pour cet id: '.$id
			);
		}

		$encadrant->setDepDeNaissance($nouveauDepDeNaissance);
		$this->em->flush();

		return $encadrant;
	}
	
	public function deleteEncadrant($id)
	{

		$encadrant = $this->repository->find($id);

		if (!$encadrant) {
			throw $this->createNotFoundException(
				'Aucun encadrant trouvé pour cet id : '.$id
			);
		}

		$em->remove($encadrant);
		$this->em->flush();

		return True;
	}
}

	


