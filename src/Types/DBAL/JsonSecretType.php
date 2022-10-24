<?php

namespace Oka\Doctrine\SecretTypeBundle\Types\DBAL;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\JsonType;
use Oka\Doctrine\SecretTypeBundle\Types\Common\SecretTypeTrait;

/**
 * @author Cedrick Oka Baidai <cedric.baidai@veone.net>
 */
class JsonSecretType extends JsonType
{
    use SecretTypeTrait;

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return $platform->getClobTypeDeclarationSQL($fieldDeclaration);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        $value = parent::convertToDatabaseValue($value, $platform);

        if (null === $value) {
            return null;
        }

        return $this->encrypt($value);
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if (null === $value || '' === $value) {
            return null;
        }

        return parent::convertToPHPValue($this->decrypt($value), $platform);
    }

    public function getMappedDatabaseTypes(AbstractPlatform $platform): array
    {
        return ['text'];
    }

    public function getName()
    {
        return 'json_secret';
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform)
    {
        return true;
    }
}
