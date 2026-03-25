<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Payment::index');
$routes->get('/payment', 'Payment::index');
$routes->post('/payment/process', 'Payment::process');
$routes->get('/payment/instructions/(:num)', 'Payment::instructions/$1');

$routes->get('/auth/login', 'Auth::login');
$routes->post('/auth/auth', 'Auth::auth');
$routes->get('/auth/logout', 'Auth::logout');

$routes->group('admin', function($routes) {
    $routes->get('/', 'Admin::index');
    $routes->get('profile', 'Admin::profile');
    $routes->post('profile_save', 'Admin::profile_save');
    $routes->get('nominals', 'Admin::nominals');
    $routes->post('nominal_save', 'Admin::nominal_save');
    $routes->get('nominal_delete/(:num)', 'Admin::nominal_delete/$1');
    $routes->get('payment_methods', 'Admin::payment_methods');
    $routes->post('pm_save', 'Admin::pm_save');
    $routes->get('pm_delete/(:num)', 'Admin::pm_delete/$1');
    
    // User Routes
    $routes->get('users', 'Admin::users');
    $routes->post('user_save', 'Admin::user_save');
    $routes->get('user_delete/(:num)', 'Admin::user_delete/$1');

    // Transaction Routes
    $routes->get('transactions', 'Admin::transactions');
    $routes->get('transaction_status/(:num)/(:any)', 'Admin::transaction_status/$1/$2');
    $routes->get('transaction_delete/(:num)', 'Admin::transaction_delete/$1');
});
