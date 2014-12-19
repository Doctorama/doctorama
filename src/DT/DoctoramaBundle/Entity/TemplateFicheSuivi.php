<?php

namespace DT\DoctoramaBundle\Entity;
require_once __DIR__ . '/Question.php';
require_once __DIR__ . '/Fiche.php';

use Doctrine\ORM\Mapping as ORM;
/**
 * TemplateFicheSuivi
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="DT\DoctoramaBundle\Repository\TemplateRepository")
 */
class TemplateFicheSuivi
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
	* @var integer
	*
	* @ORM\Column(name="version", type="integer")
	**/
	private $version;
	
	/**
	 * @ORM\ManyToOne(targetEntity="DossierDeSuivi", inversedBy="templatesFicheSuivi")
	 */
	//protected $dossierDeSuivi;
	
	/**
	* @ORM\OneToMany(targetEntity="Fiche", mappedBy="templatesFicheSuivi")
	**/
	private $fiche;
	
	/**
	 * @ORM\ManyToMany(targetEntity="Question", inversedBy="templateFicheSuivis")
	 */
	protected $questions;
	
	public function __construct() {
        $this->questions = new \Doctrine\Common\Collections\ArrayCollection();
		$this->fiche = new \Doctrine\Common\Collections\ArrayCollection();
    }
	
	public function getFiche(){
		return $this->fiche;
	}
	
	public function addFiche($fiche){
		if(!$this->fiche->contains($fiche)){
			$this->items[] = ($fiche);
		}
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
     * @return TemplateFicheSuivi
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
	
	public function getVersion(){
		return $this->version;
	}
	
	public function setVersion($version){
		$this->version = $version;
		return $this;
	}
	/**
	* Get questions
	*
	* @return Question
	**/
	public function getQuestions(){
		return $this->questions;
	}
	
	/**
	* Add questions
	*
	* @param Question $question
	**/
	public function addQuestions($question){
		if(!$this->questions->contains($question)){
			$this->questions[] = ($question);
		}
	}
	
	/**
	* Get dossierDeSuivi
	*
	* @return DossierDeSuivi
	**/
	/*public function getDossierDeSuivi()
    {
        return $this->dossierDeSuivi;
    }*/
	
	/**
	* Set dossierDeSuivi
	*
	* @param DossierDeSuivi $dossierSuivi
	* @return DossierDeSuivi
	*/
	/*public function setDossierDeSuivi($dossierSuivi)
    {
		$this->dossierDeSuivi = $dossierSuivi;
		$dossierSuivi->addTemplateFicheSuivi($this);
		return $this;
    }*/

}
