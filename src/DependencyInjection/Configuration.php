<?php

namespace Oka\Doctrine\SecretTypeBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * @author Cedrick Oka Baidai <okacedrick@gmail.com>
 */
class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('oka_doctrine_secret_type');
        /** @var \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $rootNode */
        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->addDefaultsIfNotSet()
            ->children()
                ->scalarNode('private_key_file')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()

                ->scalarNode('public_key_file')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()

                ->scalarNode('passphrase')
                    ->defaultNull()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
