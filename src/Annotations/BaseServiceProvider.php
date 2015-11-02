<?php namespace Skimia\Foundation\Annotations;


use Illuminate\Support\ServiceProvider;
use Skimia\Foundation\Providers\Traits\CommandLoaderTrait;
use Skimia\Foundation\Support\Traits\NamespaceClassFinderTrait;
use Illuminate\Contracts\Foundation\Application;

abstract class BaseServiceProvider extends ServiceProvider
{

    use NamespaceClassFinderTrait;

    /**
     * The classes to scan for annotations.
     *
     * @var array
     */
    protected $classesToScan = [];

    /**
     * Determines if we will auto-scan in the local environment.
     *
     * @var bool
     */
    protected $scanWhenLocal = true;

    /**
     * Determines whether or not to automatically scan all namespaced
     * classes for annotations.
     *
     * @var bool
     */
    protected $scanEverything = true;


    /**
     * @param \Illuminate\Contracts\Foundation\Application $app
     */
    public function __construct(Application $app)
    {
        //$this->finder = new AnnotationFinder($app);
        parent::__construct($app);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerAnnotationScanner();

        if(method_exists($this,'registerCommands'))
            $this->registerCommands();
    }

    /**
     * Register the application's annotated event listeners.
     *
     * @return void
     */
    public function boot()
    {
        $this->addAnnotations($this->getAnnotationScanner());

        $this->loadAnnotated();

    }

    /**
     * Register the scanner.
     *
     * @return void
     */
    protected abstract function registerAnnotationScanner();

    /**
     * @return Scanner
     */
    protected abstract function getAnnotationScanner();

    /**
     * Add annotation classes to the api routing scanner
     *
     * @param Scanner $scanner
     */
    public function addAnnotations(Scanner $scanner)
    {
    }


    /**
     * Scan the events for the application.
     *
     * @return void
     */
    protected function scanAnnotations()
    {
        $scans = $this->classesToScan();

        if (empty($scans))
        {
            return;
        }

        $scanner = $this->getAnnotationScanner();

        $scanner->setClassesToScan($scans);

        $scanner->scan();
    }

    /**
     * Load the annotated events.
     *
     * @return void
     */
    public function loadAnnotated()
    {
        if ($this->app->environment('local') && $this->scanWhenLocal)
        {
            $this->scanAnnotations();
        }

        $scans = $this->classesToScan();

        if ( ! empty($scans) && $this->getAnnotationScanner()->annotationsAreScanned())
        {
            $this->getAnnotationScanner()->loadScannedAnnotations();
        }
    }

    /**
     * Get the classes to be scanned by the provider.
     *
     * @return array
     */
    public function classesToScan()
    {
        if ($this->scanEverything)
        {
            return $this->getAllClasses();
        }

        return $this->classesToScan;
    }

}