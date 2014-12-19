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
	* @param createEncadrant $nom, $nomUsage, $civilite, $prenom, $adresse, $mail,
	$dateDeNaissance, $nationalite, $villeDeNaissance, $paysDeNaissance, $depDeNaissance
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
	* @param EncadrantById $id
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
	* @param EncadrantByNom $nom
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
	* @param EncadrantByNomUsage $NomUsage
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
	* @param EncadrantByCivilite $civilite
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
	* @param EncadrantByPrenom $prenom
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
	* @param EncadrantByAdresse $adresse
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
	* @param EncadrantByMail $mail
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
	* @param EncadrantByDateDeNaissance $dateDeNaissance
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
	* @param EncadrantByNationalite $nationalite
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
	* @param EncadrantByVilleDeNaissance $villeDeNaissance
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
	* @param EncadrantByPaysDeNaissance $paysDeNaissance
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
	* @param EncadrantByDepDeNaissance $depDeNaissance
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
	* @param EncadrantByNomEtPrenom $prenom, $nom
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
	* get Encadrants
	*
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
	* @param NomEncadrant $id, $nouveauNom
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
	* @param NomUsageEncadrant $id, $nouveauNomUsage
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
	* @param CiviliteEncadrant $id, $nouveauCivilite
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
	* @param PrenomEncadrant $id, $nouveauPrenom
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
	* @param AdresseEncadrant $id, $nouveauAdresse
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
	* @param MailEncadrant $id, $nouveauMail
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
	* @param DateDeNaissanceEncadrant $id, $nouveauDateDeNaissance
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
	* @param NationaliteEncadrant $id, $nouveauNationalite
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
	* @param VilleDeNaissanceEncadrant $id, $nouveauVilleDeNaissance
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
	* @param PaysDeNaissanceEncadrant $id, $nouveauPaysDeNaissance
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
	* @param DepDeNaissanceEncadrant $id, $nouveauDepDeNaissance
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
	* set Encadrant
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

	


