<?php

namespace App\Repository;

use App\Entity\SearchList;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SearchList|null find($id, $lockMode = null, $lockVersion = null)
 * @method SearchList|null findOneBy(array $criteria, array $orderBy = null)
 * @method SearchList[]    findAll()
 * @method SearchList[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SearchListRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SearchList::class);
    }

    // /**
    //  * @return SearchList[] Returns an array of SearchList objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SearchList
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
