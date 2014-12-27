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

    /**
     * Translated foreign keys.
     * Basically takes ID from parent table and returns more descriptive value from referenced table.
     * This action is supposed to work with AJAX only.
     *
     * @param Request $request
     * @return Response
     */
    public function translateForeignKeysAction(Request $request)
    {
        /** @var \Doctrine\DBAL\Connection $connection */
        /** @var \Doctrine\DBAL\Driver\Statement $statement */

        $connection = $this->app['db'];
        $tables = $request->request->all();

        $data = [];
        foreach ($tables as $table => $id) {
            $id = (int)$id;
            $query = $connection->createQueryBuilder();

            if ($table == 'klient') {
                $query->select('NAZWA')
                    ->from(strtoupper($table), 'table_alias')
                    ->where("ID = {$connection->quote($id)}");

                $statement = $connection->executeQuery($query->getSql());
                $data['klient'] = $statement->fetchAll(\PDO::FETCH_COLUMN)[0];
            }
            if ($table == 'sprzedawca') {
                $query->select('IMIE', 'NAZWISKO')
                    ->from(strtoupper($table), 'table_alias')
                    ->where("ID = {$connection->quote($id)}");

                $statement = $connection->executeQuery($query->getSql());
                $result = $statement->fetchAll(\PDO::FETCH_ASSOC)[0];
                $data['sprzedawca'] = $result['IMIE'] . ' ' . $result['NAZWISKO'];
            }
            if ($table == 'data_sprzedazy') {
                $query->select('r.NUMER AS rok', 'm.NUMER AS miesiac', 'table_alias.NUMER_MIESIAC AS dzien')
                    ->from(strtoupper($table), 'table_alias')
                    ->innerJoin('table_alias', 'MIESIAC', 'm', 'm.id = table_alias.miesiac_id')
                    ->innerJoin('table_alias', 'ROK', 'r', 'r.id = m.rok_id')
                    ->where("table_alias.ID = {$connection->quote($id)}");

                $statement = $connection->executeQuery($query->getSql());
                $result = $statement->fetchAll(\PDO::FETCH_ASSOC)[0];
                if ($result['DZIEN'] < 10) {
                    $result['DZIEN'] = '0' . $result['DZIEN'];
                }
                if ($result['MIESIAC'] < 10) {
                    $result['MIESIAC'] = '0' . $result['MIESIAC'];
                }
                $data['data_sprzedazy'] = $result['DZIEN'] . '.' . $result['MIESIAC'] . '.' . $result['ROK'];
            }
            if ($table == 'produkt') {
                $query->select('NAZWA')
                    ->from(strtoupper($table), 'table_alias')
                    ->where("ID = {$connection->quote($id)}");

                $statement = $connection->executeQuery($query->getSql());
                $data['produkt'] = $statement->fetchAll(\PDO::FETCH_COLUMN)[0];
            }
            if ($table == 'lokalizacja') {
                $query->select('table_alias.ULICA', 'table_alias.KOD_POCZTOWY', 'm.NAZWA AS MIASTO_NAZWA')
                    ->from(strtoupper($table), 'table_alias')
                    ->innerJoin('table_alias', 'MIASTO', 'm', 'm.id = table_alias.miasto_id')
                    ->where("table_alias.ID = {$connection->quote($id)}");

                $statement = $connection->executeQuery($query->getSql());
                $result = $statement->fetchAll(\PDO::FETCH_ASSOC)[0];
                $data['lokalizacja'] = $result['MIASTO_NAZWA'] . ' ul. ' . $result['ULICA'] . ', ' . $result['KOD_POCZTOWY'];
            }
        }

        return $this->app->json($data);
    }
}
