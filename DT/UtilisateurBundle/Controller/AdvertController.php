<?php

namespace DT\UtilisateurBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdvertController extends Controller
{
    public function indexAction()
    {
    	#$content = $this->get('templating')->render('DTUtilisateurBundle:Advert:index.html.twig', array('nom' => 'Pierre'));
        return new Response("lol");
    }
    public function viewAction($id)
    {
    	return new Response("Paramètre : ".$id);
    }
    
    public function viewSlugAction($slug, $year, $_format)
    {
    	return new Response("Annonce au slug '".$slug."', créée en ".$year." et au format ".$_format.".");
    }
}
