<?php

namespace DT\DoctoramaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use DT\SecurityBundle\Entity\Compte;

require_once __DIR__ . '/Personne.php';
require_once __DIR__ . '/These.php';

/**
 * Encadrant
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Encadrant extends Personne{
	
        /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
	/**
     * @ORM\ManyToMany(targetEntity="These", inversedBy="encandrants")
     **/
    private $theses;
	
	/**
     * @ORM\ManyToMany(targetEntity="These", inversedBy="directeursDeThese")
	 * @ORM\JoinTable(name="directeur_these")
     **/
    private $thesesDirecteur;

	public function __construct() {
		$this->reunions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->theses = new \Doctrine\Common\Collections\ArrayCollection();
		$this->thesesDirecteur = new \Doctrine\Common\Collections\ArrayCollection();
    }
	
    /**
     * @ORM\OneToOne(targetEntity="DT\SecurityBundle\Entity\Compte", mappedBy="encadrant")
     **/
    private $compte;
    
    
    function getId() {
        return $this->id;
    }

    function getTheses() {
        return $this->theses;
    }

    function getCompte() {
        return $this->compte;
    }

    function setId($id) {
        $this->id = $id;
        return $this;
    }

    function setCompte($compte) {
        $this->compte = $compte;
        return $this;
    }

    	
	/**
     * Get theses
     *
     * @return These 
     */
	public function getThese(){
		return $this->theses;
	}
	
	/**
	* Add These
	*
	* @param
	**/
	public function addThese($these){
		if(!$this->theses->contains($these)){
			$this->theses[] = ($these);
		}
	}
	
	public function getThesesDirecteur(){
		return $this->thesesDirecteur;
	}
	
	public function addThesesDirecteur($thesedirecteur){
		if(!$this->thesesDirecteur->contains($thesedirecteur)){
			$this->thesesDirecteur[] = ($thesedirecteur);
		}
	}
}