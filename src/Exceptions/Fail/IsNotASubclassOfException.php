<?php namespace Skimia\Foundation\Exceptions\Fail;


class IsNotASubclassOfException extends \LogicException
{


    public function __construct($object_name, $class_name, $message = "", \Exception $previous = null) {

        parent::__construct($message ?:
            sprintf('Object "%s" is not a subclass of "%s".', $object_name, $class_name),
            $previous);
    }

}