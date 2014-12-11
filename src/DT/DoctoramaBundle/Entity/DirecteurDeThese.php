<?php

namespace DT\DoctoramaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use DT\SecurityBundle\Entity\Compte;

require_once __DIR__ . '/Encadrant.php';

/**
 * DirecteurDeThese
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class DirecteurDeThese extends Encadrant{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\OneToOne(targetEntity="DT\SecurityBundle\Entity\Compte", mappedBy="directeur")
     **/
    private $compte;
    
    
    function getId() {
        return $this->id;
    }

    function getCompte() {
        return $this->compte;
    }

    function setId($id) {
        $this->id = $id;
        return $this;
    }

    function setCompte($compte) {
        $this->compte = $compte;
        return $this;
    }


}