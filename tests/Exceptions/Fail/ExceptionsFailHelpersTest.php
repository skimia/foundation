<?php

use Illuminate\Support\ServiceProvider;
use Skimia\Foundation\Exceptions\Fail\InvalidSuperclassUsedForTraitException;
use Skimia\Foundation\Exceptions\Fail\IsNotASubclassOfException;
use Skimia\Foundation\FoundationServiceProvider;
use Skimia\Foundation\Support\Traits\CommandLoaderTrait;

class ExceptionsFailHelpersTest extends TestCase
{
    /**
     *
     */
    public function testExceptionIsSubclassOfOrFailIsFired()
    {
        $this->setExpectedException(IsNotASubclassOfException::class);
        is_subclass_of_or_fail($this, ServiceProvider::class);
    }

    public function testExceptionIsSubclassOfOrFailIsNotFired()
    {
        $this->assertTrue(is_subclass_of_or_fail(FoundationServiceProvider::class, ServiceProvider::class));
    }

    public function testExceptionEnsureTraitUsedInSubclassOfOrFailIsFired()
    {
        $this->setExpectedException(InvalidSuperclassUsedForTraitException::class);
        ensure_trait_used_in_subclass_of_or_fail(CommandLoaderTrait::class, $this, ServiceProvider::class);
    }

    public function testExceptionIsSubclassOfOrFailOrFailIsNotFired()
    {
        $this->assertTrue(ensure_trait_used_in_subclass_of_or_fail(CommandLoaderTrait::class, FoundationServiceProvider::class, ServiceProvider::class));
    }
}
