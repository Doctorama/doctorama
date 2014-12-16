<?php

namespace DT\SecurityBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

use DT\DoctoramaBundle\Entity\Doctorant;
use DT\DoctoramaBundle\Entity\DirecteurDeThese;
use DT\DoctoramaBundle\Entity\Encadrant;

/**
 * @ORM\Entity
 * @ORM\Table(name="Compte")
 */
class Compte extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function __construct()
    {
        $this->directeur=null;
        $this->doctorant=null;
        $this->encadrant=null;
        
        parent::__construct();
        // your own logic
    }
    
    /**
     * @ORM\OneToOne(targetEntity="DT\DoctoramaBundle\Entity\Doctorant", inversedBy="compte")
     * @ORM\JoinColumn(name="doctorant_id", referencedColumnName="id")
     **/
    private $doctorant;
    
    /**
     * @ORM\OneToOne(targetEntity="DT\DoctoramaBundle\Entity\Encadrant", inversedBy="compte")
     * @ORM\JoinColumn(name="encadrant_id", referencedColumnName="id")
     **/
    private $encadrant;
    
    /**
     * @ORM\OneToOne(targetEntity="DT\DoctoramaBundle\Entity\DirecteurDeLaboratoire", inversedBy="compte")
     * @ORM\JoinColumn(name="directeur_id", referencedColumnName="id")
     **/
    private $directeur;
    
    
    function getDoctorant() {
        return $this->doctorant;
    }

    function getEncadrant() {
        return $this->encadrant;
    }

    function getDirecteur() {
        return $this->directeur;
    }

    function setDoctorant($doctorant) {
        $this->doctorant = $doctorant;
        return $this;
    }

    function setEncadrant($encadrant) {
        $this->encadrant = $encadrant;
        return $this;
    }

    function setDirecteur($directeur) {
        $this->directeur = $directeur;
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
    
    /* overide getRoles function */
    public function getRoles()
    {
        $roles = array();
        
        //si c'est un encadrant
        if($this->encadrant != null)
        {
            array_push($roles, "ROLE_ENCADRANT");
        }
        
        //si c'est un doctorant
        if($this->doctorant != null)
        {
            array_push($roles, "ROLE_DOCTORANT");
        }
        
        //si c'est un directeur
        if($this->directeur != null)
        {
            array_push($roles, "ROLE_DIRECTEUR");
        }
      
      // we need to make sure to have at least one role
      //$roles[] = "ROLE_ENCADRANT";

      return array_unique($roles);
    }
}
