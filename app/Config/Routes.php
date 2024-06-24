<?php

use CodeIgniter\Router\RouteCollection;

/**
 * TEST VIEWS
 */

$routes->environment('development', static function ($routes) {
  // Allow signup up of admin only on development environment
  $routes->get('/test/checkoutForm', 'TestViewsController::viewCheckoutForm');
  $routes->get('/test/orgProducts', 'TestViewsController::viewOrgProducts');
  $routes->get('/test/checkoutConfirm', 'TestViewsController::viewCheckoutConfirm');
  $routes->get('/test/barterHome', 'TestViewsController::viewBarter');
  $routes->get('/test/barterItem', 'TestViewsController::viewBarterPost');
  $routes->get('/test/createBarter', 'TestViewsController::viewCreateBarter');
  $routes->get('/test/checkout', 'PaymentController::webhook');
  $routes->get('/test/checkout/confirm', 'OrderController::success');
  $routes->get('/test/checkout/cancel', 'OrderController::cancel');
  $routes->get('/test/cart', 'TestViewsController::viewCart');
  $routes->get('/test/studentBarter', 'TestViewsController::viewStudentBarter');
});

/**
 * USER ROUTES
 */
// * Students

$routes->get('/', 'Home::index');
$routes->get('/cart', 'CartController::viewCart', ['filter' => 'isLoggedIn']);
// $routes->get('/login', 'StudentController::viewLogin');
// $routes->get('/signup', 'StudentController::viewSignup');

// $routes->post('/login', 'StudentController::login');
// $routes->post('/signup', 'StudentController::signup');
// $routes->get('/logout', 'StudentController::logout');

// * Organization

$routes->get('/(:num)/products', 'OrganizationController::viewOrgProducts/$1');

// * Products

$routes->get('/product', 'ProductController::viewAllProducts');
$routes->get('/product/(:num)', 'ProductController::viewProduct/$1');
//$routes->get('/product/test', 'ProductController::viewProduct');

// * Cart
$routes->post('/cart/add', 'CartController::addToCart', ['filter' => 'isLoggedIn']);
$routes->get('/cart/checkout', 'CartController::viewCheckoutCart', ['filter' => 'isLoggedIn']);
$routes->post('/cart/checkout', 'CartController::checkoutCart', ['filter' => 'isLoggedIn']);

$routes->post('/cart/remove/(:num)', 'CartController::deleteCartItem/$1', ['filter' => 'isLoggedIn']);

// * Orders and Payments
$routes->post('/payment/webhook', 'PaymentController::webhook');

$routes->get('/payment/success', 'PaymentController::success');
$routes->get('/payment/fail', 'PaymentController::fail');

/**
 * ADMIN ROUTES
 */

// * Admin Main Views
$routes->get('/login/admin', 'AdminViewController::viewLogin'); // login
$routes->get('/admin', 'AdminViewController::viewDashboard'); // dashboard
$routes->get('/admin/organization', 'AdminViewController::viewOrganizations'); // organizations
$routes->get('/admin/product', 'AdminViewController::viewProducts'); // products
$routes->get('/admin/orders', 'AdminViewController::viewPending'); // pending purchases
$routes->get('/admin/reports', 'AdminViewController::viewReports'); // reports
$routes->get('/admin/history', 'AdminViewController::viewHistory'); // pending purchases
$routes->get('/admin/barter', 'AdminViewController::viewBarter'); // Manage Barter


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
$routes->post('/admin/organization/(:num)', 'OrganizationController::editOrg/$1');

$routes->delete('/admin/organization/(:num)', 'OrganizationController::deleteOrg/$1');

// * Admin Products

$routes->get('/admin/product/all', 'ProductController::getAllProducts');
//$routes->get('/admin/product/(:num)', 'ProductController::getProduct/$1');

$routes->get('/admin/product/new', 'ProductController::viewCreateProduct');
$routes->post('/admin/product/new', 'ProductController::createProduct');

$routes->get('/admin/product/(:num)', 'ProductController::viewEditProduct/$1');
$routes->post('/admin/product/(:num)', 'ProductController::editProduct/$1');

$routes->delete('/admin/product/(:num)', 'ProductController::deleteProduct/$1', ['as' => 'delete_product']);

// * Admin Orders

$routes->post('/orders', 'AdminViewController::viewPending');

$routes->post('/admin/order/confirm/(:num)', 'OrderController::confirmOrder/$1');
$routes->post('/test/barterHome', 'BarterController::submit_barter');

service('auth')->routes($routes);
