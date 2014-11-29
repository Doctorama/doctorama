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
        return $this->render('DTUserBundle:User:doctorant_labo.html.php');
    }
}
