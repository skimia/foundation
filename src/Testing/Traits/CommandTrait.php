<?php

namespace Skimia\Foundation\Testing\Traits;

use Skimia\Foundation\Testing\CommandOutput;
use Skimia\Foundation\Testing\TestablePromptCommandInterface;
use Symfony\Component\Console\Input\ArrayInput;
use Illuminate\Console\Command ;
trait CommandTrait
{

    /**
     * @var null
     */
    protected $commandOutput = null;

    /**
     * @return CommandOutput
     */
    public function getCommandOutput(){
        if(!isset($this->commandOutput))
            $this->commandOutput = new CommandOutput;

        return $this->commandOutput;
    }

    /**
     * @param \Illuminate\Console\Command $mockedCommandObject
     * @param array $arguments
     * @return int
     */
    public function invokeCommand(Command $mockedCommandObject, $arguments = []){

        $mockedCommandObject->setLaravel(app());

        return $mockedCommandObject->run(new ArrayInput($arguments),
            $this->getCommandOutput());
    }

    /**
     * @param TestablePromptCommandInterface $commandObject
     * @param array $arguments
     * @return int
     */
    public function invokeCommandWithPrompt(TestablePromptCommandInterface $commandObject, $arguments = []){


        $commandObject->setCommandOutput($this->getCommandOutput());
        return $this->invokeCommand($commandObject,$arguments);
    }

    public function cleanOutputAndInvokeCommand(\Illuminate\Console\Command $commandObject, $arguments = []){

        $this->commandOutput = null;

        return $this->invokeCommand($commandObject,$arguments);
    }
}