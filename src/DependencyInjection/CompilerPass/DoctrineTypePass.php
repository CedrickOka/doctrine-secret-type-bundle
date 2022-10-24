<?php

namespace Oka\Doctrine\SecretTypeBundle\DependencyInjection\CompilerPass;

use Doctrine\DBAL\Types\Type as DBALType;
use Doctrine\ODM\MongoDB\Types\Type as MongoDBType;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * @author Cedrick Oka Baidai <okacedrick@gmail.com>
 */
class DoctrineTypePass implements CompilerPassInterface
{
    private static array $doctrineDrivers = [
        'orm' => [
            'registry' => 'doctrine',
            'class' => DBALType::class,
            'types' => [
                'string_secret',
                'json_secret',
            ],
        ],
        'mongodb' => [
            'registry' => 'doctrine_mongodb',
            'class' => MongoDBType::class,
            'types' => [
                'string_secret',
                'hash_secret',
            ],
        ],
    ];

    public function process(ContainerBuilder $container)
    {
        $privateKeyFile = $container->getParameter('oka_doctrine_secret_type.private_key_file');
        $publicKeyFile = $container->getParameter('oka_doctrine_secret_type.public_key_file');
        $passphrase = $container->getParameter('oka_doctrine_secret_type.passphrase');

        foreach (static::$doctrineDrivers as $dbDriver) {
            if (false === $container->hasDefinition($dbDriver['registry'])) {
                continue;
            }

            $typeClass = $dbDriver['class'];

            foreach ($dbDriver['types'] as $type) {
                if (true === $typeClass::hasType($type)) {
                    $typeClass::getType($type)
                                ->setPrivateKeyFile($privateKeyFile)
                                ->setPublicKeyFile($publicKeyFile)
                                ->setPassphrase($passphrase);
                }
            }
        }
    }
}
