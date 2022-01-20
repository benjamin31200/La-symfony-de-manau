<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function findByPrice($price)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.price < :val')
            ->setParameter('val', $price)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(100)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByAlim($alim)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.alimentation = :val')
            ->setParameter('val', $alim)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(100)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByBrand($brand)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.brand = :val')
            ->setParameter('val', $brand)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(100)
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return Product[] Returns an array of Product objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Product
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
