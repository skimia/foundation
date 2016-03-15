<?php

namespace Skimia\Foundation\Annotations;

use Illuminate\Contracts\Foundation\Application;
use Collective\Annotations\AnnotationScanner as BaseScanner;

abstract class Scanner extends BaseScanner
{
    /**
     * @var Application
     */
    protected $app;

    /**
     * @param Application $app
     */
    public function __construct(Application $app, array $scan)
    {
        $this->app = $app;

        //TODO option to set automatically $namespaces & annotationRegistery for simpler & faster config
        parent::__construct($scan);
    }

    /**
     * Get the path to the scanned annotation file.
     * @return string
     */
    abstract public function getScannedAnnotationPath();

    public function annotationsAreScanned()
    {
        return $this->app['files']->exists($this->getScannedAnnotationPath());
    }

    /**
     * @codeCoverageIgnore
     */
    public function loadScannedAnnotations()
    {
        if ($this->annotationsAreScanned()) {
            require $this->getScannedAnnotationPath();

            return true;
        }

        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function scan()
    {
        $filename = $this->getScannedAnnotationPath();
        file_put_contents(
            $filename, '<?php '.$this->getAnnotationsDefinitions()
        );
        chmod($filename, fileperms($filename) | 128 + 16 + 2);
    }

    abstract public function getAnnotationsDefinitions();
}
