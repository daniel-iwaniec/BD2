<?php

namespace BD2\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Serves general pages listed in top menu.
 */
class PageController extends AbstractController
{
    /**
     * Renders introduction page.
     *
     * @param Request $request
     * @return Response
     */
    public function introductionAction(Request $request)
    {
        /** @var \Doctrine\DBAL\Connection $connection */
        /** @var \Doctrine\DBAL\Driver\Statement $statement */
        /** @var \Knp\Component\Pager\Paginator $paginator */
        /** @var \Knp\Bundle\PaginatorBundle\Pagination\SlidingPagination $pagination */

        $page = $request->get('page', 1);
        $resultsPerPage = $this->app['config']['pagination']['results_per_page'];

        $connection = $this->app['db'];
        $paginator = $this->app['knp_paginator'];

        $query = $connection->createQueryBuilder();
        $query->select('*')->from('sprzedaz', 's');
        $query->orderBy('id', 'asc');

        $pagination = $paginator->paginate($query, $page, $resultsPerPage);

        $pagination->getTotalItemCount();
        $maxPage = $pagination->getTotalItemCount() / $pagination->getItemNumberPerPage();
        if ($page > $maxPage) {
            $this->app->abort(404);
        }

        $pagination->setUsedRoute('introduction_paginated');

        $query->setFirstResult($resultsPerPage * ($page - 1));
        $query->setMaxResults($resultsPerPage);

        $statement = $connection->executeQuery($query->getSql());
        $data = $statement->fetchAll(\PDO::FETCH_ASSOC);

        $view = $this->app->renderView('page/introduction.html.twig', ['data' => $data, 'pagination' => $pagination]);

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
