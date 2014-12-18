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
                . 'WHERE t.mention is NULL AND e.id = :encadrant');
            $query->setParameter('encadrant', $encadrant_id);
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

    function findByEncadrant($encadrant) {
        $qb = $this->_em->createQueryBuilder();

        return $this->createQueryBuilder('a')
                        ->select('a')
                        ->leftJoin('a.encadrants', 'c')
                        ->addSelect('c')
                        ->add('where', $qb->expr()->in('c', ':c'))
                        ->setParameter('c', $encadrant)
                        ->getQuery()
                        ->getResult();
    }

    function theseArchivee() {
        $query = $this->_em->createQuery('SELECT t FROM DTDoctoramaBundle:These t WHERE t.mention is not NULL');
        $results = $query->getResult();

        return $results;
    }

}
