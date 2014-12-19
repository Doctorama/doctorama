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
use DT\SecurityBundle\Entity\Compte;
use DT\DoctoramaBundle\Entity\Encadrant;
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
        }elseif(!strcmp($typeExport, "Valider")){
			var_dump($_POST);
			$templateRepository = $this->getDoctrine()->getManager()->getRepository('DTDoctoramaBundle:TemplateFicheSuivi');
            $templates = $templateRepository->findByTitre($_POST['ficheId']);
			$template = null;
			$version = 0;
			foreach($templates as $t){
				if($t->getVersion() > $version){
					$template = $t;
				}
			}
			// foreach($template->getQuestions() as $question){
				// foreach($question->getReponses() as $reponse){
					
				// }
			// }
			// exit;
			return $this->render('DTDoctoramaBundle:Doctorama:detail_doctorant.html.twig', array('title' => 'Erreur export'));
		}else {
            return $this->render('DTDoctoramaBundle:Doctorama:detail_doctorant.html.twig', array('title' => 'Erreur export'));
        }
    }

    public function mesDoctorantsAction(Request $request) {
        $user = $this->get('security.context')->getToken()->getUser();

        //si c'est une connexion fait grâce à un utilisateur issu de l'objet compte
        $listDoctorants = array();
        if (method_exists($user, 'getEncadrant')) {

            $listDoctorants = $this->getDoctrine()->getRepository('DTDoctoramaBundle:Doctorant')->theseNonArchivee($user->getEncadrant()->getId());
        }

        return $this->render('DTDoctoramaBundle:Doctorama:liste_doctorants_encadres.html.twig', array('title' => 'Liste des doctorants encadrés', 'doctorants' => $listDoctorants));
    }

    public function ficheSuiviExportAction(Request $request) {
        return $this->render('DTDoctoramaBundle:Doctorama:fiche_suivi_export.html.twig');
    }

    public function doctorantLaboAction(Request $request) {
        $DoctorantRepository = $this->getDoctrine()->getRepository('DTDoctoramaBundle:Doctorant');
        $listDoctorant = $DoctorantRepository->theseNonArchivee();
        $TheseRepository = $this->getDoctrine()->getRepository('DTDoctoramaBundle:These');
        /* $listThese = array(sizeof($listDoctorant));
          for ($i = 0; $i < sizeof($listDoctorant); $i++) {

          $these = $TheseRepository->findById($listDoctorant[$i]->getId());
          if (isset($these[0]))
          $listDoctorant[$i]->setThese($these[0]);
          } */
        return $this->render('DTDoctoramaBundle:Doctorama:doctorant_labo.html.twig', array('title' => 'Doctorants du laboratoire', 'listDoctorant' => $listDoctorant));
    }

    public function agendaAction(Request $request) {
        $user = $this->get('security.context')->getToken()->getUser();
        if (method_exists($user, 'getEncadrant') && $user->getEncadrant() != null) {
            $reu = $user->getEncadrant()->getReunions();
        } else if (method_exists($user, 'getDoctorant') && $user->getDoctorant() != null) {
            $reu = $user->getDoctorant()->getReunions();
        } else {
            $reunionRepository = $this->getDoctrine()->getManager()->getRepository('DTDoctoramaBundle:Reunion');
            $reu = $reunionRepository->findAll();
        }
        $event = array();
        $reunions = array();
        foreach ($reu as $reunion) {
            $pers[] = array('nom' => $reunion->getDoctorant()->getNom(),
                'prenom' => $reunion->getDoctorant()->getPrenom());

            foreach ($reunion->getEncadrants() as $personnes) {
                $pers[] = array('nom' => $personnes->getNom(),
                    'prenom' => $personnes->getPrenom());
            }

            $reunions[] = array(
                'reunion' => $reunion,
                'participants' => $pers);

            $event[] = array(
                'start' => $reunion->getDate()->format('Y-m-d H:i:s'),
                'title' => $reunion->getLieu());
              $pers=array();
        }


        if (!$fp = fopen("../../mydate.php", 'w+')) {
            echo "Echec de l'ouverture du fichier";
            exit;
        } else {
            fwrite($fp, "<?php echo '" . json_encode($event) . "';");
            fclose($fp);
        }

        // var_dump($reunions);


        return $this->render('DTDoctoramaBundle:Doctorama:agenda.html.twig', array('title' => 'Agenda', 'reunions' => $reunions));
    }

    public function statistiquesAction(Request $request) {
        $theseRepository = $this->getDoctrine()->getRepository('DTDoctoramaBundle:These');
        $theses = $theseRepository->theseArchiveeAvecDates();
        $dureeMoyenneThese = 0;
        $nbThesesAbandonnees = 0;
        $pourcentageTheseReussi = 0;

        $EncadrantRepository = $this->getDoctrine()->getRepository('DTDoctoramaBundle:Encadrant');
        $listEncadrant = $EncadrantRepository->findAll();
        $encadrants = array();

        //s'il y a des theses
        if (sizeof($theses) > 0) {
            //pour chaque these
            foreach ($theses as $these) {
                //calcul moyenne
                $interval = date_diff($these->getDateDebut(), $these->getDateDeSoutenance());

                $tempsTotal = ($interval->format('%d') / 30) + $interval->format('%m') + 12 * $interval->format('%y');
                $dureeMoyenneThese = $dureeMoyenneThese + $tempsTotal;

                //si la thése est abandonnée
                if ($these->getMention() == '4') {
                    $nbThesesAbandonnees++;
                }
            }

            //calcul de la durée moyenne d'une these
            $dureeMoyenneThese = $dureeMoyenneThese / sizeof($theses);

            //pourcentage de these reussi
            $pourcentageTheseReussi = round(100 * (sizeof($theses) - $nbThesesAbandonnees) / sizeof($theses));

            //pour les encadrants
            $theseNonArchivees = $theseRepository->theseNonArchivee();
            foreach ($listEncadrant as $encadrant) {
                $thesesEncadrees = $theseRepository->theseNonArchivee($encadrant->getId());

                $pourcentageTheseEncadrees = round(100 * (sizeof($thesesEncadrees) / sizeof($theseNonArchivees)));

                array_push($encadrants, array('nom' => $encadrant->getNom(), 'prenom' => $encadrant->getPrenom(), 'progress' => $pourcentageTheseEncadrees));
            }
        }

        return $this->render('DTDoctoramaBundle:Doctorama:statistiques.html.twig', array('title' => 'Statistiques',
                    'dureeMoyenne' => $dureeMoyenneThese,
                    'encadrants' => $encadrants,
                    'pourcentageTheseReussi' => $pourcentageTheseReussi,
        ));
    }

    public function historiqueDoctorantsAction(Request $request) {
        // return new Response("La page Historique Doctoratns est en cours de construction :)");
        $DoctorantRepository = $this->getDoctrine()->getRepository('DTDoctoramaBundle:Doctorant');
        $doctorants = $DoctorantRepository->theseArchivee();
        return $this->render('DTDoctoramaBundle:Doctorama:historique.html.twig', array('title' => 'Historique des doctorants', 'listDoctorant' => $doctorants));
    }

    public function indexAction(Request $request) {
        //return $this->render('DTDoctoramaBundle::index.html.twig', array('title' => 'Agenda'));
        return $this->redirect($this->generateUrl('dt_doctorama_agenda'));
    }

    public function adminDossierSuivisAction(Request $request) {
        return $this->render('DTDoctoramaBundle:Doctorama:admin_dossier.html.twig', array('title' => 'Dossier de suivis'));
    }

    public function adminUtilisateurAction(Request $request) {
        $compteRepository = $this->getDoctrine()->getManager()->getRepository('DTSecurityBundle:Compte');
        $listeComptesActifs = $compteRepository->findAll();

        return $this->render('DTDoctoramaBundle:Doctorama:admin_utilisateur.html.twig', array('title' => 'Gestion des utilisateurs', 'comptesActifs' => $listeComptesActifs));
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
            
            //creation du compte associé
            $compte = new Compte();
            $compte->setUsername(substr($doctorant->getPrenom(),0, 1).substr($doctorant->getNom(),0, 5));
            $compte->setPlainPassword('1234');
            $compte->setEnabled(true);
            $compte->setEmail($doctorant->getMail());
            $compte->setDoctorant($doctorant);
            $this->getDoctrine()->getManager()->persist($compte);
            
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

    public function detailDoctorantAction(Request $request, $id_doctorant) {
        $doctorant = $this->getDoctrine()->getManager()->find('DTDoctoramaBundle:Doctorant', $id_doctorant);
        $formDoctorant = $this->createForm(new DoctorantType(true), $doctorant, array('method' => 'GET', 'read_only' => true));
        $em = $this->getDoctrine()->getManager();
        $reponses = array();
        $fiches = array();
        foreach ($doctorant->getReunions() as $reunion) {
            $templateFicheSuivi = $doctorant->getThese()->getDossierDeSuivi()->getTemplateFicheSuivi();
            $fiches[$reunion->getLibelle()] = array(
                'label' => $reunion->getLibelle(),
                'date_reunion' => $reunion->getDate()->format('m/d/Y'),
                'questions' => array()
            );
            foreach ($templateFicheSuivi as $template) {
                foreach ($template->getQuestions() as $question) {
                    $query = $em->createQuery("SELECT r FROM DTDoctoramaBundle:Reponse r WHERE r.question= :id")->setParameter('id', $question->getId());
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
                $em = $this->getDoctrine()->getManager();
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
        $tab_intitule = array();
        $list_doctorants = array();
        $em = $this->getDoctrine()->getManager();

        $uploads_dir = "bundles/doctorama/uploads/";
        $tmp_name = $_FILES["file"]["tmp_name"];
        $name = $_FILES["file"]["name"];
        if (move_uploaded_file($tmp_name, "$uploads_dir/$name")) {
            $ligne = 0; // compteur de ligne

            $fic = fopen("$uploads_dir/$name", "a+");
            while ($tab = fgetcsv($fic, 1024, ',')) {
                $j = 0; //Compteur remplissage ligne $list_doctorants
                //Création des enregistrements:
                $doctorant = new Doctorant();
                $these = new These();

                //nombre de champ dans la ligne en question
                $champs = count($tab);

                //Récupération des entités du fichier CSV dans un tableau
                if ($ligne == 0) {
                    for ($i = 0; $i < $champs; $i ++) {
                        $tab_intitule[$i] = $tab[$i];
                    }
                }

                //affichage de chaque champ de la ligne en question
                if ($ligne > 0) {
                    if (!$tab[0] == "") {
                        for ($i = 0; $i < $champs; $i ++) {
                            switch ($tab_intitule[$i]) {
                                case "Numéro Etudiant":
                                    //VéRIFIER SI ETUDIANT EXISTE DéJà//
                                    $doctorant->setNumEtudiant($tab[$i]);
                                    break;
                                case "Civilité (M./MME/MLLE)":
                                    $doctorant->setCivilite($tab[$i]);
                                    break;
                                case "Nom patronymique":
                                    $list_doctorants[$ligne][$j] = $tab[$i];
                                    $j++;
                                    $doctorant->setNom($tab[$i]);
                                    break;
                                case "Nom Marital":
                                    $doctorant->setNomUsage($tab[$i]);
                                    break;
                                case "Prénom":
                                    $list_doctorants[$ligne][$j] = $tab[$i];
                                    $j++;
                                    $doctorant->setPrenom($tab[$i]);
                                    break;
                                case "Date De Naissance":
                                    //On change le format de la date avant de l'insérer
                                    $list_doctorants[$ligne][$j] = $tab[$i];
                                    $j++;
                                    if (!$tab[$i] == "") {
                                        $arr = implode('-', array_reverse(explode('/', $tab[$i])));
                                        $doctorant->setDateDeNaissance(new \DateTime($arr));
                                    }
                                    break;
                                case "Pays Nationalité (libellé)":
                                    $doctorant->setNationalite($tab[$i]);
                                    break;
                                case "Lieu de naissance":
                                    $doctorant->setVilleDeNaissance($tab[$i]);
                                    break;
                                case "Pays Naissance (libellé)":
                                    $doctorant->setPaysDeNaissance($tab[$i]);
                                    break;
                                case "Département de naissance (libellé)":
                                    $doctorant->setDepDeNaissance($tab[$i]);
                                    break;
                                case "Etablissement (libellé)":
                                    $doctorant->setUniversiteMaster($tab[$i]);
                                    break;
                                case "Département (libellé)":
                                    $doctorant->setEtabDernierDiplome($tab[$i]);
                                    break;
                                case "Cadre F - Dernier diplôme.Pays (libellé)":
                                    $doctorant->setSujetMaster($tab[$i]);
                                    break;
                                case "Type (libellé)":
                                    break;
                                case "Diplôme":
                                    $doctorant->setLibelleDernierDiplome($tab[$i]);
                                    break;
                                case "Année":
                                    $doctorant->setAnneeDernierDiplome($tab[$i]);
                                    break;
                                case "Adresse 1":
                                    break;
                                case "Adresse 2":
                                    break;
                                case "Code postal":
                                    break;
                                case "Ville":
                                    break;
                                case "Adrese de l’étudiant.Pays (libellé)":
                                    $doctorant->setAdresse($tab[$i]);
                                    break;
                                case "E-mail perso":
                                    $doctorant->setMail($tab[$i]);
                                    break;
                                case "CROUS":
                                    break;
                                case "Numéro allocataire":
                                    break;
                                case "Echelon":
                                    break;
                                case "Exonération":
                                    $doctorant->setBourseEtExoneration($tab[$i]);
                                    break;
                                case "Sujet de la thèse":
                                    $list_doctorants[$ligne][$j] = $tab[$i];
                                    $j++;
                                    $these->setSujetThese($tab[$i]);
                                    break;
                                case "Specialite de la thèse":
                                    $list_doctorants[$ligne][$j] = $tab[$i];
                                    $j++;
                                    $these->setSpecialite($tab[$i]);
                                    break;
                                case "Laboratoire de la thèse (Lib long)":
                                    $these->setLaboratoire($tab[$i]);
                                    break;
                                case "Directeur de thèse":
                                    $query = $em->createQuery("SELECT dt FROM DTDoctoramaBundle:Encadrant dt WHERE dt.nom= :nom")->setParameter('nom', $tab[$i]);
                                    $encadrant = $query->getResult();
                                    //SI IL EXISTE PAS CRéER UN NOUVEAU//
                                    $these->setDirecteursDeThese($encadrant);
                                    break;
                                case "Collaboration Université":
                                    break;
                                case "Collaboration Responsable":
                                    break;
                                case "Financement de la thèse":
                                    $these->setFinancement($tab[$i]);
                                    break;
                                case "1er année insc these":
                                    $doctorant->setDateInscr1ethese($tab[$i]);
                                    break;
                                case "Date Soutenance":
                                    //On change le format de la date avant de l'insérer
                                    if (!$tab[$i] == "") {
                                        $arr = implode('-', array_reverse(explode('/', $tab[$i])));
                                        $these->setDateDeSoutenance(new \DateTime($arr));
                                    }
                                    break;
                                case "Identite":
                                    break;
                                case "Type jury (Pres/membre)":
                                    break;
                                case "Mention":
                                    switch ($tab[$i]) {
                                        case "Très honorable avec les félicitations du jury":
                                            $these->setMention("3");
                                            break;
                                        case "Très honorable":
                                            $these->setMention("2");
                                            break;
                                        case "Honorable":
                                            $these->setMention("1");
                                            break;
                                        case "Abandonnée":
                                            $these->setMention("4");
                                            break;
                                    }
                                    break;
                            }
                        }
                        $doctorant->setThese($these);
                        $em->persist($doctorant);
                        $em->persist($these);
                    }
                }
                $ligne ++;
            }
            $reponse = "Le fichier est Uploadé et enregistré dans la base de données";
        } else {
            $reponse = 'Echec de l\'upload du fichier CSV. ';
        }
        $em->flush();
        //var_dump($arr);
        //exit;
        return $this->render('DTDoctoramaBundle:Doctorama:upload_validate.html.twig', array('title' => 'Importation fichier CSV', 'list_doctorants' => $list_doctorants));
    }

    public function modifReunionAction($id_reunion, Request $request) {

        $reunion = $this->getDoctrine()->getManager()->find("DTDoctoramaBundle:Reunion", $id_reunion);

        $formReunion = $this->createForm(new ReunionType(), $reunion);
        $formReunion->add('save', 'submit');

        $formReunion->handleRequest($request);

        if ($formReunion->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($reunion);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Reunion modifié.');

            return $this->redirect($this->generateUrl('dt_doctorama_agenda'));
        }
        return $this->render('DTDoctoramaBundle:Doctorama:modif_reunion.html.twig', array('title' => 'Modification Reunion', 'formReunion' => $formReunion->createView()));
    }

    public function creationReunionAction(Request $request) {

        $reunion = new Reunion();

        $formReunion = $this->createForm(new ReunionType(), $reunion);
        $formReunion->add('save', 'submit');

        $formReunion->handleRequest($request);

        if ($formReunion->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($reunion);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Reunion crée');

            return $this->redirect($this->generateUrl('dt_doctorama_agenda'));
        }
        return $this->render('DTDoctoramaBundle:Doctorama:creation_reunion.html.twig', array('title' => 'Creation reunion', 'formReunion' => $formReunion->createView()));
    }

    public function archiverTheseAction($id_these, Request $request) {
        $these = $this->getDoctrine()->getManager()->find("DTDoctoramaBundle:These", $id_these);

        $formThese = $this->createForm(new TheseType(true), $these);
        $formThese->add('Enregistrer', 'submit');

        $formThese->handleRequest($request);

        if ($formThese->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($these);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'These archivée !');

            return $this->redirect($this->generateUrl('dt_fermer_fenetre'));
        }

        return $this->render('DTDoctoramaBundle:Popup:popup_archivage.html.twig', array('formThese' => $formThese->createView()));
    }

    public function fermerFenetreAction(Request $request) {


        return $this->render('DTDoctoramaBundle:Popup:fermerFenetre.html.twig');
    }

    public function modifFicheAction(Request $request) {
        return $this->render('DTDoctoramaBundle:Doctorama:modif_template.html.twig', array('title' => 'Modification des templates de fiche de suivi'));
    }

    public function modifFicheFormAction(Request $request) {
        var_dump($_POST);
        exit;
        //return $this->render('DTDoctoramaBundle:Doctorama:modif_template.html.twig', array('title' => 'Modification des templates de fiche de suivi'));
    }

    public function adminInfosPeroAction($id_compte, Request $request) {

        $compte = $this->getDoctrine()->getManager()->find('DTSecurityBundle:Compte', $id_compte);


        //si c'est un encadrant
        if (method_exists($compte, 'getEncadrant') && $compte->getEncadrant() != null) {

            $encadrant = $compte->getEncadrant();
            $formEncadrant = $this->createForm(new EncadrantType(), $encadrant, array('method' => 'PUT'));
            $formEncadrant->add('Enregistrer', 'submit');

            $formEncadrant->handleRequest($request);

            if ($formEncadrant->isValid()) {

                $em->persist($encadrant);
                $em->flush();

                $request->getSession()->getFlashBag()->add('notice', 'Informations bien enregistrées.');

                return $this->redirect($this->generateUrl('dt_doctorama_accueil', array('title' => 'Accueil')));
            }

            return $this->render('DTDoctoramaBundle:Doctorama:infos_perso.html.twig', array('title' => 'Informations Personnelles', 'form' => $formEncadrant->createView(), 'compte' => $compte));
        }

        //si c'est un doctorant
        elseif (method_exists($compte, 'getDoctorant') && $compte->getDoctorant() != null) {

            $doctorant = $compte->getDoctorant();
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

            return $this->render('DTDoctoramaBundle:Doctorama:infos_perso.html.twig', array('title' => 'Informations Personnelles', 'form' => $formDoctorant->createView(), 'compte' => $compte));
        }

        return $this->redirect($this->generateUrl('dt_doctorama_accueil', array('title' => 'Accueil')));
    }
    
    public function passerEncadrantAction($id_doctorant, Request $request)
    {
        $doctorant = $this->getDoctrine()->getManager()->find('DTDoctoramaBundle:Doctorant',$id_doctorant);
        $encadrant = new Encadrant();
        
        $encadrant->setNom($doctorant->getNom());
        $encadrant->setPrenom($doctorant->getPrenom());
        $encadrant->setMail($doctorant->getMail());
        $encadrant->setNomUsage($doctorant->getNomUsage());
        $encadrant->setCivilite($doctorant->getCivilite());
        $encadrant->setAdresse($doctorant->getAdresse());
        $encadrant->setDateDeNaissance($doctorant->getDateDeNaissance());
        $encadrant->setVilleDeNaissance($doctorant->getVilleDeNaissance());
        $encadrant->setPaysDeNaissance($doctorant->getPaysDeNaissance());
        $encadrant->setDepDeNaissance($doctorant->getDepDeNaissance());
        
        $compte = $doctorant->getCompte();
        $compte->setEncadrant($encadrant);
        
        $em = $this->getDoctrine()->getManager();
        
        $em->persist($compte);
        $em->persist($encadrant);
        
        $em->flush();
        
        return $this->redirect($this->generateUrl('dt_doctorama_admin_utilisateur'));
    }

}
