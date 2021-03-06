<?php

namespace DT\DoctoramaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Security\Core\SecurityContext;

use DT\DoctoramaBundle\Services\EncadrantService;

use DT\DoctoramaBundle\Form\DoctorantType;
use DT\DoctoramaBundle\Form\TheseType;
use DT\DoctoramaBundle\Form\ReunionType;
use DT\DoctoramaBundle\Form\EncadrantType;

use DT\DoctoramaBundle\Entity\Reunion;
use DT\DoctoramaBundle\Entity\Personne;
use DT\DoctoramaBundle\Entity\These;
use DT\DoctoramaBundle\Entity\DossierDeSuivi;
use DT\DoctoramaBundle\Entity\Question;
use DT\DoctoramaBundle\Entity\TemplateFicheSuivi;
use DT\DoctoramaBundle\Entity\Doctorant;
use DT\SecurityBundle\Entity\Compte;
use DT\DoctoramaBundle\Entity\Encadrant;

use \DateTime;


class DoctoramaController extends Controller {

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

    // Page liste des doctorants du labo
    public function doctorantLaboAction(Request $request) {
        // On récupère la liste des doctorants qui n'ont pas encore fini leur thèse
        $DoctorantRepository = $this->getDoctrine()->getRepository('DTDoctoramaBundle:Doctorant');
        $listDoctorant = $DoctorantRepository->theseNonArchivee();
        // on retourne le titre de la page et cette liste
        return $this->render('DTDoctoramaBundle:Doctorama:doctorant_labo.html.twig', array('title' => 'Doctorants du laboratoire', 'listDoctorant' => $listDoctorant));
    }

    // Page d'agenda
    public function agendaAction(Request $request) {
        // récupère l'utilisateur connecté
        $user = $this->get('security.context')->getToken()->getUser();

        // suivant le rôle de l'utilisateur, on récupère les réunions
        if (method_exists($user, 'getEncadrant') && $user->getEncadrant() != null) 
        {
            $reu = $user->getEncadrant()->getReunions();
        } 
        else if (method_exists($user, 'getDoctorant') && $user->getDoctorant() != null) 
        {
            $reu = $user->getDoctorant()->getReunions();
        } 
        else 
        {
            // par defaut, on récupère toutes les réunions
            $reunionRepository = $this->getDoctrine()->getManager()->getRepository('DTDoctoramaBundle:Reunion');
            $reu = $reunionRepository->findAll();
        }

        $event = array();
        $reunions = array();

        // Pour chaque réunion récupérées
        foreach ($reu as $reunion) {
            // on récupère le doctorant associé (1 seul)
            $pers[] = array('nom' => $reunion->getDoctorant()->getNom(),
                'prenom' => $reunion->getDoctorant()->getPrenom());
            // on récupère ensuite tous les encadrants (1 ou plusieurs)
            foreach ($reunion->getEncadrants() as $personnes) {
                $pers[] = array('nom' => $personnes->getNom(),
                    'prenom' => $personnes->getPrenom());
            }
            // création du tableau a renvoyer ensuite avec à chaque case la réunion et les personnes associées
            $reunions[] = array(
                'reunion' => $reunion,
                'participants' => $pers);
            // création du tableau event pour le callendrier fullcallendar
            $event[] = array(
                'start' => $reunion->getDate()->format('Y-m-d H:i:s'),
                'title' => $reunion->getLieu());
            
            $pers=array();
        }

        // écriture au format json des évènements pour le chargement dans le calendrier js
        // ouverture du fichier
        if (!$fp = fopen("../../mydate.php", 'w+')) {
            echo "Echec de l'ouverture du fichier";
            exit;
        } 
        else 
        {
            // écriture et fermeture
            fwrite($fp, "<?php echo '" . json_encode($event) . "';");
            fclose($fp);
        }

        // retourne le titre de la page et le tableau des réunions
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

    // Page d'accueil
    public function indexAction(Request $request) {
        //return $this->render('DTDoctoramaBundle::index.html.twig', array('title' => 'Agenda'));
        // Redirection vers la page d'agenda
        return $this->redirect($this->generateUrl('dt_doctorama_agenda'));
    }

    // Page d'administration des dossiers de suivi
    public function adminDossierSuivisAction(Request $request) {
        return $this->render('DTDoctoramaBundle:Doctorama:admin_dossier.html.twig', array('title' => 'Dossier de suivis'));
    }

    // Page d'administration des utilisateurs
    public function adminUtilisateurAction(Request $request) {
        // Renvoie la liste des comptes utilisateurs
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

	// Page de détail d'un doctorant
    public function detailDoctorantAction(Request $request, $id_doctorant) {
        $doctorant = $this->getDoctrine()->getManager()->find('DTDoctoramaBundle:Doctorant', $id_doctorant);
		// Formulaire listant les attributs d'un doctorant (infos persos, master et thèse)
        $formDoctorant = $this->createForm(new DoctorantType(true), $doctorant, array('method' => 'GET', 'read_only' => true));
        $em = $this->getDoctrine()->getManager();
        $reponses = array();
        $fiches = array();
        foreach ($doctorant->getReunions() as $reunion) {
            $templateFicheSuivi = $doctorant->getThese()->getDossierDeSuivi()->getTemplateFicheSuivi();
            // fiches retournées composées d'un label, d'une date et de questions/réponses
			$fiches[$reunion->getLibelle()] = array(
                'label' => $reunion->getLibelle(),
                'date_reunion' => $reunion->getDate()->format('m/d/Y'),
                'questions' => array()
            );
			// Récupère questions et réponses de ses fiches de suivi
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

	
	// Traitement des fiches pour modification ou export
    public function exportFicheAction(Request $request) {
        $typeExport = htmlentities(str_replace('"', '\"', $_POST['export']));
        if (!strcmp($typeExport, "CSV") || !strcmp($typeExport, "PDF")) {
            $response = new Response();
			// Modification d'en-tête : contenu de fichier 
            if (!strcmp($typeExport, "PDF")) {
				// si PDF -> application
                $response->headers->set('Content-Type', 'application/pdf');
            } elseif (!strcmp($typeExport, "CSV")) {
				// si csv -> text/csv
                $response->headers->set('Content-Type', 'text/csv');
                $response->headers->set('Content-disposition', 'attachment;filename=' . $_GET['nom'] . ' ' . $_POST['ficheLabel'] . '.csv');
            }
            return $this->render('DTDoctoramaBundle:Doctorama:fiche_suivi_export.html.php', array('title' => 'Export fichier ' . $typeExport, 'export' => $typeExport), $response);
        }elseif(!strcmp($typeExport, "Valider")){
			//Modification non fonctionnelle
            $templateRepository = $this->getDoctrine()->getManager()->getRepository('DTDoctoramaBundle:TemplateFicheSuivi');
            $templates = $templateRepository->findByTitre($_POST['ficheId']);
            return $this->render('DTDoctoramaBundle:Doctorama:detail_doctorant.html.twig', array('title' => 'Erreur export'));
        }else {
            return $this->render('DTDoctoramaBundle:Doctorama:detail_doctorant.html.twig', array('title' => 'Erreur export'));
        }
    }

    public function parseCsvAction(Request $request){
    	$reponse;
    	$tab_intitule = array(); 
    	$list_doctorants = array();
    	$em = $this->getDoctrine()->getManager();
    	
    	$uploads_dir = "bundles/doctorama/uploads/";
		$tmp_name = $_FILES["file"]["tmp_name"];
        $name = $_FILES["file"]["name"];
		if(move_uploaded_file($tmp_name, "$uploads_dir/$name")) 
		{ 
			$ligne = 0; // compteur de ligne
			
			$fic = fopen("$uploads_dir/$name", "a+");
			while($tab=fgetcsv($fic,1024,',')) {
				$j = 0; //Compteur remplissage ligne $list_doctorants
				$doctorant_exist = False;
				
				//Création des enregistrements:
				$doctorant = new Doctorant();
    			$these = new These();
    			
				//nombre de champ dans la ligne en question
				$champs = count($tab);	
				
				//Récupération des entités du fichier CSV dans un tableau
				if ($ligne==0) {
					for($i=0; $i<$champs; $i ++) {
						$tab_intitule[$i] = $tab[$i];
					}
				}
				
				//affichage de chaque champ de la ligne en question
					if ($ligne>0) {
						if (!$tab[0] == "") {
							for($i=0; $i<$champs; $i ++) {	
								switch ($tab_intitule[$i]) {
									case "Numéro Etudiant":
									//VéRIFIER SI ETUDIANT EXISTE DéJà//
										$query = $em->createQuery("SELECT dt FROM DTDoctoramaBundle:Doctorant dt WHERE dt.numEtudiant= :num_etudiant")->setParameter('num_etudiant',$tab[$i]);
										$etudiant = $query->getResult();
										//var_dump($etudiant);
										//exit;
										if ($etudiant) {
											$doctorant_exist = True;
										} else {
											$doctorant->setNumEtudiant($tab[$i]);
										}
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
						    			if (!$tab[$i]=="") {
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
						    			$these->setTitreThese($tab[$i]);
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
						    			$parse_nom = explode(';', $tab[$i]);
						    			foreach ($parse_nom as $value) {
    										if ($value) {
									        	$query = $em->createQuery("SELECT dt FROM DTDoctoramaBundle:Encadrant dt WHERE dt.nom= :nom")->setParameter('nom', $value);
												$encadrant = $query->getResult();
												//SI IL EXISTE PAS CRéER UN NOUVEAU//
												if (!$encadrant) {
													$encadrant = new Encadrant;
													$encadrant->setNom($value);
													$encadrant->setPrenom($value);
													$em->persist($encadrant);
													$these->addDirecteursDeThese($encadrant);
												}
												else{
													$these->setDirecteursDeThese($encadrant);
												}
											}
										}
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
						    			if (!$tab[$i]=="") {
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
							if ($doctorant_exist) {
								break;
							}
							}
							if (!$doctorant_exist) {
								$doctorant->setThese($these);
								$em->persist($doctorant);
								$em->persist($these);
								$em->flush();;
							}
						}	
					}
				$ligne ++;
			}
			$reponse = "Le fichier est Uploadé et enregistré dans la base de données";
		} 
		else 
		{ 
			$reponse = 'Echec de l\'upload du fichier CSV. '; 
		} 
        //$em->flush();
		//var_dump($arr);
		//exit;
        return $this->render('DTDoctoramaBundle:Doctorama:upload_validate.html.twig', array('title' => 'Importation fichier CSV', 'list_doctorants' => $list_doctorants));
    }
    
    // Page de modification des réunions
    public function modifReunionAction($id_reunion, Request $request) {
        // récupère la réunion à modifier
        $reunion = $this->getDoctrine()->getManager()->find("DTDoctoramaBundle:Reunion", $id_reunion);

        // création du formulaire des modifications
        $formReunion = $this->createForm(new ReunionType(), $reunion);
        $formReunion->add('save', 'submit');

        $formReunion->handleRequest($request);

        if ($formReunion->isValid()) {
            // validation du formulaire et modification en bdd
            $em = $this->getDoctrine()->getManager();
            $em->persist($reunion);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Reunion modifié.');

            // redirection vers la page agenda
            return $this->redirect($this->generateUrl('dt_doctorama_agenda'));
        }

        // si pas validé, on va sur la page de modification
        return $this->render('DTDoctoramaBundle:Doctorama:modif_reunion.html.twig', array('title' => 'Modification Reunion', 'formReunion' => $formReunion->createView()));
    }

    // Page de création des réunions
    public function creationReunionAction(Request $request) {
        // Création d'une nouvelle réunion
        $reunion = new Reunion();

        // Création du formulaire pour les infos de la réunion
        $formReunion = $this->createForm(new ReunionType(), $reunion);
        $formReunion->add('save', 'submit');

        $formReunion->handleRequest($request);

        if ($formReunion->isValid()) {
            // lorsque l'on valide le formulaire
            $em = $this->getDoctrine()->getManager();
            // on enregistre en bdd la réunion créée
            $em->persist($reunion);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Reunion crée');

            // redirection vers la page d'agenda
            return $this->redirect($this->generateUrl('dt_doctorama_agenda'));
        }
        return $this->render('DTDoctoramaBundle:Doctorama:creation_reunion.html.twig', array('title' => 'Création réunion', 'formReunion' => $formReunion->createView()));
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
    
    public function passerEncadrantAction($id_doctorant, Request $request){
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

    // Page de modification des templates de fiches de suivi
    public function modifFicheAction(Request $request){
        // on récupère les dernières versions de chaques templates de fiches de suivi
        $TR = $this->getDoctrine()->getRepository('DTDoctoramaBundle:TemplateFicheSuivi');
        $templates = $TR->findAllTemplateLastVersion(); 

        // on retourne le tableau les contenants
        return $this->render('DTDoctoramaBundle:Doctorama:modif_template.html.twig', array('title' => 'Modification des templates de fiche de suivi', 'templates' => $templates));
    }

    // Gestion de la modification des templates de fiches de suivi
    // Page de modification des templates de fiches de suivi
    public function modifFicheFormAction(Request $request){
        $em = $this->getDoctrine()->getManager();

        // Création d'un nouveau template car c'est une nouvelle version
        $template = new TemplateFicheSuivi();

        // associe le titre et le numéro de version
        $titre = $_GET['libelle'];
        $version = $_GET['version'] + 1;
        $template->setTitre($titre);
        $template->setVersion($version);

        // Pour chaque question reçues du formulaire
        foreach ($_GET['question'] as $q) {
            // on créé la question ...
            $q1 = htmlentities(str_replace('"','\"',$q));
            $ques = new Question();
            $ques->setQuestion($q1);
            // et on l'associe au template
            $template->addQuestions($ques);
            // on insère la question en BDD
            $em->persist($ques);
        }
        // on insère le template en BDD
        $em->persist($template);
        $em->flush();

        // On retourne sur la page de modification des templates
        return $this->redirect($this->generateUrl('dt_doctorama_modif_fiche'));
    }

    // Gestion de l'ajout d'un nouveau template
    // Page de modification des templates de fiches de suivi
    public function addTemplateAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $titre = $_GET['template_libelle'];
        // création du template
        $template = new TemplateFicheSuivi();
        // association du template avec le titre et la version (0 car aucune question pour le moment)
        $template->setTitre($titre);
        $template->setVersion(0);
        // on insère en BDD
        $em->persist($template);
        $em->flush();

        // On retourne sur la page de modification des templates
        return $this->redirect($this->generateUrl('dt_doctorama_modif_fiche'));
    }

}
