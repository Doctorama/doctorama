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
	
	/**
	* Set Encadrant
	*
	* @param string $nom
	* @param string $nomUsage
	* @param string $civilite
	* @param string $prenom
	* @param string $adresse
	* @param string $mail
	* @param \datetime $dateDeNaissance
	* @param \datetime $nationalite
	* @param string $villeDeNaissance
	* @param string $paysDeNaissance
	* @param \integer $depDeNaissance
	*
	* @return Encadrant
	**/
	public function createEncadrant($nom, $nomUsage, $civilite, 
	$prenom, $adresse, $mail, $dateDeNaissance, $nationalite, 
	$villeDeNaissance, $paysDeNaissance, $depDeNaissance)
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
	
	/**
	* get EncadrantById
	*
	* @param \integer $id
	* @return Encadrant
	**/
	public function findEncadrantById($id)
	{

		
		$encadrant = $this->repository->findOneById($id);

		if (!$encadrant) {
			return null;
		}
		else
			return $encadrant;
	}
	
	/**
	* get EncadrantByNom
	*
	* @param string $nom
	* @return Encadrants
	**/
	public function findEncadrantByNom($nom)
	{

		$encadrants = $this->repository->findByNom($nom);

		if (!$encadrants) {
			return null;
		}
		else
			return $encadrants;
	}
	
	/**
	* get EncadrantByNomUsage
	*
	* @param string $NomUsage
	* @return Encadrants
	**/
	public function findEncadrantByNomUsage($nomUsage)
	{
		$encadrants = $this->repository->findByNomUsage($nomUsage)

		if (!$encadrants) {
			return null;
		}
		else
			return $encadrants;
	}
	
	/**
	* get EncadrantByCivilite
	*
	* @param string $civilite
	* @return Encadrants
	**/
	public function findEncadrantByCivilite($civilite)
	{

		$encadrants = $this->repository->findByCivilite($civilite);

		if (!$encadrants) {
			return null;
		}
		else
			return $encadrants;
	}
	
	/**
	* get EncadrantByPrenom
	*
	* @param string $prenom
	* @return Encadrants
	**/
	public function findEncadrantByPrenom($prenom)
	{
		$encadrants = $this->repository->findByPrenom($prenom);

		if (!$encadrants) {
			return null;
		}
		else
			return $encadrants;
	}
	
	/**
	* get EncadrantByAdresse
	*
	* @param string $adresse
	* @return Encadrants
	**/
	public function findEncadrantByAdresse($adresse)
	{

		$encadrants = $this->repository->findByAdresse($adresse);

		if (!$encadrants) {
			return null;
		}
		else
			return $encadrants;
	}
	
	/**
	* get EncadrantByMail
	*
	* @param string $mail
	* @return Encadrants
	**/
	public function findEncadrantByMail($mail)
	{

		$encadrants = $this->repository->findByMail($mail);

		if (!$encadrants) {
			return null;
		}
		else
			return $encadrants;
	}
	
	/**
	* get EncadrantByDateDeNaissance
	*
	* @param \datetime $dateDeNaissance
	* @return Encadrants
	**/
	public function findEncadrantByDateDeNaissance($dateDeNaissance)
	{

		$encadrants = $this->repository->findByDateDeNaissance($dateDeNaissance);

		if (!$encadrants) {
			return null;
		}
		else
			return $encadrants;
	}
	
	/**
	* get EncadrantByNationalite
	*
	* @param string $nationalite
	* @return Encadrants
	**/
	public function findEncadrantByNationalite($nationalite)
	{

		$encadrants = $this->repository->findByNationalite($nationalite);

		if (!$encadrants) {
			return null;
		}
		else
			return $encadrants;
	}
	
	/**
	* get EncadrantByVilleDeNaissance
	*
	* @param string $villeDeNaissance
	* @return Encadrants
	**/
	public function findEncadrantByVilleDeNaissance($villeDeNaissance)
	{

		$encadrants = $this->repository->findByVilleDeNaissance($villeDeNaissance);

		if (!$encadrants) {
			return null;
		}
		else
			return $encadrants;
	}
	
	/**
	* get EncadrantByPaysDeNaissance
	*
	* @param string $paysDeNaissance
	* @return Encadrants
	**/
	public function findEncadrantByPaysDeNaissance($paysDeNaissance)
	{

		$encadrants = $this->repository->findByPaysDeNaissance($paysDeNaissance);

		if (!$encadrants) {
			return null;
		}
		else
			return $encadrants;
	}
	
	/**
	* get EncadrantByDepDeNaissance
	*
	* @param \integer $depDeNaissance
	* @return Encadrants
	**/
	public function findEncadrantByDepDeNaissance($depDeNaissance)
	{

		$encadrants = $this->repository->findByDepDeNaissance($depDeNaissance);

		if (!$encadrants) {
			return null;
		}
		else
			return $encadrants;
	}
	
	/**
	* get EncadrantByNomEtPrenom
	*
	* @param string $prenom
	* @param string $nom
	* @return Encadrants
	**/
	public function findEncadrantByNomEtPrenom($prenom, $nom)
	{

		$encadrant = $this->em->getConnection()->prepare('SELECT *	FROM Encadrant e WHERE e.prenom = "'.$prenom.'" AND e.nom = "'.$nom.'";')->execute();

		if (!$encadrant) {
			return null;
		}
		else
			return $encadrant;
	}
	
	/**
	* get tous les Encadrants
	*
	* @return Encadrants
	**/
	public function findAll()
	{

		$encadrants = $this->repository->findAll();

		if (!$encadrants) {
			return null;
		}
		else
			return $encadrants;
	}
	
	/**
	* set NomEncadrant
	*
	* @param \integer $id
	* @param string $nouveauNom
	* @return Encadrant
	**/
	public function updateNom($id,$nouveauNom)
	{
	
		$encadrant = $this->repository->findOneById($id);

		if (!$encadrant) {
			return null;
		}
		else
		{
			$encadrant->setNom($nouveauNom);
			$this->em->flush();

			return $encadrant;
		}
	}
	
	/**
	* set NomUsageEncadrant
	*
	* @param \integer $id
	* @param string $nouveauNomUsage
	* @return Encadrant
	**/
	public function updateNomUsage($id,$nouveauNomUsage)
	{
	
		$encadrant = $this->repository->findOneById($id);

		if (!$encadrant) {
			return null;
		}
		else
		{
			$encadrant->setNomUsage($nouveauNomUsage);
			$this->em->flush();

			return $encadrant;
		}
	}
	
	/**
	* set CiviliteEncadrant
	*
	* @param \integer $id
	* @param string $nouveauCivilite
	* @return Encadrant
	**/
	public function updateCivilite($id,$nouveauCivilite)
	{
	
		$encadrant = $this->repository->findOneById($id);

		if (!$encadrant) {
			return null;
		}
		else
		{
			$encadrant->setCivilite($nouveauCivilite);
			$this->em->flush();

			return $encadrant;
		}
	}
	
	/**
	* set PrenomEncadrant
	*
	* @param \integer $id
	* @param string $nouveauPrenom
	* @return Encadrant
	**/
	public function updatePrenom($id,$nouveauPrenom)
	{
	
		$encadrant = $this->repository->findOneById($id);

		if (!$encadrant) {
			return null;
		}
		else
		{
			$encadrant->setPrenom($nouveauPrenom);
			$this->em->flush();

			return $encadrant;
		}
	}
	
	/**
	* set AdresseEncadrant
	*
	* @param \integer $id
	* @param string $nouveauAdresse
	* @return Encadrant
	**/
	public function updateAdresse($id,$nouveauAdresse)
	{
	
		$encadrant = $this->repository->findOneById($id);

		if (!$encadrant) {
			return null;
		}
		else
		{
			$encadrant->setAdresse($nouveauAdresse);
			$this->em->flush();

			return $encadrant;
		}
	}
	
	/**
	* set MailEncadrant
	*
	* @param \integer $id
	* @param string $nouveauMail
	* @return Encadrant
	**/
	public function updateMail($id,$nouveauMail)
	{
	
		$encadrant = $this->repository->findOneById($id);

		if (!$encadrant) {
			return null;
		}
		else
		{
			$encadrant->setMail($nouveauMail);
			$this->em->flush();

			return $encadrant;
		}
	}
	
	/**
	* set DateDeNaissanceEncadrant
	*
	* @param \integer $id
	* @param \datetime $nouveauDateDeNaissance
	* @return Encadrant
	**/
	public function updateDateDeNaissance($id,$nouveauDateDeNaissance)
	{
	
		$encadrant = $this->repository->findOneById($id);

		if (!$encadrant) {
			return null;
		}
		else
		{
			$encadrant->setDateDeNaissance($nouveauDateDeNaissance);
			$this->em->flush();

			return $encadrant;
		}
	}
	
	/**
	* set NationaliteEncadrant
	*
	* @param \integer $id
	* @param string $nouveauNationalite
	* @return Encadrant
	**/
	public function updateNationalite($id,$nouveauNationalite)
	{
	
		$encadrant = $this->repository->findOneById($id);

		if (!$encadrant) {
			return null;
		}
		else
		{
			$encadrant->setNationalite($nouveauNationalite);
			$this->em->flush();

			return $encadrant;
		}
	}
	
	/**
	* set VilleDeNaissanceEncadrant
	*
	* @param \integer $id
	* @param string $nouveauVilleDeNaissance
	* @return Encadrant
	**/
	public function updateVilleDeNaissance($id,$nouveauVilleDeNaissance)
	{
	
		$encadrant = $this->repository->findOneById($id);

		if (!$encadrant) {
			return null;
		}
		else
		{
			$encadrant->setVilleDeNaissance($nouveauVilleDeNaissance);
			$this->em->flush();

			return $encadrant;
		}
	}
	
	/**
	* set PaysDeNaissanceEncadrant
	*
	* @param \integer $id
	* @param string $nouveauPaysDeNaissance
	* @return Encadrant
	**/
	public function updatePaysDeNaissance($id,$nouveauPaysDeNaissance)
	{
	
		$encadrant = $this->repository->findOneById($id);

		if (!$encadrant) {
			return null;
		}
		else
		{
			$encadrant->setPaysDeNaissance($nouveauPaysDeNaissance);
			$this->em->flush();

			return $encadrant;
		}
	}
	/**
	* set DepDeNaissanceEncadrant
	*
	* @param \integer $id
	* @param \integer $nouveauDepDeNaissance
	* @return Encadrant
	**/
	public function updateDepDeNaissance($id,$nouveauDepDeNaissance)
	{
	
		$encadrant = $this->repository->findOneById($id);

		if (!$encadrant) {
			return null;
		}
		else
		{
			$encadrant->setDepDeNaissance($nouveauDepDeNaissance);
			$this->em->flush();

			return $encadrant;
		}
	}
	
	/**
	* delete Encadrant
	*
	* @param Encadrant $id
	* @return True
	**/
	public function delete($id)
	{

		$encadrant = $this->repository->findOneById($id);

		if (!$encadrant) {
			return null;
		}
		else
		{
			$this->em->remove($encadrant);
			$this->em->flush();

			return True;
		}
	}
}

	


