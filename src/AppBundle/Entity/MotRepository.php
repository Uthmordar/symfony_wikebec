<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * MotRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MotRepository extends EntityRepository
{
    public function findOneRandom(){
        $count = $this->createQueryBuilder('u')
             ->select('COUNT(u)')
             ->getQuery()
             ->getSingleScalarResult();
        
        return $this->createQueryBuilder('u')
            ->setFirstResult(rand(0, $count - 1))
            ->setMaxResults(1)
            ->getQuery()
            ->getSingleResult();
    }
}
