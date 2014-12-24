<?php

namespace BD2\Controller;

use Symfony\Component\HttpFoundation\Response;
use BD2\ControllerInterface\ErrorControllerInterface;

/**
 * Handles errors occurred during request processing.
 * This so called "handling" is very generic.
 */
class ErrorController extends AbstractController implements ErrorControllerInterface
{
    /**
     * Renders generic error page.
     *
     * @return Response
     */
    public function errorAction()
    {
        $view = $this->app->renderView('error/error.html.twig');

        return new Response($view);
    }
}
