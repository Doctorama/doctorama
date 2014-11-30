<?php

// src/DT/UserBundle/Controller/UserController.php;

namespace DT\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Response;
/**
 * Description of UserController
 *
 * @author benjamin
 */
class UserController extends Controller {
    
    
    public function mesDoctorantsAction(Request $request)
    {
        return $this->render('DTUserBundle:User:mesDoctorants.html.twig');
    }
    
    public function doctorantLaboAction(Request $request)
    {
        return $this->render('DTUserBundle:User:doctorant_labo.html.twig', array('title' => 'Doctorants du laboratoire'));
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
        return $this->render('DTUserBundle::index.html.twig', array('title' => 'Accueil'));
    }
    
}
