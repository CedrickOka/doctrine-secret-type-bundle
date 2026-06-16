<?php

namespace Oka\Doctrine\SecretTypeBundle\Types\ODM\MongoDB;

use Doctrine\ODM\MongoDB\MongoDBException;
use Doctrine\ODM\MongoDB\Types\Type;
use Oka\Doctrine\SecretTypeBundle\Types\Common\SecretTypeTrait;

/**
 * @author Cedrick Oka Baidai <cedric.baidai@veone.net>
 */
class HashSecretType extends Type
{
    use SecretTypeTrait;

    public const HASH_SECRET = 'hash_secret';

    public function convertToDatabaseValue($value): ?string
    {
        if (null !== $value && false === is_array($value)) {
            throw MongoDBException::invalidValueForType('HashSecret', ['array', 'null'], $value);
        }

        return null !== $value ? $this->encrypt(json_encode($value, JSON_THROW_ON_ERROR | JSON_PRESERVE_ZERO_FRACTION)) : null;
    }

    public function convertToPHPValue($value): ?array
    {
        return null !== $value ? json_decode($this->decrypt($value), true) : null;
    }

    public function closureToPHP(): string
    {
        return '$type = \Doctrine\ODM\MongoDB\Types\Type::getType(\Oka\Doctrine\SecretTypeBundle\Types\ODM\MongoDB\HashSecretType::HASH_SECRET);
				$return = $type->convertToPHPValue($value);';
    }

    public function getName(): string
    {
        return self::HASH_SECRET;
    }
}
