<?php

// src/DT/DoctoramaBundle/Entity/Reponse.php

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
     * @ORM\ManyToOne(targetEntity="Question", inversedBy="questions", cascade={"persist", "merge"})
     * @ORM\JoinColumn(name="question_id", referencedColumnName="id")
     **/
	protected $question;

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

    /**
     * Set reponse
     *
     * @param integer $question
     * @return Question
     */
    public function setQuestion($question){
        return $this->question=$question;
    }

	/**
     * Get reponse
     *
     * @return integer 
     */
	public function getQuestion(){
		return $this->question;
	}
	
}
