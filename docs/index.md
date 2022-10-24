# Getting Started With OkaDoctrineSecretTypeBundle

This bundle help the user input high quality data into your web services REST.

## Prerequisites

The OkaDoctrineSecretTypeBundle has the following requirements:

 - PHP 8.0+
 - Symfony 5.4+

## Installation

Installation is a quick (I promise!) 3 step process:

1. Download OkaDoctrineSecretTypeBundle
2. Register the Bundle
3. Configure the Bundle
4. Use bundle and enjoy!

### Step 1: Download the Bundle

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```bash
$ composer require coka/doctrine-secret-type-bundle
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

### Step 2: Register the Bundle

Then, register the bundle by adding it to the list of registered bundles
in the `config/bundles.php` file of your project (Flex did it automatically):

```php
return [
    //...
    Oka\Doctrine\SecretTypeBundle\OkaDoctrineSecretTypeBundle::class => ['all' => true],
]
```

### Step 3: Configure the Bundle

Add the following configuration in the file `config/packages/oka_doctrine_secret_type.yaml`.

```yaml
# config/packages/oka_doctrine_secret_type.yaml
doctrine:
    dbal:
        types:
            string_secret: 'Oka\Doctrine\SecretTypeBundle\Types\DBAL\StringSecretType'
            json_secret: 'Oka\Doctrine\SecretTypeBundle\Types\DBAL\JsonSecretType'
        mapping_types:
            string_secret: text
            json_secret: text

doctrine_mongodb:
    types:
        string_secret: 'Oka\Doctrine\SecretTypeBundle\Types\ODM\MongoDB\StringSecretType'
        hash_secret: 'Oka\Doctrine\SecretTypeBundle\Types\ODM\MongoDB\HashSecretType'

oka_doctrine_secret_type:
    private_key_file: '%env(resolve:COKA_SECRET_TYPE_PRIVATE_KEY_FILE)%'
    public_key_file: '%env(resolve:COKA_SECRET_TYPE_PUBLIC_KEY_FILE)%'
    passphrase: '%env(COKA_SECRET_TYPE_PASSPHRASE)%'
```

### Step 4: Use the bundle is simple

Now that the bundle is installed. 

```php
<?php
// App\Entity\Foo.php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * 
 */
#[ORM\Entity]
class Foo
{
    // ...
    
    /**
     * #[ORM\Column(type: 'string_secret')]
     *
     * @var string
     */
    protected $secret;
}
``` 
