<?php

namespace BD2\Controller;

use Symfony\Component\HttpFoundation\Response;

/**
 * Serves general pages listed in top menu.
 */
class PageController extends AbstractController
{
    /**
     * Renders introduction page.
     *
     * @return Response
     */
    public function introductionAction()
    {
        $view = $this->app->renderView('page/introduction.html.twig');

        return new Response($view);
    }

    /**
     * Renders page about database structure.
     *
     * @return Response
     */
    public function structureAction()
    {
        $structureSQL = $this->getFile('sql/structure.sql');
        $procedureDropAllSQL = $this->getFile('sql/procedure_drop_all.sql');
        $tableBranzaSQL = $this->getFile('sql/table_branza.sql');

        $view = $this->app->renderView('page/structure.html.twig',
            [
                'structureSQL' => $structureSQL,
                'procedureDropAllSQL' => $procedureDropAllSQL,
                'tableBranzaSQL' => $tableBranzaSQL
            ]
        );

        return new Response($view);
    }

    /**
     * Renders page about database data.
     *
     * @return Response
     */
    public function dataAction()
    {
        $view = $this->app->renderView('page/data.html.twig');

        return new Response($view);
    }

    /**
     * Renders page about data import.
     *
     * @return Response
     */
    public function importAction()
    {
        $view = $this->app->renderView('page/import.html.twig');

        return new Response($view);
    }

    /**
     * Renders page about data analysis.
     *
     * @return Response
     */
    public function analysisAction()
    {
        $view = $this->app->renderView('page/analysis.html.twig');

        return new Response($view);
    }

    /**
     * Renders page about authors.
     *
     * @return Response
     */
    public function authorsAction()
    {
        $view = $this->app->renderView('page/authors.html.twig');

        return new Response($view);
    }
}
