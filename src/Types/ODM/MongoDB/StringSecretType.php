<?php

namespace Oka\Doctrine\SecretTypeBundle\Types\ODM\MongoDB;

use Doctrine\ODM\MongoDB\Types\StringType;
use Oka\Doctrine\SecretTypeBundle\Types\Common\SecretTypeTrait;

/**
 * @author Cedrick Oka Baidai <okacedrick@gmail.com>
 */
class StringSecretType extends StringType
{
    use SecretTypeTrait;

    public const STRING_SECRET = 'string_secret';

    public function convertToDatabaseValue($value): ?string
    {
        return null === $value || '' === $value ? null : $this->encrypt($value);
    }

    public function convertToPHPValue($value): ?string
    {
        return null !== $value ? $this->decrypt($value) : null;
    }

    public function closureToPHP(): string
    {
        return '$type = \Doctrine\ODM\MongoDB\Types\Type::getType(\Oka\Doctrine\SecretTypeBundle\Types\ODM\MongoDB\StringSecretType::STRING_SECRET);
				$return = (string) $type->convertToPHPValue($value);';
    }

    public function getName(): string
    {
        return self::STRING_SECRET;
    }
}
