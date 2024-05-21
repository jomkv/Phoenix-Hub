<?php

use CodeIgniter\Router\RouteCollection;

/**
 * USER ROUTES
 */
// * Users

$routes->get('/', 'Home::index');
$routes->get('/login', 'UsersController::viewLogin');
$routes->get('/signup', 'UsersController::viewSignup');

$routes->post('/login', 'UsersController::login');
$routes->post('/signup', 'UsersController::signup');

// * Organization

$routes->get('/(:num)/products', 'OrganizationController::viewOrgProducts/$1');

/**
 * ADMIN ROUTES
 */

// * Admin User
$routes->get('/login/admin', 'AdminController::viewLogin');
$routes->post('/login/admin', 'AdminController::login');

$routes->get('/admin', 'AdminController::viewDashboard');

$routes->get('/admin/logout', 'AdminController::logout');

$routes->environment('development', static function ($routes) {
  // Allow signup up of admin only on development environment
  $routes->get('/signup/admin', 'AdminController::viewSignup');
  $routes->post('/signup/admin', 'AdminController::signup');
});

// * Admin Organization

$routes->get('/admin/organization/new', 'OrganizationController::viewCreateOrg');
$routes->post('/admin/organization/new', 'OrganizationController::createOrg');

// * Admin Products

$routes->get('/admin/product', 'ProductController::viewAdminProducts');

$routes->get('/admin/product/new', 'ProductController::viewCreateProduct');
$routes->post('/admin/product/new', 'ProductController::createProduct');
