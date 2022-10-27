<?php

namespace Oka\Doctrine\SecretTypeBundle\EventListener;

use Doctrine\ODM\MongoDB\Types\Type;
use Doctrine\Persistence\Event\LoadClassMetadataEventArgs;

/**
 * @author Cedrick Oka Baidai <okacedrick@gmail.com>
 */
class DoctrineMongoDBListener extends AbstractDoctrineListener
{
    public function loadClassMetadata(LoadClassMetadataEventArgs $args): void
    {
        $this->configureTypes();
    }

    protected function getTypeClass(): string
    {
        return Type::class;
    }
}
