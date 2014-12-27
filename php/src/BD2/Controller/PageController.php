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
                'tableSprzedazSQL' => $tableSprzedazSQL
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
        $tableBranzaCSV = $this->getFile('csv/branza.csv', 10);
        $tableKlientCSV = $this->getFile('csv/klient.csv', 10);
        $tableStanowiskoCSV = $this->getFile('csv/stanowisko.csv', 10);
        $tableSprzedawcaCSV = $this->getFile('csv/sprzedawca.csv', 10);
        $tableRokCSV = $this->getFile('csv/rok.csv', 10);
        $tableMiesiacCSV = $this->getFile('csv/miesiac.csv', 10);
        $tableDataSprzedazyCSV = $this->getFile('csv/data_sprzedazy.csv', 10);
        $tableProduktTypCSV = $this->getFile('csv/produkt_typ.csv', 10);
        $tableProduktCSV = $this->getFile('csv/produkt.csv', 10);
        $tableWojewodztwoCSV = $this->getFile('csv/wojewodztwo.csv', 10);
        $tableMiastoCSV = $this->getFile('csv/miasto.csv', 10);
        $tableLokalizacjaCSV = $this->getFile('csv/lokalizacja.csv', 10);
        $tableSprzedazCSV = $this->getFile('csv/sprzedaz.csv', 10);

        $view = $this->app->renderView('page/data.html.twig', [
            'tableBranzaCSV' => $tableBranzaCSV,
            'tableKlientCSV' => $tableKlientCSV,
            'tableStanowiskoCSV' => $tableStanowiskoCSV,
            'tableSprzedawcaCSV' => $tableSprzedawcaCSV,
            'tableRokCSV' => $tableRokCSV,
            'tableMiesiacCSV' => $tableMiesiacCSV,
            'tableDataSprzedazyCSV' => $tableDataSprzedazyCSV,
            'tableProduktTypCSV' => $tableProduktTypCSV,
            'tableProduktCSV' => $tableProduktCSV,
            'tableWojewodztwoCSV' => $tableWojewodztwoCSV,
            'tableMiastoCSV' => $tableMiastoCSV,
            'tableLokalizacjaCSV' => $tableLokalizacjaCSV,
            'tableSprzedazCSV' => $tableSprzedazCSV
        ]);

        return new Response($view);
    }

    /**
     * Renders page about data import.
     *
     * @return Response
     */
    public function importAction()
    {
        $tableBranzaCTL = $this->getFile('ctl/branza.ctl');
        $tableKlientCTL = $this->getFile('ctl/klient.ctl');
        $tableStanowiskoCTL = $this->getFile('ctl/stanowisko.ctl');
        $tableSprzedawcaCTL = $this->getFile('ctl/sprzedawca.ctl');
        $tableRokCTL = $this->getFile('ctl/rok.ctl');
        $tableMiesiacCTL = $this->getFile('ctl/miesiac.ctl');
        $tableDataSprzedazyCTL = $this->getFile('ctl/data_sprzedazy.ctl');
        $tableProduktTypCTL = $this->getFile('ctl/produkt_typ.ctl');
        $tableProduktCTL = $this->getFile('ctl/produkt.ctl');
        $tableWojewodztwoCTL = $this->getFile('ctl/wojewodztwo.ctl');
        $tableMiastoCTL = $this->getFile('ctl/miasto.ctl');
        $tableLokalizacjaCTL = $this->getFile('ctl/lokalizacja.ctl');
        $tableSprzedazCTL = $this->getFile('ctl/sprzedaz.ctl');

        $tableBranzaLOG = $this->getFile('log/branza.log', 15, 20);
        $tableKlientLOG = $this->getFile('log/klient.log', 16, 20);
        $tableStanowiskoLOG = $this->getFile('log/stanowisko.log', 16, 20);
        $tableSprzedawcaLOG = $this->getFile('log/sprzedawca.log', 17, 20);
        $tableRokLOG = $this->getFile('log/rok.log', 16, 20);
        $tableMiesiacLOG = $this->getFile('log/miesiac.log', 17, 20);
        $tableDataSprzedazyLOG = $this->getFile('log/data_sprzedazy.log', 19, 20);
        $tableProduktTypLOG = $this->getFile('log/produkt_typ.log', 15, 20);
        $tableProduktLOG = $this->getFile('log/produkt.log', 16, 20);
        $tableWojewodztwoLOG = $this->getFile('log/wojewodztwo.log', 16, 20);
        $tableMiastoLOG = $this->getFile('log/miasto.log', 16, 20);
        $tableLokalizacjaLOG = $this->getFile('log/lokalizacja.log', 17, 20);
        $tableSprzedazLOG = $this->getFile('log/sprzedaz.log', 23, 20);

        $importBAT = $this->getFile('bat/import.bat');

        $view = $this->app->renderView('page/import.html.twig', [
            'tableBranzaCTL' => $tableBranzaCTL,
            'tableKlientCTL' => $tableKlientCTL,
            'tableStanowiskoCTL' => $tableStanowiskoCTL,
            'tableSprzedawcaCTL' => $tableSprzedawcaCTL,
            'tableRokCTL' => $tableRokCTL,
            'tableMiesiacCTL' => $tableMiesiacCTL,
            'tableDataSprzedazyCTL' => $tableDataSprzedazyCTL,
            'tableProduktTypCTL' => $tableProduktTypCTL,
            'tableProduktCTL' => $tableProduktCTL,
            'tableWojewodztwoCTL' => $tableWojewodztwoCTL,
            'tableMiastoCTL' => $tableMiastoCTL,
            'tableLokalizacjaCTL' => $tableLokalizacjaCTL,
            'tableSprzedazCTL' => $tableSprzedazCTL,
            'tableBranzaLOG' => $tableBranzaLOG,
            'tableKlientLOG' => $tableKlientLOG,
            'tableStanowiskoLOG' => $tableStanowiskoLOG,
            'tableSprzedawcaLOG' => $tableSprzedawcaLOG,
            'tableRokLOG' => $tableRokLOG,
            'tableMiesiacLOG' => $tableMiesiacLOG,
            'tableDataSprzedazyLOG' => $tableDataSprzedazyLOG,
            'tableProduktTypLOG' => $tableProduktTypLOG,
            'tableProduktLOG' => $tableProduktLOG,
            'tableWojewodztwoLOG' => $tableWojewodztwoLOG,
            'tableMiastoLOG' => $tableMiastoLOG,
            'tableLokalizacjaLOG' => $tableLokalizacjaLOG,
            'tableSprzedazLOG' => $tableSprzedazLOG,
            'importBAT' => $importBAT
        ]);

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
