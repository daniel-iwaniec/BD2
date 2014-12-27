<?php

namespace BD2\Tests;

use Silex\WebTestCase;

/**
 * Simple functional tests for file handling.
 */
class FileTest extends WebTestCase
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
     * Simple functional test for raw file serving.
     */
    public function testRawFile()
    {
        $client = $this->createClient();
        $client->request('GET', '/plik/structure.sql');

        $this->assertTrue($client->getResponse()->isOk());
        $this->assertTrue(strpos($client->getResponse()->getContent(), 'CREATE TABLE sprzedaz') !== false);
    }
}
