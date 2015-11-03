<?php

use Skimia\Foundation\Support\Traits\CommandLoaderTrait;

class ProvidersTraitsCommandLoaderTest extends TestCase
{
    public function testRegisterCommandsIsCalled()
    {
        require_once 'fixtures/ServiceProviderMock.php';

        $serviceProvider = new ServiceProviderMock($this->app);

        $serviceProvider->register();

        $this->assertTrue($serviceProvider->registerCommandIsFired, 'pass if the commandloadertrait call the registerCommand sucessfully '.PHP_EOL.'see "'.CommandLoaderTrait::class.'::registerCommands()"');

        $this->assertArrayHasKey('skimia.phpunit.command.test', Artisan::all(), 'pass if the command is registered in artisan');

        $this->assertTrue(

            get_class(Artisan::all()['skimia.phpunit.command.test']) == CommandMock::class, 'pass if the command registered is really the command defined in the ServiceProviderMock'
        );
    }
}
