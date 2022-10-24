<?php

namespace Oka\Doctrine\SecretTypeBundle\Types\DBAL;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\TextType;
use Oka\Doctrine\SecretTypeBundle\Types\Common\SecretTypeTrait;

/**
 * @author Cedrick Oka Baidai <okacedrick@gmail.com>
 */
class StringSecretType extends TextType
{
    use SecretTypeTrait;

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (null === $value || '' === $value) {
            return null;
        }

        return parent::convertToDatabaseValue($this->encrypt($value), $platform);
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        $value = parent::convertToPHPValue($value, $platform);

        if (null === $value) {
            return null;
        }

        return $this->decrypt($value);
    }

    public function getMappedDatabaseTypes(AbstractPlatform $platform): array
    {
        return ['text'];
    }

    public function getName()
    {
        return 'string_secret';
    }
}
