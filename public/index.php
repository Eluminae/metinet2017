<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

require __DIR__ . '/../vendor/autoload.php';

use Metinet\Http\Request;
use Metinet\Http\Response;
use Metinet\CalculatorController;
use Metinet\Route;
use Metinet\RouteMatcher;
use Metinet\ControllerResolver;
use Metinet\Config\Configuration;
use Metinet\Config\RoutesCsvLoader;

$request = Request::createFromGlobals();

$configuration = new Configuration(
    new RoutesCsvLoader(__DIR__ . '/../config/routes.csv')
);
$routes = [];
foreach ($configuration->getSection('routes') as $route) {
    $routes[] = new Route($route['method'], $route['path'], $route['action']);
}

$base = $configuration->getSection('parameters')['calculator']['base'];
$controllers[] = new CalculatorController($base);
$resolver = new ControllerResolver(new RouteMatcher($routes));
$resolver->addController(new CalculatorController(16));
$callable = $resolver->resolve($request);
$response = call_user_func($callable, $request);
$response->send();
