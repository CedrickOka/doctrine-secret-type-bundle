<?php

namespace Oka\Doctrine\SecretTypeBundle\Tests\Types\DBAL;

use Doctrine\DBAL\Platforms\MySQLPlatform;
use Doctrine\DBAL\Types\Type;
use Oka\Doctrine\SecretTypeBundle\Test\KernelTestCase;

/**
 * @author Cedrick Oka Baidai <okacedrick@gmail.com>
 */
class JsonSecretTypeTest extends KernelTestCase
{
    /**
     * @covers
     */
    public function testThatWeEncryptValue()
    {
        /** @var \Oka\Doctrine\SecretTypeBundle\Types\DBAL\JsonSecretType $type */
        $type = Type::getType('json_secret');
        $dbValue = $type->convertToDatabaseValue(['greeting' => 'Hello World!'], new MySQLPlatform());
        $phpValue = $type->convertToPHPValue($dbValue, new MySQLPlatform());

        $this->assertEquals(['greeting' => 'Hello World!'], $phpValue);
    }
}
