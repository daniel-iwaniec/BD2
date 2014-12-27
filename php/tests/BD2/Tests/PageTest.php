<?php

namespace BD2\Tests;

use Silex\WebTestCase;

/**
 * Simple functional tests for subpages.
 */
class PageTest extends WebTestCase
{
    /**
     * Creates application instance for testing.
     *
     * @return mixed
     */
    public function createApplication()
    {
        /** @noinspection PhpUnusedLocalVariableInspection */
        $root = __DIR__ . '/../../..';
        return require __DIR__ . '/../../../web/app.php';
    }

    /**
     * Simple functional test for introduction page.
     */
    public function testIntroductionPage()
    {
        $client = $this->createClient();
        $crawler = $client->request('GET', '/');

        $this->assertTrue($client->getResponse()->isOk());
        $this->assertCount(1, $crawler->filter('.jumbotron'));
        $this->assertCount(1, $crawler->filter('.oracle-data-table'));
    }

    /**
     * Simple functional test for structure page.
     */
    public function testStructurePage()
    {
        $client = $this->createClient();
        $crawler = $client->request('GET', '/struktura');

        $this->assertTrue($client->getResponse()->isOk());
        $this->assertCount(1, $crawler->filter('.jumbotron'));
    }

    /**
     * Simple functional test for data page.
     */
    public function testDataPage()
    {
        $client = $this->createClient();
        $crawler = $client->request('GET', '/dane');

        $this->assertTrue($client->getResponse()->isOk());
        $this->assertCount(1, $crawler->filter('.jumbotron'));
        $this->assertCount(13, $crawler->filter('.oracle-data-table'));
    }

    /**
     * Simple functional test for import page.
     */
    public function testImportPage()
    {
        $client = $this->createClient();
        $crawler = $client->request('GET', '/import');

        $this->assertTrue($client->getResponse()->isOk());
        $this->assertCount(1, $crawler->filter('.jumbotron'));
    }

    /**
     * Simple functional test for analysis page.
     */
    public function testAnalysisPage()
    {
        $client = $this->createClient();
        $crawler = $client->request('GET', '/analiza');

        $this->assertTrue($client->getResponse()->isOk());
        $this->assertCount(1, $crawler->filter('.jumbotron'));
    }

    /**
     * Simple functional test for authors page.
     */
    public function testAuthorsPage()
    {
        $client = $this->createClient();
        $crawler = $client->request('GET', '/autorzy');

        $this->assertTrue($client->getResponse()->isOk());
        $this->assertCount(1, $crawler->filter('.jumbotron'));
    }
}
