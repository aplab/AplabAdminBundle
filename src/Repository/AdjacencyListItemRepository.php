<?php
/**
 * Created by PhpStorm.
 * User: polyanin
 * Date: 04.09.2018
 * Time: 16:39
 */

namespace Aplab\AplabAdminBundle\Repository;


use Aplab\AplabAdminBundle\Entity\AdjacencyList\ListItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class AdjacencyListItemRepository
 * @package Aplab\AplabAdminBundle\Repository
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
