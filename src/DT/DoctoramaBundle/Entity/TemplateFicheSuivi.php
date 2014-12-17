<?php

namespace DT\DoctoramaBundle\Entity;
require_once __DIR__ . '/Question.php';
require_once __DIR__ . '/DossierDeSuivi.php';

use Doctrine\ORM\Mapping as ORM;

/**
 * TemplateFicheSuivi
 *
 * @ORM\Table()
 * @ORM\Entity
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
	 * @ORM\ManyToOne(targetEntity="DossierDeSuivi", inversedBy="templatesFicheSuivi")
	 */
	protected $dossierDeSuivi;
	
	/**
	 * @ORM\ManyToMany(targetEntity="Question", inversedBy="templateFicheSuivis")
	 */
	protected $questions;
	
	public function __construct() {
        $this->questions = new \Doctrine\Common\Collections\ArrayCollection();
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
	public function getDossierDeSuivi()
    {
        return $this->dossierDeSuivi;
    }
	
	/**
	* Set dossierDeSuivi
	*
	* @param DossierDeSuivi $dossierSuivi
	* @return DossierDeSuivi
	*/
	public function setDossierDeSuivi($dossierSuivi)
    {
		$this->dossierDeSuivi = $dossierSuivi;
		$dossierSuivi->addTemplateFicheSuivi($this);
		return $this;
    }

}
