<?php

//DirecteurDeTheseService
require_once __DIR__ . '/../Entity/DirecteurDeThese.php';

class DirecteurDeTheseService
{
    $repository = $this->getDoctrine()->getRepository('DT/DoctoramaBundle/Entity:DirecteurDeThese');
	$em = $this->getDoctrine()->getManager();
    

    public function createDirecteurDeThese($nom, $nomUsage, $civilite, $prenom, $adresse, $email, $dateNaissance, $nationalite, $villeNaissance, $paysNaissance, $depNaissance)
	{
		$directeurDeThese = new DirecteurDeThese();
		$directeurDeThese->setnom($nom);
		$directeurDeThese->setnomUsage($nomUsage);
		$directeurDeThese->setcivilite($civilite);
		$directeurDeThese->setprenom($prenom);
		$directeurDeThese->setadresse($adresse);
		$directeurDeThese->setemail($email);
		$directeurDeThese->setdateNaissance($dateNaissance);
		$directeurDeThese->setnationalite($nationalite);
		$directeurDeThese->setvilleNaissance($villeNaissance);
		$directeurDeThese->setpaysNaissance($paysNaissance);
		$directeurDeThese->setdepNaissance($depNaissance);

		
		//$reunion->setPersonnes($personnes);
		//ou
		/*
		foreach($personnes as $personne)
		{
			$reunion->addPersonne($personne);
		}
		*/
		
		$em = $this->getDoctrine()->getManager();
		$em->persist($Personne);
		$em->flush();
	}

	public function findbyId($id)
	{
   		
        $directeurDeThese = $repository->find($id);

   		if (!$directeurDeThese) {
        throw $this->createNotFoundException(
            'Aucun produit trouvé pour cet id : '.$id
        );
    	}
        else 
        {
            return $directeurDeThese;
        }
    }
	
    public function findByName($nom)
	{

		$directeurDeThese = $repository->find($nom);

		if (!$directeurDeThese) {
        throw $this->createNotFoundException(
            'Aucun element trouvé pour :'.$nom );
    	}
    	else {
    		return $directeurDeThese;
    	}

	}

	public function findBynomUsage($nomUsage)
	{

		$directeurDeThese = $repository->find($nomUsage);
  	    
		if (!$directeurDeThese) {
        throw $this->createNotFoundException(
            'Aucun element trouvé pour : '.$nomUsage );
    	}
    	else {
    		return $directeurDeThese;
    	}


	public function findByLastName($LastName)
	{

		$directeurDeThese = $repository->find($LastName);
  	    
		if (!$directeurDeThese) {
        throw $this->createNotFoundException(
            'Aucun element trouvé pour : '.$LastName );
    	}
    	else {
    		return $directeurDeThese;
    	}

	}

    public function findByAdresse($adresse)
    {

        $directeurDeThese = $repository->find($adresse);
        
        if (!$directeurDeThese) {
        throw $this->createNotFoundException(
            'Aucun element trouvé pour : '.$adresse );
        }
        else {
            return $directeurDeThese;
        }
    }


    public function findByEmail($email)
    {

        $directeurDeThese = $repository->find($email);
        
        if (!$directeurDeThese) {
        throw $this->createNotFoundException(
            'Aucun element trouvé pour : '.$email );
        }
        else {
            return $directeurDeThese;
        }
    }

    public function findByDate($dateNaissance)
    {

        $directeurDeThese = $repository->find($dateNaissance);
        
        if (!$directeurDeThese) {
        throw $this->createNotFoundException(
            'Aucun element trouvé pour : '.$dateNaissance );
        }
        else {
            return $directeurDeThese;
        }
    }

     public function findByNationalite($nationalite)
    {

        $directeurDeThese = $repository->find($nationalite);
        
        if (!$directeurDeThese) {
        throw $this->createNotFoundException(
            'Aucun element trouvé pour : '.$nationalite );
        }
        else {
            return $directeurDeThese;
        }
    }

     public function findByVille($villeNaissance)
    {

        $directeurDeThese = $repository->find($villeNaissance);
        
        if (!$directeurDeThese) {
        throw $this->createNotFoundException(
            'Aucun element trouvé pour : '.$villeNaissance);
        }
        else {
            return $directeurDeThese;
        }
    }

     public function findByPays($paysNaissance)
    {

        $directeurDeThese = $repository->find($paysNaissance);
        
        if (!$directeurDeThese) {
        throw $this->createNotFoundException(
            'Aucun element trouvé pour : '.$paysNaissance );
        }
        else {
            return $directeurDeThese;
        }
    }

     public function findByDepart($depNaissance)
    {

        $directeurDeThese = $repository->find($depNaissance);
        
        if (!$directeurDeThese) {
        throw $this->createNotFoundException(
            'Aucun element trouvé pour : '.$depNaissance );
        }
        else {
            return $directeurDeThese;
        }
    }

	public function updateName($id, $nom)
	{
    
   $directeurDeThese = $em->getRepository('DT/DoctoramaBundle/Entity:DirecteurDeThese')->find($id);

    if (!$directeurDeThese) {
        throw $this->createNotFoundException(
            'Aucun produit trouvé pour cet id : '.$id
        );
    }

    $directeurDeThese->setName($nom);
    $em->flush();

    return $this->redirect($this->generateUrl('homepage'));
	}

	public function updateNameUsage($id, $nomUsage)
	{
        
    $directeurDeThese = $em->getRepository('DT/DoctoramaBundle/Entity:DirecteurDeThese')->find($id);

    if (!$directeurDeThese) {
        throw $this->createNotFoundException(
            'Aucun produit trouvé pour cet id : '.$id
        );
    }

    $directeurDeThese->set($setnomUsage);
    $em->flush();

    return $this->redirect($this->generateUrl('homepage'));
	}

	public function updateLastName($id, $prenom)
	{
    
    $directeurDeThese = $em->getRepository('DT/DoctoramaBundle/Entity:DirecteurDeThese')->find($id);

    if (!$directeurDeThese) {
        throw $this->createNotFoundException(
            'Aucun produit trouvé pour cet id : '.$id
        );
    }

    $directeurDeThese->set($prenom);
    $em->flush();

    return $this->redirect($this->generateUrl('homepage'));
	}

	public function updateEmail($id, $email)
	{

    $directeurDeThese = $em->getRepository('DT/DoctoramaBundle/Entity:DirecteurDeThese')->find($id);

    if (!$directeurDeThese) {
        throw $this->createNotFoundException(
            'Aucun produit trouvé pour cet id : '.$id
        );
    }

    $directeurDeThese->set($email);
    $em->flush();

    r

	public function updateDateNaissance($id, $dateNaissance)
	{
    
   $directeurDeThese = $em->getRepository('DT/DoctoramaBundle/Entity:DirecteurDeThese')->find($id);

    if (!$directeurDeThese) {
        throw $this->createNotFoundException(
            'Aucun produit trouvé pour cet id : '.$id
        );
    }

    $directeurDeThese->set($dateNaissance);
    $em->flush();

    return $this->redirect($this->generateUrl('homepage'));
	}

    public function deleteDirecteurDeThese($id)
    {
    
    $directeurDeThese = $em->getRepository('DT/DoctoramaBundle/Entity:DirecteurDeThese')->find($id);

    if (!$directeurDeThese) {
        throw $this->createNotFoundException(
            'Aucun produit trouvé pour cet id : '.$id
        );
    }
    $em->remove($directeurDeThese);
    $em->flush();
    
    return $directeurDeThese;
    }
}