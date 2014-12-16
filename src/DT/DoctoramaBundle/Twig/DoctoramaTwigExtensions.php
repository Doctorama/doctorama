<?php

// src/DT/DoctoramaBundle/Twig/TwigExtension.php
namespace DT\DoctoramaBundle\Twig;
/**
 * Description of TwigExtensions
 *
 * @author benjamin
 */
class DoctoramaTwigExtensions extends \Twig_Extension{
    
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('progressionDoctorant', array($this, 'progressionDoctorantFilter')),
        );
    }
    

    public function progressionDoctorantFilter($dateDebut, $dateFin )
    {
        //echo "<script>alert(\" : progressionDoctorantFilter \")</script>";
        /*$today = date("m.d.y");
        $tempsEcoule = $today->diff($dateDebut->format("m.d.y"));*/
        $tempsTotal = $dateFin->diff($dateDebut);
        //var_dump($tempsTotal);
        //echo "<script>alert(\" dateDebut :".$dateDebut->format("d/M/Y")."Date fin : ".$dateFin->format("d/M/Y").".tempsTotal : ".$tempsTotal->format('%d')." \")</script>";
        //$resultat = $tempsEcoule/$tempsTotal;
        //var_dump($resultat);
        
        return 150;
    }

    public function getName()
    {
        return 'doctorama_twig_extensions';
    }
}
