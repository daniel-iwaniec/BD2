<?php

namespace BD2\Tests;

use Silex\WebTestCase;

/**
 * Simple functional tests for table handling.
 * This test case could use data fixtures,
 * but because it is data warehouse, it is unlikely that data will be removed.
 */
class TableTest extends WebTestCase
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
     * Simple functional test for table handling.
     */
    public function testTable()
    {
        $client = $this->createClient();
        $crawler = $client->request('GET', '/table/klient/1/ID/asc/ID/1');

        $this->assertTrue($client->getResponse()->isOk());
        $this->assertTrue($crawler->filter('table tr td')->first()->text() == 1);
    }

    /**
     * Simple functional test for foreign keys translating.
     */
    public function testTranslateFK()
    {
        $client = $this->createClient();
        $client->request('POST', '/translatefk', ['klient' => 74]);

        $response = json_decode($client->getResponse()->getContent(), true);

        $this->assertTrue($client->getResponse()->isOk());
        $this->assertArrayHasKey('klient', $response);
        $this->assertTrue($response['klient'] == 'RITA');
    }
}
