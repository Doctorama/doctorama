<?php

namespace DT\DoctoramaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
}