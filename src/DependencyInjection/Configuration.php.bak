<?php
/**
 * Created by PhpStorm.
 * User: polyanin
 * Date: 08.08.2018
 * Time: 12:53
 */

namespace Aplab\AplabAdminBundle\DependencyInjection;


use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{

    /**
     * Generates the configuration tree builder.
     *
     * @return \Symfony\Component\Config\Definition\Builder\TreeBuilder The tree builder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('aplab_admin');

        return $treeBuilder;
    }
}