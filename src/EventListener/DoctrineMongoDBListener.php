<?php

namespace Oka\Doctrine\SecretTypeBundle\EventListener;

use Doctrine\ODM\MongoDB\Types\Type;
use Doctrine\Persistence\Event\LifecycleEventArgs;
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

    public function prePersist(LifecycleEventArgs $args): void
    {
        $this->configureTypes();
    }

    public function preUpdate(LifecycleEventArgs $args): void
    {
        $this->configureTypes();
    }

    public function preLoad(LifecycleEventArgs $args): void
    {
        $this->configureTypes();
    }

    protected static function getTypeClass(): string
    {
        return Type::class;
    }
}
