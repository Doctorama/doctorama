<?php

namespace DT\DoctoramaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use DT\SecurityBundle\Entity\Compte;

require_once __DIR__ . '/Personne.php';

/**
 * DirecteurDeThese
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class DirecteurDeLaboratoire extends Personne{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\OneToOne(targetEntity="DT\SecurityBundle\Entity\Compte", mappedBy="directeur")
     **/
    private $compte;
    
    /**
    * Get id
    *
    * @return integer 
    */
    function getId() {
        return $this->id;
    }

    /**
	* Set id
	*
	* @param id $id
	* @return id
	**/
    function setId($id) {
        $this->id = $id;
        return $this;
    }
	
	/**
	* Get compte
	*
	* @return Compte
	**/
    function getCompte() {
        return $this->compte;
    }

	/**
	* Set compte
	*
	* @param Compte $compte
	* @return Compte
	**/
    function setCompte($compte) {
        $this->compte = $compte;
        return $this;
    }


}