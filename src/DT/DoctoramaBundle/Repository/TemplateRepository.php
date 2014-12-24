<?php

namespace DT\DoctoramaBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;

use DT\DoctoramaBundle\Entity\TemplateFicheSuivi;

/**
 * Description of TemplateRepository
 *
 * @author mickael
 */
class TemplateRepository extends EntityRepository{
    
    /**
    * Permet de trouver les dernières versions de template avec les questions associées
    * @return un tableau contenant l'ensemble des templates avec leurs informations
    **/
    function findAllTemplateLastVersion()
    {
        // Sélectionne les titres distinct des templates
        $query = $this->_em->createQuery('SELECT DISTINCT t.titre FROM DTDoctoramaBundle:TemplateFicheSuivi t ORDER BY t.titre ASC');
        $results = $query->getResult();

        // Pour chaque
        foreach ($results as $res) {
            // On récupère la dernière version
        	$query2 = $this->_em->createQuery('SELECT MAX(t.version) FROM DTDoctoramaBundle:TemplateFicheSuivi t WHERE t.titre=\''.$res['titre'].'\'');
        	$res2 = $query2->getResult();

        	// Et ensuite son id
        	$query3 = $this->_em->createQuery('SELECT t.id FROM DTDoctoramaBundle:TemplateFicheSuivi t WHERE t.titre=\''.$res['titre'].'\' AND t.version='.$res2[0][1]);
        	$res3 = $query3->getResult();

            // On récupère les questions associées à cette version de template
        	$questions = $this->findAllQuestionByTemplate($res3[0]['id']);

            // que l'on renge dans un tableau
            $ques = array(); 
            foreach ($questions as $q) {
                $ques[] = $q->getQuestion();
            }

        	$return[] = array('titre'=>$res['titre'], 'id'=>$res3[0]['id'], 'version'=>$res2[0][1], 'questions'=>$ques);
        }
        // La fonction renvoie le titre du template, l'id, la version actuelle et la liste de questions associées
        return $return;
    }

    /**
    * Permet de récupérer les questions associées à un template
    * @param integer $id_template
    * @return un tableau contenant l'ensemble des questions du template
    **/
    function findAllQuestionByTemplate($id_template)
    {
        // Récupère le template
        $temp = $this->findOneById($id_template);
        // et les questions associées à ce template
        $questions = $temp->getQuestions();

        return $questions;
    }

    
}
