<?php

namespace Oka\Doctrine\SecretTypeBundle\EventListener;

/**
 * @author Cedrick Oka Baidai <okacedrick@gmail.com>
 */
abstract class AbstractDoctrineListener
{
    public function __construct(
        private string $privateKeyFile,
        private string $publicKeyFile,
        private string $passphrase,
        protected array $types = [],
    ) {
    }

    protected function configureTypes(): void
    {
        $typeClass = static::getTypeClass();

        foreach ($this->types as $type) {
            if (true === $typeClass::hasType($type)) {
                $typeClass::getType($type)
                        ->setPrivateKeyFile($this->privateKeyFile)
                        ->setPublicKeyFile($this->publicKeyFile)
                        ->setPassphrase($this->passphrase);
            }
        }
    }

    abstract protected static function getTypeClass(): string;
}
