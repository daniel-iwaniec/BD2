<?php

namespace BD2\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Serves raw files.
 */
class RawFileController extends AbstractController
{
    /**
     * Outputs raw file.
     *
     * @param Request $request
     * @return Response
     */
    public function readAction(Request $request)
    {
        $file = $request->get('file', '');

        $type = explode('.', $file);
        $type = end($type);

        $file = $type . '/' . $file;
        $fileContents = $this->getFile($file);

        if (!$fileContents) {
            $this->app->abort(404);
        }

        return new Response($fileContents, 200, ['Content-Type' => 'text/plain']);
    }
}
