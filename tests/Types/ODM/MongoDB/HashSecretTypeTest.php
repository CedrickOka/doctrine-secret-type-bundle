<?php

namespace Oka\Doctrine\SecretTypeBundle\Tests\Types\ODM\MongoDB;

use Doctrine\DBAL\Types\Type;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * @author Cedrick Oka Baidai <okacedrick@gmail.com>
 */
class HashSecretTypeTest extends KernelTestCase
{
    /**
     * @covers
     */
    public function testThatWeEncryptValue()
    {
        static::bootKernel();

        /** @var \Oka\Doctrine\SecretTypeBundle\Types\ODM\MongoDB\HashSecretType $type */
        $type = Type::getType('hash_secret');
        $dbValue = $type->convertToDatabaseValue(['greeting' => 'Hello World!']);
        $phpValue = $type->convertToPHPValue($dbValue);

        $this->assertEquals(['greeting' => 'Hello World!'], $phpValue);
        dd($dbValue);
    }
}
