<?php

namespace Oka\Doctrine\SecretTypeBundle\Tests\Types\ODM\MongoDB;

use Oka\Doctrine\SecretTypeBundle\Test\MongoDBTypeTestCase;
use Oka\Doctrine\SecretTypeBundle\Types\ODM\MongoDB\StringSecretType;

/**
 * @author Cedrick Oka Baidai <okacedrick@gmail.com>
 */
class StringSecretTypeTest extends MongoDBTypeTestCase
{
    /**
     * @covers
     */
    public function testThatWeEncryptValue()
    {
        /** @var StringSecretType $type */
        $type = $this->getType();
        $dbValue = $type->convertToDatabaseValue('Hello World!');
        $phpValue = $type->convertToPHPValue($dbValue);

        $this->assertEquals('Hello World!', $phpValue);
    }

    protected function getTypeClass(): string
    {
        return StringSecretType::class;
    }

    protected function getTypeName(): string
    {
        return StringSecretType::STRING_SECRET;
    }
}
