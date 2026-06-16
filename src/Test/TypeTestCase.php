<?php

namespace Oka\Doctrine\SecretTypeBundle\Test;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * @author Cedrick Oka Baidai <okacedrick@gmail.com>
 */
abstract class TypeTestCase extends KernelTestCase
{
    /**
     * @var \Doctrine\DBAL\Types\Type|\Doctrine\ODM\MongoDB\Types\Type
     */
    protected $type;

    protected function setUp(): void
    {
        static::bootKernel();

        $this->getType()->setPrivateKeyFile(static::getContainer()->getParameter('oka_doctrine_secret_type.private_key_file'))
                        ->setPublicKeyFile(static::getContainer()->getParameter('oka_doctrine_secret_type.public_key_file'))
                        ->setPassphrase(static::getContainer()->getParameter('oka_doctrine_secret_type.passphrase'));
    }

    abstract protected function getType(): \Doctrine\DBAL\Types\Type|\Doctrine\ODM\MongoDB\Types\Type;

    abstract protected function getTypeClass(): string;

    abstract protected function getTypeName(): string;
}
