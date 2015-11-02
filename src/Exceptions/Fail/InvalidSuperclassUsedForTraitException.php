<?php namespace Skimia\Foundation\Exceptions\Fail;


class InvalidSuperclassUsedForTraitException extends \LogicException
{


    public function __construct($trait_name, $class_name, $message = "", \Exception $previous = null) {

        parent::__construct($message ?:
            sprintf('%s may be used only in classes that extends %s.',
                $trait_name,
                $class_name
            ), $previous);
    }

}