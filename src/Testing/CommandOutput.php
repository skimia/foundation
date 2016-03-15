<?php
/**
 * Created by PhpStorm.
 * User: kessler
 * Date: 20/02/16
 * Time: 13:31.
 */
namespace Skimia\Foundation\Testing;

use Symfony\Component\Console\Output\NullOutput;

class CommandOutput extends NullOutput
{
    protected $outputs = [];

    public function writeln($messages, $type = self::OUTPUT_NORMAL)
    {
        $this->outputs[] = $messages;
        parent::writeln($messages, $type); // TODO: Change the autogenerated stub
    }

    public function getOutputs()
    {
        return $this->outputs;
    }

    public function contains($needle)
    {
        foreach ($this->outputs as $line) {
            if (stristr($line, $needle) !== false) {
                return true;
            }
        }

        return false;
    }
}