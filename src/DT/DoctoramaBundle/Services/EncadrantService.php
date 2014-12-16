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

		
		$encadrant = $this->repository->findOneById($id);

		if (!$encadrant) {
			return null;
		}
		else
			return $encadrant;
	}
	
	public function findEncadrantByNom($nom)
	{

		$encadrant = $this->repository->findByNom($nom);

		if (!$encadrant) {
			return null;
		}
		else
			return $encadrant;
	}
	
	public function findEncadrantByNomUsage($nomUsage)
	{
		$encadrant = $this->repository->findByNomUsage($nomUsage);

		if (!$encadrant) {
			return null;
		}
		else
			return $encadrant;
	}
		
	public function findEncadrantByCivilite($civilite)
	{

		$encadrant = $this->repository->findByCivilite($civilite);

		if (!$encadrant) {
			return null;
		}
		else
			return $encadrant;
	}
	
	public function findEncadrantByPrenom($prenom)
	{
		$encadrant = $this->repository->findByPrenom($prenom);

		if (!$encadrant) {
			return null;
		}
		else
			return $encadrant;
	}
		
	public function findEncadrantByAdresse($adresse)
	{

		$encadrant = $this->repository->findByAdresse($adresse);

		if (!$encadrant) {
			return null;
		}
		else
			return $encadrant;
	}
	
	public function findEncadrantByMail($mail)
	{

		$encadrant = $this->repository->findByMail($mail);

		if (!$encadrant) {
			return null;
		}
		else
			return $encadrant;
	}
	
	public function findEncadrantByDateDeNaissance($dateDeNaissance)
	{

		$encadrant = $this->repository->findByDateDeNaissance($dateDeNaissance);

		if (!$encadrant) {
			return null;
		}
		else
			return $encadrant;
	}
	
	public function findEncadrantByNationalite($nationalite)
	{

		$encadrant = $this->repository->findByNationalite($nationalite);

		if (!$encadrant) {
			return null;
		}
		else
			return $encadrant;
	}
	
	public function findEncadrantByVilleDeNaissance($villeDeNaissance)
	{

		$encadrant = $this->repository->findByVilleDeNaissance($villeDeNaissance);

		if (!$encadrant) {
			return null;
		}
		else
			return $encadrant;
	}
	
	public function findEncadrantByPaysDeNaissance($paysDeNaissance)
	{

		$encadrant = $this->repository->findByPaysDeNaissance($paysDeNaissance);

		if (!$encadrant) {
			return null;
		}
		else
			return $encadrant;
	}
	
	public function findEncadrantByDepDeNaissance($depDeNaissance)
	{

		$encadrant = $this->repository->findByDepDeNaissance($depDeNaissance);

		if (!$encadrant) {
			return null;
		}
		else
			return $encadrant;
	}
	
	public function findEncadrantByNomEtPrenom($prenom, $nom)
	{

		$encadrant = $this->em->getConnection()->prepare('SELECT *	FROM Encadrant e WHERE e.prenom = "'.$prenom.'" AND e.nom = "'.$nom.'";')->execute();

		if (!$encadrant) {
			return null;
		}
		else
			return $encadrant;
	}
	
	public function findAll()
	{

		$encadrant = $this->repository->findAll();

		if (!$encadrant) {
			return null;
		}
		else
			return $encadrant;
	}
	
	
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

	


