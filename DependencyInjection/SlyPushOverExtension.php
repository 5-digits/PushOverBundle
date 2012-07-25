<?php

namespace Sly\PushOverBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @uses Extension
 * @author Cédric Dugat <ph3@slynett.com>
 */
class SlyPushOverExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('config.xml');
        $loader->load('manager.xml');

        $configuration = $configs[0];

        /* --- Configuration management and overloads --- */

        $container->setParameter('sly_push_over.config', $configuration);
    }
}
