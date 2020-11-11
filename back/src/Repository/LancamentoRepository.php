<?php

namespace App\Repository;

use App\Entity\Lancamento;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Lancamento|null find($id, $lockMode = null, $lockVersion = null)
 * @method Lancamento|null findOneBy(array $criteria, array $orderBy = null)
 * @method Lancamento[]    findAll()
 * @method Lancamento[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LancamentoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Lancamento::class);
    }

    // /**
    //  * @return Lancamento[] Returns an array of Lancamento objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Lancamento
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
