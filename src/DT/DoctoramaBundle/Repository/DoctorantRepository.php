<?php

namespace DT\DoctoramaBundle\Repository;

use Doctrine\ORM\EntityRepository;

use DT\DoctoramaBundle\Entity\Doctorant;
use DT\DoctoramaBundle\Entity\These;
/**
 * Description of TheseRepository
 *
 * @author benjamin
 */
class DoctorantRepository extends EntityRepository{
    
    function theseNonArchivee($encadrant_id=null){
        
        $results=null;
        if($encadrant_id==null)
        {
            $query = $this->_em->createQuery('SELECT d, t FROM DTDoctoramaBundle:Doctorant d JOIN d.these t WHERE t.mention is NULL');
            $results = $query->getResult();
        }
        
        else
        {
            $query = $this->_em->createQuery('SELECT d, t '
                    . 'FROM DTDoctoramaBundle:Doctorant d '
                    . 'JOIN d.these t '
                    . 'JOIN t.encadrants e '
                    . 'WHERE t.mention is NULL AND e.id = :id ');
            $query->setParameter('id', $encadrant_id);
            $results = $query->getResult();
        }

        return $results;
    }
    
    function theseArchivee()
    {
        $query = $this->_em->createQuery('SELECT d, t FROM DTDoctoramaBundle:Doctorant d JOIN d.these t WHERE t.mention is not NULL');
        $results = $query->getResult();
        
        return $results;
    }
}

