<?php

namespace Skimia\Foundation\Testing\Traits;

use Skimia\Foundation\Testing\CommandOutput;

trait TestableCommandTrait
{
    protected $commandOutput = null;

    public function setCommandOutput(CommandOutput $commandOutput)
    {
        $this->commandOutput = $commandOutput;
    }

    /**
     * Prompt the user for input.
     *
     * @param  string  $question
     * @param  string  $default
     * @return string
     */
    public function ask($question, $default = null)
    {
        //dd($this->commandOutput);
        if (isset($this->commandOutput)) {
            $this->commandOutput->writeln('<ask>'.$question.'</ask>');
        } else {
            return;
        } //::ask($question,$default);

        return $default;
    }
}
