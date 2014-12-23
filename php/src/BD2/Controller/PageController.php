<?php

namespace BD2\Controller;

use Silex\Application;
use BD2\BD2Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Serves general pages listed in top menu.
 */
class PageController
{
    /**
     * Renders introduction page.
     *
     * @param BD2Application $app
     * @return Response
     */
    public function introductionAction(BD2Application $app, Request $request)
    {
        $page = $request->get('page', 1);

        /** @var \Doctrine\DBAL\Connection $connection */
        $connection = $app['db'];
        $query = $connection->createQueryBuilder();

        $query->select('*')->from('sprzedaz', 's');
        $query->orderBy('id', 'asc');

        $pagination = $app['knp_paginator']->paginate($query);

        $query->setFirstResult(20 * ($page - 1));
        $query->setMaxResults(20);
        $statement = $connection->executeQuery($query->getSql());
        $data = $statement->fetchAll(\PDO::FETCH_ASSOC);

        $view = $app->renderView('page/introduction.html.twig', ['data' => $data, 'pagination' => $pagination]);

        return new Response($view);
    }

    /**
     * Renders page about database structure.
     *
     * @param BD2Application $app
     * @return Response
     */
    public function structureAction(BD2Application $app)
    {
        $view = $app->renderView('page/structure.html.twig');

        return new Response($view);
    }

    /**
     * Renders page about database data.
     *
     * @param BD2Application $app
     * @return Response
     */
    public function dataAction(BD2Application $app)
    {
        $view = $app->renderView('page/data.html.twig');

        return new Response($view);
    }

    /**
     * Renders page about data import.
     *
     * @param BD2Application $app
     * @return Response
     */
    public function importAction(BD2Application $app)
    {
        $view = $app->renderView('page/import.html.twig');

        return new Response($view);
    }

    /**
     * Renders page about data analysis.
     *
     * @param BD2Application $app
     * @return Response
     */
    public function analysisAction(BD2Application $app)
    {
        $view = $app->renderView('page/analysis.html.twig');

        return new Response($view);
    }

    /**
     * Renders page about authors.
     *
     * @param BD2Application $app
     * @return Response
     */
    public function authorsAction(BD2Application $app)
    {
        $view = $app->renderView('page/authors.html.twig');

        return new Response($view);
    }
}
