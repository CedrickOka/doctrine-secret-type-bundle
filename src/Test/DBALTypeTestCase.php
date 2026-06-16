<?php

namespace Oka\Doctrine\SecretTypeBundle\Test;

use Doctrine\DBAL\Types\Type;

/**
 * @author Cedrick Oka Baidai <okacedrick@gmail.com>
 */
abstract class DBALTypeTestCase extends TypeTestCase
{
    protected function getType(): Type|\Doctrine\ODM\MongoDB\Types\Type
    {
        if (false === Type::hasType($this->getTypeName())) {
            Type::addType($this->getTypeName(), $this->getTypeClass());
        }

        return Type::getType($this->getTypeName());
    }
}
