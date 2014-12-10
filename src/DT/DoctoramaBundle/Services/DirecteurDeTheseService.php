<?php

//EncadrantService
require_once __DIR__ . 'DT\DoctoramaBundle\Entity\Encadrant.php';

class EncadrantService
{
	$repository = $this->getDoctrine()->getRepository('DTDoctoramaBundleEntity:Encadrant');
	$em = $this->getDoctrine()->getManager();

	public function createEncadrant($nom, $nomUsage, $civilite, $prenom, $adresse, $mail,
	$dateDeNaissance, $nationalite, $villeDeNaissance, $paysDeNaissance, $depDeNaissance)
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
		
		
		$em->persist($encadrant);
		$em->flush();
		return new Response('Id Encadrant créé : '.$encadrant->getId());
	}
	public function findEncadrantById($id)
	{
    $encadrant = $repository->find($id);

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

		$encadrants = $repository->findByNom($nom);

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

    $encadrants = $repository->findByNomUsage($nomUsage);

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

    $encadrants = $repository->findByCivilite($civilite);

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

    $encadrants = $repository->findByPrenom($prenom);

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

    $encadrants = $repository->findByAdresse($adresse);

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

    $encadrant = $repository->findByMail($mail);

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

    $encadrants = $repository->findByDateDeNaissance($dateDeNaissance);

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

    $encadrants = $repository->findByNationalite($nationalite);

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

    $encadrants = $repository->findByVilleDeNaissance($villeDeNaissance);

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

    $encadrants = $repository->findByPaysDeNaissance($paysDeNaissance);

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

    $encadrants = $repository->findByDepDeNaissance($depDeNaissance);

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

	$query = $em->createQuery(
		'SELECT e
		FROM DTDoctoramaBundleEntity:Encadrant e
		WHERE e.prenom = :prenom
		AND e.nom = :nom'
	)->setParameter(array('prenom' => $prenom, 'nom' => $nom));

	$encadrants = $query->getResult();

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

		$encadrants = $repository->findAll();

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
	
		$encadrant = $repository->find(id);

		if (!$encadrant) {
			throw $this->createNotFoundException(
				'Aucun encadrant trouvé pour cet id: '.$id
			);
		}

		$nom->setNom($nouveauNom);
		$em->flush();

		return $encadrant;
	}
	
	public function updateNomUsageEncadrant($id,$nouveauNomUsage)
	{
	
		$encadrant = $repository->find(id);

		if (!$encadrant) {
			throw $this->createNotFoundException(
				'Aucun encadrant trouvé pour cet id: '.$id
			);
		}

		$nomUsage->setNomUsage($nouveauNomUsage);
		$em->flush();

		return $encadrant;
	}
	
	public function updateCiviliteEncadrant($id,$nouveauCivilite)
	{
	
		$encadrant = $repository->find(id);

		if (!$encadrant) {
			throw $this->createNotFoundException(
				'Aucun encadrant trouvé pour cet id: '.$id
			);
		}

		$civilite->setCivilite($nouveauCivilite);
		$em->flush();

		return $encadrant;
	}
	
	public function updatePrenomEncadrant($id,$nouveauPrenom)
	{
	
		$encadrant = $repository->find(id);

		if (!$encadrant) {
			throw $this->createNotFoundException(
				'Aucun encadrant trouvé pour cet id: '.$id
			);
		}

		$prenom->setPrenom($nouveauPrenom);
		$em->flush();

		return $encadrant;
	}
	
	public function updateAdresseEncadrant($id,$nouveauAdresse)
	{
	
		$encadrant = $repository->find(id);

		if (!$encadrant) {
			throw $this->createNotFoundException(
				'Aucun encadrant trouvé pour cet id: '.$id
			);
		}

		$adresse->setAdresse($nouveauAdresse);
		$em->flush();

		return $encadrant;
	}
	
	public function updateMailEncadrant($id,$nouveauMail)
	{
	
		$encadrant = $repository->find(id);

		if (!$encadrant) {
			throw $this->createNotFoundException(
				'Aucun encadrant trouvé pour cet id: '.$id
			);
		}

		$mail->setMail($nouveauMai);
		$em->flush();

		return $encadrant;
	}
	
	public function updateDateDeNaissancEncadrant($id,$nouveauDateDeNaissance)
	{
	
		$encadrant = $repository->find(id);

		if (!$encadrant) {
			throw $this->createNotFoundException(
				'Aucun encadrant trouvé pour cet id: '.$id
			);
		}

		$dateDeNaissance->setDateDeNaissance($nouveauDateDeNaissance);
		$em->flush();

		return $encadrant;
	}
	
	public function updateNationaliteEncadrant($id,$nouveauNationalite)
	{
	
		$encadrant = $repository->find(id);

		if (!$encadrant) {
			throw $this->createNotFoundException(
				'Aucun encadrant trouvé pour cet id: '.$id
			);
		}

		$nationalite->setNationalite($nouveauNationalite);
		$em->flush();

		return $encadrant;
	}
	
	public function updateVilleDeNaissanceEncadrant($id,$nouveauVilleDeNaissance)
	{
	
		$encadrant = $repository->find(id);

		if (!$encadrant) {
			throw $this->createNotFoundException(
				'Aucun encadrant trouvé pour cet id: '.$id
			);
		}

		$villeDeNaissance->setVilleDeNaissance($nouveauVilleDeNaissance);
		$em->flush();

		return $encadrant;
	}
	
	public function updatePaysDeNaissanceEncadrant($id,$nouveauPaysDeNaissance)
	{
	
		$encadrant = $repository->find(id);

		if (!$encadrant) {
			throw $this->createNotFoundException(
				'Aucun encadrant trouvé pour cet id: '.$id
			);
		}

		$paysDeNaissance->setPaysDeNaissance($nouveauPaysDeNaissance);
		$em->flush();

		return $encadrant;
	}
	
	public function updateDepDeNaissanceEncadrant($id,$nouveauDepDeNaissance)
	{
	
		$encadrant = $repository->find(id);

		if (!$encadrant) {
			throw $this->createNotFoundException(
				'Aucun encadrant trouvé pour cet id: '.$id
			);
		}

		$depDeNaissance->setDepDeNaissance($nouveauDepDeNaissance);
		$em->flush();

		return $encadrant;
	}
	
	public function deleteEncadrant($id)
	{

		$encadrant = $repository->find($id);

		if (!$encadrant) {
			throw $this->createNotFoundException(
				'Aucun encadrant trouvé pour cet id : '.$id
			);
		}

		$em->remove($encadrant);
		$em->flush();

		return True;
	}
}

	


