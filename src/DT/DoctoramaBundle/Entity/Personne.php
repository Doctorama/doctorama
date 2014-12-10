<?php

namespace DT\DoctoramaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

require_once __DIR__ . '/Reunion.php';

/**
 * Personne
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Personne
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="nomUsage", type="string", length=255)
     */
    private $nomUsage;

    /**
     * @var string
     *
     * @ORM\Column(name="civilite", type="string", length=255)
     */
    private $civilite;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=255)
     */
    private $mail;

    /**
     * @var datetime
     *
     * @ORM\Column(name="dateDeNaissance", type="datetime")
     */
    private $dateDeNaissance;

    /**
     * @var string
     *
     * @ORM\Column(name="nationalite", type="string", length=255)
     */
    private $nationalite;

    /**
     * @var string
     *
     * @ORM\Column(name="villeDeNaissance", type="string", length=255)
     */
    private $villeDeNaissance;

    /**
     * @var string
     *
     * @ORM\Column(name="paysDeNaissance", type="string", length=255)
     */
    private $paysDeNaissance;

    /**
     * @var string
     *
     * @ORM\Column(name="depDeNaissance", type="string", length=255)
     */
    private $depDeNaissance;
	
    /**
     * @ORM\ManyToMany(targetEntity="Reunion", mappedBy="personnes")
     **/
    private $reunions;
	
	public function __construct(){
		$this->reunions = new \Doctrine\Common\Collections\ArrayCollection();
	}
	
	/**
	* Get Reunion
	*
	* @return Reunion
	*/
	public function getReunion(){
		return $this->reunions;
	}
	
	/**
	* Set Reunion
	*
	* @param Reunion $reunion
	* @return Reunion
	**/
	public function setReunion($reunion){
		$this->reunions = $reunion;
		
		return $this;
	}
	
	/**
	* Delete Reunion
	*
	* @param $reunion
	**/
	public function deleteReunion($reunion){
		$this->reunions->removeElement($reunion);
	}
	
	/**
	* Add Reunion
	*
	* @param $reunion
	**/
	public function addReunion($reunion){
		if(!$this->reunions->contains($reunion)){
			$this->reunions[] = ($reunion);
		}
	}


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Personne
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    
        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set nomUsage
     *
     * @param string $nomUsage
     * @return Personne
     */
    public function setNomUsage($nomUsage)
    {
        $this->nomUsage = $nomUsage;
    
        return $this;
    }

    /**
     * Get nomUsage
     *
     * @return string 
     */
    public function getNomUsage()
    {
        return $this->nomUsage;
    }

    /**
     * Set civilite
     *
     * @param string $civilite
     * @return Personne
     */
    public function setCivilite($civilite)
    {
        $this->civilite = $civilite;
    
        return $this;
    }

    /**
     * Get civilite
     *
     * @return string 
     */
    public function getCivilite()
    {
        return $this->civilite;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     * @return Personne
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    
        return $this;
    }

    /**
     * Get prenom
     *
     * @return string 
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     * @return Personne
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    
        return $this;
    }

    /**
     * Get adresse
     *
     * @return string 
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set mail
     *
     * @param string $mail
     * @return Personne
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    
        return $this;
    }

    /**
     * Get mail
     *
     * @return string 
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set dateDeNaissance
     *
     * @param \datetime $dateDeNaissance
     * @return Personne
     */
    public function setDateDeNaissance(\datetime $dateDeNaissance)
    {
        $this->dateDeNaissance = $dateDeNaissance;
    
        return $this;
    }

    /**
     * Get dateDeNaissance
     *
     * @return \datetime 
     */
    public function getDateDeNaissance()
    {
        return $this->dateDeNaissance;
    }

    /**
     * Set nationalite
     *
     * @param string $nationalite
     * @return Personne
     */
    public function setNationalite($nationalite)
    {
        $this->nationalite = $nationalite;
    
        return $this;
    }

    /**
     * Get nationalite
     *
     * @return string 
     */
    public function getNationalite()
    {
        return $this->nationalite;
    }

    /**
     * Set villeDeNaissance
     *
     * @param string $villeDeNaissance
     * @return Personne
     */
    public function setVilleDeNaissance($villeDeNaissance)
    {
        $this->villeDeNaissance = $villeDeNaissance;
    
        return $this;
    }

    /**
     * Get villeDeNaissance
     *
     * @return string 
     */
    public function getVilleDeNaissance()
    {
        return $this->villeDeNaissance;
    }

    /**
     * Set paysDeNaissance
     *
     * @param string $paysDeNaissance
     * @return Personne
     */
    public function setPaysDeNaissance($paysDeNaissance)
    {
        $this->paysDeNaissance = $paysDeNaissance;
    
        return $this;
    }

    /**
     * Get paysDeNaissance
     *
     * @return string 
     */
    public function getPaysDeNaissance()
    {
        return $this->paysDeNaissance;
    }

    /**
     * Set depDeNaissance
     *
     * @param string $depDeNaissance
     * @return Personne
     */
    public function setDepDeNaissance($depDeNaissance)
    {
        $this->depDeNaissance = $depDeNaissance;
    
        return $this;
    }

    /**
     * Get depDeNaissance
     *
     * @return string 
     */
    public function getDepDeNaissance()
    {
        return $this->depDeNaissance;
    }
}
