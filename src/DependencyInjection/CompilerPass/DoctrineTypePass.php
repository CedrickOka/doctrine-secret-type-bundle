<?php

namespace Oka\Doctrine\SecretTypeBundle\DependencyInjection\CompilerPass;

use Oka\Doctrine\SecretTypeBundle\EventListener\DoctrineMongoDBListener;
use Oka\Doctrine\SecretTypeBundle\EventListener\DoctrineORMListener;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Parameter;

/**
 * @author Cedrick Oka Baidai <okacedrick@gmail.com>
 */
class DoctrineTypePass implements CompilerPassInterface
{
    private static array $doctrineDrivers = [
        'orm' => [
            'registry' => 'doctrine',
            'class' => DoctrineORMListener::class,
        ],
        'mongodb' => [
            'registry' => 'doctrine_mongodb',
            'class' => DoctrineMongoDBListener::class,
        ],
    ];

    public function process(ContainerBuilder $container)
    {
        foreach (static::$doctrineDrivers as $key => $dbDriver) {
            if (false === $container->hasDefinition($dbDriver['registry'])) {
                continue;
            }

            $container
                ->setDefinition(
                    sprintf('oka_doctrine_secret_type.%s.kernel_listener', $key),
                    new Definition(
                        $dbDriver['class'],
                        [
                            new Parameter('oka_doctrine_secret_type.private_key_file'),
                            new Parameter('oka_doctrine_secret_type.public_key_file'),
                            new Parameter('oka_doctrine_secret_type.passphrase'),
                        ]
                    )
                )
                ->addTag('kernel.event_listener', ['event' => 'kernel.request']);
        }
    }
}
