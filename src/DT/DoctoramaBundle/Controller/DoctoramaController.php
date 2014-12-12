<?php

// src/DT/DoctoramaBundle/Controller/DoctoramaController.php;

namespace DT\DoctoramaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Response;
use DT\DoctoramaBundle\Entity\Doctorant;

use DT\DoctoramaBundle\Entity\Reunion;
use DT\DoctoramaBundle\Entity\Personne;
use \DateTime;
/**
 * Description of DoctoramaController
 *
 * @author benjamin
 */
class DoctoramaController extends Controller {
    
    public function mesDoctorantsAction(Request $request)
    {
        /*$user = $this->get('security.context')->getToken()->getUser();
        
        $theseRepository = $this->getDoctrine()->getRepository('DTDoctoramaBundle:These');
        $theses = $theseRepository->findBy(array('encadrants'=>$user->getId()));*/
        
        
        $DoctorantRepository = $this->getDoctrine()->getRepository('DTDoctoramaBundle:Doctorant');
        $listDoctorant = $DoctorantRepository->findAll();
        return $this->render('DTDoctoramaBundle:Doctorama:liste_doctorants_encadres.html.twig', array('title' => 'Liste des doctorants encadres', 'doctorants' =>$listDoctorant));
    }
    
    public function doctorantLaboAction(Request $request)
    {
        $DoctorantRepository = $this->getDoctrine()->getRepository('DTDoctoramaBundle:Doctorant');
        $listDoctorant = $DoctorantRepository->findAll();
        
        return $this->render('DTDoctoramaBundle:Doctorama:doctorant_labo.html.twig', array('title' => 'Doctorants du laboratoire', 'listDoctorant'=> $listDoctorant));
    }
    
    public function agendaAction(Request $request)
    {
        /* Toute les réunions : juste les dates(date début et fin) en json
         * + Renvoi réunion 7 prochain par ordre croissant normale*/
        $toutesLesReunions = array(
                array('date'=>new DateTime('2014-12-12 08:00:00'),'lieu'=>'Pascal 135'),
                array('date'=>new DateTime('2014-12-09 10:00:00'),'lieu'=>'MSI 223'),
                array('date'=>new DateTime('2014-12-25 14:00:00'),'lieu'=>'Pascal 300'),
                array('date'=>new DateTime('2014-12-27 10:00:00'),'lieu'=>'Pascal 400'),
                array('date'=>new DateTime('2014-12-30 11:00:00'),'lieu'=>'Pascal 666')
            );
        
        $personne1 = new Personne();
        $personne1->setNom("NEILZ");
        $personne1->setPrenom("Benjamin");
        
        $personne2 = new Personne();
        $personne2->setNom("FOURNIER");
        $personne2->setPrenom("Pierre");
        
        $personne3 = new Personne();
        $personne3->setNom("REVEL");
        $personne3->setPrenom("ARNAUD");
        
        $personne4 = new Personne();
        $personne4->setNom("BERTER");
        $personne4->setPrenom("Karel");
        
        
        $reunion1 = new Reunion;
        $reunion1->setDate(new DateTime('2014-12-12 08:00:00'));
        $reunion1->setLieu("Pascal 135");
        $reunion1->addPersonne($personne1);
        $reunion1->addPersonne($personne3);
        
        $reunion2 = new Reunion;
        $reunion2->setDate(new DateTime('2014-12-09 10:00:00'));
        $reunion2->setLieu("MSI 223");
        $reunion2->addPersonne($personne2);
        $reunion2->addPersonne($personne4);
        $reunions=array('1'=>$reunion1,'2'=>$reunion2);
        
        return $this->render('DTDoctoramaBundle:Doctorama:agenda.html.twig', array('title' => 'Agenda','reunions'=>$reunions, 'toutesLesReunions'=>$toutesLesReunions));
    }
    
    public function statistiquesAction(Request $request)
    {
        $encadrants = $this->getDoctrine()->getManager()->getRepository('DTDoctoramaBundle:Encadrant')->findAll();
        return $this->render('DTDoctoramaBundle:Doctorama:statistiques.html.twig', array('title' => 'Accueil','dureeMoyenne'=>2, 'encadrants'=>$encadrants));
    }
    
    public function historiqueDoctorantsAction(Request $request)
    {
        return new Response("La page Historique Doctoratns est en cours de construction :)");
    }
    
    public function indexAction(Request $request)
    {
        return $this->render('DTDoctoramaBundle::index.html.twig', array('title' => 'Accueil'));
    }
    
    public function adminDossierSuivisAction(Request $request)
    {
        return $this->render('DTDoctoramaBundle:Doctorama:admin_dossier.html.twig', array('title' => 'Dossier de suivis'));
    }
    
    public function creerDossierSuivisAction(Request $request)
    {
        return $this->render('DTDoctoramaBundle:Doctorama:creer_dossier.html.twig', array('title' => 'Créer dossier de suivis'));
    }
    
    public function modifDossierSuivisAction($id_doctorant, Request $request)
    {
        
        //il faudra charger les infos du doctorant concerné.
        return $this->render('DTDoctoramaBundle:Doctorama:modif_dossier.html.twig', array('title' => 'Modifier dossier de suivis'));
    }
    
    public function detailDoctorantAction($id_doctorant, Request $request)
    {
        $doctorant = $this->getDoctrine()->getManager()->find('DTDoctoramaBundle:Doctorant', 1);
        return $this->render('DTDoctoramaBundle:Doctorama:detail_doctorant.html.twig', array('title' => 'Detail du doctorant','doctorant'=>$doctorant));
    }

}