<?php

namespace Oka\Doctrine\SecretTypeBundle\Tests\Types\DBAL;

use Doctrine\DBAL\Platforms\MySQLPlatform;
use Doctrine\DBAL\Types\Type;
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
        $text = <<<EOF
Parfois, plusieurs longues phrases peuvent être réduites au minimum de leur compte de caractères. En effet, beaucoup d'expressions grammaticales doivent seulement être écrites une fois, au lieu de plusieurs fois. Une virgule, alors qu'elle compte, pourrait accomplir les mêmes effets qu'un certain nombre de lettres. Contre-productif? Non, pas vraiment. 
EOF;

        /** @var \Oka\Doctrine\SecretTypeBundle\Types\DBAL\StringSecretType $type */
        $type = Type::getType('string_secret');
        $dbValue = $type->convertToDatabaseValue($text, new MySQLPlatform());
        $phpValue = $type->convertToPHPValue($dbValue, new MySQLPlatform());

        $this->assertEquals($text, $phpValue);
    }
}
