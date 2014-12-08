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
	 * @OneToMany(targetEntity="DossierDeSuivi", inversedBy="commentaires")
	 */
	protected $commentaires;
	
	/**
	 * @ManyToMany(targetEntity="Question", mappedBy="questions")
	 */
	protected $questions;
	
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
	
	public function getCommentaires()
    {
        return $this->commentaires;
    }
	
	public function setCommentaires($commentaires)
    {
        $this->commentaires = $commentaires;
    
        return $this;
    }

}
