<?php

namespace DT\DoctoramaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

require_once __DIR__ . '/Personne.php';
require_once __DIR__ . '/Doctorant.php';
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
     * @ORM\ManyToMany(targetEntity="Encadrant", inversedBy="reunions")
     **/
    private $encadrants;
    
    /**
     * @ORM\ManyToOne(targetEntity="Doctorant", inversedBy="reunions")
     * @ORM\JoinColumn(name="doctorant_id", referencedColumnName="id")
     **/
    private $doctorant;
	
	public function __construct(){
		$this->encadrants = new \Doctrine\Common\Collections\ArrayCollection();
	}
    
    
    /**
     * Get encadrants
     *
     * @return encadrant 
     */
    public function getEncadrants()
    {
        return $this->encadrants;
    }
    
    /**
     * add encadrant
     *
     * 
     */
    public function addEncadrant($encadrant)
    {
        if(!$this->encadrants->contains($encadrant)){
			$this->encadrants[] = ($encadrant);
                        
        }
    }
    
    /**
     * Get doctorant
     *
     * @return encadrant 
     */
    public function getDoctorant()
    {
        return $this->doctorant;
    }
    
    /**
     * add doctorant
     *
     * 
     */
    public function setDoctorant($doctorant)
    {
        $this->doctorant=$doctorant;
        
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
}
