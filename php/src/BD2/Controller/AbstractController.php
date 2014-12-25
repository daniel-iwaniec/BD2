<?php

namespace BD2\Controller;

use BD2\BD2Application;

/**
 * Base class for controllers.
 */
abstract class AbstractController
{
    /** @var BD2Application */
    protected $app;

    /**
     * Injects dependencies.
     *
     * @param BD2Application $app
     */
    public function __construct(BD2Application $app)
    {
        $this->app = $app;
    }

    /**
     * Returns contents of a file.
     *
     * @param string $file
     * @return string
     */
    public function getFile($file)
    {
        $path = [$this->app['root'], $this->app['config']['resources']['root'], $this->app['config']['resources']['files']];
        $path = implode(DIRECTORY_SEPARATOR, $path);
        
        return file_get_contents($path . DIRECTORY_SEPARATOR . $file);
    }
}
