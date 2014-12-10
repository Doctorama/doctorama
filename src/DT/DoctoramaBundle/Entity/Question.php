<?php

namespace DT\DoctoramaBundle\Entity;
require_once __DIR__ . '/Reponse.php';
require_once __DIR__ . '/TemplateFicheSuivi.php';

use Doctrine\ORM\Mapping as ORM;

/**
 * Question
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Question
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
     * @ORM\Column(name="question", type="string", length=255)
     */
    private $question;
	
	/**
	 * @ORM\ManyToMany(targetEntity="Reponse", mappedBy="questions")
	 */
	protected $reponses;
	
	/**
	 * @ORM\ManyToMany(targetEntity="TemplateFicheSuivi", inversedBy="questions")
	 * @ORM\JoinTable(name="Tem_Que")
	 */
	protected $templateFicheSuivis;
	
	public function __construct() {
        $this->reponses = new \Doctrine\Common\Collections\ArrayCollection();
		$this->templateFicheSuivis = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set question
     *
     * @param string $question
     * @return Question
     */
    public function setQuestion($question)
    {
        $this->question = $question;
    
        return $this;
    }

    /**
     * Get question
     *
     * @return string 
     */
    public function getQuestion()
    {
        return $this->question;
    }
	
	public function addReponse($reponse)
	{
	if(!$this->reponse->contains($reponse)){
       		$this->reponses[] = ($reponse); }
	}
	
	public function deleteReponse($reponse)
	{
		$this->reponses->removeElement($reponse);
	}
	
	public function getReponses(){
		return $this->reponses;
	}
	
	public function setReponses($reponse){
		return $this->reponses = $reponse;
	}
	
	public function getTitre(){
		return $this->templateFicheSuivis;
	}
	
	public function setTitre($ficheSuivi){
		return $this->templateFicheSuivis = $ficheSuivi;
	}
	
	public function addTitre($ficheSuivi){
		if($this->templateFicheSuivis->contains($ficheSuivi)){
			$ficheSuivi->addQuestions($this);
			$this->templateFicheSuivis[] = ($ficheSuivi);
		}
	}
}