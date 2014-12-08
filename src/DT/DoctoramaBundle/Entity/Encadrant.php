<?php

namespace DT\DoctoramaBundle\Entity;
require_once __DIR__ . '/../Entity/Personne.php';
use Doctrine\ORM\Mapping as ORM;

/**
 * Encadrant
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Encadrant extends Personne
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
}
