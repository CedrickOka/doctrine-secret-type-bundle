<?php

namespace Oka\Doctrine\SecretTypeBundle;

use Oka\Doctrine\SecretTypeBundle\DependencyInjection\CompilerPass\DoctrineTypePass;
use Symfony\Component\DependencyInjection\Compiler\PassConfig;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * @author Cedrick Oka Baidai <okacedrick@gmail.com>
 */
class OkaDoctrineSecretTypeBundle extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }

    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new DoctrineTypePass(), PassConfig::TYPE_BEFORE_OPTIMIZATION, 255);
    }
}
