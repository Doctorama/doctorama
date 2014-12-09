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
	 * @ORM\OneToMany(targetEntity="DossierDeSuivi", inversedBy="titre")
	 */
	protected $commentaires;
	
	/**
	 * @ORM\ManyToMany(targetEntity="Question", mappedBy="titre")
	 */
	protected $questions;
	
	public function __construct() {
        $this->questions = new \Doctrine\Common\Collections\ArrayCollection();
    }
	
	public function __construct() {
        $this->commentaires = new \Doctrine\Common\Collections\ArrayCollection();
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
	
	public function getQuestions(){
		return $this->questions;
	}
	
	public function setQuestions($question){
		return $this->questions = $question;
	}
	
	public function addQuestions($question){
		if($this->questions->contains($question)){
			$this->questions[] = ($question);
		}
	}
	
	
	public function getCommentaires()
    {
        return $this->commentaires;
    }
	
	public function setCommentaires($commentaires)
    {
        $this->commentaires = $commentaires;
    
        return $this;
    }
	
	public function addCommentaires($commentaire){
		if(!$this->commentaires->contains($commentaire)){
			$commantaire->addTitre($this);
			$this->commentaires[] = ($commentaire);
		}
	}

}
