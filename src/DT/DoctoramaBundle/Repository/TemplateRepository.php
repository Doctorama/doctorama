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
    
    function findAllTemplateLastVersion()
    {
        $query = $this->_em->createQuery('SELECT DISTINCT t.titre FROM DTDoctoramaBundle:TemplateFicheSuivi t ');
        $results = $query->getResult();

        foreach ($results as $res) {
        	$query2 = $this->_em->createQuery('SELECT MAX(t.version) FROM DTDoctoramaBundle:TemplateFicheSuivi t WHERE t.titre=\''.$res['titre'].'\'');
        	$res2 = $query2->getResult();
        	
        	$query3 = $this->_em->createQuery('SELECT t.id FROM DTDoctoramaBundle:TemplateFicheSuivi t WHERE t.titre=\''.$res['titre'].'\' AND t.version='.$res2[0][1]);
        	$res3 = $query3->getResult();

        	$questions = $this->findAllQuestionByTemplate($res3[0]['id']);

        	$return[] = array('titre'=>$res['titre'], 'id'=>$res3[0]['id'], 'version'=>$res2[0][1], 'questions'=>$questions);
        }
        return $return;
    }

    function findAllQuestionByTemplate($id_template)
    {
    	// Récupérer l'id des questions du template passé en paramètres //
    	//$query = $this->_em->createQuery('SELECT tq.question_id FROM templatefichesuivi_question tq WHERE tq.templatefichesuivi_id ='.$id_template);
        //$results = $query->getResult();
        //var_dump($results);
        
        $tab = array(1,2,3);
        foreach ($tab as $val) {
        	$query = $this->_em->createQuery('SELECT q.question FROM DTDoctoramaBundle:Question q WHERE q.id='.$val);
        	$results = $query->getResult();
        	$questions[]=$results[0]['question'];
        }

        return $questions;
    }

    
}
