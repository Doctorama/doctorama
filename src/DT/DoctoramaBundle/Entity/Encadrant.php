<?php

namespace DT\DoctoramaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

require_once __DIR__ . '/Personne.php';
require_once __DIR__ . '/These.php';

/**
 * Encadrant
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Encadrant extends Personne{
	
        /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
	/**
     * @ORM\ManyToMany(targetEntity="These", mappedBy="encandrants")
     **/
    private $theses;

	public function __construct() {
        $this->theses = new \Doctrine\Common\Collections\ArrayCollection();
    }
	
	
	/**
     * Get theses
     *
     * @return These 
     */
	public function getThese(){
		return $this->theses;
	}
	
	/**
     * Get theses
     *
	 * @param $these
     * @return These 
     */
	public function setThese($these){
		$this->theses = $these;
		
		return $this;
	}
	
	/**
	* Add These
	*
	* @param
	**/
	public function addThese($these){
		if(!$this->theses->contains($these)){
			$this->theses[] = ($these);
		}
	}
	
}