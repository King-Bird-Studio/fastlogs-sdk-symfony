<?php

namespace fastlogs\FastlogsBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

class FastlogsExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(dirname(__DIR__) . '/Resources/config'));
        $loader->load('services.xml');

        $configuration = $this->getConfiguration($configs, $container);
        $config = $this->processConfiguration($configuration, $configs);

        $definition = $container->getDefinition('fastlogs');
        $definition->setArgument(0, $config['slug']);
        $definition->setArgument(1, $config['url']);

        $definition = $container->getDefinition('monolog.processor.session_request');
        $definition->setArgument(1, $config['channel']);
        $definition->setArgument(2, $config['level']);
    }

    public function getAlias()
    {
        return 'fastlogs';
    }
}