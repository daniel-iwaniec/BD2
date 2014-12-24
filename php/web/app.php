<?php

namespace App;

use Silex\Application;
use BD2\BD2Application;
use DerAlex\Silex\YamlConfigServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\DoctrineServiceProvider;
use Qck\Silex\Provider\PaginationServiceProvider;
use Symfony\Component\HttpFoundation\Request;
use BD2\ControllerInterface\ErrorControllerInterface;

$root = __DIR__ . '/..';

require_once $root . '/vendor/autoload.php';
$app = new BD2Application();
$app['root'] = $root;

$app->register(new YamlConfigServiceProvider('../app/config/parameters.yml.dist'));
$app->register(new YamlConfigServiceProvider('../app/config/config.yml'));
$app->register(new YamlConfigServiceProvider('../app/config/routing.yml'));

$app->register(new ServiceControllerServiceProvider());
$app->register(new UrlGeneratorServiceProvider());
$app->register(new TwigServiceProvider(), ['twig.path' => $app['config']['twig']['paths']]);

$app->register(new PaginationServiceProvider());
$app['knp_paginator.options'] = [
    'template' => [
        'pagination' => $app['config']['pagination']['templates']['pagination']
    ]
];

$app->register(new DoctrineServiceProvider(), [
    'db.options' => [
        'driver' => $app['config']['parameters']['database_driver'],
        'charset' => $app['config']['parameters']['database_charset'],
        'host' => $app['config']['parameters']['database_host'],
        'port' => $app['config']['parameters']['database_port'],
        'dbname' => $app['config']['parameters']['database_name'],
        'user' => $app['config']['parameters']['database_user'],
        'password' => $app['config']['parameters']['database_password']
    ]
]);

foreach ($app['config']['services'] as $serviceName => $service) {
    $app[$serviceName] = $app->share(function () use ($app, $service, $serviceName) {
        $dependencies = [];
        if (isset($service['tags'])) {
            if (in_array('bd2.controller', $service['tags'])) {
                $dependencies[] = $app;
            }
        }
        if (isset($service['dependencies'])) {
            foreach ($service['dependencies'] as $dependency) {
                $dependencies[] = $app[$dependency];
            }
        }

        return new $service['class'](...$dependencies);
    });
}

foreach ($app['config']['routes'] as $routeName => $route) {
    $app->match($route['match'], $route['action'])->bind($routeName);
}

$app->before(function (Request $request, BD2Application $app) {
    $app['twig']->addGlobal('activePage', $request->get('_route'));
});

$app['twig'] = $app->share($app->extend('twig', function ($twig) use ($app) {
    /** @var \Twig_Environment $twig */
    $twig->addFunction(new \Twig_SimpleFunction('asset', function ($asset, $environment) use ($app) {
        if (!isset($app['config']['twig']['assets'][$environment])) {
            return '';
        }
        return sprintf($app['config']['twig']['assets'][$environment] . '/%s', ltrim($asset, '/'));
    }));
    return $twig;
}));

$app->error(function () use ($app) {
    $errorController = $app[$app['config']['error']['service']];
    if (!($errorController instanceof ErrorControllerInterface)) {
        return null;
    }

    return $errorController->errorAction($app);
});

$app->run();
