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

        /** @var \Doctrine\ORM\EntityManagerInterface $em */
        $em = static::$container->get('doctrine.orm.entity_manager');
        /** @var \Doctrine\ODM\MongoDB\DocumentManager $dm */
        $dm = static::$container->get('doctrine_mongodb.odm.document_manager');
    }
}
