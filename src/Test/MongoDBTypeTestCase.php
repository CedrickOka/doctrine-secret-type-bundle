<?php

namespace Oka\Doctrine\SecretTypeBundle\Test;

use Doctrine\ODM\MongoDB\Types\Type;

/**
 * @author Cedrick Oka Baidai <okacedrick@gmail.com>
 */
abstract class MongoDBTypeTestCase extends TypeTestCase
{
    protected function getType(): \Doctrine\DBAL\Types\Type|Type
    {
        if (false === Type::hasType($this->getTypeName())) {
            Type::addType($this->getTypeName(), $this->getTypeClass());
        }

        return Type::getType($this->getTypeName());
    }
}
