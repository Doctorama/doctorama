<?php
namespace DT\DoctoramaBundle\Services;
//DoctorantService
use DT\DoctoramaBundle\Entity\Doctorant;

class DoctorantService
{
	private $em;
	
	private $repository;
	
	public function __construct($em)
	{
		$this->em = $em;
		$this->repository = $this->em->getRepository('DTDoctoramaBundle:Doctorant');
	}
	/**
	* Set Doctorant
	*
	* @param createDoctorant $nom, $nomUsage, $civilite, $prenom, $adresse, $mail,
	$dateDeNaissance, $nationalite, $villeDeNaissance, $paysDeNaissance, $depDeNaissance,
	$numEtudiant, $bourseEtExoneration, $dateInscr1eThese, $dcace, $nomFormationMaster,
	$universiteMaster, $sujetMaster, $laboratoireAccueilMaster, $encadrantsMaster, $etabDernierDiplome,
	$depDernierDiplome, $paysDernierDiplome, $libelleDernierDiplome, $anneeDernierDiplome
	*
	* @return Doctorant
	**/
	public function createDoctorant($nom, $nomUsage, $civilite, $prenom, $adresse, $mail,
	$dateDeNaissance, $nationalite, $villeDeNaissance, $paysDeNaissance, $depDeNaissance,
	$numEtudiant, $bourseEtExoneration, $dateInscr1eThese, $dcace, $nomFormationMaster,
	$universiteMaster, $sujetMaster, $laboratoireAccueilMaster, $encadrantsMaster, $etabDernierDiplome,
	$depDernierDiplome, $paysDernierDiplome, $libelleDernierDiplome, $anneeDernierDiplome)
	{
		$doctorant = new Doctorant();
		$doctorant->setNom($nom);
		$doctorant->setNomUsage($nomUsage);
		$doctorant->setCivilite($civilite);
		$doctorant->setPrenom($prenom);
		$doctorant->setAdresse($adresse);
		$doctorant->setMail($mail);
		$doctorant->setDateDeNaissance($dateDeNaissance);
		$doctorant->setNationalite($nationalite);
		$doctorant->setVilleDeNaissance($villeDeNaissance);
		$doctorant->setPaysDeNaissance($paysDeNaissance);
		$doctorant->setDepDeNaissance($depDeNaissance);
		$doctorant->setNumEtudiant($numEtudiant);
		$doctorant->setBourseEtExoneration($bourseEtExoneration);
		$doctorant->setDateInscr1eThese($dateInscr1eThese);
		$doctorant->setDcace($dcace);
		$doctorant->setNomFormationMaster($nomFormationMaster);
		$doctorant->setUniversiteMaster($universiteMaster);
		$doctorant->setSujetMaster($sujetMaster);
		$doctorant->setLaboratoireAcceuilMaster($laboratoireAccueilMaster);
		$doctorant->setEncadrantssMaster($encadrantsMaster);
		$doctorant->setEtabDernierDiplome($etabDernierDiplome);
		$doctorant->setDepDernierDiplome($depDernierDiplome);
		$doctorant->setPaysDernierDiplome($paysDernierDiplome);
		$doctorant->setLibelleDernierDiplome($libelleDernierDiplome);
		$doctorant->setAnneeDernierDiplome($anneeDernierDiplome);
		
		$this->em->persist($doctorant);
		$this->em->flush();
		return $doctorant;
	}
	/**
	* get DoctorantById
	*
	* @param DoctorantById $id
	* @return Doctorant
	**/
	public function findDoctorantById($id)
	{
    
        $doctorant = $this->repository->findOneById($id);
		if (!$doctorant) {
			return null;
		}
		else
			return $doctorant;
	}
	/**
	* get DoctorantByNom
	*
	* @param DoctorantByNom $nom
	* @return Doctorant
	**/
	public function findDoctorantByNom($nom)
	{

		$doctorants = $this->repository->findByNom($nom);

		if (!$doctorants) {
			return null;
		}
		else
			return $doctorants;
	}
	/**
	* get DoctorantByNomUsage
	*
	* @param DoctorantByNomUsage $nomUsage
	* @return Doctorant
	**/
	public function findDoctorantByNomUsage($nomUsage)
	{

		$doctorants = $this->repository->findByNomUsage($nomUsage);

		if (!$doctorants) {
			return null;
		}
		else
			return $doctorants;
	}
	/**
	* get DoctorantByCivilite
	*
	* @param DoctorantByCivilite $civilite
	* @return Doctorant
	**/
	public function findDoctorantByCivilite($civilite)
	{

		$doctorants = $this->repository->findByCivilite($civilite);

		if (!$doctorants) {
			return null;
		}
		else
			return $doctorants;
	}
	/**
	* get DoctorantByPrenom
	*
	* @param DoctorantByPrenom $prenom
	* @return Doctorant
	**/
	public function findDoctorantByPrenom($prenom)
	{

		$doctorants = $this->repository->findByPrenom($prenom);

		if (!$doctorants) {
			return null;
		}
		else
			return $doctorants;
	}
	/**
	* get DoctorantByAdresse
	*
	* @param DoctorantByAdresse $adresse
	* @return Doctorant
	**/
	public function findDoctorantByAdresse($adresse)
	{

		$doctorants = $this->repository->findByAdresse($adresse);

		if (!$doctorants) {
			return null;
		}
		else
			return $doctorants;
	}
	/**
	* get DoctorantByMail
	*
	* @param DoctorantByMail $mail
	* @return Doctorant
	**/
	public function findDoctorantByMail($mail)
	{

		$doctorants = $this->repository->findByMail($mail);

		if (!$doctorants) {
			return null;
		}
		else
			return $doctorants;
	}
	/**
	* get DoctorantByDateDeNaissance
	*
	* @param DoctorantByDateDeNaissance $dateDeNaissance
	* @return Doctorant
	**/
	public function findDoctorantByDateDeNaissance($dateDeNaissance)
	{

		$doctorants = $this->repository->findByDateDeNaissance($dateDeNaissance);

		if (!$doctorants) {
			return null;
		}
		else
			return $doctorants;
	}
	/**
	* get DoctorantByNationalite
	*
	* @param DoctorantByNationalite $nationalite
	* @return Doctorant
	**/
	public function findDoctorantByNationalite($nationalite)
	{

		$doctorants = $this->repository->findByNationalite($nationalite);

		if (!$doctorants) {
			return null;
		}
		else
			return $doctorants;
	}
	/**
	* get DoctorantByVilleDeNaissance
	*
	* @param DoctorantByVilleDeNaissance $villeDeNaissance
	* @return Doctorant
	**/
	public function findDoctorantByVilleDeNaissance($villeDeNaissance)
	{

		$doctorants = $this->repository->findByVilleDeNaissance($villeDeNaissance);

		if (!$doctorants) {
			return null;
		}
		else
			return $doctorants;
	}
	/**
	* get DoctorantByPaysDeNaissance
	*
	* @param DoctorantByPaysDeNaissance $paysDeNaissance
	* @return Doctorant
	**/
	public function findDoctorantByPaysDeNaissance($paysDeNaissance)
	{

		$doctorants = $this->repository->findByPaysDeNaissance($paysDeNaissance);

		if (!$doctorants) {
			return null;
		}
		else
			return $doctorants;
	}
	/**
	* get DoctorantByDepDeNaissance
	*
	* @param DoctorantByDepDeNaissance $depDeNaissance
	* @return Doctorant
	**/
	public function findDoctorantByDepDeNaissance($depDeNaissance)
	{

		$doctorants = $this->repository->findByDepDeNaissance($depDeNaissance);

		if (!$doctorants) {
			return null;
		}
		else
			return $doctorants;
	}
	/**
	* get DoctorantByNumEtudiant
	*
	* @param DoctorantByNumEtudiant $numEtudiant
	* @return Doctorant
	**/
	public function findDoctorantByNumEtudiant($numEtudiant)
	{

		$doctorant = $this->repository->findByNumEtudiant($numEtudiant);

		if (!$doctorant) {
			return null;
		}
		else
			return $doctorant;
	}
	/**
	* get DoctorantByBourseEtExoneration
	*
	* @param DoctorantByBourseEtExoneration $bourseEtExoneration
	* @return Doctorant
	**/
	public function findDoctorantByBourseEtExoneration($bourseEtExo)
	{

		$doctorants = $this->repository->findByBourseEtExoneration($bourseEtExo);

		if (!$doctorants) {
			return null;
		}
		else
			return $doctorants;
	}
	/**
	* get DoctorantByDateInscr1eThese
	*
	* @param DoctorantByDateInscr1eThese $dateInscr1eThese
	* @return Doctorant
	**/
	public function findDoctorantByDateInscr1eThese($dateInscr1eThese)
	{

		$doctorants = $this->repository->findByDateInscr1eThese($dateInscr1eThese);

		if (!$doctorants) {
			return null;
		}
		else
			return $doctorants;
	}
	/**
	* get DoctorantByDcace
	*
	* @param DoctorantByDcace $dcace
	* @return Doctorant
	**/
	public function findDoctorantByDcace($dcace)
	{

		$doctorants = $this->repository->findByDcace($dcace);

		if (!$doctorants) {
			return null;
		}
		else
			return $doctorants;
	}
	/**
	* get DoctorantByNomFormationMaster
	*
	* @param DoctorantByNomFormationMaster $nomFormationMaster
	* @return Doctorant
	**/
	public function findDoctorantByNomFormationMaster($nomFormationMaster)
	{

		$doctorants = $this->repository->findByNomFormationMaster($nomFormationMaster);

		if (!$doctorants) {
			return null;
		}
		else
			return $doctorants;
	}
	/**
	* get DoctorantByUniversiteMaster
	*
	* @param DoctorantByUniversiteMaster $universiteMaster
	* @return Doctorant
	**/
	public function findDoctorantByUniversiteMaster($numEtudiant)
	{

		$doctorants = $this->repository->findByUniversiteMaster($numEtudiant);

		if (!$doctorants) {
			return null;
		}
		else
			return $doctorants;
	}
	/**
	* get DoctorantBySujetMaster
	*
	* @param DoctorantBySujetMaster $sujetMaster
	* @return Doctorant
	**/
	public function findDoctorantBySujetMaster($numEtudiant)
	{

		$doctorants = $this->repository->findBySujetMaster($numEtudiant);

		if (!$doctorants) {
			return null;
		}
		else
			return $doctorants;
	}
	/**
	* get DoctorantByLaboratoireAcceuilMaster
	*
	* @param DoctorantByLaboratoireAcceuilMaster $laboratoireAcceuilMaster
	* @return Doctorant
	**/
	public function findDoctorantByLaboratoireAcceuilMaster($numEtudiant)
	{

		$doctorants = $this->repository->findByLaboratoireAcceuilMaster($numEtudiant);

		if (!$doctorants) {
			return null;
		}
		else
			return $doctorants;
	}
	/**
	* get DoctorantByEncadrantsMaster
	*
	* @param DoctorantByEncadrantsMaster $encadrantsMaster
	* @return Doctorant
	**/
	public function findDoctorantByEncadrantsMaster($numEtudiant)
	{

		$doctorants = $this->repository->findByEncadrantsMaster($numEtudiant);

		if (!$doctorants) {
			return null;
		}
		else
			return $doctorants;
	}
	/**
	* get DoctorantByEtabDernierDiplome
	*
	* @param DoctorantByEtabDernierDiplome $etabDernierDiplome
	* @return Doctorant
	**/
	public function findDoctorantByEtabDernierDiplome($numEtudiant)
	{

		$doctorants = $this->repository->findByEtabDernierDiplome($numEtudiant);

		if (!$doctorants) {
			return null;
		}
		else
			return $doctorants;
	}
	/**
	* get DoctorantByPaysDernierDiplome
	*
	* @param DoctorantByPaysDernierDiplome $paysDernierDiplome
	* @return Doctorant
	**/
	public function findDoctorantByPaysDernierDiplome($numEtudiant)
	{

		$doctorants = $this->repository->findByPaysDernierDiplome($numEtudiant);

		if (!$doctorants) {
			return null;
		}
		else
			return $doctorants;
	}
	/**
	* get DoctorantByLibelleDernierDiplome
	*
	* @param DoctorantByLibelleDernierDiplome $libelleDernierDiplome
	* @return Doctorant
	**/
	public function findDoctorantByLibelleDernierDiplome($numEtudiant)
	{

		$doctorants = $this->repository->findByLibelleDernierDiplome($numEtudiant);

		if (!$doctorants) {
			return null;
		}
		else
			return $doctorants;
	}
	/**
	* get DoctorantByAnneeDernierDiplome
	*
	* @param DoctorantByAnneeDernierDiplome $anneeDernierDiplome
	* @return Doctorant
	**/
	public function findDoctorantByAnneeDernierDiplome($numEtudiant)
	{

		$doctorants = $this->repository->findByAnneeDernierDiplome($numEtudiant);

		if (!$doctorants) {
			return null;
		}
		else
			return $doctorants;
	}
	/**
	* get DoctorantByDepDernierDiplome
	*
	* @param DoctorantByDepDernierDiplome $depDernierDiplome
	* @return Doctorant
	**/
	public function findDoctorantByDepDernierDiplome($numEtudiant)
	{

		$doctorants = $this->repository->findByDepDernierDiplome($numEtudiant);

		if (!$doctorants) {
			return null;
		}
		else
			return $doctorants;
	}
	/**
	* get DoctorantByNomEtPrenom
	*
	* @param DoctorantByNomEtPrenom $prenom, $nom
	* @return Doctorant
	**/
	public function findDoctorantByNomEtPrenom($prenom, $nom)
	{
    
		$query = $this->em->getConnection()->prepare('SELECT *	FROM Doctorant d WHERE d.prenom = "'.$prenom.'" AND d.nom = "'.$nom.'";')->execute();

		$doctorant = $query->getResult();

		if (!$doctorant) {
			return null;
		}
		else
			return $doctorant;
	}
	/**
	* get Doctorants
	*
	* 
	* @return Doctorants
	**/
	public function findAll()
	{

		$doctorants = $this->repository->findAll();

		if (!$doctorants) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé'
			);
						}
		else
			return $doctorants;
	}
	/**
	* set NomDoctorant
	*
	* @param NomDoctorant $id, $nouveauNom
	* @return Doctorant
	**/
	public function updateNom($id,$nouveauNom)
	{
	
		
		$doctorant = $this->repository->findOneById($id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$doctorant->setNom($nouveauNom);
		$this->em->flush();

		return $doctorant;
	}
	/**
	* set NomUsageDoctorant
	*
	* @param NomUsageDoctorant $id, $nouveauNomUsage
	* @return Doctorant
	**/
	public function updateNomUsage($id,$nouveauNomUsage)
	{
	
		$doctorant = $this->repository->findOneById($id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$doctorant->setNomUsage($nouveauNomUsage);
		$this->em->flush();

		return $doctorant;
	}
	/**
	* set CiviliteDoctorant
	*
	* @param CiviliteDoctorant $id, $nouveauCivilite
	* @return Doctorant
	**/
	public function updateCivilite($id,$nouveauCivilite)
	{

		$doctorant = $this->repository->findOneById($id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$doctorant->setCivilite($nouveauCivilite);
		$this->em->flush();

		return $doctorant;
	}
	/**
	* set PrenomDoctorant
	*
	* @param PrenomDoctorant $id, $nouveauPrenom
	* @return Doctorant
	**/
	public function updatePrenom($id,$nouveauPrenom)
	{
	
		$doctorant = $this->repository->findOneById($id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$doctorant->setPrenom($nouveauPrenom);
		$this->em->flush();

		return $doctorant;
	}
	/**
	* set AdresseDoctorant
	*
	* @param AdresseDoctorant $id, $nouveauAdresse
	* @return Doctorant
	**/
	public function updateAdresse($id,$nouveauAdresse)
	{

		$doctorant = $this->repository->findOneById($id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$doctorant->setAdresse($nouveauAdresse);
		$this->em->flush();

		return $doctorant;
	}
	/**
	* set MailDoctorant
	*
	* @param MailDoctorant $id, $nouveauMail
	* @return Doctorant
	**/
	public function updateMail($id,$nouveauMail)
	{

		$doctorant = $this->repository->findOneById($id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$doctorant->setMail($nouveauMail);
		$this->em->flush();

		return $doctorant;
	}
	/**
	* set DateDeNaissanceDoctorant
	*
	* @param DateDeNaissanceDoctorant $id, $nouveauDateDeNaissance
	* @return Doctorant
	**/
	public function updateDateDeNaissance($id,$nouveauDateDeNaissance)
	{

		$doctorant = $this->repository->findOneById($id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$doctorant->setDateDeNaissance($nouveauDateDeNaissance);
		$this->em->flush();

		return $doctorant;
	}
	/**
	* set Nationalitedoctorant
	*
	* @param Nationalitedoctorant $id, $nouveauNationalite
	* @return doctorant
	**/
	public function updateNationalite($id,$nouveauNationalite)
	{
	
		$doctorant = $this->repository->findOneById($id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$doctorant->setNationalite($nouveauNationalite);
		$this->em->flush();

		return $doctorant;
	}
	/**
	* set VilleDeNaissancedoctorant
	*
	* @param VilleDeNaissancedoctorant $id, $VilleDeNaissance
	* @return doctorant
	**/
	public function updateVilleDeNaissance($id,$nouveauVilleDeNaissance)
	{
	
		$doctorant = $this->repository->findOneById($id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$doctorant->setVilleDeNaissance($nouveauVilleDeNaissance);
		$this->em->flush();

		return $doctorant;
	}
	/**
	* set PaysDeNaissancedoctorant
	*
	* @param PaysDeNaissancedoctorant $id, $nouveauPaysDeNaissance
	* @return doctorant
	**/
	public function updatePaysDeNaissance($id,$nouveauPaysDeNaissance)
	{
	
		$doctorant = $this->repository->findOneById($id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$doctorant->setPaysDeNaissance($nouveauPaysDeNaissance);
		$this->em->flush();

		return $doctorant;
	}
	/**
	* set DepDeNaissancedoctorant
	*
	* @param DepDeNaissancedoctorant $id, $nouveauDepDeNaissance
	* @return doctorant
	**/
	public function updateDepDeNaissance($id,$nouveauDepDeNaissance)
	{
	
		$doctorant = $this->repository->findOneById($id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$doctorant->setDepDeNaissance($nouveauDepDeNaissance);
		$this->em->flush();

		return $doctorant;
	}
	/**
	* set NumEtudiantdoctorant
	*
	* @param NumEtudiantdoctorant $id, $nouveauNumEtudiant
	* @return doctorant
	**/
	public function updateNumEtudiant($id,$nouveauNumEtudiant)
	{
	
		$doctorant = $this->repository->findOneById($id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$doctorant->setNumEtudiant($nouveauNumEtudiant);
		$this->em->flush();

		return $doctorant;
	}
	/**
	* set BourseEtExonerationdoctorant
	*
	* @param BourseEtExonerationdoctorant $id, $nouveauBourseEtExoneration
	* @return doctorant
	**/
	public function updateBourseEtExoneration($id,$nouveauBourseEtExoneration)
	{
	
		$doctorant = $this->repository->findOneById($id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$doctorant->setBourseEtExoneration($nouveauBourseEtExoneration);
		$this->em->flush();

		return $doctorant;
	}
	/**
	* set DateInscr1eThesedoctorant
	*
	* @param DateInscr1eThesedoctorant $id, $nouveauDateInscr1eThese
	* @return doctorant
	**/
	public function updateDateInscr1eThese($id,$nouveauDateInscr1eThese)
	{
	
		$doctorant = $this->repository->findOneById($id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$doctorant->setDateInscr1eThese($nouveauDateInscr1eThese);
		$this->em->flush();

		return $doctorant;
	}
	/**
	* set Dcacedoctorant
	*
	* @param Dcacedoctorant $id, $nouveauDcace
	* @return doctorant
	**/
	public function updateDcace($id,$nouveauDcace)
	{
	
		$doctorant = $this->repository->findOneById($id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$doctorant->setDcace($nouveauDcace);
		$this->em->flush();

		return $doctorant;
	}
	/**
	* set NomFormationMasterdoctorant
	*
	* @param NomFormationMasterdoctorant $id, $nouveauNomFormationMaster
	* @return doctorant
	**/
	public function updateNomFormationMaster($id,$nouveauNomFormationMaster)
	{
	
		$doctorant = $this->repository->findOneById($id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$doctorant->setNomFormationMaster($nouveauNomFormationMaster);
		$this->em->flush();

		return $doctorant;
	}
	/**
	* set UniversiteMasterdoctorant
	*
	* @param UniversiteMasterdoctorant $id, $nouveauUniversiteMaster
	* @return doctorant
	**/
	public function updateUniversiteMaster($id,$nouveauUniversiteMaster)
	{
	
		$doctorant = $this->repository->findOneById($id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$doctorant->setUniversiteMaster($nouveauUniversiteMaster);
		$this->em->flush();

		return $doctorant;
	}
	/**
	* set SujetMasterdoctorant
	*
	* @param SujetMasterdoctorant $id, $nouveauSujetMaster
	* @return doctorant
	**/
	public function updateSujetMaster($id,$nouveauSujetMaster)
	{
	
		$doctorant = $this->repository->findOneById($id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$doctorant->setSujetMaster($nouveauSujetMaster);
		$this->em->flush();

		return $doctorant;
	}
	/**
	* set LaboratoireAccueilMasterdoctorant
	*
	* @param LaboratoireAccueilMasterdoctorant $id, $nouveauLaboratoireAccueilMaster
	* @return doctorant
	**/
	public function updateLaboratoireAccueilMaster($id,$nouveauLaboratoireAccueilMaster)
	{
	
		$doctorant = $this->repository->findOneById($id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$doctorant->setLaboratoireAcceuilMaster($nouveauLaboratoireAccueilMaster);
		$this->em->flush();

		return $doctorant;
	}
	/**
	* set EncadrantsMasterdoctorant
	*
	* @param EncadrantsMasterdoctorant $id, $nouveauEncadrantsMaster
	* @return doctorant
	**/
	public function updateEncadrantsMaster($id,$nouveauEncadrantsMaster)
	{
	
		$doctorant = $this->repository->findOneById($id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$doctorant->setEncadrantssMaster($nouveauEncadrantsMaster);
		$this->em->flush();

		return $doctorant;
	}
	/**
	* set EtabDernierDiplomedoctorant
	*
	* @param EtabDernierDiplomedoctorant $id, $nouveauEtabDernierDiplome
	* @return doctorant
	**/
	public function updateEtabDernierDiplome($id,$nouveauEtabDernierDiplome)
	{
	
		$doctorant = $this->repository->findOneById($id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$doctorant->setEtabDernierDiplome($nouveauEtabDernierDiplome);
		$this->em->flush();

		return $doctorant;
	}
	/**
	* set DepDernierDiplomedoctorant
	*
	* @param DepDernierDiplomedoctorant $id, $nouveauDepDernierDiplome
	* @return doctorant
	**/
	public function updateDepDernierDiplome($id,$nouveauDepDernierDiplome)
	{
	
		$doctorant = $this->repository->findOneById($id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$doctorant->setDepDernierDiplome($nouveauDepDernierDiplome);
		$this->em->flush();

		return $doctorant;
	}
	/**
	* set PaysDernierDiplomedoctorant
	*
	* @param PaysDernierDiplomedoctorant $id, $nouveauPaysDernierDiplome
	* @return doctorant
	**/
	public function updatePaysDernierDiplome($id,$nouveauPaysDernierDiplome)
	{
	
		$doctorant = $this->repository->findOneById($id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$doctorant->setPaysDernierDiplome($nouveauPaysDernierDiplome);
		$this->em->flush();

		return $doctorant;
	}
	/**
	* set LibelleDernierDiplomedoctorant
	*
	* @param LibelleDernierDiplomedoctorant $id, $nouveauLibelleDernierDiplome
	* @return doctorant
	**/
	public function updateLibelleDernierDiplome($id,$nouveauLibelleDernierDiplome)
	{
	
		$doctorant = $this->repository->findOneById($id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$doctorant->setLibelleDernierDiplome($nouveauLibelleDernierDiplome);
		$this->em->flush();

		return $doctorant;
	}
	/**
	* set AnneeDernierDiplomedoctorant
	*
	* @param AnneeDernierDiplomedoctorant $id, $nouveauAnneeDernierDiplome
	* @return doctorant
	**/
	public function updateAnneeDernierDiplome($id,$nouveauAnneeDernierDiplome)
	{
	
		$doctorant = $this->repository->findOneById($id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$doctorant->setAnneeDernierDiplome($nouveauAnneeDernierDiplome);
		$this->em->flush();

		return $doctorant;
	}
	/**
	* set Doctorant
	*
	* @param Nomdoctorant $id
	* @return True
	**/
	public function delete($id)
	{
	
		$doctorant = $this->repository->findOneById($id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id : '.$id
			);
		}

		$this->em->remove($doctorant);
		$this->em->flush();

		return True;
	}
}

	


