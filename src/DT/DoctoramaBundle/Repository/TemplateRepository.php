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
        $query = $this->_em->createQuery('SELECT DISTINCT t.titre FROM DTDoctoramaBundle:TemplateFicheSuivi t ORDER BY t.titre ASC');
        $results = $query->getResult();

        foreach ($results as $res) {
        	$query2 = $this->_em->createQuery('SELECT MAX(t.version) FROM DTDoctoramaBundle:TemplateFicheSuivi t WHERE t.titre=\''.$res['titre'].'\'');
        	$res2 = $query2->getResult();
        	
        	$query3 = $this->_em->createQuery('SELECT t.id FROM DTDoctoramaBundle:TemplateFicheSuivi t WHERE t.titre=\''.$res['titre'].'\' AND t.version='.$res2[0][1]);
        	$res3 = $query3->getResult();

        	$questions = $this->findAllQuestionByTemplate($res3[0]['id']);

            $ques = array(); 
            foreach ($questions as $q) {
                $ques[] = $q->getQuestion();
            }

        	$return[] = array('titre'=>$res['titre'], 'id'=>$res3[0]['id'], 'version'=>$res2[0][1], 'questions'=>$ques);
        }
        return $return;
    }

    /**
    * Permet de récupérer les questions associées à un template
    * @param integer $id_template
    * @return un tableau contenant l'ensemble des questions du template
    **/
    function findAllQuestionByTemplate($id_template)
    {
        $temp = $this->findOneById($id_template);
        $questions = $temp->getQuestions();

        return $questions;
    }

    
}
