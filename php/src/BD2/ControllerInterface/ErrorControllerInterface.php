<?php

namespace BD2\ControllerInterface;

use Symfony\Component\HttpFoundation\Response;

/**
 * Controller that handles errors must implement this interface.
 */
interface ErrorControllerInterface
{
    /**
     * Renders error page.
     *
     * @return Response
     */
    public function errorAction();
}
