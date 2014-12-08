<?php

namespace DT\SecurityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Response;

class SecurityController extends Controller
{
    public function indexAction()
    {
    	#$content = $this->get('templating')->render('DTUtilisateurBundle:Advert:index.html.twig', array('nom' => 'Pierre'));
        return new Response("Vous êtes connecté");
    }
    
    public function loginAction(Request $request)
    {
      // Si le visiteur est déjà identifié, on le redirige vers l'accueil
      if ($this->get('security.context')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
        return $this->redirect($this->generateUrl('dt_doctorama_accueil'));
      }

      $session = $request->getSession();

      // On vérifie s'il y a des erreurs d'une précédente soumission du formulaire
      if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
        $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
      } else {
        $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
        $session->remove(SecurityContext::AUTHENTICATION_ERROR);
      }

      return $this->render('DTSecurityBundle::login.html.twig', array(
        // Valeur du précédent nom d'utilisateur entré par l'internaute
        'last_username' => $session->get(SecurityContext::LAST_USERNAME),
        'error'         => $error
      ));
    }

}
