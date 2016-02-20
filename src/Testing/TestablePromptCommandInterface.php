<?php
/**
 * Created by PhpStorm.
 * User: kessler
 * Date: 20/02/16
 * Time: 14:17
 */

namespace Skimia\Foundation\Testing;


interface TestablePromptCommandInterface
{

    public function setCommandOutput(CommandOutput $commandOutput);
}