<?php namespace Skimia\Foundation\Support\Traits;

use Illuminate\Console\AppNamespaceDetectorTrait;

trait NamespaceClassFinderTrait
{
    use AppNamespaceDetectorTrait;

    /**
     * Convert the given namespace to a file path
     *
     * @param  string $namespace the namespace to convert
     *
     * @return string
     */
    public function convertNamespaceToPath($namespace)
    {
        // remove the app namespace from the namespace if it is there
        $appNamespace = $this->getAppNamespace();

        if (substr($namespace, 0, strlen($appNamespace)) == $appNamespace)
        {
            $namespace = substr($namespace, strlen($appNamespace));
        }

        // trim and return the path
        return str_replace('\\', '/', trim($namespace, ' \\'));
    }

    /**
     * Get a list of the classes in a namespace. Leaving the second argument
     * will scan for classes within the project's app directory
     *
     * @param string  $namespace the namespace to search
     * @param null    $base
     *
     * @return array
     */
    public function getClassesFromNamespace($namespace, $base = null)
    {
        $directory = ($base ?: app('path')) . '/' . $this->convertNamespaceToPath($namespace);

        return app('Illuminate\Filesystem\ClassFinder')->findClasses($directory);
    }

    /**
     * Get a list of classes in the root namespace.
     *
     * @return array
     */
    protected function getAllClasses()
    {
        return $this->getClassesFromNamespace($this->getAppNamespace());
    }
}
