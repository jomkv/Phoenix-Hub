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

// * Products

$routes->get('/product/test', 'ProductController::viewProduct');

/**
 * ADMIN ROUTES
 */

// * Admin Main Views
$routes->get('/login/admin', 'AdminViewController::viewLogin'); // login
$routes->get('/admin', 'AdminViewController::viewDashboard'); // dashboard
$routes->get('/admin/organization', 'AdminViewController::viewOrganizations'); // organizations
$routes->get('/admin/product', 'AdminViewController::viewProducts'); // products
$routes->get('/admin/pending', 'AdminViewController::viewPending'); // pending purchases
$routes->get('/admin/reports', 'AdminViewController::viewReports'); // reports
$routes->get('/admin/history', 'AdminViewController::viewHistory'); // pending purchases

// * Admin User
$routes->post('/login/admin', 'AdminController::login');

$routes->get('/admin/logout', 'AdminController::logout');

$routes->environment('development', static function ($routes) {
  // Allow signup up of admin only on development environment
  $routes->get('/signup/admin', 'AdminViewController::viewSignup');
  $routes->post('/signup/admin', 'AdminController::signup');
});

// * Admin Organization

$routes->get('/admin/organization/new', 'OrganizationController::viewCreateOrg');
$routes->post('/admin/organization/new', 'OrganizationController::createOrg');
$routes->get('/admin/organization/(:num)', 'OrganizationController::viewEditOrg/$1');
$routes->delete('/admin/organization/(:num)', 'OrganizationController::deleteOrg/$1');

// * Admin Products

$routes->get('/admin/product/all', 'ProductController::getAllProducts');
$routes->get('/admin/product/(:num)', 'ProductController::getProduct/$1');
$routes->get('/admin/product/new', 'ProductController::viewCreateProduct');
$routes->post('/admin/product/new', 'ProductController::createProduct');
$routes->put('/admin/product/(:num)', 'ProductController::editProduct/$1');
$routes->delete('/admin/product/(:num)', 'ProductController::deleteProduct/$1', ['as' => 'delete_product']);
