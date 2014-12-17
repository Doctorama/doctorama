<?php

// src/DT/DoctoramaBundle/Controller/DoctoramaController.php;

namespace DT\DoctoramaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Response;
use DT\DoctoramaBundle\Entity\Doctorant;
use DT\DoctoramaBundle\Services\EncadrantService;
use DT\DoctoramaBundle\Entity\Reunion;
use DT\DoctoramaBundle\Entity\Personne;
use DT\DoctoramaBundle\Entity\These;
use DT\DoctoramaBundle\Entity\DossierDeSuivi;
use DT\DoctoramaBundle\Form\DoctorantType;
use DT\DoctoramaBundle\Form\TheseType;
use DT\DoctoramaBundle\Form\ReunionType;
use DT\DoctoramaBundle\Form\EncadrantType;
use \DateTime;

/**
 * Description of DoctoramaController
 *
 * @author benjamin
 */
class DoctoramaController extends Controller {

    public function exportFicheAction(Request $request) {
        $typeExport = htmlentities(str_replace('"', '\"', $_POST['export']));
        if (!strcmp($typeExport, "CSV") || !strcmp($typeExport, "PDF")) {
            $response = new Response();
            if (!strcmp($typeExport, "PDF")) {
                $response->headers->set('Content-Type', 'application/pdf');
            } elseif (!strcmp($typeExport, "CSV")) {
                $response->headers->set('Content-Type', 'text/csv');
                $response->headers->set('Content-disposition', 'attachment;filename=' . $_GET['nom'] . ' ' . $_POST['ficheLabel'] . '.csv');
            }
            return $this->render('DTDoctoramaBundle:Doctorama:fiche_suivi_export.html.php', array('title' => 'Export fichier ' . $typeExport, 'export' => $typeExport), $response);
        } else {
            return $this->render('DTDoctoramaBundle:Doctorama:detail_doctorant.html.twig', array('title' => 'Erreur export'));
        }
    }

    public function mesDoctorantsAction(Request $request) {
        $user = $this->get('security.context')->getToken()->getUser();

        //si c'est une connexion fait grâce à un utilisateur issu de l'objet compte
        $listDoctorants = array();
        if (method_exists($user, 'getEncadrant')) {
            /* $theseRepository = $this->getDoctrine()->getRepository('DTDoctoramaBundle:These');
              $theses = $theseRepository->findByEncadrant($user->getEncadrant()->getId());

              foreach($theses as $these)
              {
              array_push($listDoctorants, $these->getDoctorant());
              } */

            $listDoctorants = $this->getDoctrine()->getRepository('DTDoctoramaBundle:Doctorant')->theseNonArchivee($user->getEncadrant()->getId());
        } else {
            $doctorantRepository = $this->getDoctrine()->getRepository('DTDoctoramaBundle:Doctorant');
            $listDoctorants = $doctorantRepository->findAll();
        }

        return $this->render('DTDoctoramaBundle:Doctorama:liste_doctorants_encadres.html.twig', array('title' => 'Liste des doctorants encadres', 'doctorants' => $listDoctorants));
    }

    public function ficheSuiviExportAction(Request $request) {
        return $this->render('DTDoctoramaBundle:Doctorama:fiche_suivi_export.html.twig');
    }

    public function doctorantLaboAction(Request $request) {
        $DoctorantRepository = $this->getDoctrine()->getRepository('DTDoctoramaBundle:Doctorant');
        $listDoctorant = $DoctorantRepository->theseNonArchivee();
        $TheseRepository = $this->getDoctrine()->getRepository('DTDoctoramaBundle:These');
        $listThese = array(sizeof($listDoctorant));
        for ($i = 0; $i < sizeof($listDoctorant); $i++) {

            $these = $TheseRepository->findById($listDoctorant[$i]->getId());
            if (isset($these[0]))
                $listDoctorant[$i]->setThese($these[0]);
        }
        return $this->render('DTDoctoramaBundle:Doctorama:doctorant_labo.html.twig', array('title' => 'Doctorants du laboratoire', 'listDoctorant' => $listDoctorant));
    }

    
    public function agendaAction(Request $request)
    {
         $user = $this->get('security.context')->getToken()->getUser();
        if(method_exists($user,'getEncadrant'))
        {
            $reu = $user->getEncadrant()->getReunions();

        }
        else if(method_exists($user, 'getDoctorant'))
        {
            $reu=$user->getDoctorant()->getReunions();
        }
        else
        {
            $reunionRepository = $this->getDoctrine()->getManager()->getRepository('DTDoctoramaBundle:Reunion');
            $reu=$reunionRepository->findAll();
        }
        
        foreach ($reu as $reunion) 
        {
            $pers[] = array('nom'=>$reunion->getDoctorant()->getNom(),
                    'prenom'=>$reunion->getDoctorant()->getPrenom());

            foreach ($reunion->getEncadrants() as $personnes) {
                $pers[] = array('nom'=>$personnes->getNom(),
                    'prenom'=>$personnes->getPrenom());
            }
            
            $reunions[]=array(
                    'reunion'=>$reunion, 
                    'participants'=>$pers);

            $event[]=array(
                    'start'=>$reunion->getDate()->format('Y-m-d H:i:s'),
                    'title'=>$reunion->getLieu());
        }


        if (!$fp = fopen("../../mydate.php", 'w+')) {
            echo "Echec de l'ouverture du fichier";
            exit;
        } else {
            fwrite($fp, "<?php echo '" . json_encode($event) . "';");
            fclose($fp);
        }

        // var_dump($reunions);


        return $this->render('DTDoctoramaBundle:Doctorama:agenda.html.twig', array('title' => 'Agenda','reunions'=>$reunions));


        
    }
    
    public function statistiquesAction(Request $request)
    {
	$EncadrantRepository = $this->getDoctrine()->getRepository('DTDoctoramaBundle:Encadrant');

        $listEncadrant = $EncadrantRepository->findAll();
        return $this->render('DTDoctoramaBundle:Doctorama:statistiques.html.twig', array('title' => 'Statistiques',
                    'dureeMoyenne' => '40 mois',
                    'encadrants' => $listEncadrant
        ));
    }

    public function historiqueDoctorantsAction(Request $request) {
        // return new Response("La page Historique Doctoratns est en cours de construction :)");
        $DoctorantRepository = $this->getDoctrine()->getRepository('DTDoctoramaBundle:Doctorant');
        $doctorants = $DoctorantRepository->theseArchivee();
        return $this->render('DTDoctoramaBundle:Doctorama:historique.html.twig', array('title' => 'Historique des doctorants', 'listDoctorant' => $doctorants));
    }

    public function indexAction(Request $request) {
        return $this->render('DTDoctoramaBundle::index.html.twig', array('title' => 'Accueil'));
    }

    public function adminDossierSuivisAction(Request $request) {
        return $this->render('DTDoctoramaBundle:Doctorama:admin_dossier.html.twig', array('title' => 'Dossier de suivis'));
    }

    public function adminUtilisateurAction(Request $request) {
        return $this->render('DTDoctoramaBundle:Doctorama:admin_utilisateur.html.twig', array('title' => 'Gestion des utilisateurs'));
    }

    public function persisterDossierSuivis($doctorant) {
        $em = $this->getDoctrine()->getManager();

        foreach ($doctorant->getThese()->getEncadrants() as $encadrant) {
            $encadrant->addThese($doctorant->getThese());

            $em->persist($encadrant);
        }

        foreach ($doctorant->getThese()->getDirecteursDeThese() as $directeur) {
            $directeur->addThesesDirecteur($doctorant->getThese());

            $em->persist($directeur);
        }

        $em->persist($doctorant->getThese());
        $em->persist($doctorant);
        $em->flush();
    }

    public function creerDossierSuivisAction(Request $request) {
        $doctorant = new Doctorant();

        $formDoctorant = $this->createForm(new DoctorantType(true), $doctorant);
        $formDoctorant->add('Enregistrer', 'submit');

        $formDoctorant->handleRequest($request);


        if ($formDoctorant->isValid()) {


            $this->persisterDossierSuivis($doctorant);

            $request->getSession()->getFlashBag()->add('notice', 'Dossier bien crée.');


            return $this->redirect($this->generateUrl('dt_doctorama_doctorant_labo'));
        }
        return $this->render('DTDoctoramaBundle:Doctorama:creer_dossier.html.twig', array('title' => 'Créer dossier de suivis', 'formDoctorant' => $formDoctorant->createView()));
    }

    public function modifDossierSuivisAction($id_doctorant, Request $request) {
        $doctorant = $this->getDoctrine()->getManager()->find('DTDoctoramaBundle:Doctorant', $id_doctorant);
        $formDoctorant = $this->createForm(new DoctorantType(true), $doctorant, array('method' => 'PUT'));

        $formDoctorant->add('Enregistrer', 'submit');

        $formDoctorant->handleRequest($request);

        if ($formDoctorant->isValid()) {

            $this->persisterDossierSuivis($doctorant);

            $request->getSession()->getFlashBag()->add('notice', 'Le dossier a bien était modifié.');

            // On redirige vers la page de visualisation de l'annonce nouvellement créée
            return $this->redirect($this->generateUrl('dt_detail_doctorant', array('id_doctorant' => $id_doctorant)));
        }

        return $this->render('DTDoctoramaBundle:Doctorama:modif_dossier.html.twig', array('title' => 'Modifier dossier de suivis', 'formDoctorant' => $formDoctorant->createView()));
    }

	
    public function detailDoctorantAction(Request $request, $id_doctorant)
	{
		$doctorant = $this->getDoctrine()->getManager()->find('DTDoctoramaBundle:Doctorant', $id_doctorant);
		$formDoctorant = $this->createForm(new DoctorantType(true), $doctorant, array('method' => 'GET','read_only'=>true));
		$em = $this->getDoctrine()->getManager();
		$reponses = array();
		$fiches = array();
		foreach($doctorant->getReunions() as $reunion){
			$templateFicheSuivi = $doctorant->getThese()->getDossierDeSuivi()->getTemplateFicheSuivi();
			$fiches[$reunion->getLibelle()] = array(
				'label'=>$reunion->getLibelle(),
				'date_reunion'=>$reunion->getDate()->format('m/d/Y'),
				'questions'=>array()
			);
			foreach($templateFicheSuivi as $template){
				foreach($template->getQuestions() as $question){
					$query = $em->createQuery("SELECT r FROM DTDoctoramaBundle:Reponse r WHERE r.question= :id")->setParameter('id',$question->getId());
					$fiche = $query->getResult();
					$reponse = $query->getResult();
					array_push($fiches[$reunion->getLibelle()]['questions'], array(
						'question' => $question->getQuestion(),
						'reponse' => $reponse[0]->getReponse(),
					));
				}
			}
		}
		return $this->render('DTDoctoramaBundle:Doctorama:detail_doctorant.html.twig', array(
				'title' => 'Détails du doctorant',
				'formDoctorant' => $formDoctorant->createView(),
				'doctorant' => $doctorant,
				'fiches' => $fiches,
			)
		);
	}

    public function creationDossierAction(Request $request) {

        /* $requete = $this->get('request');
          if($requete->getMethod() == 'POST')
          {
          extract ($_POST);
          //$nom_doct = htmlentities(str_replace('"','\"',$_POST['nom_doct']));

          $em = $this->getDoctrine()->getManager();

          $doctorant = new Doctorant();
          $doctorant->setNom($nom_doct);
          $doctorant->setPrenom($prenom_doct);
          $doctorant->setMail("email@enDurDansLeControleur.com");
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
          $these->setTitreThese("Titre de la these en dur dans le controleur");
          $these->setSujetThese($sujet_th);
          $these->setAxeThematique($axe_th);
          $these->setAxeScientifique($axe_sc);
          $these->setFinancement($finance);

          $serviceEnc = new EncadrantService($em);

          //for($i=0; $i<sizeof($enc_th); $i++)
          //{
          //    $nomEnc = explode(" ", $enc_th[$i]);
          //    $encadrant = $serviceEnc->findEncadrantByNomEtPrenom($nomEnc[1], $nomEnc[0]);
          //    $these->addEncadrant($encadrant);
          //}


          $em->persist($these);

          $DossierSuiviRepository = $this->getDoctrine()->getRepository('DTDoctoramaBundle:DossierDeSuivi');

          $dossierDeSuivi = new DossierDeSuivi();
          $dossierDeSuivi->setThese($these);
          $em->persist($dossierDeSuivi);
          $em->flush();

          }

          return $this->render('DTDoctoramaBundle:Doctorama:creer_dossier.html.twig', array('title' => 'Créer dossier de suivis')); */
    }

    public function infoPersoAction(Request $request) {
        $user = $this->getUser();

        //si c'est un encadrant
        if (method_exists($user, 'getEncadrant') && $user->getEncadrant() != null) {

            $encadrant = $user->getEncadrant();
            $formEncadrant = $this->createForm(new EncadrantType(), $encadrant, array('method' => 'PUT'));
            $formEncadrant->add('Enregistrer', 'submit');

            $formEncadrant->handleRequest($request);

            if ($formEncadrant->isValid()) {

                $em->persist($encadrant);
                $em->flush();

                $request->getSession()->getFlashBag()->add('notice', 'Informations bien enregistrées.');

                // On redirige vers la page de visualisation de l'annonce nouvellement créée
                return $this->redirect($this->generateUrl('dt_doctorama_accueil', array('title' => 'Accueil')));
            }

            return $this->render('DTDoctoramaBundle:Doctorama:infos_perso.html.twig', array('title' => 'Informations Personnelles', 'form' => $formEncadrant->createView()));
        }

        //si c'est un doctorant
        elseif (method_exists($user, 'getDoctorant') && $user->getDoctorant() != null) {
            
            $doctorant = $user->getDoctorant();
            $formDoctorant = $this->createForm(new DoctorantType(false), $doctorant, array('method' => 'PUT'));
            $formDoctorant->add('Enregistrer', 'submit');

            $formDoctorant->handleRequest($request);

            if ($formDoctorant->isValid()) {

                $em->persist($doctorant);
                $em->flush();

                $request->getSession()->getFlashBag()->add('notice', 'Informations bien enregistrées.');

                // On redirige vers la page de visualisation de l'annonce nouvellement créée
                return $this->redirect($this->generateUrl('dt_doctorama_accueil', array('title' => 'Accueil')));
            }

            return $this->render('DTDoctoramaBundle:Doctorama:infos_perso.html.twig', array('title' => 'Informations Personnelles', 'form' => $formDoctorant->createView()));
        }

        return $this->redirect($this->generateUrl('dt_doctorama_accueil', array('title' => 'Accueil')));
    }

    public function importCsvAction(Request $request) {
        return $this->render('DTDoctoramaBundle:Doctorama:import_csv.html.twig', array('title' => 'Importation fichier CSV'));
    }

    public function parseCsvAction(Request $request) {
        $reponse;

        $uploads_dir = "bundles/doctorama/uploads/";

        $tmp_name = $_FILES["file"]["tmp_name"];
        $name = $_FILES["file"]["name"];

        if (move_uploaded_file($tmp_name, "$uploads_dir/$name")) {
            //$reponse = 'Upload effectué avec succès pour le fichier '; 
        } else {
            //$reponse = 'Echec de l\'upload. '; 
        }

        $ligne = 1; // compteur de ligne
        $fic = fopen("$uploads_dir/$name", "a+");
        while ($tab = fgetcsv($fic, 1024, ';')) {
            $champs = count($tab); //nombre de champ dans la ligne en question	
            //affichage de chaque champ de la ligne en question
            if ($ligne > 1) {
                for ($i = 0; $i < $champs; $i ++) {
                    $reponse = $reponse . $tab[$i] . "<br />";
                }
            }
            $ligne ++;
        }

        return new Response($reponse);
    }

    public function modifReunionAction(Request $request) {

        $reunion = new Reunion();
        $formReunion = $this->createForm(new ReunionType(), $reunion);
        $formReunion->add('save', 'submit');
        // On fait le lien Requête <-> Formulaire
        // À partir de maintenant, la variable $advert contient les valeurs entrées dans le formulaire par le visiteur
        $formReunion->handleRequest($request);

        // On vérifie que les valeurs entrées sont correctes
        // (Nous verrons la validation des objets en détail dans le prochain chapitre)
        if ($formReunion->isValid()) {

            // On l'enregistre notre objet $advert dans la base de données, par exemple
            $em = $this->getDoctrine()->getManager();
            $em->persist($reunion);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Reunion modifié.');

            // On redirige vers la page de visualisation de l'annonce nouvellement créée
            return $this->redirect($this->generateUrl('dt_doctorama_doctorant_labo'));
        }
        return $this->render('DTDoctoramaBundle:Doctorama:modif_reunion.html.twig', array('title' => 'Modification Reunion', 'formReunion' => $formReunion->createView()));
    }



        public function creationReunionAction(Request $request){

       $reunion = new Reunion();

        $formReunion = $this->createForm(new ReunionType(), $reunion);
        $formReunion->add('save',      'submit');
        // On fait le lien Requête <-> Formulaire
        // À partir de maintenant, la variable $advert contient les valeurs entrées dans le formulaire par le visiteur
        $formReunion->handleRequest($request);
            
        // On vérifie que les valeurs entrées sont correctes
        // (Nous verrons la validation des objets en détail dans le prochain chapitre)
        if ($formReunion->isValid()) {
        
            // On l'enregistre notre objet $advert dans la base de données, par exemple
            $em = $this->getDoctrine()->getManager();
            $em->persist($reunion);
            $em->flush();

          $request->getSession()->getFlashBag()->add('notice', 'Reunion crée');

          // On redirige vers la page de visualisation de l'annonce nouvellement créée
          return $this->redirect($this->generateUrl('dt_doctorama_agenda'));
        }
        return $this->render('DTDoctoramaBundle:Doctorama:creation_reunion.html.twig', array('title' => 'Creation reunion','formReunion' => $formReunion->createView()));
    }

}
