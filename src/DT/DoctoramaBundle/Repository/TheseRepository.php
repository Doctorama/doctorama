<?php

namespace DT\DoctoramaBundle\Repository;

use Doctrine\ORM\EntityRepository;

use DT\DoctoramaBundle\Entity\These;
/**
 * Description of TheseRepository
 *
 * @author benjamin
 */
class TheseRepository extends EntityRepository{
    
    function findByEncadrant($encadrant){
        $qb = $this->_em->createQueryBuilder();
        
        return $this->createQueryBuilder('a')
            ->select('a')
            ->leftJoin('a.encadrants', 'c')
            ->addSelect('c')
            ->add('where', $qb->expr()->in('c', ':c') )
            ->setParameter('c', $encadrant)
            ->getQuery()
            ->getResult();
 
    }
    
    function theseArchivee()
    {
        $query = $this->_em->createQuery('SELECT t FROM DTDoctoramaBundle:These t WHERE t.mention is not NULL');
        $results = $query->getResult();
        
        return $results;
    }
}
