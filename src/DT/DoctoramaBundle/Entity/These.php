<?php

namespace DT\DoctoramaBundle\Entity;
require_once __DIR__ . '/DossierDeSuivi.php';
require_once __DIR__ . '/Encadrant.php';

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
	 * @OneToOne(targetEntity="DossierDeSuivi")
	 */
	protected $dossierdesuivi
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
     * @var int
     *
     * @ORM\Column(name="financement", type="int")
     */
    private $financement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDebut", type="date")
     */
    private $dateDebut;

    /**
     * @var \DateTime
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
     * @param \int $financement
     * @return These
     */
    public function setFinancement(\int $financement)
    {
        $this->financement = $financement;
    
        return $this;
    }

    /**
     * Get financement
     *
     * @return \int 
     */
    public function getFinancement()
    {
        return $this->financement;
    }

    /**
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
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
     * @return \DateTime 
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set dateDeSoutenance
     *
     * @param \DateTime $dateDeSoutenance
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
     * @return \DateTime 
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
