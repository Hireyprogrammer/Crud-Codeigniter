<?php

use App\Controllers\Shop;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/users', 'UserController::index');

$routes->post('users', 'UserController::store');

$routes->get('user/edit/(:num)', 'UserController::edit/$1');

$routes->post('user/update/(:num)', 'UserController::update/$1');

$routes->get('user/delete/(:num)', 'UserController::delete/$1');