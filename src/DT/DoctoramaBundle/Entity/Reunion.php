<?php

namespace DT\DoctoramaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

require_once __DIR__ . '/Personne.php';

/**
 * Reunion
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Reunion
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
     * @ORM\Column(name="lieu", type="string", length=255)
     */
    private $lieu;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="date", type="DateTime")
     */
    private $date;

	/**
     * @ManyToMany(targetEntity="Personne", inversedBy="reunions")
     * @JoinTable(name="per_reu")
     **/
    private $personnes;

	public function __construct() {
        $this->personnes = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set lieu
     *
     * @param string $lieu
     * @return Reunion
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;

        return $this;
    }

    /**
     * Get lieu
     *
     * @return string 
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Reunion
     */
    public function setDate(\DateTime $date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }
    
    public function getPersonnes()
    {
        return $this->personnes;
    }
    
    public function setPersonnes($personnes)
    {
    	$this->personnes = $personnes;
    	
        return $this;
    }

	public function addPersonne($personne)
	{
		if(!$this->personnes->contains($personne)){
			$personne->addReunion($this);
       		$this->personnes[] = ($personne);
		}
	}

	public function deletePersonne($personne)
	{
       	$this->personnes->removeElement($personne);
	}
}
