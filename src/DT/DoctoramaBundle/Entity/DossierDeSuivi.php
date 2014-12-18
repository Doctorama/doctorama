<?php

namespace DT\DoctoramaBundle\Entity;
require_once __DIR__ . '/Fiche.php';

use Doctrine\ORM\Mapping as ORM;

/**
 * DossierDeSuivi
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class DossierDeSuivi
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
     * @ORM\Column(name="commentaires", type="string", length=255, nullable=true)
     */
    private $commentaires;
	
	/**
	 * @ORM\OneToMany(targetEntity="TemplateFicheSuivi", mappedBy="dossierDeSuivi")
	 */
	//protected $templatesFicheSuivi;
	
	/**
	* @ORM\OneToMany(targetEntity="Fiche", mappedBy="dossierDeSuivi")
	**/
	protected $fiches;
	
	/**
	 * @ORM\OneToOne(targetEntity="These")
	 */
	protected $these;
	
	public function __construct() {
        $this->titre = new \Doctrine\Common\Collections\ArrayCollection();
		//$this->templatesFicheSuivi = new \Doctrine\Common\Collections\ArrayCollection();
		$this->fiches = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set commentaires
     *
     * @param string $commentaires
     * @return DossierDeSuivi
     */
    public function setCommentaires($commentaires)
    {
        $this->commentaires = $commentaires;
    
        return $this;
    }

    /**
     * Get commentaires
     *
     * @return string 
     */
    public function getCommentaires()
    {
        return $this->commentaires;
    }
	
	/**
	* Get templateFicheSuivi
	*
	* @return TemplateFicheSuivi
	**/
	/*public function getTemplateFicheSuivi(){
		return $this->templatesFicheSuivi;
	}*/
	
	/**
	* Set templateFicheSuivi
	*
	* @param TemplateFicheSuivi $ficheSuivi
	* @return TemplateFicheSuivi
	**/
	/*public function addTemplateFicheSuivi($ficheSuivi){
		if(!$this->templatesFicheSuivi->contains($ficheSuivi)){
			//$ficheSuivi->addDossierDeSuivi($this);
			$this->items[] = ($ficheSuivi);
		}
		return $this;
	}*/
	
	public function getFiches(){
		return $this->fiches;
	}
	
	public function addFiche($fiche){
		if(!$this->fiches->contains($fiche)){
			$this->items[] = ($fiche);
		}
		return $this;
	}
	
	/**
	* Get these
	*
	* @return These
	**/
	public function getThese(){
		return $this->these;
	}
	
	/**
	* Set these
	*
	* @param These $these
	* @return These
	**/
	public function setThese($these){
		$this->these = $these;
		$these->setDossierDeSuivi($this);
		return $this;
	}

}
