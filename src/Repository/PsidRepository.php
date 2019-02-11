<?php

namespace App\Repository;

use App\Entity\Psid;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Psid|null find($id, $lockMode = null, $lockVersion = null)
 * @method Psid|null findOneBy(array $criteria, array $orderBy = null)
 * @method Psid[]    findAll()
 * @method Psid[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PsidRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Psid::class);
    }

    // /**
    //  * @return Psid[] Returns an array of Psid objects
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
    public function findOneBySomeField($value): ?Psid
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
