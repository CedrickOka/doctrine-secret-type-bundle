<?php

namespace Oka\Doctrine\SecretTypeBundle\Tests\Types\DBAL;

use Doctrine\DBAL\Platforms\MySQLPlatform;
use Oka\Doctrine\SecretTypeBundle\Test\DBALTypeTestCase;
use Oka\Doctrine\SecretTypeBundle\Types\DBAL\TextSecretType;

/**
 * @author Cedrick Oka Baidai <okacedrick@gmail.com>
 */
class TextSecretTypeTest extends DBALTypeTestCase
{
    /**
     * @covers
     */
    public function testThatWeEncryptValue()
    {
        /** @var TextSecretType $type */
        $type = $this->getType();
        $dbValue = $type->convertToDatabaseValue('Hello World!', new MySQLPlatform());
        $phpValue = $type->convertToPHPValue($dbValue, new MySQLPlatform());

        $this->assertEquals('Hello World!', $phpValue);
    }

    protected function getTypeClass(): string
    {
        return TextSecretType::class;
    }

    protected function getTypeName(): string
    {
        return TextSecretType::TEXT_SECRET;
    }
}
