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

        $table = $request->get('table', null);
        $page = $request->get('page');
        $sort = $request->get('sort');
        $direction = $request->get('direction') === 'asc' ? 'asc' : 'desc';
        $filterField = $request->get('filterField');
        $filterValue = $request->get('filterValue', '');

        if (!in_array($table, $this->app['config']['tables'])) {
            $this->app->abort(404);
        }

        $resultsPerPage = $this->app['config']['pagination']['results_per_page'];
        $connection = $this->app['db'];
        $paginator = $this->app['knp_paginator'];

        $query = $connection->createQueryBuilder();
        $query->select('*')->from($table, 'table_alias');
        $query->orderBy($connection->quoteIdentifier($sort), $direction);
        if ($filterField && $filterValue) {
            if (ctype_digit((string)$filterValue)) {
                $query->where("{$connection->quoteIdentifier($filterField)} = {$connection->quote($filterValue)}");
            } else {
                $query->where("LOWER({$connection->quoteIdentifier($filterField)}) LIKE LOWER({$connection->quote('%' . $filterValue . '%')})");
            }
        }

        $pagination = $paginator->paginate($query, $page, $resultsPerPage);
        $pagination->getTotalItemCount();

        $pagination->setUsedRoute('table');
        $pagination->setParam('table', $table);
        $pagination->setParam('page', $page);
        $pagination->setParam('sort', $sort);
        $pagination->setParam('direction', $direction);
        $pagination->setParam('filterField', $filterField);
        $pagination->setParam('filterValue', $filterValue);

        $query->setFirstResult($resultsPerPage * ($page - 1));
        $query->setMaxResults($resultsPerPage);
        $statement = $connection->executeQuery($query->getSql());
        $data = $statement->fetchAll(\PDO::FETCH_ASSOC);

        $view = $this->app->renderView("table/{$table}.html.twig", ['data' => $data, 'pagination' => $pagination]);

        return new Response($view);
    }
}
