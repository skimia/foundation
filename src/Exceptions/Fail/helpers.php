<?php

use Skimia\Foundation\Exceptions\Fail\IsNotASubclassOfException;
use Skimia\Foundation\Exceptions\Fail\InvalidSuperclassUsedForTraitException;

if (! function_exists('is_subclass_of_or_fail')) {
    function is_subclass_of_or_fail($object, $class_name, $allow_string = true)
    {
        //TODO: Implement Message
        if (! is_subclass_of($object, $class_name, $allow_string)) {
            throw new IsNotASubclassOfException(
                is_object($object) ? get_class($object) : $object,
                $class_name);
        }

        return true;
    }
}

if (! function_exists('ensure_trait_used_in_subclass_of_or_fail')) {

    /**
     * @param $trait mixed The trait name (use get_class(self)).
     * @param $object mixed A class name or an object instance. No error is generated if the class does not exist.
     * @param $class_name string The required parent class name
     * @param bool|true $allow_string
     *
     * @throws LogicException if the trait is used in class not extends the required
     *
     * @return bool
     */
    function ensure_trait_used_in_subclass_of_or_fail($trait, $object, $class_name, $allow_string = true)
    {
        if (! is_subclass_of($object, $class_name, $allow_string)) {
            throw new InvalidSuperclassUsedForTraitException(
                is_object($trait) ? get_class($trait) : $trait,
                is_object($class_name) ? get_class($class_name) : $class_name
                );
        }

        return true;
    }
}
