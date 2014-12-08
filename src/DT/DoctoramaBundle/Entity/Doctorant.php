<?php

namespace DT\DoctoramaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

require_once __DIR__ . '/Personne.php';

/**
 * Doctorant
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Doctorant extends Personne
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
     * @var integer
     *
     * @ORM\Column(name="numEtudiant", type="integer")
     */
    private $numEtudiant;

    /**
     * @var integer
     *
     * @ORM\Column(name="bourseEtExoneration", type="integer")
     */
    private $bourseEtExoneration;

    /**
     * @var string
     *
     * @ORM\Column(name="dateInscr1eThese", type="string")
     */
    private $dateInscr1eThese;

    /**
     * @var string
     *
     * @ORM\Column(name="DCACE", type="string", length=255)
     */
    private $DCACE;

    /**
     * @var string
     *
     * @ORM\Column(name="nomFormationMaster", type="string", length=255)
     */
    private $nomFormationMaster;

    /**
     * @var string
     *
     * @ORM\Column(name="universiteMaster", type="string", length=255)
     */
    private $universiteMaster;

    /**
     * @var string
     *
     * @ORM\Column(name="sujetMaster", type="string", length=255)
     */
    private $sujetMaster;

    /**
     * @var string
     *
     * @ORM\Column(name="laboratoireAcceuilMaster", type="string", length=255)
     */
    private $laboratoireAcceuilMaster;

    /**
     * @var string
     *
     * @ORM\Column(name="encadrantsMaster", type="string", length=255)
     */
    private $encadrantsMaster;

    /**
     * @var string
     *
     * @ORM\Column(name="etabDernierDiplome", type="string", length=255)
     */
    private $etabDernierDiplome;

    /**
     * @var string
     *
     * @ORM\Column(name="depDernierDiplome", type="string", length=255)
     */
    private $depDernierDiplome;

    /**
     * @var string
     *
     * @ORM\Column(name="paysDernierDiplome", type="string", length=255)
     */
    private $paysDernierDiplome;

    /**
     * @var string
     *
     * @ORM\Column(name="libelleDernierDiplome", type="string", length=255)
     */
    private $libelleDernierDiplome;

    /**
     * @var string
     *
     * @ORM\Column(name="anneeDernierDiplome", type="string", length=255)
     */
    private $anneeDernierDiplome;


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
     * Set numEtudiant
     *
     * @param integer $numEtudiant
     * @return Doctorant
     */
    public function setNumEtudiant($numEtudiant)
    {
        $this->numEtudiant = $numEtudiant;
    
        return $this;
    }

    /**
     * Get numEtudiant
     *
     * @return integer 
     */
    public function getNumEtudiant()
    {
        return $this->numEtudiant;
    }

    /**
     * Set bourseEtExoneration
     *
     * @param integer $bourseEtExoneration
     * @return Doctorant
     */
    public function setBourseEtExoneration($bourseEtExoneration)
    {
        $this->bourseEtExoneration = $bourseEtExoneration;
    
        return $this;
    }

    /**
     * Get bourseEtExoneration
     *
     * @return integer 
     */
    public function getBourseEtExoneration()
    {
        return $this->bourseEtExoneration;
    }

    /**
     * Set dateInscr1eThese
     *
     * @param string $dateInscr1eThese
     * @return Doctorant
     */
    public function setDateInscr1eThese($dateInscr1eThese)
    {
        $this->dateInscr1eThese = $dateInscr1eThese;
    
        return $this;
    }

    /**
     * Get dateInscr1eThese
     *
     * @return string 
     */
    public function getDateInscr1eThese()
    {
        return $this->dateInscr1eThese;
    }

    /**
     * Set DCACE
     *
     * @param string $dCACE
     * @return Doctorant
     */
    public function setDCACE($dCACE)
    {
        $this->DCACE = $dCACE;
    
        return $this;
    }

    /**
     * Get DCACE
     *
     * @return string 
     */
    public function getDCACE()
    {
        return $this->DCACE;
    }

    /**
     * Set nomFormationMaster
     *
     * @param string $nomFormationMaster
     * @return Doctorant
     */
    public function setNomFormationMaster($nomFormationMaster)
    {
        $this->nomFormationMaster = $nomFormationMaster;
    
        return $this;
    }

    /**
     * Get nomFormationMaster
     *
     * @return string 
     */
    public function getNomFormationMaster()
    {
        return $this->nomFormationMaster;
    }

    /**
     * Set universiteMaster
     *
     * @param string $universiteMaster
     * @return Doctorant
     */
    public function setUniversiteMaster($universiteMaster)
    {
        $this->universiteMaster = $universiteMaster;
    
        return $this;
    }

    /**
     * Get universiteMaster
     *
     * @return string 
     */
    public function getUniversiteMaster()
    {
        return $this->universiteMaster;
    }

    /**
     * Set sujetMaster
     *
     * @param string $sujetMaster
     * @return Doctorant
     */
    public function setSujetMaster($sujetMaster)
    {
        $this->sujetMaster = $sujetMaster;
    
        return $this;
    }

    /**
     * Get sujetMaster
     *
     * @return string 
     */
    public function getSujetMaster()
    {
        return $this->sujetMaster;
    }

    /**
     * Set laboratoireAcceuilMaster
     *
     * @param string $laboratoireAcceuilMaster
     * @return Doctorant
     */
    public function setLaboratoireAcceuilMaster($laboratoireAcceuilMaster)
    {
        $this->laboratoireAcceuilMaster = $laboratoireAcceuilMaster;
    
        return $this;
    }

    /**
     * Get laboratoireAcceuilMaster
     *
     * @return string 
     */
    public function getLaboratoireAcceuilMaster()
    {
        return $this->laboratoireAcceuilMaster;
    }

    /**
     * Set encadrantsMaster
     *
     * @param string $encadrantsMaster
     * @return Doctorant
     */
    public function setEncadrantsMaster($encadrantsMaster)
    {
        $this->encadrantsMaster = $encadrantsMaster;
    
        return $this;
    }

    /**
     * Get encadrantsMaster
     *
     * @return string 
     */
    public function getEncadrantsMaster()
    {
        return $this->encadrantsMaster;
    }

    /**
     * Set etabDernierDiplome
     *
     * @param string $etabDernierDiplome
     * @return Doctorant
     */
    public function setEtabDernierDiplome($etabDernierDiplome)
    {
        $this->etabDernierDiplome = $etabDernierDiplome;
    
        return $this;
    }

    /**
     * Get etabDernierDiplome
     *
     * @return string 
     */
    public function getEtabDernierDiplome()
    {
        return $this->etabDernierDiplome;
    }

    /**
     * Set depDernierDiplome
     *
     * @param string $depDernierDiplome
     * @return Doctorant
     */
    public function setDepDernierDiplome($depDernierDiplome)
    {
        $this->depDernierDiplome = $depDernierDiplome;
    
        return $this;
    }

    /**
     * Get depDernierDiplome
     *
     * @return string 
     */
    public function getDepDernierDiplome()
    {
        return $this->depDernierDiplome;
    }

    /**
     * Set paysDernierDiplome
     *
     * @param string $paysDernierDiplome
     * @return Doctorant
     */
    public function setPaysDernierDiplome($paysDernierDiplome)
    {
        $this->paysDernierDiplome = $paysDernierDiplome;
    
        return $this;
    }

    /**
     * Get paysDernierDiplome
     *
     * @return string 
     */
    public function getPaysDernierDiplome()
    {
        return $this->paysDernierDiplome;
    }

    /**
     * Set libelleDernierDiplome
     *
     * @param string $libelleDernierDiplome
     * @return Doctorant
     */
    public function setLibelleDernierDiplome($libelleDernierDiplome)
    {
        $this->libelleDernierDiplome = $libelleDernierDiplome;
    
        return $this;
    }

    /**
     * Get libelleDernierDiplome
     *
     * @return string 
     */
    public function getLibelleDernierDiplome()
    {
        return $this->libelleDernierDiplome;
    }

    /**
     * Set anneeDernierDiplome
     *
     * @param string $anneeDernierDiplome
     * @return Doctorant
     */
    public function setAnneeDernierDiplome($anneeDernierDiplome)
    {
        $this->anneeDernierDiplome = $anneeDernierDiplome;
    
        return $this;
    }

    /**
     * Get anneeDernierDiplome
     *
     * @return string 
     */
    public function getAnneeDernierDiplome()
    {
        return $this->anneeDernierDiplome;
    }
}
