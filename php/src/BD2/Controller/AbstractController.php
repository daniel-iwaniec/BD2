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
     * @param integer|null $linesAmount
     * @param integer $offset
     * @return string
     */
    public function getFile($file, $linesAmount = null, $offset = 0)
    {
        $path = [$this->app['root'], $this->app['config']['resources']['root'], $this->app['config']['resources']['files']];
        $path = implode(DIRECTORY_SEPARATOR, $path);

        $fileExtension = explode('.', $file);
        if (array_pop($fileExtension) == 'csv') {
            $output = file($path . DIRECTORY_SEPARATOR . $file);
            $output = str_getcsv(implode('', $output), "\n");
            if ($linesAmount) {
                $output = array_slice($output, $offset, $linesAmount);
            }
            $output = implode("\n", $output);
        } else {
            $output = file($path . DIRECTORY_SEPARATOR . $file);
            if ($linesAmount) {
                $output = array_slice($output, $offset, $linesAmount);
            }
            $output = trim(implode('', $output), "\n\r");
        }

        return $output;
    }
}
