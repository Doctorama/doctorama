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
    
    public function import_csvAction($file)
    {
    	$ligne = 2; // compteur de ligne
		$fic = fopen($file, "a+");
		while($tab=fgetcsv($fic,1024,';'))
		{
			$champs = count($tab);//nombre de champ dans la ligne en question	
			echo "<b> Les " . $champs . " champs de la ligne " . $ligne . " sont :</b><br />";
			$ligne ++;
			//affichage de chaque champ de la ligne en question
			for($i=0; $i<$champs; $i ++)
			{
				echo $tab[$i] . "<br />";
			}
		}
    }
    
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
    
    public function importCsvAction(Request $request)
    {
        return $this->render('DTDoctoramaBundle:Doctorama:import_csv.html.twig', array('title' => 'Importation fichier CSV'));
    }
}
