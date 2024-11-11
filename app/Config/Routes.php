<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/form', 'FormController::index', ['filter' => 'session']);

$routes->post('form/submit', 'FormController::submit');

service('auth')->routes($routes);



