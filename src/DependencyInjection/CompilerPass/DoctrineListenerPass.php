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
class DoctrineListenerPass implements CompilerPassInterface
{
    private static array $doctrineDrivers = [
        'orm' => [
            'registry' => 'doctrine',
            'class' => DoctrineORMListener::class,
            'types' => [
                'string_secret',
                'json_secret',
            ],
            'tags' => [
                [
                    'name' => 'doctrine.event_listener',
                    'event' => 'postConnect',
                ],
            ],
        ],
        'mongodb' => [
            'registry' => 'doctrine_mongodb',
            'class' => DoctrineMongoDBListener::class,
            'types' => [
                'string_secret',
                'hash_secret',
            ],
            'tags' => [
                [
                    'name' => 'doctrine_mongodb.odm.event_listener',
                    'event' => 'loadClassMetadata',
                ],
                [
                    'name' => 'doctrine_mongodb.odm.event_listener',
                    'event' => 'prePersist',
                ],
                [
                    'name' => 'doctrine_mongodb.odm.event_listener',
                    'event' => 'preUpdate',
                ],
                [
                    'name' => 'doctrine_mongodb.odm.event_listener',
                    'event' => 'preLoad',
                ],
            ],
        ],
    ];

    public function process(ContainerBuilder $container)
    {
        foreach (static::$doctrineDrivers as $key => $dbDriver) {
            if (false === $container->hasDefinition($dbDriver['registry'])) {
                continue;
            }

            $definition = $container->setDefinition(
                sprintf('oka_doctrine_secret_type.%s.doctrine_listener', $key),
                new Definition(
                    $dbDriver['class'],
                    [
                        new Parameter('oka_doctrine_secret_type.private_key_file'),
                        new Parameter('oka_doctrine_secret_type.public_key_file'),
                        new Parameter('oka_doctrine_secret_type.passphrase'),
                        $dbDriver['types'],
                    ]
                )
            );

            foreach ($dbDriver['tags'] as $tag) {
                $definition->addTag($tag['name'], ['event' => $tag['event']]);
            }
        }
    }
}
