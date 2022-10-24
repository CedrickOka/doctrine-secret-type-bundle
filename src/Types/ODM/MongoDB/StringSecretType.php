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

    public function convertToDatabaseValue($value)
    {
        return null === $value || '' === $value ? null : $this->encrypt($value);
    }

    public function convertToPHPValue($value)
    {
        return null !== $value ? $this->decrypt($value) : null;
    }

    public function closureToPHP(): string
    {
        return '$type = \Doctrine\ODM\MongoDB\Types\Type::getType(\'string_secret\');
				$return = (string) $type->convertToPHPValue($value);';
    }

    public function getName()
    {
        return 'string_secret';
    }
}
