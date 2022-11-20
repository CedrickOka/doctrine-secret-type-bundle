<?php

namespace Oka\Doctrine\SecretTypeBundle\EventListener;

use Doctrine\DBAL\Event\ConnectionEventArgs;
use Doctrine\DBAL\Types\Type;

/**
 * @author Cedrick Oka Baidai <okacedrick@gmail.com>
 */
class DoctrineORMListener extends AbstractDoctrineListener
{
    public function postConnect(ConnectionEventArgs $args): void
    {
        $this->configureTypes();
    }

    protected static function getTypeClass(): string
    {
        return Type::class;
    }
}
