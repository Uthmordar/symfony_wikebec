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
        $count = $this->getEntityManager()
            ->createQuery('
                SELECT m.id FROM AppBundle:Mot m
                LEFT JOIN m.definitions d
                LEFT JOIN m.exemples e
                WHERE m.nb_votes>10'
            )
            ->getResult();
        $key=array_rand($count);

        return $this->findOneById($count[$key]['id']);
    }
    
    public function getCoupsDeCoeur()
    {
        $query = $this->createQueryBuilder('m')
                        ->where('m.nb_votes > 20')
                        ->setMaxResults( 20 )
                        ->orderBy('m.nb_votes', 'DESC')
                        ->getQuery();
        
        dump($query->getResult());
        
        return $query->getResult();
    }
}
