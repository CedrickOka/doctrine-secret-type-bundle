<?php

namespace Oka\Doctrine\SecretTypeBundle\Types\Common;

use Doctrine\DBAL\Types\ConversionException;

/**
 * @author Cedrick Oka Baidai <okacedrick@gmail.com>
 */
trait SecretTypeTrait
{
    /**
     * @var string
     */
    private $privateKeyFile;

    /**
     * @var string
     */
    private $publicKeyFile;

    /**
     * @var string
     */
    private $passphrase = null;

    public function setPrivateKeyFile(string $privateKeyFile): self
    {
        $this->privateKeyFile = $privateKeyFile;

        return $this;
    }

    public function setPublicKeyFile(string $publicKeyFile): self
    {
        $this->publicKeyFile = $publicKeyFile;

        return $this;
    }

    public function setPassphrase(string $passphrase): self
    {
        $this->passphrase = $passphrase;

        return $this;
    }

    protected function encrypt(string $data, int $maxlength = 256): ?string
    {
        $output = '';
        $encrypted = null;
        $resource = fopen($this->publicKeyFile, 'r');
        $publicKey = openssl_get_publickey(fread($resource, filesize($this->publicKeyFile)));
        fclose($resource);

        while ($data) {
            if (false === openssl_public_encrypt(substr($data, 0, $maxlength), $encrypted, $publicKey)) {
                throw ConversionException::conversionFailedSerialization($data, $this->getName(), openssl_error_string());
            }

            $output .= $encrypted;
            $data = substr($data, $maxlength);
        }

        return base64_encode($output);
    }

    protected function decrypt(string $data, int $maxlength = 512): ?string
    {
        $output = '';
        $decrypted = null;
        $resource = fopen($this->privateKeyFile, 'r');
        $privateKey = openssl_get_privatekey(fread($resource, filesize($this->privateKeyFile)), $this->passphrase);
        fclose($resource);
        $data = base64_decode($data);

        while ($data) {
            if (false === openssl_private_decrypt(substr($data, 0, $maxlength), $decrypted, $privateKey)) {
                throw ConversionException::conversionFailedUnserialization($data, $this->getName(), openssl_error_string());
            }

            $output .= $decrypted;
            $data = substr($data, $maxlength);
        }

        return $output;
    }
}
