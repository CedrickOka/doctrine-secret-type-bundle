<?php

namespace Oka\Doctrine\SecretTypeBundle\EventListener;

use Doctrine\DBAL\Types\Type;

/**
 * @author Cedrick Oka Baidai <okacedrick@gmail.com>
 */
class DoctrineORMListener extends AbstractDoctrineListener
{
    protected function getTypeClassName(): string
    {
        return Type::class;
    }

    protected function getTypes(): array
    {
        return [
            'string_secret',
            'json_secret',
        ];
    }
}
