<?php

namespace DT\DoctoramaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use DT\SecurityBundle\Entity\Compte;

require_once __DIR__ . '/Personne.php';
require_once __DIR__ . '/These.php';

/**
 * Encadrant
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Encadrant extends Personne {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToMany(targetEntity="These", inversedBy="encandrants")
     * */
    private $theses;

    /**
     * @ORM\ManyToMany(targetEntity="These", inversedBy="directeursDeThese")
     * @ORM\JoinTable(name="directeur_these")
     * */
    private $thesesDirecteur;

    public function __construct() {
        $this->reunions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->theses = new \Doctrine\Common\Collections\ArrayCollection();
        $this->thesesDirecteur = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @ORM\OneToOne(targetEntity="DT\SecurityBundle\Entity\Compte", mappedBy="encadrant")
     * */
    private $compte;

    /**
     * @ORM\ManyToMany(targetEntity="Reunion", mappedBy="encandrants")
     * */
    private $reunions;

    /**
     * Get reunions
     *
     * @return reunion[] 
     */
    public function getReunions() {
        return $this->reunions;
    }

    /**
     * add encadrant
     *
     * 
     */
    public function addReunion($reunion) {
        if (!$this->reunions > contains($reunion)) {
            $reunion->addEncadrant($this);
            $this->items[] = $reunion;
        }

        return $this;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    function getId() {
        return $this->id;
    }

    /**
     * Set id
     *
     * @param id $id
     * @return id
     * */
    function setId($id) {
        $this->id = $id;
        return $this;
    }

    function getCompte() {
        return $this->compte;
    }

    function setCompte($compte) {
        $this->compte = $compte;
        return $this;
    }

    /**
     * Get theses
     *
     * @return ArrayCollection These
     * */
    function getTheses() {
        return $this->theses;
    }

    /**
     * Get theses
     *
     * @return These 
     */
    public function getThese() {
        return $this->theses;
    }

    /**
     * Add These
     *
     * @param These $these
     * */
    public function addThese($these) {
        if (!$this->theses->contains($these)) {
            $this->theses[] = ($these);
        }
    }

    /**
     * Get thesesDirecteur
     *
     * @return ArrayCollection ThesesDirecteur
     */
    public function getThesesDirecteur() {
        return $this->thesesDirecteur;
    }

    /**
     * Add thesesDirecteur
     *
     * @param ThesesDirecteur $theseDirecteur
     * */
    public function addThesesDirecteur($thesedirecteur) {
        if (!$this->thesesDirecteur->contains($thesedirecteur)) {
            $this->thesesDirecteur[] = ($thesedirecteur);
        }
    }

}
