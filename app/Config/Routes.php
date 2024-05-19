<?php

use CodeIgniter\Router\RouteCollection;

/**
 * View Routes
 */

$routes->get('/', 'Home::index');
$routes->get('/login', 'UsersController::viewLogin');
$routes->get('/signup', 'UsersController::viewSignup');

// * Admin
$routes->get('/admin/login', 'AdminController::viewLogin');
$routes->get('/admin/signup', 'AdminController::viewSignup');

/**
 * @var RouteCollection $routes
 */

$routes->post('/login', 'UsersController::login');
$routes->post('/signup', 'UsersController::signup');

// * Admin
$routes->post('/admin/login', 'AdminController::login');
$routes->post('/admin/signup', 'AdminController::signup');
$routes->get('/admin/logout', 'AdminController::logout');
