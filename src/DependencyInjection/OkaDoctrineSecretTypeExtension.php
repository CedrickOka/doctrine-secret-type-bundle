<?php

namespace Oka\Doctrine\SecretTypeBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * @author Cedrick Oka Baidai <okacedrick@gmail.com>
 */
class OkaDoctrineSecretTypeExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../../config'));
        $loader->load('services.yaml');

        $container->setParameter('oka_doctrine_secret_type.private_key_file', $config['private_key_file']);
        $container->setParameter('oka_doctrine_secret_type.public_key_file', $config['public_key_file']);
        $container->setParameter('oka_doctrine_secret_type.passphrase', $config['passphrase']);
    }
}
