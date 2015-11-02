<?php


class ServiceProviderMock extends \Illuminate\Support\ServiceProvider
{
    use \Skimia\Foundation\Providers\Traits\CommandLoaderTrait;



    protected $commands = [
        'Test' => 'skimia.phpunit.command.test',
    ];
    
    /**
     * @inheritDoc
     */
    public function register()
    {
        $this->registerCommands();
    }

    public function removeCommandsField(){
        unset ($this->commands);
    }


    public $registerCommandIsFired = false;

    public function registerTestCommand(){

        $this->registerCommandIsFired = true;

        $this->app->singleton('skimia.phpunit.command.test', function ($app)
        {
            //TODO: return a real instance of command;
            return new CommandMock();
        });
    }

}

class CommandMock extends \Illuminate\Console\Command{

    protected $signature = 'skimia.phpunit.command.test';

}