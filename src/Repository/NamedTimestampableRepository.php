<?php
/**
 * Created by PhpStorm.
 * User: polyanin
 * Date: 19.08.2018
 * Time: 16:02
 */

namespace Aplab\AplabAdminBundle\Repository;


use Aplab\AplabAdminBundle\Entity\NamedTimestampable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class NamedTimestampableRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NamedTimestampable::class);
    }
}