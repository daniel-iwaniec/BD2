<?php

namespace BD2\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Handles actions related to tables.
 */
class TableController extends AbstractController
{
    /**
     * Reads requested table.
     *
     * @param Request $request
     * @return Response
     */
    public function readAction(Request $request)
    {
        /** @var \Doctrine\DBAL\Connection $connection */
        /** @var \Doctrine\DBAL\Driver\Statement $statement */
        /** @var \Knp\Component\Pager\Paginator $paginator */
        /** @var \Knp\Bundle\PaginatorBundle\Pagination\SlidingPagination $pagination */

        $page = $request->get('page', 1);
        $table = $request->get('table', null);

        if (!in_array($table, $this->app['config']['tables'])) {
            $this->app->abort(404);
        }

        $resultsPerPage = $this->app['config']['pagination']['results_per_page'];
        $connection = $this->app['db'];
        $paginator = $this->app['knp_paginator'];

        $query = $connection->createQueryBuilder();
        $query->select('*')->from($table, 'table_alias');
        $query->orderBy('id', 'asc');

        $pagination = $paginator->paginate($query, $page, $resultsPerPage);

        $pagination->getTotalItemCount();
        $maxPage = ceil($pagination->getTotalItemCount() / $pagination->getItemNumberPerPage());
        if ($page > $maxPage) {
            $this->app->abort(404);
        }

        $pagination->setUsedRoute('table');
        $pagination->setParam('table', $table);

        $query->setFirstResult($resultsPerPage * ($page - 1));
        $query->setMaxResults($resultsPerPage);

        $statement = $connection->executeQuery($query->getSql());
        $data = $statement->fetchAll(\PDO::FETCH_ASSOC);

        $view = $this->app->renderView("table/{$table}.html.twig", ['data' => $data, 'pagination' => $pagination]);

        return new Response($view);
    }
}
