<?php

namespace Oka\Doctrine\SecretTypeBundle\Tests\Types\ODM\MongoDB;

use Doctrine\ODM\MongoDB\Types\Type;
use Oka\Doctrine\SecretTypeBundle\Test\KernelTestCase;

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
        /** @var \Oka\Doctrine\SecretTypeBundle\Types\ODM\MongoDB\StringSecretType $type */
        $type = Type::getType('string_secret');
        $dbValue = $type->convertToDatabaseValue('Hello World!');
        $phpValue = $type->convertToPHPValue($dbValue);

        $this->assertEquals('Hello World!', $phpValue);
    }
}
