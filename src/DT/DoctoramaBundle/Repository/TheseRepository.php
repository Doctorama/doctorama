<?php

namespace DT\DoctoramaBundle\Repository;

use Doctrine\ORM\EntityRepository;
use DT\DoctoramaBundle\Entity\These;

/**
 * Description of TheseRepository
 *
 * @author benjamin
 */
class TheseRepository extends EntityRepository {

    function theseNonArchivee($encadrant_id = null) {
        if($encadrant_id != null)
        {
            $query = $this->_em->createQuery('SELECT t FROM DTDoctoramaBundle:These t '
                . 'JOIN t.encadrants e '
                . 'JOIN t.directeursDeThese dir '
                . 'WHERE t.mention is NULL AND (e.id = :id OR dir.id = :id)');
            $query->setParameter('id', $encadrant_id);
            $results = $query->getResult();

            return $results; 
        }
        
        else
        {
            $query = $this->_em->createQuery('SELECT t FROM DTDoctoramaBundle:These t WHERE t.mention is NULL');
            $results = $query->getResult();

            return $results;
        }
        
    }
    function theseArchiveeAvecDates(){
        $query = $this->_em->createQuery('SELECT t '
                . 'FROM DTDoctoramaBundle:These t '
                . 'WHERE t.mention is not NULL '
                . 'AND t.dateDebut is not NULL '
                . 'AND t.dateDeSoutenance is not null');
        $results = $query->getResult();

        return $results;
    }

    function theseArchivee() {
        $query = $this->_em->createQuery('SELECT t FROM DTDoctoramaBundle:These t WHERE t.mention is not NULL');
        $results = $query->getResult();

        return $results;
    }

}
