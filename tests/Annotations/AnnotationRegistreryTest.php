<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Symfony\Component\Finder\Finder;
use Skimia\ApiFusion\Annotations\ApiRouting\Scanner as ApiRouteScanner;
use Doctrine\Common\Annotations\AnnotationRegistry;

class AnnotationRegistryTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function registerAnnotations()
    {
        $scanner = new \Skimia\ApiFusion\Annotations\ApiRouting\Scanner($this->app,[]);

        foreach (Finder::create()->files()->in(__DIR__.'/fixtures/Annotations') as $file)
        {
            AnnotationRegistry::registerFile($file->getRealPath());
        }

    }

    /**
     *
     */
    public function testAnnotationsRegistered(){

        $this->registerAnnotations();
        $this->assertTrue(class_exists(TestAnnotation::class));

    }


}
