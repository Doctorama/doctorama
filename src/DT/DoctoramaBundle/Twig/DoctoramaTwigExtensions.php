<?php

// src/DT/DoctoramaBundle/Twig/TwigExtension.php
namespace DT\DoctoramaBundle\Twig;

class DoctoramaTwigExtensions extends \Twig_Extension{
    
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('progressionDoctorant', array($this, 'progressionDoctorantFilter')),
        );
    }
    
    function date_diff($date1, $date2) { 
        $s = strtotime($date2)-strtotime($date1); 
        $d = intval($s/86400);   
        return $d; 
    } 
    

    public function progressionDoctorantFilter($dateDebut, $dateFin )
    {
        if($dateDebut != null &&  $dateFin != null)
        {
            $today = new \DateTime('now');

            $intervalEcoule = date_diff($dateDebut,$today);
            $nbJoursEcoule = $intervalEcoule->format('%a');
            $intervalDebFin = date_diff($dateDebut,$dateFin);
            $nbJoursTotaux = $intervalDebFin->format('%a');
            
            return round(100*($nbJoursEcoule/$nbJoursTotaux));
        }
        

        
        return 0;
    }

    public function getName()
    {
        return 'doctorama_twig_extensions';
    }
}
