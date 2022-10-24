<?php

namespace Oka\Doctrine\SecretTypeBundle\Tests\Types\DBAL;

use Doctrine\DBAL\Platforms\MySQLPlatform;
use Doctrine\DBAL\Types\Type;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * @author Cedrick Oka Baidai <okacedrick@gmail.com>
 */
class StringSecretTypeTest extends KernelTestCase
{
    /**
     * @covers
     */
    public function testThatWeEncryptValue()
    {
        static::bootKernel();

        /** @var \Oka\Doctrine\SecretTypeBundle\Types\DBAL\StringSecretType $type */
        $type = Type::getType('string_secret');
        $dbValue = $type->convertToDatabaseValue('Hello World!', new MySQLPlatform());
        $phpValue = $type->convertToPHPValue($dbValue, new MySQLPlatform());

        $this->assertEquals('Hello World!', $phpValue);
        dd($dbValue);
    }
}
