<?php

namespace Oka\Doctrine\SecretTypeBundle\Tests\Command;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

/**
 * @author Cedrick Oka Baidai <okacedrick@gmail.com>
 */
class GenerateKeyPairCommandTest extends KernelTestCase
{
    /**
     * @covers
     */
    public function testThatCanExecute()
    {
        $kernel = static::createKernel();
        $application = new Application($kernel);

        $command = $application->find('coka:doctrine:secret:type:generate-keypair');
        $commandTester = new CommandTester($command);
        $commandTester->execute(['--overwrite' => true]);

        $commandTester->assertCommandIsSuccessful();
    }
}
