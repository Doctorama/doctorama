<?php

//DoctorantService
require_once __DIR__ . 'DT\DoctoramaBundle\Entity\Doctorant.php';

class DoctorantService
{
	$repository = $this->getDoctrine()->getRepository('DT\DoctoramaBundle\Entity:Doctorant')
	$em = $this->getDoctrine()->getManager();
	
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
		$doctorant->setLaboratoireAccueilMaster($laboratoireAccueilMaster);
		$doctorant->setEncadrantMaster($encadrantMaster);
		$doctorant->setEtabDernierDiplome($etabDernierDiplome);
		$doctorant->setDepDernierDiplome($depDernierDiplome);
		$doctorant->setPaysDernierDiplome($paysDernierDiplome);
		$doctorant->setLibelleDernierDiplome($libelleDernierDiplome);
		$doctorant->setAnneeDernierDiplome($anneeDernierDiplome);
		
		$em->persist($doctorant);
		$em->flush();
		return new Response('Id du doctorant créé : '.$doctorant->getId());
	}
	public function findDoctorantById($id)
	{
    
        $doctorant = $repository->find($id);

    if (!$doctorant) {
        throw $this->createNotFoundException(
            'Aucun doctorant trouvé par : : '.$id
        );
					}
	else
		return $doctorant;
	}
	public function findDoctorantByNom($nom)
	{

		$doctorants = $repository->findByNom($nom);

		if (!$doctorants) 
		{
			throw $this->createNotFoundException(
			'Aucun doctorant trouvé par : : '.$nom
		);
		}
		else
			return $doctorants;
	}
	
	public function findDoctorantByNomUsage($nomUsage)
	{

    $doctorants = $repository->findByNomUsage($nomUsage);

    if (!$doctorants) {
        throw $this->createNotFoundException(
            'Aucun doctorant trouvé par : : '.$nomUsage
        );
					}
	else
		return $doctorants;
	}
	
	public function findDoctorantByCivilite($civilite)
	{

    $doctorants = $repository->findByCivilite($civilite);

    if (!$doctorants) {
        throw $this->createNotFoundException(
            'Aucun doctorant trouvé par : : '.$civilite
        );
					}
	else
		return $doctorants;
	}
	
	public function findDoctorantByPrenom($prenom)
	{

    $doctorants = $repository->findByPrenom($prenom);

    if (!$doctorants) {
        throw $this->createNotFoundException(
            'Aucun doctorant trouvé par : : '.$prenom
        );
					}
	else
		return $doctorants;
	}
	
	public function findDoctorantByAdresse($adresse)
	{

    $doctorants = $repository->findByAdresse($adresse);

    if (!$doctorants) {
        throw $this->createNotFoundException(
            'Aucun doctorant trouvé par : : '.$adresse
        );
					}
	else
		return $doctorants;
	}
	
	public function findDoctorantByMail($mail)
	{

    $doctorant = $repository->findByMail($mail);

    if (!$doctorant) {
        throw $this->createNotFoundException(
            'Aucun doctorant trouvé par : : '.$mail
        );
					}
	else
		return $doctorant;
	}
	
	public function findDoctorantByDateDeNaissance($dateDeNaissance)
	{

    $doctorants = $repository->findByDateDeNaissance($dateDeNaissance);

    if (!$doctorants) {
        throw $this->createNotFoundException(
            'Aucun doctorant trouvé par : : '.$dateDeNaissance
        );
					}
	else
		return $doctorants;
	}
	
	public function findDoctorantByNationalite($nationalite)
	{

    $doctorants = $repository->findByNationalite($nationalite);

    if (!$doctorants) {
        throw $this->createNotFoundException(
            'Aucun doctorant trouvé par : : '.$nationalite
        );
					}
	else
		return $doctorants;
	}
	
	public function findDoctorantByVilleDeNaissance($villeDeNaissance)
	{

    $doctorants = $repository->findByVilleDeNaissance($villeDeNaissance);

    if (!$doctorants) {
        throw $this->createNotFoundException(
            'Aucun doctorant trouvé par : : '.$villeDeNaissance
        );
					}
	else
		return $doctorants;
	}
	
	public function findDoctorantByPaysDeNaissance($paysDeNaissance)
	{

    $doctorants = $repository->findByPaysDeNaissance($paysDeNaissance);

    if (!$doctorants) {
        throw $this->createNotFoundException(
            'Aucun doctorant trouvé par : : '.$paysDeNaissance
        );
					}
	else
		return $doctorants;
	}
	
	public function findDoctorantByDepDeNaissance($depDeNaissance)
	{

    $doctorants = $repository->findByDepDeNaissance($depDeNaissance);

    if (!$doctorants) {
        throw $this->createNotFoundException(
            'Aucun doctorant trouvé par : : '.$depDeNaissance
        );
					}
	else
		return $doctorants;
	}
	
	public function findDoctorantByNumEtudiant($numEtudiant)
	{

    $doctorant = $repository->findByNumEtudiant($numEtudiant);

    if (!$doctorant) {
        throw $this->createNotFoundException(
            'Aucun doctorant trouvé par : : '.$numEtudiant
        );
					}
	else
		return $doctorant;
	}
	
	public function findDoctorantByNomEtPrenom($prenom, $nom)
	{
    $query = $em->createQuery(
		'SELECT d
		FROM DTDoctoramaBundleEntity:Doctorant d
		WHERE d.prenom = '$date'
		AND d.nom = :nom'
	)->setParameter(array('prenom' => $prenom, 'nom' => $nom));

	$encadrants = $query->getResult();

    if (!$doctorants) {
        throw $this->createNotFoundException(
            'Aucun doctorant trouvé'
        );
					}
	else
		return $doctorants;
	}
	
	
	
	public function findAll()
	{

		$doctorants = $repository->findAll();

		if (!$doctorants) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé'
			);
						}
		else
			return $doctorants;
	}
	public function updateDoctorant($id)
	{
	
		$doctorant = $repository->find($id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id : '.$id
			);
		}

		$doctorant->setName('doctorant!');
		$em->flush();

		return $doctorant;
	}
	
	public function updateNomDoctorant($id,$nouveauNom)
	{
	
		
		$doctorant = $repository->find(id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$nom->setNom($nouveauNom);
		$em->flush();

		return $doctorant;
	}
	
	public function updateNomUsageDoctorant($id,$nouveauNomUsage)
	{
	
		$doctorant = $repository->find(id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$nomUsage->setNomUsage($nouveauNomUsage);
		$em->flush();

		return $doctorant;
	}
	
	public function updateCiviliteDoctorant($id,$nouveauCivilite)
	{

		$doctorant = $repository->find(id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$civilite->setCivilite($nouveauCivilite);
		$em->flush();

		return $doctorant;
	}
	
	public function updatePrenomDoctorant($id,$nouveauPrenom)
	{
	
		$doctorant = $repository->find(id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$prenom->setPrenom($nouveauPrenom);
		$em->flush();

		return $doctorant;
	}
	
	public function updateAdresseDoctorant($id,$nouveauAdresse)
	{

		$doctorant = $repository->find(id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$adresse->setAdresse($nouveauAdresse);
		$em->flush();

		return $doctorant;
	}
	
	public function updateMailDoctorant($id,$nouveauMail)
	{

		$doctorant = $repository->find(id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$mail->setMail($nouveauMai);
		$em->flush();

		return $doctorant;
	}
	
	public function updateDateDeNaissancDoctorant($id,$nouveauDateDeNaissance)
	{

		$doctorant = $repository->find(id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$dateDeNaissance->setDateDeNaissance($nouveauDateDeNaissance);
		$em->flush();

		return $doctorant;
	}
	
	public function updateNationaliteDoctorant($id,$nouveauNationalite)
	{
	
		$doctorant = $repository->find(id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$nationalite->setNationalite($nouveauNationalite);
		$em->flush();

		return $doctorant;
	}
	
	public function updateVilleDeNaissanceDoctorant($id,$nouveauVilleDeNaissance)
	{
	
		$doctorant = $repository->find(id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$villeDeNaissance->setVilleDeNaissance($nouveauVilleDeNaissance);
		$em->flush();

		return $doctorant;
	}
	
	public function updatePaysDeNaissanceDoctorant($id,$nouveauPaysDeNaissance)
	{
	
		$doctorant = $repository->find(id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$paysDeNaissance->setPaysDeNaissance($nouveauPaysDeNaissance);
		$em->flush();

		return $doctorant;
	}
	
	public function updateDepDeNaissanceDoctorant($id,$nouveauDepDeNaissance)
	{
	
		$doctorant = $repository->find(id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$depDeNaissance->setDepDeNaissance($nouveauDepDeNaissance);
		$em->flush();

		return $doctorant;
	}
	
	public function updateNumEtudiantDoctorant($id,$nouveauNumEtudiant)
	{
	
		$doctorant = $repository->find(id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$numEtudiant->setNumEtudiant($nouveauNumEtudiant);
		$em->flush();

		return $doctorant;
	}
	
	public function updateBourseEtExonerationDoctorant($id,$nouveauBourseEtExoneration)
	{
	
		$doctorant = $repository->find(id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$bourseEtExoneration->setBourseEtExoneration($nouveauBourseEtExoneration);
		$em->flush();

		return $doctorant;
	}
	
	public function updateDateInscr1eTheseDoctorant($id,$nouveauDateInscr1eThese)
	{
	
		$doctorant = $repository->find(id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$dateInscr1eThese->setDateInscr1eThese($nouveauDateInscr1eThese);
		$em->flush();

		return $doctorant;
	}
	
	public function updateDcaceDoctorant($id,$nouveauDcace)
	{
	
		$doctorant = $repository->find(id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$dcace->setDcace($nouveauDcace);
		$em->flush();

		return $doctorant;
	}
	
	public function updateNomFormationMaster($id,$nouveauNomFormationMaster)
	{
	
		$doctorant = $repository->find(id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$nomFormationMaster->setNomFormationMaster($nouveauNomFormationMaster);
		$em->flush();

		return $doctorant;
	}
	
	public function updateUniversiteMaster($id,$nouveauUniversiteMaster)
	{
	
		$doctorant = $repository->find(id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$universiteMaster->setUniversiteMaster($nouveauUniversiteMaster);
		$em->flush();

		return $doctorant;
	}
	
	public function updateSujetMaster($id,$nouveauSujetMaster)
	{
	
		$doctorant = $repository->find(id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$sujetMaster->setSujetMaster($nouveauSujetMaster);
		$em->flush();

		return $doctorant;
	}
	
	public function updateLaboratoireAccueilMaster($id,$nouveauLaboratoireAccueilMaster)
	{
	
		$doctorant = $repository->find(id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$laboratoireAccueilMaster->setLaboratoireAccueilMaster($nouveauLaboratoireAccueilMaster);
		$em->flush();

		return $doctorant;
	}
	
	public function updateEncadrantMaster($id,$nouveauEncadrantMaster)
	{
	
		$doctorant = $repository->find(id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$encadrantMaster->setEncadrantMaster($nouveauEncadrantMaster);
		$em->flush();

		return $doctorant;
	}
	
	public function updateEtabDernierDiplome($id,$nouveauEtabDernierDiplome)
	{
	
		$doctorant = $repository->find(id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$etabDernierDiplome->setEtabDernierDiplome($nouveauEtabDernierDiplome);
		$em->flush();

		return $doctorant;
	}
	
	public function updateDepDernierDiplome($id,$nouveauDepDernierDiplome)
	{
	
		$doctorant = $repository->find(id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$depDernierDiplome->setDepDernierDiplome($nouveauDepDernierDiplome);
		$em->flush();

		return $doctorant;
	}
	
	public function updatePaysDernierDiplome($id,$nouveauPaysDernierDiplome)
	{
	
		$doctorant = $repository->find(id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$paysDernierDiplome->setPaysDernierDiplome($nouveauPaysDernierDiplome);
		$em->flush();

		return $doctorant;
	}
	
	public function updateLibelleDernierDiplome($id,$nouveauLibelleDernierDiplome)
	{
	
		$doctorant = $repository->find(id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$libelleDernierDiplome->setLibelleDernierDiplome($nouveauLibelleDernierDiplome);
		$em->flush();

		return $doctorant;
	}
	
	public function updateAnneeDernierDiplome($id,$nouveauAnneeDernierDiplome)
	{
	
		$doctorant = $repository->find(id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id: '.$id
			);
		}

		$anneeDernierDiplome->setAnneeDernierDiplome($nouveauAnneeDernierDiplome);
		$em->flush();

		return $doctorant;
	}
	
	public function deleteDoctorant($id)
	{
	
		$doctorant = $repository->find($id);

		if (!$doctorant) {
			throw $this->createNotFoundException(
				'Aucun doctorant trouvé pour cet id : '.$id
			);
		}

		$em->remove($doctorant);
		$em->flush();

		return True;
	}
}

	


