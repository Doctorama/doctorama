<?php

namespace DT\DoctoramaBundle\Entity;
require_once __DIR__ . '/TemplateFicheSuivi.php';

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
     * @ORM\Column(name="commentaires", type="string", length=255)
     */
    private $commentaires;
	
	/**
	 * @ORM\OneToOne(targetEntity="TemplateFicheSuivi")
	 */
	protected $templateFicheSuivi;
	
	/**
	 * @ORM\OneToOne(targetEntity="These")
	 */
	protected $these;
	
	public function __construct() {
        $this->titre = new \Doctrine\Common\Collections\ArrayCollection();
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
	
	public function getTemplateFicheSuivi(){
		return $this->templateFicheSuivi;
	}
	
	public function setTemplateFicheSuivi($ficheSuivi){
		return $this->templateFicheSuivi = $ficheSuivi;
	}
	
	public function getThese(){
		return $this->these;
	}
	
	public function setThese($these){
		$this->these = $these;
		$these->setDossierDeSuivi($this);
		return $this;
	}

}
