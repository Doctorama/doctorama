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
	
	public function createDoctorant($nom, $nomUsage, $civilite, $prenom, $adresse, $mail,
	$dateDeNaissance, $nationalite, $villeDeNaissance, $paysDeNaissance, $depDeNaissance,
	$numEtudiant, $bourseEtExoneration, $dateInscr1eThese, $dcace, $nomFormationMaster,
	$universiteMaster, $sujetMaster, $laboratoireAccueilMaster, $encadrantMaster, $etabDernierDiplome,
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
		$doctorant->setEncadrantsMaster($encadrantMaster);
		$doctorant->setEtabDernierDiplome($etabDernierDiplome);
		$doctorant->setDepDernierDiplome($depDernierDiplome);
		$doctorant->setPaysDernierDiplome($paysDernierDiplome);
		$doctorant->setLibelleDernierDiplome($libelleDernierDiplome);
		$doctorant->setAnneeDernierDiplome($anneeDernierDiplome);
		
		$this->em->persist($doctorant);
		$this->em->flush();
		return $doctorant;
	}
	
	public function findDoctorantById($id)
	{
    
        $doctorant = $this->repository->findById($id);
		if (!$doctorant) {
			return null;
		}
		else
			return $doctorant;
	}
	
	public function findDoctorantByNom($nom)
	{

		$doctorant = $this->repository->findByNom($nom);

		if (!$doctorant) {
			return null;
		}
		else
			return $doctorant;
	}
	
	public function findDoctorantByNomUsage($nomUsage)
	{

		$doctorant = $this->repository->findByNomUsage($nomUsage);

		if (!$doctorant) {
			return null;
		}
		else
			return $doctorant;
	}
	
	public function findDoctorantByCivilite($civilite)
	{

		$doctorant = $this->repository->findByCivilite($civilite);

		if (!$doctorant) {
			return null;
		}
		else
			return $doctorant;
	}
	
	public function findDoctorantByPrenom($prenom)
	{

		$doctorant = $this->repository->findByPrenom($prenom);

		if (!$doctorant) {
			return null;
		}
		else
			return $doctorant;
	}
	
	public function findDoctorantByAdresse($adresse)
	{

		$doctorant = $this->repository->findByAdresse($adresse);

		if (!$doctorant) {
			return null;
		}
		else
			return $doctorant;
	}
	
	public function findDoctorantByMail($mail)
	{

		$doctorant = $this->repository->findByMail($mail);

		if (!$doctorant) {
			return null;
		}
		else
			return $doctorant;
	}
	
	public function findDoctorantByDateDeNaissance($dateDeNaissance)
	{

		$doctorant = $this->repository->findByDateDeNaissance($dateDeNaissance);

		if (!$doctorant) {
			return null;
		}
		else
			return $doctorant;
	}
	
	public function findDoctorantByNationalite($nationalite)
	{

		$doctorant = $this->repository->findByNationalite($nationalite);

		if (!$doctorant) {
			return null;
		}
		else
			return $doctorant;
	}
	
	public function findDoctorantByVilleDeNaissance($villeDeNaissance)
	{

		$doctorant = $this->repository->findByVilleDeNaissance($villeDeNaissance);

		if (!$doctorant) {
			return null;
		}
		else
			return $doctorant;
	}
	
	public function findDoctorantByPaysDeNaissance($paysDeNaissance)
	{

		$doctorant = $this->repository->findByPaysDeNaissance($paysDeNaissance);

		if (!$doctorant) {
			return null;
		}
		else
			return $doctorant;
	}
	
	public function findDoctorantByDepDeNaissance($depDeNaissance)
	{

		$doctorant = $this->repository->findByDepDeNaissance($depDeNaissance);

		if (!$doctorant) {
			return null;
		}
		else
			return $doctorant;
	}
	
	public function findDoctorantByNumEtudiant($numEtudiant)
	{

		$doctorant = $this->repository->findByNumEtudiant($numEtudiant);

		if (!$doctorant) {
			return null;
		}
		else
			return $doctorant;
	}
	
	public function findDoctorantByBourseEtExoneration($bourseEtExo)
	{

		$doctorant = $this->repository->findByBourseEtExoneration($bourseEtExo);

		if (!$doctorant) {
			return null;
		}
		else
			return $doctorant;
	}
	
	public function findDoctorantByDateInscr1eThese($dateInscr1eThese)
	{

		$doctorant = $this->repository->findByDateInscr1eThese($dateInscr1eThese);

		if (!$doctorant) {
			return null;
		}
		else
			return $doctorant;
	}
	
	public function findDoctorantByDcace($dcace)
	{

		$doctorant = $this->repository->findByDcace($dcace);

		if (!$doctorant) {
			return null;
		}
		else
			return $doctorant;
	}
	
	public function findDoctorantByNomFormationMaster($nomFormationMaster)
	{

		$doctorant = $this->repository->findByNomFormationMaster($nomFormationMaster);

		if (!$doctorant) {
			return null;
		}
		else
			return $doctorant;
	}
	
	public function findDoctorantByUniversiteMaster($numEtudiant)
	{

		$doctorant = $this->repository->findByUniversiteMaster($numEtudiant);

		if (!$doctorant) {
			return null;
		}
		else
			return $doctorant;
	}
	
	public function findDoctorantBySujetMaster($numEtudiant)
	{

		$doctorant = $this->repository->findBySujetMaster($numEtudiant);

		if (!$doctorant) {
			return null;
		}
		else
			return $doctorant;
	}
	
	public function findDoctorantByLaboratoireAcceuilMaster($numEtudiant)
	{

		$doctorant = $this->repository->findByLaboratoireAcceuilMaster($numEtudiant);

		if (!$doctorant) {
			return null;
		}
		else
			return $doctorant;
	}
	
	public function findDoctorantByEncadrantsMaster($numEtudiant)
	{

		$doctorant = $this->repository->findByEncadrantsMaster($numEtudiant);

		if (!$doctorant) {
			return null;
		}
		else
			return $doctorant;
	}
	
	public function findDoctorantByEtabDernierDiplome($numEtudiant)
	{

		$doctorant = $this->repository->findByEtabDernierDiplome($numEtudiant);

		if (!$doctorant) {
			return null;
		}
		else
			return $doctorant;
	}
	
	public function findDoctorantByPaysDernierDiplome($numEtudiant)
	{

		$doctorant = $this->repository->findByPaysDernierDiplome($numEtudiant);

		if (!$doctorant) {
			return null;
		}
		else
			return $doctorant;
	}
	
	public function findDoctorantByLibelleDernierDiplome($numEtudiant)
	{

		$doctorant = $this->repository->findByLibelleDernierDiplome($numEtudiant);

		if (!$doctorant) {
			return null;
		}
		else
			return $doctorant;
	}
	
	public function findDoctorantByAnneeDernierDiplome($numEtudiant)
	{

		$doctorant = $this->repository->findByAnneeDernierDiplome($numEtudiant);

		if (!$doctorant) {
			return null;
		}
		else
			return $doctorant;
	}
	
	public function findDoctorantByDepDernierDiplome($numEtudiant)
	{

		$doctorant = $this->repository->findByDepDernierDiplome($numEtudiant);

		if (!$doctorant) {
			return null;
		}
		else
			return $doctorant;
	}
	
	public function findDoctorantByNomEtPrenom($prenom, $nom)
	{
    
		$query = $this->em->getConnection()->prepare('SELECT *	FROM Doctorant d WHERE d.prenom = "'.$prenom.'" AND d.nom = "'.$nom.'";')->execute();

		$encadrants = $query->getResult();

		if (!$doctorant) {
			return null;
		}
		else
			return $doctorant;
	}
	
	public function findAll()
	{

		$doctorant = $this->repository->findAll();

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé'
			);
						}
		else
			return $doctorant;
	}
	
	public function updateNom($id,$nouveauNom)
	{
	
		
		$doctorant = $this->repository->findById($id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$doctorant->setNom($nouveauNom);
		$this->em->flush();

		return $doctorant;
	}
	
	public function updateNomUsage($id,$nouveauNomUsage)
	{
	
		$doctorant = $this->repository->findById($id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$doctorant->setNomUsage($nouveauNomUsage);
		$this->em->flush();

		return $doctorant;
	}
	
	public function updateCivilite($id,$nouveauCivilite)
	{

		$doctorant = $this->repository->findById($id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$doctorant->setCivilite($nouveauCivilite);
		$this->em->flush();

		return $doctorant;
	}
	
	public function updatePrenom($id,$nouveauPrenom)
	{
	
		$doctorant = $this->repository->findById($id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$doctorant->setPrenom($nouveauPrenom);
		$this->em->flush();

		return $doctorant;
	}
	
	public function updateAdresse($id,$nouveauAdresse)
	{

		$doctorant = $this->repository->findById($id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$doctorant->setAdresse($nouveauAdresse);
		$this->em->flush();

		return $doctorant;
	}
	
	public function updateMail($id,$nouveauMail)
	{

		$doctorant = $this->repository->findById($id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$doctorant->setMail($nouveauMail);
		$this->em->flush();

		return $doctorant;
	}
	
	public function updateDateDeNaissance($id,$nouveauDateDeNaissance)
	{

		$doctorant = $this->repository->findById($id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$doctorant->setDateDeNaissance($nouveauDateDeNaissance);
		$this->em->flush();

		return $doctorant;
	}
	
	public function updateNationalite($id,$nouveauNationalite)
	{
	
		$doctorant = $this->repository->findById($id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$doctorant->setNationalite($nouveauNationalite);
		$this->em->flush();

		return $doctorant;
	}
	
	public function updateVilleDeNaissance($id,$nouveauVilleDeNaissance)
	{
	
		$doctorant = $this->repository->findById($id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$doctorant->setVilleDeNaissance($nouveauVilleDeNaissance);
		$this->em->flush();

		return $doctorant;
	}
	
	public function updatePaysDeNaissance($id,$nouveauPaysDeNaissance)
	{
	
		$doctorant = $this->repository->findById($id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$doctorant->setPaysDeNaissance($nouveauPaysDeNaissance);
		$this->em->flush();

		return $doctorant;
	}
	
	public function updateDepDeNaissance($id,$nouveauDepDeNaissance)
	{
	
		$doctorant = $this->repository->findById($id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$doctorant->setDepDeNaissance($nouveauDepDeNaissance);
		$this->em->flush();

		return $doctorant;
	}
	
	public function updateNumEtudiant($id,$nouveauNumEtudiant)
	{
	
		$doctorant = $this->repository->findById($id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$doctorant->setNumEtudiant($nouveauNumEtudiant);
		$this->em->flush();

		return $doctorant;
	}
	
	public function updateBourseEtExoneration($id,$nouveauBourseEtExoneration)
	{
	
		$doctorant = $this->repository->findById($id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$doctorant->setBourseEtExoneration($nouveauBourseEtExoneration);
		$this->em->flush();

		return $doctorant;
	}
	
	public function updateDateInscr1eThese($id,$nouveauDateInscr1eThese)
	{
	
		$doctorant = $this->repository->findById($id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$doctorant->setDateInscr1eThese($nouveauDateInscr1eThese);
		$this->em->flush();

		return $doctorant;
	}
	
	public function updateDcace($id,$nouveauDcace)
	{
	
		$doctorant = $this->repository->findById($id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$doctorant->setDcace($nouveauDcace);
		$this->em->flush();

		return $doctorant;
	}
	
	public function updateNomFormationMaster($id,$nouveauNomFormationMaster)
	{
	
		$doctorant = $this->repository->findById($id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$doctorant->setNomFormationMaster($nouveauNomFormationMaster);
		$this->em->flush();

		return $doctorant;
	}
	
	public function updateUniversiteMaster($id,$nouveauUniversiteMaster)
	{
	
		$doctorant = $this->repository->findById($id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$doctorant->setUniversiteMaster($nouveauUniversiteMaster);
		$this->em->flush();

		return $doctorant;
	}
	
	public function updateSujetMaster($id,$nouveauSujetMaster)
	{
	
		$doctorant = $this->repository->findById($id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$doctorant->setSujetMaster($nouveauSujetMaster);
		$this->em->flush();

		return $doctorant;
	}
	
	public function updateLaboratoireAccueilMaster($id,$nouveauLaboratoireAccueilMaster)
	{
	
		$doctorant = $this->repository->findById($id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$doctorant->setLaboratoireAcceuilMaster($nouveauLaboratoireAccueilMaster);
		$this->em->flush();

		return $doctorant;
	}
	
	public function updateEncadrantsMaster($id,$nouveauEncadrantMaster)
	{
	
		$doctorant = $this->repository->findById($id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$doctorant->setEncadrantsMaster($nouveauEncadrantMaster);
		$this->em->flush();

		return $doctorant;
	}
	
	public function updateEtabDernierDiplome($id,$nouveauEtabDernierDiplome)
	{
	
		$doctorant = $this->repository->findById($id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$doctorant->setEtabDernierDiplome($nouveauEtabDernierDiplome);
		$this->em->flush();

		return $doctorant;
	}
	
	public function updateDepDernierDiplome($id,$nouveauDepDernierDiplome)
	{
	
		$doctorant = $this->repository->findById($id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$doctorant->setDepDernierDiplome($nouveauDepDernierDiplome);
		$this->em->flush();

		return $doctorant;
	}
	
	public function updatePaysDernierDiplome($id,$nouveauPaysDernierDiplome)
	{
	
		$doctorant = $this->repository->findById($id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$doctorant->setPaysDernierDiplome($nouveauPaysDernierDiplome);
		$this->em->flush();

		return $doctorant;
	}
	
	public function updateLibelleDernierDiplome($id,$nouveauLibelleDernierDiplome)
	{
	
		$doctorant = $this->repository->findById($id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$doctorant->setLibelleDernierDiplome($nouveauLibelleDernierDiplome);
		$this->em->flush();

		return $doctorant;
	}
	
	public function updateAnneeDernierDiplome($id,$nouveauAnneeDernierDiplome)
	{
	
		$doctorant = $this->repository->findById($id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$doctorant->setAnneeDernierDiplome($nouveauAnneeDernierDiplome);
		$this->em->flush();

		return $doctorant;
	}
	
	public function delete($id)
	{
	
		$doctorant = $this->repository->findById($id);

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

	


