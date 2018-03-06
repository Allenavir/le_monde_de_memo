<?php

namespace App\Repository;

use App\Entity\Memo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class MemoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Memo::class);
    }

    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('m')
            ->where('m.something = :value')->setParameter('value', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    public function findByTypeUser($value, $id_user)
    {
        return $this->createQueryBuilder('m')
            ->where('m.type = :type')->setParameter('type', $value)
            ->andWhere('m.utilisateur = :user')->setParameter('user', $id_user)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByUser($id_user) {
        return $this->createQueryBuilder('m')
            ->where('m.utilisateur = :value')->setParameter('value', $id_user)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;

    }



    
}
