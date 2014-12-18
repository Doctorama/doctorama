<?php

namespace DT\DoctoramaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fiche
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Fiche
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
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;
	
	/**
	* @ORM\ManyToOne(targetEntity="TemplateFicheSuivi", inversedBy="fiche")
	**/
	private $templatesFicheSuivi;
	
	/**
	* @ORM\ManyToOne(targetEntity="DossierDeSuivi", inversedBy="fiche")
	**/
	private $dossierDeSuivis;
	
	public function getTemplatesFicheSuivi(){
		return $this->templatesFicheSuivi;
	}
	
	public function setTemplatesFicheSuivi($template)
    {
		$this->templatesFicheSuivi = $template;
		$template->addFiche($this); //a changer
		return $this;
    }
	
	public function getDossierDeSuivis(){
		return $this->dossierDeSuivis;
	}
	
	public function setDossierDeSuivis($dossier)
    {
		$this->dossierDeSuivis = $dossier;
		$dossier->addFiche($this); //a changer
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
     * Set titre
     *
     * @param string $titre
     * @return Fiche
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    
        return $this;
    }

    /**
     * Get titre
     *
     * @return string 
     */
    public function getTitre()
    {
        return $this->titre;
    }
}
