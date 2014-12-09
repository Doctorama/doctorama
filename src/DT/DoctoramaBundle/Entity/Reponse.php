<?php

namespace DT\DoctoramaBundle\Entity;
require_once __DIR__ . '/Question.php';

use Doctrine\ORM\Mapping as ORM;

/**
 * Reponse
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Reponse
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
     * @ORM\Column(name="reponse", type="string", length=255)
     */
    private $reponse;

	/**
	 * @ORM\ManyToMany(targetEntity="Question", inversedBy="reponses")
	 * @ORM\JoinTable(name="Que_rep")
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
     * Set reponse
     *
     * @param string $reponse
     * @return Reponse
     */
    public function setReponse($reponse)
    {
        $this->reponse = $reponse;
    
        return $this;
    }

    /**
     * Get reponse
     *
     * @return string 
     */
    public function getReponse()
    {
        return $this->reponse;
    }
	
	public function addQuestion($question)
	{
		if(!$this->questions->contains($question)){
			$reponse->addReponse($this);
       		$this->questions[] = ($question); 
		}
	}
	
	public function deleteQuestion($question)
	{
		$this->questions->removeElement($question);
	}
	
	public function getQuestions(){
		return $this->questions;
	}
	
	public function setQuestions($question){
		return $this->questions = $question;
	}
}
