<?php

namespace Oka\Doctrine\SecretTypeBundle\Tests;

use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;

/**
 * @author Cedrick Oka Baidai <okacedrick@gmail.com>
 */
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = [
            new \Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new \Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new \Doctrine\Bundle\MongoDBBundle\DoctrineMongoDBBundle(),
            new \Oka\Doctrine\SecretTypeBundle\OkaDoctrineSecretTypeBundle(),
        ];

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        // We don't need that Environment stuff, just one config
        $loader->load(__DIR__.'/config.yaml');
    }
}
