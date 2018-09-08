<?php

namespace Aplab\AplabAdminBundle\Repository;

use Aplab\AplabAdminBundle\Entity\AdjacencyList\ListItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ListItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method ListItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method ListItem[]    findAll()
 * @method ListItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdjacencyListItemRepository extends ServiceEntityRepository
{
    /**
     * AdjacencyListItemRepository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ListItem::class);
    }

//    /**
//     * @return ListItem[] Returns an array of ListItem objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ListItem
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
