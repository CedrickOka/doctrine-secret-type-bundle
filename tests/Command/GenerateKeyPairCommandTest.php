<?php

namespace Oka\Doctrine\SecretTypeBundle\Tests\Command;

use Oka\Doctrine\SecretTypeBundle\Command\GenerateKeyPairCommand;
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

        $command = $application->find(GenerateKeyPairCommand::getDefaultName());
        $commandTester = new CommandTester($command);
        $commandTester->execute(['--overwrite' => true]);

        $commandTester->assertCommandIsSuccessful();
    }
}
