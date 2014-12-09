<?php

//ReunionService
require_once __DIR__ . '/../Entity/Reunion.php';

class ReunionService
{
	$repository = $this->getDoctrine()->getRepository('DTDoctoramaBundleEntity:Reunion');
	$em = $this->getDoctrine()->getManager();

	public function createReunion($lieu, $date, $personnes)
	{
		$reunion = new Reunion();
		$reunion->setLieu($lieu);
		$reunion->setDate($date);
		$reunion->setPersonnes($personnes);
		//ou
		/*
		foreach($personnes as $personne)
		{
			$reunion->addPersonne($personne);
		}
		*/
		
		$em->persist($reunion);
		$em->flush();
		return new Response('Id de réunion créé : '.$reunion->getId());
	}
	public function findReunionById($id)
	{
    $repository->find($id);

    if (!$reunion) {
        throw $this->createNotFoundException(
            'Aucune réunion trouvée par : : '.$id
        );
					}
	else
		return $reunion;
	}
	public function findReunionByDate($date)
	{

		$reunion = $repository->findByDate($date);

		if (!$reunion) 
		{
			throw $this->createNotFoundException(
			'Aucune réunion trouvée le : : '.$date
		);
		}
		else
			return $reunion;
	}
	
	public function findReunionByLieu($lieu)
	{
    
    $reunion = $repository->findByLieu($lieu);
    if (!$reunion) {
        throw $this->createNotFoundException(
            'Aucune réunion trouvée à : : '.$lieu
        );
					}
	else
		return $reunion;
	}
	
	public function findReunionByLieuAndDate($lieu, $date)
	{
	
	$query = $em->createQuery(
		'SELECT r
		FROM DTDoctoramaBundleEntity:Reunion r
		WHERE r.date = :date
		AND r.lieu = :lieu'
	)->setParameter(array('date' => $date,
							'lieu' =>$lieu,));

	$reunion = $query->getResult();

    if (!$reunion) {
        throw $this->createNotFoundException(
            'Aucune réunion trouvée'
        );
					}
	else
		return $reunion;
	}
	
	public function findAll()
	{
	
		$reunions = $repository->findAll();

		if (!$reunions) {
			throw $this->createNotFoundException(
				'Aucune réunion trouvée'
			);
						}
		else
			return $reunions;
	}
	public function updateReunion($id)
	{
		
		$reunion = $em->getRepository('DT\DoctoramaBundle\Entity:Reunion')->find($id);

		if (!$reunion) {
			throw $this->createNotFoundException(
				'Aucune réunion trouvée pour cet id : '.$id
			);
		}

		$reunion->setName($reunion);
		$em->flush();

		return $reunion;
	}
	public function updateLieuReunion($id,$nouveaulieu)
	{
	
		$reunion = $em->getRepository('DT\DoctoramaBundle\Entity:Reunion')->find(id);

		if (!$reunion) {
			throw $this->createNotFoundException(
				'Aucune réunion trouvée pour cet id: '.$id
			);
		}

		$reunion->setLieu($nouveaulieu);
		$em->flush();

		return $reunion;
	}
	public function updateDateReunion($id,$nouvelleDate)
	{
	
		$reunion = $em->getRepository('DT\DoctoramaBundle\Entity:Reunion')->find(id);

		if (!$reunion) {
			throw $this->createNotFoundException(
				'Aucune réunion trouvée pour cet id: '.$id
			);
		}

		$reunion->setDate($nouvelleDate);
		$em->flush();

		return $reunion;
	}
	public function addPersonne($id,$nouvellePersonne)
	{
	
		$reunion = $em->getRepository('DT\DoctoramaBundle\Entity:Reunion')->find(id);

		if (!$reunion) {
			throw $this->createNotFoundException(
				'Aucune réunion trouvée pour cet id: '.$id
			);
		}
		$reunion->addPersonne($nouvellePersonne);
		$entityManager->persist($reunion);
		$em->flush();

		return $reunion;
	}
	public function deleteReunion($id)
	{
	
		$reunion = $em->getRepository('DT\DoctoramaBundle\Entity:Reunion')->find($id);

		if (!$reunion) {
			throw $this->createNotFoundException(
				'Aucune réunion trouvée pour cet id : '.$id
			);
		}

		$em->remove($reunion);
		$em->flush();

		return True;
	}
	
}

	


