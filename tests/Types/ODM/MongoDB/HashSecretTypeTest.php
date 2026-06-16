<?php

namespace Oka\Doctrine\SecretTypeBundle\Tests\Types\ODM\MongoDB;

use Oka\Doctrine\SecretTypeBundle\Test\MongoDBTypeTestCase;
use Oka\Doctrine\SecretTypeBundle\Types\ODM\MongoDB\HashSecretType;

/**
 * @author Cedrick Oka Baidai <okacedrick@gmail.com>
 */
class HashSecretTypeTest extends MongoDBTypeTestCase
{
    /**
     * @covers
     */
    public function testThatWeEncryptValue()
    {
        /** @var HashSecretType $type */
        $type = $this->getType();
        $dbValue = $type->convertToDatabaseValue(['greeting' => 'Hello World!']);
        $phpValue = $type->convertToPHPValue($dbValue);

        $this->assertEquals(['greeting' => 'Hello World!'], $phpValue);
    }

    protected function getTypeClass(): string
    {
        return HashSecretType::class;
    }

    protected function getTypeName(): string
    {
        return HashSecretType::HASH_SECRET;
    }
}
