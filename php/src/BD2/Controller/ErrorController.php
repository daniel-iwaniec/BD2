<?php

namespace BD2\Controller;

use Silex\Application;
use BD2\BD2Application;
use Symfony\Component\HttpFoundation\Response;
use BD2\ControllerInterface\ErrorControllerInterface;

/**
 * Handles errors occurred during request processing.
 * This so called "handling" is very generic.
 */
class ErrorController implements ErrorControllerInterface
{
    /**
     * Renders generic error page.
     *
     * @param BD2Application $app
     * @return Response
     */
    public function errorAction(BD2Application $app)
    {
        $view = $app->renderView('error/error.html.twig');

        return new Response($view);
    }
}
