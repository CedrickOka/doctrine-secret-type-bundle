<?php

namespace Oka\Doctrine\SecretTypeBundle\EventListener;

/**
 * @author Cedrick Oka Baidai <okacedrick@gmail.com>
 */
abstract class AbstractDoctrineListener
{
    private $privateKeyFile;
    private $publicKeyFile;
    private $passphrase;

    protected $types;

    public function __construct(string $privateKeyFile, string $publicKeyFile, string $passphrase, array $types = [])
    {
        $this->privateKeyFile = $privateKeyFile;
        $this->publicKeyFile = $publicKeyFile;
        $this->passphrase = $passphrase;
        $this->types = $types;
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
