<?php

namespace Oka\Doctrine\SecretTypeBundle\Test;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase as BaseKernelTestCase;

/**
 * @author Cedrick Oka Baidai <okacedrick@gmail.com>
 */
class KernelTestCase extends BaseKernelTestCase
{
    protected function setUp(): void
    {
        static::bootKernel();

        /* @var \Oka\Doctrine\SecretTypeBundle\EventListener\DoctrineORMListener $listener */
        static::$container->get('oka_doctrine_secret_type.orm.kernel_listener')->onKernelRequest();
        /* @var \Oka\Doctrine\SecretTypeBundle\EventListener\DoctrineMongoDBListener $listener */
        static::$container->get('oka_doctrine_secret_type.orm.kernel_listener')->onKernelRequest();
    }
}
