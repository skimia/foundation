<?php

use Symfony\Component\Finder\Finder;
use Doctrine\Common\Annotations\AnnotationRegistry;

class AnnotationRegistryTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return Skimia\ApiFusion\Annotations\ApiRouting\Scanner
     */
    public function registerAnnotations()
    {
        $scanner = new \Skimia\ApiFusion\Annotations\ApiRouting\Scanner($this->app, []);

        foreach (Finder::create()->files()->in(__DIR__.'/fixtures/Annotations') as $file) {
            AnnotationRegistry::registerFile($file->getRealPath());
        }
        return $scanner;
    }

    /**
     *
     */
    public function testAnnotationsRegistered()
    {
        $scanner = $this->registerAnnotations();
        $file_exist = $scanner->annotationsAreScanned();
        $this->assertTrue(class_exists(TestAnnotation::class));

        if($file_exist)
            $this->assertFileExists($scanner->getScannedAnnotationPath());
        else
            $this->assertFileNotExists($scanner->getScannedAnnotationPath());
    }
}
