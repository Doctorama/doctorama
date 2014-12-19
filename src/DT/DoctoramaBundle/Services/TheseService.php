<?php
namespace DT\DoctoramaBundle\Services;
//TheseService
use DT\DoctoramaBundle\Entity\These;

/**
 * Services associes a l'entite These
 */
class TheseService

	/**
	* @var \Doctrine\ORM\EntityManager
	*/
	private $em;
	
	/**
	* @var Repository
	*/
	private $repository;
	
	/**
	* Constructor
	* @param EntityManager $em
	*/
	public function __construct($em)
	{
		$this->em = $em;
		$this->repository = $this->em->getRepository('DTDoctoramaBundle:These');
	}
    
	/**
	* Set These
	*
	* @param string $titreThese,
	* @param string $sujetThese,
	* @param string $specialite,
	* @param string $laboratoire,
	* @param string axeThematique,
	* @paramstring axeScientifique,
	* @param \integer $financement,
	* @param \datetime $dateDebut,
	* @param \datetime $dateDeSoutenance,
	* @param string $mention
	*
	*
	* @return These
	**/
	public function createThese($titreThese, $sujetThese, $specialite, $laboratoire, $axeThematique, $axeScientifique, $financement, $dateDebut, $dateDeSoutenance, $mention)
	{
		$these = new These();
		$these->setTitreThese($titreThese);
		$these->setSujetThese($sujetThese);
		$these->setSpecialite($specialite);
		$these->setLaboratoire($laboratoire);
		$these->setAxeThematique($axeThematique);
		$these->setAxeScientifique($axeScientifique);
		$these->setFinancement($financement);
		$these->setDateDebut($dateDebut);
		$these->setDateDeSoutenance($dateDeSoutenance);
		$these->setMention($mention);

		$this->em->persist($these);
		$this->em->flush();
		
		return $these;
	}
	
	/**
	* get TheseById
	*
	* @param \integer $id
	* @return These
	**/
	public function findById($id)
	{		
        $these = $this->repository->findOneById($id);

   		if (!$these) {
			return null;
    	}
    	return $these;
    }
	
	/**
	* get TheseByTitre
	*
	* @param string $titre
	* @return These
	**/
    public function findByTitreThese($titreThese)
	{
		$these = $this->repository->findByTitreThese($titreThese);

  	    if (!$these) {
			return null;
    	}
    	else {
    		return $these;
    	}		
	}

	/**
	* get TheseBySubject
	*
	* @param string $sujetThese
	* @return These
	**/
    public function findBySujetThese($sujetThese)
	{
		$these = $this->repository->findBySujetThese($sujetThese);

  	    if (!$these) {
			return null;
    	}
    	else {
    		return $these;
    	}		
	}

	/**
	* get TheseBySpeciality
	*
	* @param string $specialite
	* @return These
	**/
	public function findBySpecialite($specialite)
	{
		$these = $this->repository->findBySpecialite($specialite);

  	    if (!$these) {
			return null;
    	}
    	else {   		
    		return $these;
    	}
		
	}
	
	/**
	* get TheseByLabo
	*
	* @param string $labo
	* @return These
	**/
	public function findByLaboratoire($laboratoire)
	{
		$these = $this->repository->findByLaboratoire($laboratoire);

  	    if (!$these) {
			return null;
    	}
    	else {		
    		return $these;
    	}
	}

	/**
	* get TheseByAxeThematique
	*
	* @param string $axeThematique
	* @return These
	**/
	public function findByAxeThematique($axeThematique)
	{
		$these = $this->repository->findByAxeThematique($axeThematique);

  	    if (!$these) {
			return null;
    	}
    	else {    		
    		return $these;
    	}		
	}

	/**
	* get TheseByAxeSpecifique
	*
	* @param string $axeSpecifique
	* @return These
	**/
	public function findByAxeScientifique($axeScientifique)
	{

		$these = $this->repository->findByAxeScientifique($axeScientifique);
  	    if (!$these) {
			return null;
    	}
    	else {  		
    		return $these;
    	}		
	}

	/**
	* get TheseByFinancement
	*
	* @param \integer $financement
	* @return These
	**/
	public function findByFinancement($financement)
	{
		$these = $this->repository->findByFinancement($financement);

  	    if (!$these) {
			return null;
    	}
    	else {   		
    		return $these;
    	}		
	}

	/**
	* get TheseByDateDebut
	*
	* @param \datetime $dateDebut
	* @return These
	**/
	public function findByDateDebut($dateDebut)
	{
		$these = $this->repository->findByDateDebut($dateDebut);

  	    if (!$these) {
			return null;
    	}
    	else {    		
    		return $these;
    	}		
	}

	/**
	* get TheseByDateDeSoutenance
	*
	* @param \datetime $dateDeSoutenance
	* @return These
	**/
	public function findByDateDeSoutenance($dateDeSoutenance)
	{

		$these = $this->repository->findByDateDeSoutenance($dateDeSoutenance);

  	    if (!$these) {
			return null;
    	}
    	else {  		
    		return $these;
    	}		
	}

	/**
	* get TheseByMention
	*
	* @param string $mention
	* @return These
	**/
	public function findByMention($mention)
	{
		$these = $this->repository->findByMention($mention);

  	    if (!$these) {
			return null;
    	}
    	else {    		
    		return $these;
    	}		
	}

	/**
	* Set TitreThese
	*
	* @param \integer $id,
	* @param string $newTitreThese
	*
	* @return These
	**/
	public function updateTitreThese($id, $newTitreThese)
	{   
		$these = $this->repository->findOneById($id);

		if (!$these) {
			return null;
		}

		$these->setTitreThese($newTitreThese);
		$this->em->flush();

		return $these;
	}

	/**
	* Set SujetThese
	*
	* @param \integer $id,
	* @param string $newSujetThese
	*
	* @return These
	**/
	public function updateSujetThese($id, $newSujetThese)
	{   
		$these = $this->repository->findOneById($id);

		if (!$these) {
			return null;
		}
		$these->setSujetThese($newSujetThese);
		$this->em->flush();

		return $these;
	}

	/**
	* Set SpecialiteThese
	*
	* @param \integer $id,
	* @param string $newSpecialite
	*
	* @return These
	**/
	public function updateSpecialite($id, $newSpecialite)
	{  
		$these = $this->repository->findOneById($id);
		
		if (!$these) {
			return null;
		}
		$these->setSpecialite($newSpecialite);
		$this->em->flush();

		return $these;
	}

	/**
	* Set LaboratoireThese
	*
	* @param \integer $id,
	* @param string $newlaboratoire
	*
	* @return These
	**/
	public function updateLaboratoire($id, $newlaboratoire)
	{
		$these = $this->repository->findOneById($id);

		if (!$these) {
			return null;
		}

		$these->setlaboratoire($newlaboratoire);
		$this->emem->flush();

		return $these;
	}

	/**
	* Set FinancementThese
	*
	* @param \integer $id,
	* @param \integer $newFinancement
	*
	* @return These
	**/
	public function updateFinancement($id, $newFinancement)
	{
		$these = $this->repository->findOneById($id);

		if (!$these) {
			return null;
		}

		$these->setFinancement($newFinancement);
		$this->em->flush();

		return $these;
	}

	/**
	* Set DateDebutThese
	*
	* @param \integer $id,
	* @param \datetime $newDateDebut
	*
	* @return These
	**/
	public function updatedateDebut($id, $newdateDebut)
	{
		$these = $this->repository->findOneById($id);

		if (!$these) {
			return null;
		}

		$these->setdateDebut($newdateDebut);
		$this->em->flush();

		return $these;
	}

	/**
	* Set DateDeSoutenanceThese
	*
	* @param \integer $id,
	* @param \datetime $newdateDeSoutenance
	*
	* @return These
	**/
	public function updatedateDeSoutenance($id, $newdateDeSoutenance)
	{
		$these = $this->repository->findOneById($id);

		if (!$these) {
			return null;
		}

		$these->setdateDeSoutenance($newdateDeSoutenance);
		$this->em->flush();

		return $these;
	}

	/**
	* Set MentionThese
	*
	* @param \integer $id,
	* @param string $newMention
	*
	* @return These
	**/
	public function updateMention($id, $newMention)
	{
		$these = $this->repository->findOneById($id);

		if (!$these) {
			return null;
		}

		$these->setMention($newMention);
		$this->em->flush();

		return $these;
	}
	
	/**
	* Delete These
	*
	* @param \integer $id
	*
	* @return boolean
	**/
	public function deleteThese($id)
	{
		$these = $this->repository->findOneById($id);

		if (!$these) {
			return false;
		}
		$this->em->remove($these);
		$this->em->flush();

		return true;
	}

	/**
	* get TheseByDoctorant
	*
	* @param \integer $id
	*
	* @return These
	**/
	public function findByDoctorant($doctorant)
	{
		$these = $this->repository->findByDoctorant($doctorant);
		
		if (!$these) {
			return null;
		}
		return $these;
	}
	
	/**
	* set Doctorant
	*
	* @param \integer $id,
	* @param Doctorant $doctorant,
	*
	* @return These
	**/
	public function updateDoctorant($id, $doctorant)
	{
		$these = $this->repository->findOneById($id);

		if (!$these) {
			return null;
		}

		$these->setDoctorant($doctorant);
		$this->em->flush();

		return $these;
	}
	
	/**
	* get EncadrantsByIdThese
	*
	* @param \integer $id
	*
	* @return Encadrant[]
	**/
	public function findEncadrantsByIdThese($idThese)
	{
		$these = $this->repository->findOneById($id);

		if (!$these) {
			return null;
		}
		
		return $these->getEncadrants();
	}
}