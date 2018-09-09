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
use Doctrine\ORM\Query\Expr\OrderBy;
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

    /**
     * @return array
     */
    public function get2d()
    {
        $items = $this->findBy([], ['order' => 'ASC', 'id' => 'ASC']);
        $result = [];
        foreach ($items as $item) {
            $parent = $item->getParent();
            $result[$parent ? $parent->getId() : 0][$item->getId()] = $item;
        }
        return $result;
    }

    /**
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getRoots()
    {
        return $this->createQueryBuilder('t')
            ->where('t.parent is null')
            ->orderBy('t.order', 'ASC')
            ->addOrderBy('t.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @param $limit
     * @param $offset
     * @return ListItem[]
     */
    public function rootPage($limit, $offset)
    {
        $children = $this->findBy(
            ['parent' => null],
            ['order' => 'ASC', 'id' => 'ASC'], $limit, $offset);
        $level = 0;
        $tmp = [];
        while ($children) {
            foreach ($children as $child) {
                $child->level = $level;
                $tmp[] = $child;
            }
            $children = $this->getChildrenOf($children);
            $level++;
        }
        $tmp = $this->to2d($tmp);
        $ret = array();
        $level = 0;
        $to_list = function ($from_key = 0) use (& $ret, $tmp, & $to_list, & $level) {
            if (!isset($tmp[$from_key])) return;
            foreach ($tmp[$from_key] as $k => $v) {
                $v->levelCheck = $level;
                $ret[$k] = $v;
                if (isset($tmp[$k])) {
                    $level++;
                    $to_list($k);
                    $level--;
                }
            }
        };
        $to_list(0);
        return $ret;
    }

    /**
     * @return int
     */
    public function getRootsCount()
    {
        return $this->count(['parent' => null]);
    }

    /**
     * @param ListItem[] $items
     * @return ListItem[]
     */
    public function getChildrenOf(array $items)
    {
        return $this->findBy(['parent' => $items], ['order' => 'ASC', 'id' => 'ASC']);
    }

    /**
     * @return array|mixed
     */
    public function getTree()
    {
        $tmp = $this->get2d();
        $roots = $tmp[0] ?? [];
        if (empty($roots)) {
            return $roots;
        }
        $ret = array();
        $level = 0;
        $to_list = function ($from_key = 0) use (& $ret, $tmp, & $to_list, & $level) {
            if (!isset($tmp[$from_key])) return;
            foreach ($tmp[$from_key] as $k => $v) {
                $v->level = $level;
                $ret[$k] = $v;
                if (isset($tmp[$k])) {
                    $level++;
                    $to_list($k);
                    $level--;
                }
            }
        };
        $to_list(0);
        return $ret;
    }

    /**
     * @param ListItem[] $items
     * @return ListItem[]
     */
    public function to2d(array $items)
    {
        $result = [];
        foreach ($items as $item) {
            $parent = $item->getParent();
            $result[$parent ? $parent->getId() : 0][$item->getId()] = $item;
        }
        return $result;
    }

    /**
     *
     */
    public function getOptionsDataList()
    {
        $tmp = $this->getTree();
        array_walk($tmp, function ($v, $k) use (& $tmp) {
            $tmp[$k] = array(
                'value' => $k,
                'text' => str_repeat('. ', $v->level) . $v->getName(),
                'selectd' => false
            );
        });
        return $tmp;
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
