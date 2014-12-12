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
        $user = $this->get('security.context')->getToken()->getUser();
        
        //si c'est une connexion fait grâce à un utilisateur issu de l'objet compte
        $listDoctorants = array();
        if(method_exists($user,'getDoctorant'))
        {
            $theseRepository = $this->getDoctrine()->getRepository('DTDoctoramaBundle:These');
            $theses = $theseRepository->findByEncadrant($user->getEncadrant()->getId());
            
            foreach($theses as $these)
            {
                array_push($listDoctorants, $these->getDoctorant());
            }
            
        }
        
        else
        {
            $doctorantRepository = $this->getDoctrine()->getRepository('DTDoctoramaBundle:Doctorant');
            $listDoctorants=$doctorantRepository->findAll();
        }
        
        return $this->render('DTDoctoramaBundle:Doctorama:liste_doctorants_encadres.html.twig', array('title' => 'Liste des doctorants encadres', 'doctorants' => $listDoctorants));
    }
	
	public function ficheSuiviExportAction(Request $request)
    {
        return $this->render('DTDoctoramaBundle:Doctorama:fiche_suivi_export.html.twig');
    }
    
    public function doctorantLaboAction(Request $request)
    {
        $DoctorantRepository = $this->getDoctrine()->getRepository('DTDoctoramaBundle:Doctorant');
        $listDoctorant = $DoctorantRepository->findAll();
        $TheseRepository = $this->getDoctrine()->getRepository('DTDoctoramaBundle:These');
		$listThese = array(sizeof($listDoctorant));
		for($i=0; $i<sizeof($listDoctorant); $i++){
			$these = $TheseRepository->findById($listDoctorant[$i]->getId());
			$listDoctorant[$i]->setThese($these[0]);
		}
        return $this->render('DTDoctoramaBundle:Doctorama:doctorant_labo.html.twig', array('title' => 'Doctorants du laboratoire', 'listDoctorant'=> $listDoctorant));
    }
    
    public function agendaAction(Request $request)
    {
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
        
        return $this->render('DTDoctoramaBundle:Doctorama:agenda.html.twig', array('title' => 'Agenda','reunions'=>$reunions));
    }
    
    public function statistiquesAction(Request $request)
    {
		$EncadrantRepository = $this->getDoctrine()->getRepository('DTDoctoramaBundle:Encadrant');
        $listEncadrant = $EncadrantRepository->findAll();
        return $this->render('DTDoctoramaBundle:Doctorama:statistiques.html.twig', array('title' => 'Statistiques',
			'dureeMoyenne'=>'40 mois',
			'encadrants'=> $listEncadrant
		));
    }
    
    public function historiqueDoctorantsAction(Request $request)
    {
        // return new Response("La page Historique Doctoratns est en cours de construction :)");
        $DoctorantRepository = $this->getDoctrine()->getRepository('DTDoctoramaBundle:Doctorant');
            $doctorants = $DoctorantRepository->findAll();
         return $this->render('DTDoctoramaBundle:Doctorama:historique.html.twig', array('title' => 'Historique des doctorants','listDoctorant'=>$doctorants));
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
	
    public function detailDoctorantAction(Request $request, $id_doctorant)
    {
		$DoctorantRepository = $this->getDoctrine()->getRepository('DTDoctoramaBundle:Doctorant');
        $Doctorant = $DoctorantRepository->findById($id_doctorant);
		$EncadrantRepository = $this->getDoctrine()->getRepository('DTDoctoramaBundle:Encadrant');
        $listEncadrant = $EncadrantRepository->findAll();
        return $this->render('DTDoctoramaBundle:Doctorama:detail_doctorant.html.twig', array(
			'title'=>'Détails',
			//'doctorant'=>$Doctorant[0],
			'titre' => 'Detail du doctorant', 
			'doctorant'=>array('nom'=> $Doctorant[0]->getNom(), 'prenom'=>$Doctorant[0]->getPrenom()),
			'titreThese'=>'titre',
			'directeur'=>'dirlo',
			'encadrantsDoctorant'=>$listEncadrant,
			'axe_thematique'=>'thematique',
			'axe_scientifique'=>'scientifique',
			'financement'=>'financement',
			'date_inscription'=>'premiere',
			'date_fin'=>'fin prévue',
			'dcace'=>'dcace',
			'formation'=>'formation',
			'universite'=>'univ',
			'sujetMaster'=>'sujetMaster',
			'laboratoire'=>'labo',
			'encadrantsMaster'=>array(
				array(
					'nom'=>'Totomaster','prenom'=>'Titimaster'
				),
				array(
					'nom'=>'Tatamaster','prenom'=>'Tutumaster'
				)
			),
			'fiche'=>array(
				array('question'=>'question1',
					'reponse'=>'reponse1'
				),array('question'=>'question2',
					'reponse'=>'reponse2'
				),array('question'=>'question3',
					'reponse'=>'reponse3'
				),
			),
		));
    }

    public function creationDossierAction(Request $request)
    {
        $requete = $this->get('request');
        if($requete->getMethod() == 'POST')
        {  
            extract ($_POST);
            //$nom_doct = htmlentities(str_replace('"','\"',$_POST['nom_doct']));

            $em = $this->getDoctrine();;

            $doctorant = new Doctorant();
            $doctorant->setNom($nom_doct);
            $doctorant->setPrenom($prenom_doct);
            $doctorant->setDCACE($dcace);
            $doctorant->setDateInscr1eThese($date_1er);

            $doctorant->setNomFormationMaster($nom_mast);
            $doctorant->setUniversiteMaster($univ);
            $doctorant->setSujetMaster($sujet_mast);
            $doctorant->setLaboratoireAcceuilMaster($labo_acc);
            $doctorant->setEncadrantsMaster($enc_mast);

            $em->persist($doctorant);
            
            
            $theseRepository = $this->getDoctrine()->getRepository('DTDoctoramaBundle:These');

            $these = new These();
            $these->setSujetThese($sujet_th);
            $these->setAxeThematique($axe_th);
            $these->setAxeScientifique($axe_sc);
            $these->setFinancement($finance);

            $serviceEnc = new EncadrantService($em);

            for($i=0; $i<sizeof($enc_th); $i++)
            {
                $nomEnc = explode(" ", $enc_th[$i]);
                $encadrant = $serviceEnc->findEncadrantByNomEtPrenom($nomEnc[1], $nomEnc[0]);
                $these->addEncadrant($encadrant);
            }

            $em->persist($these);

            $DossierSuiviRepository = $this->getDoctrine()->getRepository('DTDoctoramaBundle:DossierDeSuivi');

            $dossierDeSuivi = new DossierDeSuivi();
            $dossierDeSuivi->setThese($these);

            $em->persist($dossierDeSuivi);
            $em->flush();

        }

        return $this->render('DTDoctoramaBundle:Doctorama:creer_dossier.html.twig', array('title' => 'Créer dossier de suivis'));
    }

}
