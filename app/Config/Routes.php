<?php

use CodeIgniter\Router\RouteCollection;

/**
 * View Routes
 */

$routes->get('/', 'Home::index');
$routes->get('/login', 'UsersController::viewLogin');
$routes->get('/signup', 'UsersController::viewSignup');

/**
 * @var RouteCollection $routes
 */

$routes->post('/login', 'UsersController::login');
$routes->post('/signup', 'UsersController::signuo');
