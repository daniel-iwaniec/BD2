<?php

namespace BD2\ControllerInterface;

use Silex\Application;
use BD2\BD2Application;
use Symfony\Component\HttpFoundation\Response;

/**
 * Controller that handles errors must implement this interface.
 */
interface ErrorControllerInterface
{
    /**
     * Renders error page.
     *
     * @param BD2Application $app
     * @return Response
     */
    public function errorAction(BD2Application $app);
}
