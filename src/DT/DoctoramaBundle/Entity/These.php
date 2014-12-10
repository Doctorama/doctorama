<?php

namespace DT\DoctoramaBundle\Entity;
require_once __DIR__ . '/DossierDeSuivi.php';
require_once __DIR__ . '/Encadrant.php';
require_once __DIR__ . '/Doctorant.php';

use Doctrine\ORM\Mapping as ORM;

/**
 * These
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class These
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
     * @ORM\Column(name="titreThese", type="string", length=255)
     */
    private $titreThese;
	
    /**
     * @var string
     *
     * @ORM\Column(name="sujetThese", type="string", length=255)
     */
    private $sujetThese;

    /**
     * @var string
     *
     * @ORM\Column(name="specialite", type="string", length=255)
     */
    private $specialite;

    /**
     * @var string
     *
     * @ORM\Column(name="laboratoire", type="string", length=255)
     */
    private $laboratoire;

    /**
     * @var string
     *
     * @ORM\Column(name="axeThematique", type="string", length=255)
     */
    private $axeThematique;

    /**
     * @var string
     *
     * @ORM\Column(name="axeScientifique", type="string", length=255)
     */
    private $axeScientifique;

    /**
     * @var integer
     *
     * @ORM\Column(name="financement", type="integer")
     */
    private $financement;

    /**
     * @var \datetime
     *
     * @ORM\Column(name="dateDebut", type="date")
     */
    private $dateDebut;

    /**
     * @var \datetime
     *
     * @ORM\Column(name="dateDeSoutenance", type="date")
     */
    private $dateDeSoutenance;

    /**
     * @var string
     *
     * @ORM\Column(name="mention", type="string", length=255)
     */
    private $mention;
	
	/**
	 * @ORM\OneToOne(targetEntity="DossierDeSuivi")
	 */
	protected $dossierdesuivi;
	
	/**
	*
	* @ORM\ManyToMany(targetEntity="Encadrant", inversedBy="theses")
	*/
	protected $encadrants;
	
	/**
	 * @ORM\OneToOne(targetEntity="Doctorant")
	 */
	protected $doctorant;
	
	public function __construct() {
        $this->encadrants = new \Doctrine\Common\Collections\ArrayCollection();
    }
	
	/**
	 * @ORM\ManyToMany(targetEntity="DossierDeSuivi", inversedBy="theses")
	 */
	protected $doctorants;
	
	public function getDoctorant(){
		return $this->doctorant;
	}
	
	public function setDoctorant($doctorant){
		$this->doctorant = $doctorant;
		
		return $this;
	}
	
	/**
     * Get encadrant
     *
     * @return Encadrant 
     */
	public function getEncadrant(){
		return $this->encadrants;
	}
	
	/**
     * Get encadrant
     *
	 * @param Encadrant $encadrant
     * @return These 
     */
	public function setEncadrant($encadrant){
		$this->encadrants = $encadrant;
		
		return $this;
	}
	
	/**
	* Add encradrant
	*
	* @param Encadrant $encadrant
	**/
	public function addEncadrant($encadrant){
		if(!$this->encadrants->contains($encadrant)){
			$encadrant->addThese($this);
			$this->theses[] = ($encadrant);
		}
	}
	
	/**
     * Get dossierDeSuivi
     *
     * @return DossierDeSuivi 
     */
	public function getDossierDeSuivi(){
		return $this->dossierDeSuivi;
	}
	
	/**
     * Get dossierDeSuivi
     *
	 * @param DossierDeSuivi $dossierDeSuivi
     * @return DossierDeSuivi 
     */
	public function setDossierDeSuivi($dossierDeSuivi){
		$this->dossierDeSuivi = $dossierDeSuivi;
		
		return $this;
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
     * Set titreThese
     *
     * @param string $titreThese
     * @return These
     */
    public function setTitreThese($titreThese)
    {
        $this->titreThese = $titreThese;
    
        return $this;
    }

    /**
     * Get titreThese
     *
     * @return string 
     */
    public function getTitreThese()
    {
        return $this->titreThese;
    }

    /**
     * Set sujetThese
     *
     * @param string $sujetThese
     * @return These
     */
    public function setSujetThese($sujetThese)
    {
        $this->sujetThese = $sujetThese;
    
        return $this;
    }

    /**
     * Get sujetThese
     *
     * @return string 
     */
    public function getSujetThese()
    {
        return $this->sujetThese;
    }

    /**
     * Set specialite
     *
     * @param string $specialite
     * @return These
     */
    public function setSpecialite($specialite)
    {
        $this->specialite = $specialite;
    
        return $this;
    }

    /**
     * Get specialite
     *
     * @return string 
     */
    public function getSpecialite()
    {
        return $this->specialite;
    }

    /**
     * Set laboratoire
     *
     * @param string $laboratoire
     * @return These
     */
    public function setLaboratoire($laboratoire)
    {
        $this->laboratoire = $laboratoire;
    
        return $this;
    }

    /**
     * Get laboratoire
     *
     * @return string 
     */
    public function getLaboratoire()
    {
        return $this->laboratoire;
    }

    /**
     * Set axeThematique
     *
     * @param string $axeThematique
     * @return These
     */
    public function setAxeThematique($axeThematique)
    {
        $this->axeThematique = $axeThematique;
    
        return $this;
    }

    /**
     * Get axeThematique
     *
     * @return string 
     */
    public function getAxeThematique()
    {
        return $this->axeThematique;
    }

    /**
     * Set axeScientifique
     *
     * @param string $axeScientifique
     * @return These
     */
    public function setAxeScientifique($axeScientifique)
    {
        $this->axeScientifique = $axeScientifique;
    
        return $this;
    }

    /**
     * Get axeScientifique
     *
     * @return string 
     */
    public function getAxeScientifique()
    {
        return $this->axeScientifique;
    }

    /**
     * Set financement
     *
     * @param \integer $financement
     * @return These
     */
    public function setFinancement($financement)
    {
        $this->financement = $financement;
    
        return $this;
    }

    /**
     * Get financement
     *
     * @return \integer
     */
    public function getFinancement()
    {
        return $this->financement;
    }

    /**
     * Set dateDebut
     *
     * @param \datetime $dateDebut
     * @return These
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;
    
        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \datetime 
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set dateDeSoutenance
     *
     * @param \datetime $dateDeSoutenance
     * @return These
     */
    public function setDateDeSoutenance($dateDeSoutenance)
    {
        $this->dateDeSoutenance = $dateDeSoutenance;
    
        return $this;
    }

    /**
     * Get dateDeSoutenance
     *
     * @return \datetime 
     */
    public function getDateDeSoutenance()
    {
        return $this->dateDeSoutenance;
    }

    /**
     * Set mention
     *
     * @param string $mention
     * @return These
     */
    public function setMention($mention)
    {
        $this->mention = $mention;
    
        return $this;
    }

    /**
     * Get mention
     *
     * @return string 
     */
    public function getMention()
    {
        return $this->mention;
    }
	

}
