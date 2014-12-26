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
        $procedureDropAllSQL = $this->getFile('sql/procedure_drop_all.sql');
        $tableBranzaSQL = $this->getFile('sql/table_branza.sql');
        $tableKlientSQL = $this->getFile('sql/table_klient.sql');
        $tableStanowiskoSQL = $this->getFile('sql/table_stanowisko.sql');
        $tableSprzedawcaSQL = $this->getFile('sql/table_sprzedawca.sql');
        $tableRokSQL = $this->getFile('sql/table_rok.sql');
        $tableMiesiacSQL = $this->getFile('sql/table_miesiac.sql');
        $tableDataSprzedazySQL = $this->getFile('sql/table_data_sprzedazy.sql');
        $tableProduktTypSQL = $this->getFile('sql/table_produkt_typ.sql');
        $tableProduktSQL = $this->getFile('sql/table_produkt.sql');
        $tableWojewodztwoSQL = $this->getFile('sql/table_wojewodztwo.sql');
        $tableMiastoSQL = $this->getFile('sql/table_miasto.sql');
        $tableLokalizacjaSQL = $this->getFile('sql/table_lokalizacja.sql');
        $tableSprzedazSQL = $this->getFile('sql/table_sprzedaz.sql');

        $view = $this->app->renderView('page/structure.html.twig',
            [
                'procedureDropAllSQL' => $procedureDropAllSQL,
                'tableBranzaSQL' => $tableBranzaSQL,
                'tableKlientSQL' => $tableKlientSQL,
                'tableStanowiskoSQL' => $tableStanowiskoSQL,
                'tableSprzedawcaSQL' => $tableSprzedawcaSQL,
                'tableRokSQL' => $tableRokSQL,
                'tableMiesiacSQL' => $tableMiesiacSQL,
                'tableDataSprzedazySQL' => $tableDataSprzedazySQL,
                'tableProduktTypSQL' => $tableProduktTypSQL,
                'tableProduktSQL' => $tableProduktSQL,
                'tableWojewodztwoSQL' => $tableWojewodztwoSQL,
                'tableMiastoSQL' => $tableMiastoSQL,
                'tableLokalizacjaSQL' => $tableLokalizacjaSQL,
                'tableSprzedazSQL' => $tableSprzedazSQL,
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
