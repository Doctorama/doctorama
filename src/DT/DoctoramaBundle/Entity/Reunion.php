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
     * @var datetime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;
	
	/**
	* @var string
	*
	* @ORM\Column(name="libelle", type="string", length=255)
	**/
	private $libelle;

    /**
     * @ORM\ManyToMany(targetEntity="Personne", mappedBy="reunions")
     * @ORM\JoinTable(name="per_reu")
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
     * @param \datetime $date
     * @return Reunion
     */
    public function setDate(\datetime $date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \datetime 
     */
    public function getDate()
    {
        return $this->date;
    }
	
	/**
	* Get libelle
	*
	* @return Libelle
	**/
	public function getLibelle(){
		return $this->libelle;
	}
	
	/**
	* Set libelle
	*
	* @param string $libelle
	* @return Reunion
	**/
	public function setLibelle($libelle){
		$this->libelle = $libelle;
		return $this;
	}
	
    /**
	* Get personnes
	*
	* @return ArrayCollection Personne
	**/
    public function getPersonnes()
    {
        return $this->personnes;
    }
	
	/**
	* Add personne
	*
	* @param Personne $personne
	**/
	public function addPersonne($personne)
	{
		if(!$this->personnes->contains($personne)){
			$personne->addReunion($this);
       		$this->personnes[] = ($personne);
		}
	}
	
	/**
	* Delete personne
	*
	* @param Personne $personne
	*/
	public function deletePersonne($personne)
	{
       	$this->personnes->removeElement($personne);
	}
	
}
