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
use \DateTime;
/**
 * Description of DoctoramaController
 *
 * @author benjamin
 */
class DoctoramaController extends Controller {
    
	public function exportFicheAction(Request $request)
    {
		$typeExport = htmlentities(str_replace('"','\"',$_POST['export']));
		if(!strcmp($typeExport,"CSV") || !strcmp($typeExport,"PDF")){
			$response = new Response();
			if(!strcmp($typeExport,"PDF")){
				$response->headers->set('Content-Type', 'application/pdf');
			}
			elseif(!strcmp($typeExport,"CSV")){
				$response->headers->set('Content-Type', 'text/csv');
				$response->headers->set('Content-disposition','attachment;filename='.$_GET['nom'].' '.$_POST['ficheLabel'].'.csv');
			}
			return $this->render('DTDoctoramaBundle:Doctorama:fiche_suivi_export.html.php', array('title' => 'Export fichier '.$typeExport, 'export'=>$typeExport), $response);
		}else{
			return $this->render('DTDoctoramaBundle:Doctorama:detail_doctorant.html.twig', array('title' => 'Erreur export'));
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
                        if(isset($these[0]))
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
        $reunion2->setDate(new DateTime('2014-12-19 10:00:00'));
        $reunion2->setLieu("MSI 223");
        $reunion2->addPersonne($personne2);
        $reunion2->addPersonne($personne4);
      

            $reunion3 = new Reunion;
        $reunion3->setDate(new DateTime('2014-12-15 10:00:00'));
        $reunion3->setLieu("MSI 20");
        $reunion3->addPersonne($personne2);
        $reunion3->addPersonne($personne4);
   

            $reunion4 = new Reunion;
        $reunion4->setDate(new DateTime('2014-12-15 10:00:00'));
        $reunion4->setLieu("MSI 4000");
        $reunion4->addPersonne($personne2);
        $reunion4->addPersonne($personne4);

        $reunions=array('1'=>$reunion1,'2'=>$reunion2, '3'=>$reunion3, '4'=>$reunion4);
        
    

        foreach ($reunions as $reunion) {
             $event[]=array(
                    'start'=>$reunion->getDate()->format('Y-m-d H:i:s'),
                    'title'=>$reunion->getLieu());
        }
          


        if (!$fp = fopen("../../mydate.php", 'w+')) {
            echo "Echec de l'ouverture du fichier";
            exit;
        } else {
            fwrite($fp, "<?php echo '".json_encode($event)."';") ;
            fclose($fp);
        }


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

    public function adminUtilisateurAction(Request $request)
    {
        return $this->render('DTDoctoramaBundle:Doctorama:admin_utilisateur.html.twig', array('title' => 'Gestion des utilisateurs'));
    }
    
    public function creerDossierSuivisAction(Request $request)
    {
        $doctorant = new Doctorant();

        $formDoctorant = $this->createForm(new DoctorantType(), $doctorant);
        $formDoctorant->add('save',      'submit');
        // On fait le lien Requête <-> Formulaire
        // À partir de maintenant, la variable $advert contient les valeurs entrées dans le formulaire par le visiteur
        $formDoctorant->handleRequest($request);
               
        // On vérifie que les valeurs entrées sont correctes
        // (Nous verrons la validation des objets en détail dans le prochain chapitre)
        if ($formDoctorant->isValid()) {
        
            // On l'enregistre notre objet $advert dans la base de données, par exemple
            $em = $this->getDoctrine()->getManager();
            $em->persist($doctorant->getThese());
            $em->persist($doctorant);
            $em->flush();

          $request->getSession()->getFlashBag()->add('notice', 'Dossier bien crée.');

          // On redirige vers la page de visualisation de l'annonce nouvellement créée
          return $this->redirect($this->generateUrl('dt_doctorama_doctorant_labo'));
        }
        return $this->render('DTDoctoramaBundle:Doctorama:creer_dossier.html.twig', array('title' => 'Créer dossier de suivis','formDoctorant' => $formDoctorant->createView()));

    }
    
    public function modifDossierSuivisAction($id_doctorant, Request $request)
    {
        $doctorant = $this->getDoctrine()->getManager()->find('DTDoctoramaBundle:Doctorant', $id_doctorant);
        $formDoctorant = $this->createForm(new DoctorantType(), $doctorant, array('method' => 'PUT'));
        
        $formDoctorant->add('save',      'submit');
        
        
        $formDoctorant->handleRequest($request);  
        // On vérifie que les valeurs entrées sont correctes
        // (Nous verrons la validation des objets en détail dans le prochain chapitre)
        if ($formDoctorant->isValid()) {
        
            // On l'enregistre notre objet $advert dans la base de données, par exemple
            $em = $this->getDoctrine()->getManager();
            $em->persist($doctorant->getThese());
            $em->persist($doctorant);
            $em->flush();

          $request->getSession()->getFlashBag()->add('notice', 'Le dossier a bien était modifié.');

          // On redirige vers la page de visualisation de l'annonce nouvellement créée
          return $this->redirect($this->generateUrl('dt_detail_doctorant', array('id_doctorant'=>$id_doctorant)));
        }
        
        return $this->render('DTDoctoramaBundle:Doctorama:modif_dossier.html.twig', array('title' => 'Modifier dossier de suivis','formDoctorant' => $formDoctorant->createView()));
    }
	
    public function detailDoctorantAction(Request $request, $id_doctorant)
    {
        $doctorant = $this->getDoctrine()->getManager()->find('DTDoctoramaBundle:Doctorant', $id_doctorant);
        $formDoctorant = $this->createForm(new DoctorantType(), $doctorant, array('method' => 'GET','read_only'=>true));
        
        return $this->render('DTDoctoramaBundle:Doctorama:detail_doctorant.html.twig', array('title' => 'Détails du doctorant','formDoctorant' => $formDoctorant->createView(), 'doctorant'=>$doctorant));
    
        
	/*	$DoctorantRepository = $this->getDoctrine()->getRepository('DTDoctoramaBundle:Doctorant');
        $doctorant = $DoctorantRepository->find($id_doctorant);
		$EncadrantRepository = $this->getDoctrine()->getRepository('DTDoctoramaBundle:Encadrant');
        $listEncadrant = $EncadrantRepository->findAll();
        return $this->render('DTDoctoramaBundle:Doctorama:detail_doctorant.html.twig', 
			array(
				'title'=>'Détails',
				'titre' => 'Detail du doctorant', 
				'doctorant'=>$doctorant,
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
				'fiches'=>array(
					'T6'=>array(
						'label'=>'T+6',
						'date_reunion'=>'16-1-14',
						'questions'=>array(
							array(
								'question'=>'question1',
								'reponse'=>'reponse1'
							),
							array(
								'question'=>'question2',
								'reponse'=>'reponse2'
							),
							array(
								'question'=>'question3',
								'reponse'=>'reponse3'
							),
						),
					),
					'T9'=>array(
						'label'=>'T+9',
						'date_reunion'=>'16-9-14',
						'questions'=>array(
							array(
								'question'=>'question10',
								'reponse'=>'reponse10'
							),
							array(
								'question'=>'question20',
								'reponse'=>'reponse20'
							),
							array(
								'question'=>'question30',
								'reponse'=>'reponse30'
							),
						),
					),
					'T12'=>array(
						'label'=>'T+12',
						'date_reunion'=>'16-12-14',
						'questions'=>array(
							array(
								'question'=>'question100',
								'reponse'=>'reponse100'
							),
							array(
								'question'=>'question200',
								'reponse'=>'reponse200'
							),
							array(
								'question'=>'question300',
								'reponse'=>'reponse300'
							),
						),
					),
				),
			)
		);*/
    }

    public function creationDossierAction(Request $request)
    {
        
        /*$requete = $this->get('request');
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

        return $this->render('DTDoctoramaBundle:Doctorama:creer_dossier.html.twig', array('title' => 'Créer dossier de suivis'));*/
    }

    public function infoPersoAction(Request $request)
    {
        return $this->render('DTDoctoramaBundle:Doctorama:infos_perso.html.twig', array('title' => 'Informations Personnelles'));
    }
    
        public function importCsvAction(Request $request)
    {
        return $this->render('DTDoctoramaBundle:Doctorama:import_csv.html.twig', array('title' => 'Importation fichier CSV'));
    }

}
