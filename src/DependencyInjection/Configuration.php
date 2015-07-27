<?php
/**
 * teqneers/ext-direct-bundle
 *
 * @category   TQ
 * @package    TQ\Bundle\ExtDirectBundle
 * @copyright  Copyright (C) 2015 by TEQneers GmbH & Co. KG
 */

namespace TQ\Bundle\ExtDirectBundle\DependencyInjection;


use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 *
 * @package TQ\Bundle\ExtDirectBundle\DependencyInjection
 */
class Configuration implements ConfigurationInterface
{
    /**
     * @var bool
     */
    private $debug;

    /**
     * @param bool $debug
     */
    public function __construct($debug = false)
    {
        $this->debug = $debug;
    }

    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode    = $treeBuilder->root('tq_ext_direct', 'array');

        $rootNode
            ->children()
                ->booleanNode('debug')
                    ->defaultValue($this->debug)
                ->end()
                ->scalarNode('cache')
                    ->defaultValue('file')
                ->end()
                ->scalarNode('file_cache_dir')
                    ->defaultValue('%kernel.cache_dir%/tq_ext_direct')
                ->end()
                ->booleanNode('validate_arguments')
                    ->defaultValue(true)
                ->end()
                ->booleanNode('strict_validation')
                    ->defaultValue(true)
                ->end()
                ->booleanNode('convert_arguments')
                    ->defaultValue(true)
                ->end()
                ->booleanNode('convert_result')
                    ->defaultValue(true)
                ->end()
                ->arrayNode('endpoints')
                    ->fixXmlConfig('endpoint')
                    ->isRequired()
                    ->requiresAtLeastOneElement()
                    ->useAttributeAsKey('id')
                    ->prototype('array')
                        ->addDefaultsIfNotSet()
                        ->children()
                            ->scalarNode('descriptor')
                                ->defaultValue('Ext.app.REMOTING_API')
                            ->end()
                            ->scalarNode('namespace')
                                ->defaultValue('Ext.global')
                            ->end()
                            ->booleanNode('auto_discover')
                                ->defaultValue(true)
                            ->end()
                            ->booleanNode('all_bundles')
                                ->defaultValue(true)
                            ->end()
                            ->arrayNode('bundles')
                                ->fixXmlConfig('bundle')
                                ->prototype('scalar')
                                ->end()
                            ->end()
                            ->arrayNode('directories')
                                ->fixXmlConfig('directory')
                                ->prototype('scalar')
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}