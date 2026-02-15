<?php
namespace Config;

use CodeIgniter\Router\RouteCollection;

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false); 

// Custom routes
$routes->get('/', 'Auth::login');
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::attemptLogin');
$routes->get('/register', 'Auth::register');
$routes->post('/register', 'Auth::attemptRegister');
$routes->get('/logout', 'Auth::logout');
$routes->get('/dashboard', 'Dashboard::index');
$routes->get('/profile', 'Dashboard::profile');

// Cart routes
$routes->get('/cart', 'Dashboard::cart');
$routes->post('/add-to-cart', 'Dashboard::addToCart');
$routes->post('/update-cart', 'Dashboard::updateCart');
$routes->get('/remove-from-cart/(:num)', 'Dashboard::removeFromCart/$1');

// Checkout routes
$routes->get('/checkout', 'Dashboard::checkout');
$routes->post('/place-order', 'Dashboard::processCheckout');
$routes->post('/process-checkout', 'Dashboard::processCheckout'); // Add this for safety
$routes->get('/order-confirmation/(:num)', 'Dashboard::orderConfirmation/$1');
$routes->get('/orders', 'Dashboard::orders');

// Debug route
$routes->get('/debug', 'Dashboard::debug');

// Admin routes
$routes->group('admin', function($routes) {
    $routes->get('users', 'Admin::users');
    $routes->get('products', 'Admin::products');
    $routes->get('orders', 'Admin::orders');
    $routes->get('users/edit/(:num)', 'Admin::editUser/$1');
    $routes->post('users/update/(:num)', 'Admin::updateUser/$1');
    $routes->get('users/delete/(:num)', 'Admin::deleteUser/$1');
    $routes->post('users/create', 'Admin::createUser');
    $routes->get('add-product', 'Admin::addProduct');
    $routes->post('add-product', 'Admin::addProduct');
    $routes->get('edit-product/(:num)', 'Admin::editProduct/$1');
    $routes->post('edit-product/(:num)', 'Admin::editProduct/$1');
    $routes->get('delete-product/(:num)', 'Admin::deleteProduct/$1');
    $routes->post('update-order-status/(:num)', 'Admin::updateOrderStatus/$1');
});

//profiles
$routes->get('/profile', 'Profile::index');
$routes->get('/profile/edit', 'Profile::edit');
$routes->post('/profile/update', 'Profile::update');
$routes->post('/profile/updateUsername', 'Profile::updateUsername');
$routes->post('/profile/deleteProfilePicture', 'Profile::deleteProfilePicture');

// Product Management Routes
$routes->get('/admin/products', 'Admin::products');
$routes->post('/admin/products/create', 'Admin::createProduct');
$routes->get('/admin/products/edit/(:num)', 'Admin::editProduct/$1');
$routes->post('/admin/products/update/(:num)', 'Admin::updateProduct/$1');
$routes->get('/admin/products/delete/(:num)', 'Admin::deleteProduct/$1');
$routes->get('/admin/products/toggle-status/(:num)', 'Admin::toggleProductStatus/$1');
