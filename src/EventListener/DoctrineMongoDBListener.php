<?php

namespace Oka\Doctrine\SecretTypeBundle\EventListener;

use Doctrine\ODM\MongoDB\Types\Type;

/**
 * @author Cedrick Oka Baidai <okacedrick@gmail.com>
 */
class DoctrineMongoDBListener extends AbstractDoctrineListener
{
    protected function getTypeClassName(): string
    {
        return Type::class;
    }

    protected function getTypes(): array
    {
        return [
            'string_secret',
            'hash_secret',
        ];
    }
}
