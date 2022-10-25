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

    public function __construct(string $privateKeyFile, string $publicKeyFile, string $passphrase)
    {
        $this->privateKeyFile = $privateKeyFile;
        $this->publicKeyFile = $publicKeyFile;
        $this->passphrase = $passphrase;
    }

    public function onKernelRequest(): void
    {
        $typeClass = $this->getTypeClassName();

        foreach ($this->getTypes() as $type) {
            if (true === $typeClass::hasType($type)) {
                $typeClass::getType($type)
                            ->setPrivateKeyFile($this->privateKeyFile)
                            ->setPublicKeyFile($this->publicKeyFile)
                            ->setPassphrase($this->passphrase);
            }
        }
    }

    abstract protected function getTypeClassName(): string;

    abstract protected function getTypes(): array;
}
