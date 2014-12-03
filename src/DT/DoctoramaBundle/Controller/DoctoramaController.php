<?php

// src/DT/DoctoramaBundle/Controller/DoctoramaController.php;

namespace DT\DoctoramaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Response;
/**
 * Description of DoctoramaController
 *
 * @author benjamin
 */
class DoctoramaController extends Controller {
    
    
    public function mesDoctorantsAction(Request $request)
    {
        return $this->render('DTDoctoramaBundle:Doctorama:mesDoctorants.html.twig');
    }
    
    public function doctorantLaboAction(Request $request)
    {
        return $this->render('DTDoctoramaBundle:Doctorama:doctorant_labo.html.twig', array('title' => 'Doctorants du laboratoire'));
    }
    
    public function agendaAction(Request $request)
    {
        return new Response("La page Agenda est en cours de construction :)");
    }
    
    public function statistiquesAction(Request $request)
    {
        return new Response("La page Statistiques est en cours de construction :)");
    }
    
    public function historiqueDoctorantsAction(Request $request)
    {
        return new Response("La page Historique Doctoratns est en cours de construction :)");
    }
    
    public function indexAction(Request $request)
    {
        return $this->render('DTDoctoramaBundle::index.html.twig', array('title' => 'Accueil'));
    }
    
    
    
}
